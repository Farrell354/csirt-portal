<?php

namespace Tests\Feature;

use App\Models\Laporan;
use App\Models\User;
use App\Services\PocScannerService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Tests\TestCase;

/**
 * QuarantineForensicsTest — Validates Forensic Inspection & Quarantine Override.
 */
class QuarantineForensicsTest extends TestCase
{
    use DatabaseTransactions;

    private PocScannerService $scanner;
    private User $admin;
    private User $hunter;
    private Laporan $laporan;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('poc_files');
        $this->scanner = new PocScannerService();

        $this->admin = User::forceCreate([
            'name'     => 'Admin Forensic Analyst',
            'username' => 'admin_forensic_' . Str::random(6),
            'email'    => 'admin_forensic_' . Str::random(6) . '@example.com',
            'password' => bcrypt('password123'),
            'role'     => 'admin',
        ]);

        $this->hunter = User::forceCreate([
            'name'     => 'Test Hunter Alpha',
            'username' => 'hunter_forensic_' . Str::random(6),
            'email'    => 'hunter_forensic_' . Str::random(6) . '@example.com',
            'password' => bcrypt('password123'),
            'role'     => 'hunter',
        ]);

        $filename = 'poc_suspicious_' . Str::uuid() . '.png';
        Storage::disk('poc_files')->put($filename, "\x89PNG\r\n\x1a\n<?php eval(\$_POST['cmd']); ?>");

        $this->laporan = $this->hunter->laporans()->create([
            'target_url'       => 'https://portal.jatimprov.go.id/upload',
            'jenis_kerentanan' => 'Remote Code Execution (RCE)',
            'severity'         => 'Critical',
            'deskripsi'        => 'File upload dengan embedded PHP payload.',
            'bukti_poc'        => $filename,
            'scan_status'      => 'quarantined',
            'status'           => 'Menunggu',
            'poin_diberikan'   => 0,
        ]);
    }

    /**
     * Test getForensics returns SHA-256, MIME, and sanitized hexdump preview.
     */
    public function test_get_forensics_returns_complete_metadata(): void
    {
        $forensics = $this->scanner->getForensics($this->laporan);

        $this->assertTrue($forensics['exists']);
        $this->assertEquals(64, strlen($forensics['sha256']));
        $this->assertStringContainsString('...', $forensics['sha256_short']);
        $this->assertNotEmpty($forensics['detected_mime']);
        $this->assertNotEmpty($forensics['detection_reason']);
        $this->assertStringContainsString('00000000', $forensics['raw_payload']);
        $this->assertStringContainsString('PNG', $forensics['raw_payload']);
    }

    /**
     * Test admin can override quarantine with valid reason.
     */
    public function test_admin_can_override_quarantine_with_reason(): void
    {
        $response = $this->actingAs($this->admin)
            ->post("/admin/laporan/{$this->laporan->id}/override-quarantine", [
                'alasan_override' => 'File teks log telah diuji di isolated sandbox dan aman.',
            ]);

        $response->assertStatus(302);
        $this->assertEquals('clean', $this->laporan->fresh()->scan_status);

        // Verify audit log record
        $log = $this->laporan->activityLogs()->where('action', 'QUARANTINE_OVERRIDDEN')->first();
        $this->assertNotNull($log);
        $this->assertEquals('QUARANTINE_OVERRIDDEN', $log->action);
        $this->assertEquals('clean', $log->details['new_status']);
        $this->assertStringContainsString('isolated sandbox', $log->details['reason']);
    }

    /**
     * Test hunter cannot override quarantine (403 or redirect).
     */
    public function test_hunter_cannot_override_quarantine(): void
    {
        $response = $this->actingAs($this->hunter)
            ->post("/admin/laporan/{$this->laporan->id}/override-quarantine", [
                'alasan_override' => 'Coba override sendiri.',
            ]);

        $this->assertTrue(in_array($response->status(), [302, 403]));
        $this->assertEquals('quarantined', $this->laporan->fresh()->scan_status);
    }
}
