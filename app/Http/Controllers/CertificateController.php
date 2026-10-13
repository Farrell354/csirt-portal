<?php

namespace App\Http\Controllers;

use App\Http\Requests\IssueCertificateRequest;
use App\Models\Certificate;
use App\Models\Laporan;
use App\Services\CertificateService;
use DomainException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * CertificateController — Handles Certificate Issuance & Secure Hunter Downloads
 */
class CertificateController extends Controller
{
    public function __construct(
        private readonly CertificateService $certificateService
    ) {}

    /**
     * Issue a new Certificate of Appreciation for a validated report (Admin only).
     */
    public function issue(IssueCertificateRequest $request, Laporan $laporan): RedirectResponse
    {
        Gate::authorize('create', Certificate::class);

        /** @var \App\Models\User $admin */
        $admin = $request->user();

        try {
            $certificate = $this->certificateService->generateForReport($laporan, $admin);

            return redirect()->route('admin.laporan.show', $laporan)
                ->with('status', 'certificate-issued')
                ->with('success', "Sertifikat penghargaan resmi ({$certificate->certificate_number}) berhasil diterbitkan dan siap diunduh oleh pelapor.");
        } catch (DomainException $e) {
            return redirect()->route('admin.laporan.show', $laporan)
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Securely download a certificate PDF file (Hunter owner or Admin only).
     *
     * Guarded by CertificatePolicy@download (Strict Anti-IDOR).
     */
    public function download(Certificate $certificate): StreamedResponse
    {
        Gate::authorize('download', $certificate);

        return $this->certificateService->download($certificate);
    }
}
