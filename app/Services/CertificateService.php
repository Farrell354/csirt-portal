<?php

namespace App\Services;

use App\Models\Certificate;
use App\Models\Laporan;
use App\Models\LaporanActivityLog;
use App\Models\User;
use DomainException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * CertificateService — Orchestrates Certificate of Appreciation Generation & Retrieval
 */
class CertificateService
{
    public function __construct(
        private readonly CertificatePdfService $pdfService
    ) {}

    /**
     * Generate an official Certificate of Appreciation for a validated report.
     *
     * @param Laporan $report
     * @param User $issuer
     * @return Certificate
     *
     * @throws DomainException If report is not valid or already has a certificate.
     */
    public function generateForReport(Laporan $report, User $issuer): Certificate
    {
        // 1. Validation of business rules
        if ($report->status !== 'Valid') {
            throw new DomainException("Sertifikat hanya dapat diterbitkan untuk laporan dengan status 'Valid'. Status saat ini: {$report->status}.");
        }

        if ($report->certificate()->exists()) {
            throw new DomainException("Sertifikat penghargaan telah diterbitkan sebelumnya untuk laporan ini.");
        }

        /** @var User $hunter */
        $hunter = $report->user;

        // 2. Prepare metadata & identifiers
        $certificateId = (string) Str::uuid();
        $certNumber = 'CERT/CSIRT-JTM/' . now()->format('Y/m') . '/' . strtoupper(Str::random(6));
        $issuedAt = now();
        $severity = $report->severity ?: 'Medium';
        $cvssScore = $report->cvss_score;

        // Canonical verification hash (SHA-256)
        $hashPayload = implode('|', [
            $certificateId,
            $report->id,
            $hunter->id,
            $certNumber,
            $issuedAt->toIso8601String(),
            $severity,
            (string) $cvssScore,
        ]);
        $verificationHash = hash('sha256', $hashPayload);

        // Verification URL
        $verificationUrl = url('/verify-certificate/' . $certificateId);

        // 3. Instantiate model instance for rendering
        $certificate = new Certificate([
            'report_id'          => $report->id,
            'user_id'            => $hunter->id,
            'certificate_number' => $certNumber,
            'issued_at'          => $issuedAt,
            'cvss_score'         => $cvssScore,
            'severity'           => $severity,
            'verification_hash'  => $verificationHash,
        ]);
        $certificate->id = $certificateId;

        // 4. Generate PDF binary content
        $pdfBinary = $this->pdfService->generate($certificate, $report, $hunter, $verificationUrl);

        // 5. Store PDF in private storage disk
        $storageFilename = $certificateId . '.pdf';
        $disk = Storage::disk('certificates');
        $disk->put($storageFilename, $pdfBinary);

        $certificate->pdf_path = $storageFilename;

        // 6. Persist to database within transaction
        DB::transaction(function () use ($certificate, $report, $issuer, $hunter) {
            $certificate->save();

            // Record audit log entry
            LaporanActivityLog::record(
                laporan: $report,
                causer:  $issuer,
                action:  'CERTIFICATE_ISSUED',
                details: [
                    'certificate_id'     => $certificate->id,
                    'certificate_number' => $certificate->certificate_number,
                    'recipient_user_id'  => $hunter->id,
                    'verification_hash'  => $certificate->verification_hash,
                ]
            );
        });

        return $certificate;
    }

    /**
     * Download the certificate PDF file from private storage.
     *
     * @param Certificate $certificate
     * @return StreamedResponse
     */
    public function download(Certificate $certificate): StreamedResponse
    {
        $disk = Storage::disk('certificates');

        if (! $certificate->pdf_path || ! $disk->exists($certificate->pdf_path)) {
            abort(404, 'File sertifikat tidak ditemukan dalam penyimpanan.');
        }

        $safeDownloadName = 'Sertifikat-Penghargaan-' . str_replace(['/', '\\'], '-', $certificate->certificate_number) . '.pdf';

        return $disk->download(
            $certificate->pdf_path,
            $safeDownloadName,
            [
                'Content-Type'        => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="' . $safeDownloadName . '"',
                'X-Content-Type-Options' => 'nosniff',
            ]
        );
    }
}
