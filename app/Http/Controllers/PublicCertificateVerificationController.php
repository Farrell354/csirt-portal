<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Response;
use Illuminate\View\View;

/**
 * PublicCertificateVerificationController — Public Verification Endpoint (UU PDP Compliant)
 *
 * Verifies certificate integrity and legitimacy to the public without leaking private PII.
 */
class PublicCertificateVerificationController extends Controller
{
    /**
     * Display public certificate verification page.
     */
    public function show(string $uuid): View|Response
    {
        try {
            /** @var Certificate|null $certificate */
            $certificate = Certificate::with(['report', 'user'])->find($uuid);
        } catch (\Throwable) {
            $certificate = null;
        }

        if (! $certificate instanceof Certificate) {
            return response()->view('certificate-verify-invalid', [
                'attemptedUuid' => $uuid,
            ], 404);
        }

        $report = $certificate->report;
        $user   = $certificate->user;

        // UU PDP No. 27/2022 Data Minimization:
        // Mask identity if report was submitted anonymously.
        if ($report->is_anonymous) {
            $displayName = $report->pseudonym ? $report->pseudonym . ' (Anonim / Pseudonim)' : 'Peneliti Keamanan Anonim';
            $isMasked = true;
        } else {
            $displayName = $user->name ?: 'Peneliti Keamanan';
            $isMasked = false;
        }

        $targetHost = parse_url($report->target_url, PHP_URL_HOST) ?: $report->target_url;

        return view('certificate-verify', [
            'certificate' => $certificate,
            'report'      => $report,
            'displayName' => $displayName,
            'isMasked'    => $isMasked,
            'targetHost'  => $targetHost,
        ]);
    }
}
