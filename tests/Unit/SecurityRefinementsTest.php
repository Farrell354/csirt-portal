<?php

namespace Tests\Unit;

use App\Models\Laporan;
use App\Models\LaporanActivityLog;
use App\Models\User;
use App\Policies\LaporanPolicy;
use PHPUnit\Framework\TestCase;

class SecurityRefinementsTest extends TestCase
{
    /**
     * Test deterministic blind-index email hashing (normalized lowercase and trimmed).
     */
    public function test_blind_index_email_hash_is_deterministic(): void
    {
        $hash1 = User::hashEmail('hunter@example.com');
        $hash2 = User::hashEmail('  HUNTER@EXAMPLE.COM  ');
        $hash3 = User::hashEmail('different@example.com');

        $this->assertEquals($hash1, $hash2);
        $this->assertNotEquals($hash1, $hash3);
        $this->assertEquals(64, strlen($hash1)); // 64 hex characters for SHA-256
    }

    /**
     * Test action separation between external hunter-visible actions and internal CSIRT actions.
     */
    public function test_activity_log_actions_are_strictly_separated(): void
    {
        $external = LaporanActivityLog::EXTERNAL_ACTIONS;
        $internal = LaporanActivityLog::INTERNAL_ACTIONS;

        // No action should be in both external and internal lists
        $intersection = array_intersect($external, $internal);
        $this->assertEmpty($intersection);

        $this->assertContains('REPORT_SUBMITTED', $external);
        $this->assertContains('STATUS_UPDATED', $external);
        $this->assertContains('CVSS_ASSIGNED', $external);

        $this->assertContains('DISPOSITION_SENT', $internal);
        $this->assertContains('POC_SCANNED', $internal);
        $this->assertContains('QUARANTINE_OVERRIDDEN', $internal);
    }

    /**
     * Test LaporanPolicy::viewActivityLog data privacy rules.
     */
    public function test_policy_restricts_internal_logs_from_hunters(): void
    {
        $policy = new LaporanPolicy();

        $admin = new User();
        $admin->id = 1;
        $admin->role = 'admin';

        $hunterA = new User();
        $hunterA->id = 2;
        $hunterA->role = 'hunter';

        $hunterB = new User();
        $hunterB->id = 3;
        $hunterB->role = 'hunter';

        $laporan = new Laporan();
        $laporan->id = '01a07ade-0000-4000-8000-000000000001';
        $laporan->user_id = 2; // Owned by Hunter A

        $externalLog = new LaporanActivityLog();
        $externalLog->action = 'STATUS_UPDATED';

        $internalLog = new LaporanActivityLog();
        $internalLog->action = 'DISPOSITION_SENT';

        // Admin bypass via before()
        $this->assertTrue($policy->before($admin, 'viewActivityLog'));

        // Hunter A viewing external log on their own report -> ALLOWED
        $this->assertTrue($policy->viewActivityLog($hunterA, $laporan, $externalLog));

        // Hunter A viewing internal log (DISPOSITION_SENT) -> FORBIDDEN
        $this->assertFalse($policy->viewActivityLog($hunterA, $laporan, $internalLog));

        // Hunter B viewing Hunter A's report logs -> FORBIDDEN
        $this->assertFalse($policy->viewActivityLog($hunterB, $laporan, $externalLog));
        $this->assertFalse($policy->viewActivityLog($hunterB, $laporan, $internalLog));
    }
}
