<?php

namespace Tests\Feature\Security;

use App\Models\Certificate;
use App\Models\Laporan;
use App\Models\User;
use App\Policies\CertificatePolicy;
use App\Services\CertificatePdfService;
use App\Services\CertificateService;
use App\Services\QrCodeService;
use DomainException;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/**
 * CertificateTest — Automated Security & Functional Test Suite for VDP Certificates
 */
class CertificateTest extends TestCase
{
    private QrCodeService $qrCodeService;
    private CertificatePdfService $pdfService;
    private CertificatePolicy $policy;

    protected function setUp(): void
    {
        parent::setUp();
        $this->qrCodeService = new QrCodeService();
        $this->pdfService = new CertificatePdfService($this->qrCodeService);
        $this->policy = new CertificatePolicy();
    }

    /**
     * Test QR Code generator creates valid SVG markup with vector modules.
     */
    public function test_qr_code_service_generates_valid_svg_matrix(): void
    {
        $payload = 'https://csirt.jatimprov.go.id/verify-certificate/01923456-789a-bcde-f012-3456789abcde';
        $matrix = $this->qrCodeService->generateMatrix($payload);

        $this->assertIsArray($matrix);
        $this->assertGreaterThanOrEqual(33, count($matrix)); // Version 4+
        $this->assertEquals(count($matrix), count($matrix[0])); // Square matrix

        $svg = $this->qrCodeService->generateSvg($payload, 220);
        $this->assertStringStartsWith('<svg', trim($svg));
        $this->assertStringContainsString('xmlns="http://www.w3.org/2000/svg"', $svg);
        $this->assertStringContainsString('<path fill="#0f172a"', $svg);
    }

    /**
     * Test Certificate PDF generator outputs standard, valid PDF binary syntax.
     */
    public function test_certificate_pdf_service_generates_valid_vector_pdf(): void
    {
        $hunter = new User();
        $hunter->id = 42;
        $hunter->name = 'Budi Wicaksono';

        $report = new Laporan();
        $report->id = '01923456-789a-bcde-f012-3456789abcde';
        $report->target_url = 'https://portal.jatimprov.go.id/admin';
        $report->jenis_kerentanan = 'SQL Injection (SQLi)';
        $report->severity = 'Critical';
        $report->cvss_score = 9.8;
        $report->is_anonymous = false;

        $cert = new Certificate();
        $cert->id = '01999999-aaaa-bbbb-cccc-dddddddddddd';
        $cert->certificate_number = 'CERT/CSIRT-JTM/2026/09/TEST01';
        $cert->issued_at = now();
        $cert->severity = 'Critical';
        $cert->cvss_score = 9.8;
        $cert->verification_hash = hash('sha256', 'test-cert-signature');

        $verifyUrl = 'https://csirt.jatimprov.go.id/verify-certificate/' . $cert->id;

        $pdf = $this->pdfService->generate($cert, $report, $hunter, $verifyUrl);

        $this->assertStringStartsWith('%PDF-1.4', $pdf);
        $this->assertStringContainsString('%%EOF', $pdf);
        $this->assertStringContainsString('/Type /Catalog', $pdf);
        $this->assertStringContainsString('/MediaBox [0 0 841.89 595.28]', $pdf);
        $this->assertStringContainsString('CERTIFICATE OF APPRECIATION', $pdf);
        $this->assertStringContainsString('Budi Wicaksono', $pdf);
        $this->assertStringContainsString('CERT/CSIRT-JTM/2026/09/TEST01', $pdf);
    }

