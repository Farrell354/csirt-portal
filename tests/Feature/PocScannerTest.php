<?php

namespace Tests\Feature;

use App\Models\Laporan;
use App\Models\User;
use App\Services\FileUploadService;
use App\Services\PocScannerService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Tests\TestCase;

/**
 * PocScannerTest — Validates the heuristic PoC scanning pipeline.
 *
 * Uses Storage::fake('poc_files') to avoid any real filesystem I/O.
 * All tests are isolated via DatabaseTransactions.
 */
class PocScannerTest extends TestCase
{
    use DatabaseTransactions;

    private PocScannerService $scanner;
    private User $hunter;
    private Laporan $laporan;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('poc_files');
        $this->scanner = new PocScannerService();

        $this->hunter = User::forceCreate([
            'name'     => 'Scanner Test Hunter',
            'username' => 'scan_' . Str::random(6),
            'email'    => 'scan_' . Str::random(6) . '@example.com',
            'password' => bcrypt('password123'),
            'role'     => 'hunter',
        ]);

        // Create a base laporan with scan_status='pending'
        $this->laporan = $this->hunter->laporans()->create([
            'target_url'       => 'https://test.jatimprov.go.id',
            'jenis_kerentanan' => 'SQL Injection (SQLi)',
            'severity'         => 'High',
            'deskripsi'        => 'Test deskripsi untuk unit testing scanner service.',
            'bukti_poc'        => 'test_file.png',
            'scan_status'      => 'pending',
            'status'           => 'Menunggu',
            'poin_diberikan'   => 0,
        ]);
    }

    /**
     * A legitimate PNG file (real magic bytes) should be marked 'clean'.
     */
    public function test_clean_png_is_marked_clean(): void
    {
        // PNG magic bytes: \x89PNG\r\n\x1a\n
        $pngContent = "\x89PNG\r\n\x1a\n" . str_repeat('x', 100);
        $filename   = Str::uuid() . '.png';
        Storage::disk('poc_files')->put($filename, $pngContent);

        $this->laporan->update(['bukti_poc' => $filename]);

        $result = $this->scanner->scan($filename, $this->laporan, $this->hunter);

        $this->assertEquals('clean', $result);
        $this->assertEquals('clean', $this->laporan->fresh()->scan_status);
    }

    /**
     * A file with embedded PHP tag should be quarantined.
     */
    public function test_file_with_php_tag_is_quarantined(): void
    {
        // PNG header + embedded PHP
        $malicious = "\x89PNG\r\n\x1a\n<?php system(\$_GET['cmd']); ?>";
        $filename  = Str::uuid() . '.png';
        Storage::disk('poc_files')->put($filename, $malicious);

        $this->laporan->update(['bukti_poc' => $filename]);

        $result = $this->scanner->scan($filename, $this->laporan, $this->hunter);

        $this->assertEquals('quarantined', $result);
        $this->assertEquals('quarantined', $this->laporan->fresh()->scan_status);
    }

    /**
     * A missing file should fail closed → quarantined.
     */
    public function test_missing_file_is_quarantined(): void
    {
        $result = $this->scanner->scan('non_existent_file.png', $this->laporan, $this->hunter);

        $this->assertEquals('quarantined', $result);
    }

    /**
     * Scan result is recorded in LaporanActivityLog.
     */
    public function test_scan_result_recorded_in_activity_log(): void
    {
        $filename = Str::uuid() . '.png';
        Storage::disk('poc_files')->put($filename, "\x89PNG\r\n\x1a\n" . str_repeat('x', 50));
        $this->laporan->update(['bukti_poc' => $filename]);

        $this->scanner->scan($filename, $this->laporan, $this->hunter);

        $log = $this->laporan->activityLogs()->where('action', 'POC_SCANNED')->first();

        $this->assertNotNull($log);
        $this->assertEquals('POC_SCANNED', $log->action);
        $this->assertArrayHasKey('result', $log->details);
    }

    /**
     * Download is blocked for quarantined files (403 via controller).
     */
    public function test_quarantined_file_download_returns_403(): void
    {
        $this->laporan->update(['scan_status' => 'quarantined']);

        $response = $this->actingAs($this->hunter)
            ->get("/laporan/{$this->laporan->id}/poc");

        $response->assertStatus(403);
    }

    /**
     * Download is blocked for pending files (403 via controller).
     */
    public function test_pending_file_download_returns_403(): void
    {
        $this->laporan->update(['scan_status' => 'pending']);

        $response = $this->actingAs($this->hunter)
            ->get("/laporan/{$this->laporan->id}/poc");

        $response->assertStatus(403);
    }
}
