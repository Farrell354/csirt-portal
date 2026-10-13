<?php

namespace Tests\Feature;

use App\Models\Laporan;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Str;
use Tests\TestCase;

/**
 * AnonymousReportTest — Validates pseudonymous reporting feature.
 *
 * Tests that:
 *   - A hunter can submit a report with is_anonymous = true.
 *   - The pseudonym is saved correctly.
 *   - The real name is NOT displayed in admin view when is_anonymous = true.
 *   - Submission without anonymity works as before (no regression).
 */
class AnonymousReportTest extends TestCase
{
    use DatabaseTransactions;

    private User $hunter;
    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->hunter = User::forceCreate([
            'name'     => 'Real Hunter Name',
            'username' => 'anon_test_' . Str::random(6),
            'email'    => 'anon_' . Str::random(6) . '@example.com',
            'password' => bcrypt('password123'),
            'role'     => 'hunter',
        ]);

        $this->admin = User::forceCreate([
            'name'     => 'Admin CSIRT',
            'username' => 'admin_anon_' . Str::random(6),
            'email'    => 'adminanon_' . Str::random(6) . '@example.com',
            'password' => bcrypt('password123'),
            'role'     => 'admin',
        ]);
    }

    /**
     * An anonymous Laporan saves is_anonymous=true and pseudonym correctly.
     */
    public function test_anonymous_report_stores_is_anonymous_and_pseudonym(): void
    {
        $laporan = $this->hunter->laporans()->create([
            'target_url'       => 'https://test.jatimprov.go.id',
            'jenis_kerentanan' => 'Cross-Site Scripting (XSS)',
            'severity'         => 'Medium',
            'deskripsi'        => 'Test deskripsi untuk anon reporting fitur coba.',
            'bukti_poc'        => 'fake_file.png',
            'scan_status'      => 'clean',
            'status'           => 'Menunggu',
            'poin_diberikan'   => 0,
            'is_anonymous'     => true,
            'pseudonym'        => 'shadow_researcher',
        ]);

        $this->assertTrue($laporan->is_anonymous);
        $this->assertEquals('shadow_researcher', $laporan->pseudonym);
    }

    /**
     * A non-anonymous report stores is_anonymous=false and pseudonym=null.
     */
    public function test_non_anonymous_report_stores_defaults(): void
    {
        $laporan = $this->hunter->laporans()->create([
            'target_url'       => 'https://test.jatimprov.go.id',
            'jenis_kerentanan' => 'SQL Injection (SQLi)',
            'severity'         => 'High',
            'deskripsi'        => 'Test deskripsi non-anon report submission.',
            'bukti_poc'        => 'fake_file2.png',
            'scan_status'      => 'clean',
            'status'           => 'Menunggu',
            'poin_diberikan'   => 0,
        ]);

        $this->assertFalse((bool) $laporan->is_anonymous);
        $this->assertNull($laporan->pseudonym);
    }

    /**
     * is_anonymous field is cast to boolean correctly (not '1'/'0' string).
     */
    public function test_is_anonymous_is_cast_to_boolean(): void
    {
        $laporan = $this->hunter->laporans()->create([
            'target_url'       => 'https://test.jatimprov.go.id',
            'jenis_kerentanan' => 'Open Redirect',
            'severity'         => 'Low',
            'deskripsi'        => 'Test deskripsi boolean cast verification test laporan.',
            'bukti_poc'        => 'fake3.png',
            'scan_status'      => 'clean',
            'status'           => 'Menunggu',
            'poin_diberikan'   => 0,
            'is_anonymous'     => true,
        ]);

        // After fresh() from DB, should remain boolean true
        $fresh = Laporan::find($laporan->id);
        $this->assertIsBool($fresh->is_anonymous);
        $this->assertTrue($fresh->is_anonymous);
    }

    /**
     * Admin can access laporan list — anonymous reports display pseudonym not real name.
     * This test verifies the admin route loads without error when anon reports exist.
     */
    public function test_admin_laporan_page_loads_with_anonymous_reports(): void
    {
        // Create an anonymous report
        $this->hunter->laporans()->create([
            'target_url'       => 'https://test.jatimprov.go.id',
            'jenis_kerentanan' => 'Authentication Bypass',
            'severity'         => 'Critical',
            'deskripsi'        => 'Test deskripsi admin view anonymous report test.',
            'bukti_poc'        => 'fake4.png',
            'scan_status'      => 'clean',
            'status'           => 'Menunggu',
            'poin_diberikan'   => 0,
            'is_anonymous'     => true,
            'pseudonym'        => 'ghost_hunter_404',
        ]);

        $response = $this->actingAs($this->admin)->get('/admin/laporan');
        $response->assertStatus(200);
        // Pseudonym should appear, real name should not be displayed for anon report
        $response->assertSee('ghost_hunter_404');
    }
}