    /**
     * Test Certificate PDF service properly masks recipient identity for anonymous reports.
     */
    public function test_certificate_pdf_respects_anonymous_reporting(): void
    {
        $hunter = new User();
        $hunter->id = 77;
        $hunter->name = 'Real Secret Name';

        $report = new Laporan();
        $report->id = '01923456-789a-bcde-f012-3456789abcde';
        $report->target_url = 'https://dinkes.jatimprov.go.id';
        $report->jenis_kerentanan = 'Cross-Site Scripting (XSS)';
        $report->severity = 'Medium';
        $report->cvss_score = 6.1;
        $report->is_anonymous = true;
        $report->pseudonym = 'ghost_rider_jatim';

        $cert = new Certificate();
        $cert->id = '01888888-1111-2222-3333-444444444444';
        $cert->certificate_number = 'CERT/CSIRT-JTM/2026/09/ANON01';
        $cert->issued_at = now();
        $cert->severity = 'Medium';
        $cert->cvss_score = 6.1;
        $cert->verification_hash = hash('sha256', 'anon-signature');

        $verifyUrl = 'https://csirt.jatimprov.go.id/verify-certificate/' . $cert->id;

        $pdf = $this->pdfService->generate($cert, $report, $hunter, $verifyUrl);

        $this->assertStringContainsString('ghost_rider_jatim', $pdf);
        $this->assertStringNotContainsString('Real Secret Name', $pdf);
    }

    /**
     * Test Anti-IDOR Policy: Hunter can only view and download their own certificate.
     */
    public function test_certificate_policy_enforces_anti_idor_ownership(): void
    {
        $admin = new User();
        $admin->id = 1;
        $admin->role = 'admin';

        $hunterA = new User();
        $hunterA->id = 10;
        $hunterA->role = 'hunter';

        $hunterB = new User();
        $hunterB->id = 20;
        $hunterB->role = 'hunter';

        $certA = new Certificate();
        $certA->user_id = 10; // Belongs to Hunter A

        // Admin can view and download any certificate
        $this->assertTrue($this->policy->before($admin, 'view'));
        $this->assertTrue($this->policy->before($admin, 'download'));
        $this->assertTrue($this->policy->create($admin));

        // Hunter A can view and download their own certificate
        $this->assertTrue($this->policy->view($hunterA, $certA));
        $this->assertTrue($this->policy->download($hunterA, $certA));

        // Hunter B CANNOT view or download Hunter A's certificate (Strict IDOR prevention)
        $this->assertFalse($this->policy->view($hunterB, $certA));
        $this->assertFalse($this->policy->download($hunterB, $certA));

        // Hunters cannot create/issue certificates
        $this->assertFalse($this->policy->create($hunterA));
    }

    /**
     * Test CertificateService rejects reports that are not in 'Valid' status.
     */
    public function test_certificate_service_rejects_unvalidated_report(): void
    {
        $admin = new User();
        $admin->id = 1;
        $admin->role = 'admin';

        $report = new Laporan();
        $report->id = '01923456-789a-bcde-f012-3456789abcde';
        $report->status = 'Menunggu'; // Not Valid

        $service = new CertificateService($this->pdfService);

        $this->expectException(DomainException::class);
        $this->expectExceptionMessage("Sertifikat hanya dapat diterbitkan untuk laporan dengan status 'Valid'.");

        $service->generateForReport($report, $admin);
    }

    /**
     * Test download method streams file from private storage disk with correct headers.
     */
    public function test_certificate_service_download_from_private_storage(): void
    {
        Storage::fake('certificates');

        $disk = Storage::disk('certificates');
        $disk->put('test-cert-uuid.pdf', '%PDF-1.4 Dummy PDF Content %%EOF');

        $cert = new Certificate();
        $cert->id = 'test-cert-uuid';
        $cert->certificate_number = 'CERT/CSIRT-JTM/2026/09/DL001';
        $cert->pdf_path = 'test-cert-uuid.pdf';

        $service = new CertificateService($this->pdfService);
        $response = $service->download($cert);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('application/pdf', (string) $response->headers->get('Content-Type'));
        $this->assertEquals('nosniff', $response->headers->get('X-Content-Type-Options'));
    }

