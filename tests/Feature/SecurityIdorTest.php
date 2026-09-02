<?php

namespace Tests\Feature;

use App\Models\Laporan;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Tests\TestCase;

class SecurityIdorTest extends TestCase
{
    use DatabaseTransactions;

    private User $hunterA;
    private User $hunterB;
    private User $admin;
    private Laporan $laporanA;
    private Laporan $laporanB;

    protected function setUp(): void
    {
        parent::setUp();

        // Fake isolated private storage disk
        Storage::fake('poc_files');

        // Create Hunter A & PoC
        $this->hunterA = User::forceCreate([
            'name'     => 'Hunter Alpha',
            'username' => 'hunter_alpha_' . Str::random(6),
            'email'    => 'alpha_' . Str::random(6) . '@example.com',
            'password' => bcrypt('password123'),
            'role'     => 'hunter',
        ]);

        $fileA = 'test_poc_a_' . Str::uuid() . '.png';
        Storage::disk('poc_files')->put($fileA, 'fake_png_data');

        $this->laporanA = $this->hunterA->laporans()->create([
            'target_url'       => 'https://victim.jatimprov.go.id/vuln',
            'jenis_kerentanan' => 'SQL Injection (SQLi)',
            'severity'         => 'High',
            'deskripsi'        => 'Ditemukan SQL Injection pada parameter id yang dapat mengekstrak data.',
            'bukti_poc'        => $fileA,
            'status'           => 'Menunggu',
            'poin_diberikan'   => 0,
        ]);

        // Create Hunter B & PoC
        $this->hunterB = User::forceCreate([
            'name'     => 'Hunter Beta',
            'username' => 'hunter_beta_' . Str::random(6),
            'email'    => 'beta_' . Str::random(6) . '@example.com',
            'password' => bcrypt('password123'),
            'role'     => 'hunter',
        ]);

        $fileB = 'test_poc_b_' . Str::uuid() . '.png';
        Storage::disk('poc_files')->put($fileB, 'fake_png_data');

        $this->laporanB = $this->hunterB->laporans()->create([
            'target_url'       => 'https://portal.jatimprov.go.id/xss',
            'jenis_kerentanan' => 'Cross-Site Scripting (XSS)',
            'severity'         => 'Medium',
            'deskripsi'        => 'Ditemukan Stored XSS pada form komentar yang dapat mencuri session cookie.',
            'bukti_poc'        => $fileB,
            'status'           => 'Menunggu',
            'poin_diberikan'   => 0,
        ]);

        // Create Admin CSIRT
        $this->admin = User::forceCreate([
            'name'     => 'Admin CSIRT',
            'username' => 'admin_test_' . Str::random(6),
            'email'    => 'admin_' . Str::random(6) . '@example.com',
            'password' => bcrypt('password123'),
            'role'     => 'admin',
        ]);
    }

    /**
     * Anti-IDOR: Primary Key of Laporan must be a valid UUID v4 (not sequential integer).
     */
    public function test_laporan_primary_key_is_uuid_v4(): void
    {
        $this->assertTrue(Str::isUuid($this->laporanA->id));
        $this->assertTrue(Str::isUuid($this->laporanB->id));
        $this->assertIsString($this->laporanA->id);
    }

    /**
     * Anti-IDOR: Hunter A MUST NOT be able to download Hunter B's PoC file (403 Forbidden).
     */
    public function test_hunter_cannot_download_another_hunters_poc_file(): void
    {
        $response = $this->actingAs($this->hunterA)
            ->get("/laporan/{$this->laporanB->id}/poc");

        $response->assertStatus(403);
    }

    /**
     * Access Control: Hunter A CAN download their own PoC file (200 OK Streamed).
     */
    public function test_hunter_can_download_their_own_poc_file(): void
    {
        $response = $this->actingAs($this->hunterA)
            ->get("/laporan/{$this->laporanA->id}/poc");

        $response->assertStatus(200);
        $response->assertHeader('content-disposition');
    }

    /**
     * Access Control: Admin CSIRT CAN download any report's PoC file (200 OK Streamed).
     */
    public function test_admin_can_download_any_hunters_poc_file(): void
    {
        $response = $this->actingAs($this->admin)
            ->get("/laporan/{$this->laporanA->id}/poc");

        $response->assertStatus(200);
    }

    /**
     * Access Control: Non-admin (Hunter) MUST NOT be able to access the validation endpoint.
     */
    public function test_hunter_cannot_validate_or_score_laporan(): void
    {
        $response = $this->actingAs($this->hunterA)
            ->post("/admin/laporan/{$this->laporanA->id}/validasi", [
                'status' => 'Valid',
                'poin'   => 100,
            ]);

        // Blocked by 'role:admin' middleware (redirect) or policy (403)
        $this->assertTrue(in_array($response->status(), [302, 403]));
    }

    /**
     * Access Control: Admin CSIRT CAN validate and score reports.
     */
    public function test_admin_can_validate_laporan(): void
    {
        $response = $this->actingAs($this->admin)
            ->post("/admin/laporan/{$this->laporanA->id}/validasi", [
                'status' => 'Valid',
                'poin'   => 75,
            ]);

        $response->assertStatus(302);
        $this->laporanA->refresh();
        $this->assertEquals('Valid', $this->laporanA->status);
        $this->assertEquals(75, $this->laporanA->poin_diberikan);
    }

    /**
     * Guest access must be rejected.
     */
    public function test_unauthenticated_guest_cannot_download_poc(): void
    {
        $response = $this->get("/laporan/{$this->laporanA->id}/poc");
        $response->assertRedirect('/login');
    }
}