    /**
     * Test public verification route returns 404 for non-existent certificate UUID.
     */
    public function test_public_verification_returns_404_for_unknown_uuid(): void
    {
        $response = $this->get('/verify-certificate/non-existent-random-uuid-999');

        $response->assertStatus(404);
        $response->assertSee('Sertifikat Tidak Ditemukan / Tidak Valid');
    }

    /**
     * Test public verification view displays valid certificate details.
     */
    public function test_public_verification_view_displays_valid_certificate_details(): void
    {
        $hunter = new User();
        $hunter->id = 15;
        $hunter->name = 'Arya Cyber';

        $report = new Laporan();
        $report->id = '01923456-789a-bcde-f012-3456789abcde';
        $report->target_url = 'https://portal.jatimprov.go.id';
        $report->jenis_kerentanan = 'Remote Code Execution (RCE)';
        $report->severity = 'Critical';
        $report->cvss_score = 9.8;
        $report->is_anonymous = false;

        $cert = new Certificate();
        $cert->id = '01999999-aaaa-bbbb-cccc-dddddddddddd';
        $cert->certificate_number = 'CERT/CSIRT-JTM/2026/09/VAL001';
        $cert->issued_at = now();
        $cert->severity = 'Critical';
        $cert->cvss_score = 9.8;
        $cert->verification_hash = hash('sha256', 'sample-valid-hash');

        $view = $this->view('certificate-verify', [
            'certificate' => $cert,
            'report'      => $report,
            'displayName' => 'Arya Cyber',
            'isMasked'    => false,
            'targetHost'  => 'portal.jatimprov.go.id',
        ]);

        $view->assertSee('VALID &amp; RESMI DITERBITKAN', false);
        $view->assertSee('CERT/CSIRT-JTM/2026/09/VAL001');
        $view->assertSee('Arya Cyber');
        $view->assertSee('Remote Code Execution (RCE)');
        $view->assertSee('portal.jatimprov.go.id');
        $view->assertSee($cert->verification_hash);
    }

    /**
     * Test public verification view masks identity when report is anonymous (UU PDP).
     */
    public function test_public_verification_view_masks_anonymous_identity(): void
    {
        $hunter = new User();
        $hunter->id = 88;
        $hunter->name = 'Very Real Private Name';

        $report = new Laporan();
        $report->id = '01923456-789a-bcde-f012-3456789abcde';
        $report->target_url = 'https://bkd.jatimprov.go.id';
        $report->jenis_kerentanan = 'Cross-Site Scripting (XSS)';
        $report->severity = 'Medium';
        $report->cvss_score = 6.1;
        $report->is_anonymous = true;
        $report->pseudonym = 'anon_sec_99';

        $cert = new Certificate();
        $cert->id = '01999999-aaaa-bbbb-cccc-dddddddddddd';
        $cert->certificate_number = 'CERT/CSIRT-JTM/2026/09/ANON02';
        $cert->issued_at = now();
        $cert->severity = 'Medium';
        $cert->cvss_score = 6.1;
        $cert->verification_hash = hash('sha256', 'sample-anon-hash');

        $view = $this->view('certificate-verify', [
            'certificate' => $cert,
            'report'      => $report,
            'displayName' => 'anon_sec_99 (Anonim / Pseudonim)',
            'isMasked'    => true,
            'targetHost'  => 'bkd.jatimprov.go.id',
        ]);

        $view->assertSee('anon_sec_99 (Anonim / Pseudonim)');
        $view->assertSee('Identitas Dilindungi (UU PDP No. 27/2022)');
        $view->assertDontSee('Very Real Private Name');
    }

    /**
     * Test activity log vocabulary includes CERTIFICATE_ISSUED.
     */
    public function test_activity_log_includes_certificate_issued(): void
    {
        $externalActions = \App\Models\LaporanActivityLog::EXTERNAL_ACTIONS;
        $this->assertContains('CERTIFICATE_ISSUED', $externalActions);
    }
}
