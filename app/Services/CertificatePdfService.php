<?php

namespace App\Services;

use App\Models\Certificate;
use App\Models\Laporan;
use App\Models\User;

/**
 * CertificatePdfService — Generates Official JatimProv-CSIRT PDF Certificates
 *
 * Produces crisp, vector-standard A4 landscape PDF documents (841.89 x 595.28 pt).
 * Built entirely in pure PHP with zero external dependencies and zero GD/Imagick requirements.
 */
class CertificatePdfService
{
    public function __construct(
        private readonly QrCodeService $qrCodeService
    ) {}

    /**
     * Render the Certificate into a binary PDF string.
     *
     * @param Certificate $certificate
     * @param Laporan $report
     * @param User $hunter
     * @param string $verificationUrl
     * @return string Binary PDF content
     */
    public function generate(Certificate $certificate, Laporan $report, User $hunter, string $verificationUrl): string
    {
        $w = 841.89;
        $h = 595.28;

        // Determine recipient display name (respecting UU PDP anonymity)
        if ($report->is_anonymous) {
            $recipientName = $report->pseudonym ? $report->pseudonym . ' (Anonim)' : 'Security Researcher Anonim';
        } else {
            $recipientName = $hunter->name ?: 'Security Researcher';
        }

        $certNumber = $certificate->certificate_number;
        $issuedDate = $certificate->issued_at->translatedFormat('d F Y');
        $severity   = strtoupper($certificate->severity);
        $cvssScore  = $certificate->cvss_score !== null ? number_format($certificate->cvss_score, 1) : '-';
        $vulnerability = $report->jenis_kerentanan;
        $targetHost = parse_url($report->target_url, PHP_URL_HOST) ?: $report->target_url;
        $hash       = $certificate->verification_hash;

        // Generate QR code module matrix
        $qrMatrix = $this->qrCodeService->generateMatrix($verificationUrl);

        // Build PDF Content Stream
        $stream = "";

        // 1. Page Background & Outer Guilloche-style Frame
        $stream .= "0.985 0.988 0.995 rg 0 0 {$w} {$h} re f\n";

        // Deep Navy border (outer)
        $stream .= "0.04 0.10 0.22 RG 6 w 22 22 " . ($w - 44) . " " . ($h - 44) . " re S\n";

        // Thin navy accent
        $stream .= "0.10 0.20 0.38 RG 1 w 26 26 " . ($w - 52) . " " . ($h - 52) . " re S\n";

        // Rich Gold border (inner)
        $stream .= "0.82 0.67 0.22 RG 2 w 30 30 " . ($w - 60) . " " . ($h - 60) . " re S\n";

        // Thin inner decorative border
        $stream .= "0.82 0.67 0.22 RG 0.75 w 34 34 " . ($w - 68) . " " . ($h - 68) . " re S\n";

        // Corner decorative corner brackets / ornaments
        $corners = [
            [38, 38],
            [$w - 38, 38],
            [38, $h - 38],
            [$w - 38, $h - 38],
        ];
        $stream .= "0.82 0.67 0.22 RG 1.5 w\n";
        foreach ($corners as [$cx, $cy]) {
            $sx = ($cx > $w / 2) ? -1 : 1;
            $sy = ($cy > $h / 2) ? -1 : 1;
            $stream .= sprintf("%.2F %.2F m %.2F %.2F l S\n", $cx, $cy + $sy * 16, $cx, $cy);
            $stream .= sprintf("%.2F %.2F m %.2F %.2F l S\n", $cx + $sx * 16, $cy, $cx, $cy);
            // small diamond
            $stream .= sprintf("0.82 0.67 0.22 rg %.2F %.2F m %.2F %.2F l %.2F %.2F l %.2F %.2F l f\n",
                $cx, $cy + $sy * 4,
                $cx + $sx * 4, $cy,
                $cx, $cy - $sy * 4,
                $cx - $sx * 4, $cy
            );
        }

        // Top decorative gold ribbon / bar
        $stream .= "0.82 0.67 0.22 rg 120 " . ($h - 48) . " " . ($w - 240) . " 2 re f\n";

        // 2. Official Provincial Header
        $stream .= $this->renderTextCentered("PEMERINTAH PROVINSI JAWA TIMUR", $w / 2, $h - 68, "/F2", 13, [0.04, 0.10, 0.22]);
        $stream .= $this->renderTextCentered("DINAS KOMUNIKASI DAN INFORMATIKA", $w / 2, $h - 84, "/F1", 10.5, [0.25, 0.30, 0.40]);
        $stream .= $this->renderTextCentered("COMPUTER SECURITY INCIDENT RESPONSE TEAM (JATIMPROV-CSIRT)", $w / 2, $h - 99, "/F2", 11, [0.82, 0.67, 0.22]);

        // Separator line
        $stream .= "0.85 0.88 0.92 RG 1 w 180 " . ($h - 109) . " m " . ($w - 180) . " " . ($h - 109) . " l S\n";

        // 3. Certificate Title
        $stream .= $this->renderTextCentered("CERTIFICATE OF APPRECIATION", $w / 2, $h - 142, "/F2", 24, [0.04, 0.10, 0.22]);
        $stream .= $this->renderTextCentered("PENGHARGAAN VULNERABILITY DISCLOSURE PROGRAM (VDP)", $w / 2, $h - 160, "/F2", 10, [0.65, 0.50, 0.12]);
        $stream .= $this->renderTextCentered("Nomor Registrasi: " . $certNumber, $w / 2, $h - 176, "/F3", 9.5, [0.40, 0.45, 0.55]);

        // 4. Recipient Section
        $stream .= $this->renderTextCentered("Diberikan sebagai bentuk apresiasi resmi kepada:", $w / 2, $h - 208, "/F1", 11, [0.30, 0.35, 0.45]);

        // Recipient Name
        $stream .= $this->renderTextCentered($recipientName, $w / 2, $h - 242, "/F2", 23, [0.03, 0.25, 0.65]);

        // Underline for recipient name
        $nameUnderlineWidth = min(460, max(220, strlen($recipientName) * 14));
        $stream .= sprintf("0.82 0.67 0.22 rg %.2F %.2F %.2F 2 re f\n", ($w - $nameUnderlineWidth) / 2, $h - 250, $nameUnderlineWidth);

        // Citation Text
        $citation1 = "Atas dedikasi, integritas, dan kontribusi profesional dalam mengidentifikasi serta melaporkan celah";
        $citation2 = "keamanan secara bertanggung jawab (Responsible Disclosure) pada sistem informasi Pemerintah Provinsi Jawa Timur.";
        $stream .= $this->renderTextCentered($citation1, $w / 2, $h - 275, "/F1", 10.5, [0.25, 0.30, 0.40]);
        $stream .= $this->renderTextCentered($citation2, $w / 2, $h - 291, "/F1", 10.5, [0.25, 0.30, 0.40]);

        // 5. Findings Classification Box (Card in the middle)
        $boxW = 680;
        $boxH = 70;
        $boxX = ($w - $boxW) / 2;
        $boxY = $h - 380;

        // Card background & border
        $stream .= sprintf("0.96 0.97 0.99 rg %.2F %.2F %.2F %.2F re f\n", $boxX, $boxY, $boxW, $boxH);
        $stream .= sprintf("0.85 0.88 0.94 RG 1 w %.2F %.2F %.2F %.2F re S\n", $boxX, $boxY, $boxW, $boxH);
        // Left accent bar
        $stream .= sprintf("0.03 0.25 0.65 rg %.2F %.2F 5 %.2F re f\n", $boxX, $boxY, $boxH);

        // 4 Columns in box: Target Scope | Vulnerability | Severity | CVSS v3.1
        $col1X = $boxX + 20;
        $col2X = $boxX + 190;
        $col3X = $boxX + 410;
        $col4X = $boxX + 540;

        // Column Labels
        $stream .= "BT /F2 8 Tf 0.50 0.55 0.65 rg " . $col1X . " " . ($boxY + 48) . " Td (LINGKUP TARGET) Tj ET\n";
        $stream .= "BT /F2 8 Tf 0.50 0.55 0.65 rg " . $col2X . " " . ($boxY + 48) . " Td (KLASIFIKASI KERENTANAN) Tj ET\n";
        $stream .= "BT /F2 8 Tf 0.50 0.55 0.65 rg " . $col3X . " " . ($boxY + 48) . " Td (SEVERITY) Tj ET\n";
        $stream .= "BT /F2 8 Tf 0.50 0.55 0.65 rg " . $col4X . " " . ($boxY + 48) . " Td (CVSS v3.1 SCORE) Tj ET\n";

        // Column Values
        $shortTarget = strlen($targetHost) > 22 ? substr($targetHost, 0, 20) . '..' : $targetHost;
        $shortVuln   = strlen($vulnerability) > 26 ? substr($vulnerability, 0, 24) . '..' : $vulnerability;

        $stream .= "BT /F3 10.5 Tf 0.04 0.10 0.22 rg " . $col1X . " " . ($boxY + 24) . " Td (" . $this->escapePdf($shortTarget) . ") Tj ET\n";
        $stream .= "BT /F2 10.5 Tf 0.04 0.10 0.22 rg " . $col2X . " " . ($boxY + 24) . " Td (" . $this->escapePdf($shortVuln) . ") Tj ET\n";

        // Severity colored badge
        [$sR, $sG, $sB] = match ($severity) {
            'CRITICAL' => [0.85, 0.12, 0.15],
            'HIGH'     => [0.90, 0.40, 0.05],
            'MEDIUM'   => [0.85, 0.60, 0.05],
            default    => [0.05, 0.65, 0.35],
        };
        $stream .= sprintf("%.2F %.2F %.2F rg %.2F %.2F 85 20 re f\n", $sR, $sG, $sB, $col3X, $boxY + 20);
        $stream .= "BT /F2 10 Tf 1 1 1 rg " . ($col3X + 10) . " " . ($boxY + 26) . " Td (" . $this->escapePdf($severity) . ") Tj ET\n";

        // CVSS score
        $stream .= "BT /F2 16 Tf 0.04 0.10 0.22 rg " . $col4X . " " . ($boxY + 22) . " Td (" . $cvssScore . ") Tj ET\n";

        // 6. Security Footer Grid
        // Left Column: Vector QR Code
        $qrSize = 82;
        $qrX = 52;
        $qrY = 46;

        // QR Background
        $stream .= sprintf("1 1 1 rg %.2F %.2F %.2F %.2F re f\n", $qrX - 3, $qrY - 3, $qrSize + 6, $qrSize + 6);
        $stream .= sprintf("0.85 0.88 0.94 RG 0.5 w %.2F %.2F %.2F %.2F re S\n", $qrX - 3, $qrY - 3, $qrSize + 6, $qrSize + 6);

        // Draw Vector QR Code modules
        $n = count($qrMatrix);
        $quiet = 2;
        $modSize = $qrSize / ($n + $quiet * 2);

        $stream .= "0.04 0.10 0.22 rg\n";
        for ($r = 0; $r < $n; $r++) {
            for ($c = 0; $c < $n; $c++) {
                if ($qrMatrix[$r][$c]) {
                    $px = $qrX + ($c + $quiet) * $modSize;
                    $py = $qrY + ($n - 1 - $r + $quiet) * $modSize;
                    $stream .= sprintf("%.2F %.2F %.2F %.2F re f\n", $px, $py, $modSize, $modSize);
                }
            }
        }

        // QR label
        $stream .= "BT /F2 7.5 Tf 0.30 0.35 0.45 rg 50 36 Td (PINDAI UNTUK VERIFIKASI) Tj ET\n";

        // Middle: Integrity Hash & Digital Signature Info
        $stream .= "BT /F2 8 Tf 0.40 0.45 0.55 rg 150 115 Td (TANDA TANGAN & INTEGRITAS KRIPTOGRAFI DOKUMEN) Tj ET\n";
        $stream .= "BT /F3 7.5 Tf 0.20 0.30 0.50 rg 150 102 Td (SHA-256: " . substr($hash, 0, 32) . ") Tj ET\n";
        $stream .= "BT /F3 7.5 Tf 0.20 0.30 0.50 rg 150 91 Td (         " . substr($hash, 32) . ") Tj ET\n";

        // Security checkmark badge
        $stream .= "0.93 0.96 1.00 rg 150 48 300 32 re f\n";
        $stream .= "0.75 0.85 0.98 RG 0.5 w 150 48 300 32 re S\n";
        $stream .= "BT /F2 8 Tf 0.05 0.35 0.70 rg 160 67 Td ([x] VERIFIED RESPONSIBLE DISCLOSURE) Tj ET\n";
        $stream .= "BT /F1 7 Tf 0.35 0.45 0.55 rg 160 55 Td (Dokumen sah diterbitkan resmi oleh Tim CSIRT Pemerintah Provinsi Jawa Timur) Tj ET\n";

        // Right Column: Official Signer & Location Block
        $rightX = $w - 240;
        $stream .= "BT /F1 9 Tf 0.30 0.35 0.45 rg " . $rightX . " 124 Td (Surabaya, " . $this->escapePdf($issuedDate) . ") Tj ET\n";
        $stream .= "BT /F2 9.5 Tf 0.04 0.10 0.22 rg " . $rightX . " 110 Td (Pemerintah Provinsi Jawa Timur) Tj ET\n";
        $stream .= "BT /F2 9 Tf 0.82 0.67 0.22 rg " . $rightX . " 98 Td (JatimProv-CSIRT) Tj ET\n";

        // Signature seal badge
        $stream .= sprintf("0.96 0.97 0.99 rg %.2F 45 180 40 re f\n", $rightX);
        $stream .= sprintf("0.82 0.67 0.22 RG 1 w %.2F 45 180 40 re S\n", $rightX);
        $stream .= "BT /F2 8 Tf 0.82 0.67 0.22 rg " . ($rightX + 12) . " 68 Td (TERTANDATANGAN ELEKTRONIK) Tj ET\n";
        $stream .= "BT /F3 7 Tf 0.40 0.45 0.55 rg " . ($rightX + 12) . " 54 Td (ID: CSIRT-JTM-" . substr($certificate->id, 0, 13) . ") Tj ET\n";

        // 7. Assemble Complete PDF Document Structure
        $objs = [];
        $objs[1] = "<< /Type /Catalog /Pages 2 0 R >>";
        $objs[2] = "<< /Type /Pages /Kids [3 0 R] /Count 1 >>";
        $objs[3] = "<< /Type /Page /Parent 2 0 R /MediaBox [0 0 {$w} {$h}] /Resources << /Font << /F1 4 0 R /F2 5 0 R /F3 6 0 R >> >> /Contents 7 0 R >>";
        $objs[4] = "<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>";
        $objs[5] = "<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica-Bold >>";
        $objs[6] = "<< /Type /Font /Subtype /Type1 /BaseFont /Courier-Bold >>";
        $objs[7] = "<< /Length " . strlen($stream) . " >>\nstream\n" . $stream . "\nendstream";

        $pdf = "%PDF-1.4\n";
        $offsets = [];
        foreach ($objs as $id => $content) {
            $offsets[$id] = strlen($pdf);
            $pdf .= "{$id} 0 obj\n{$content}\nendobj\n";
        }
        $xrefOffset = strlen($pdf);
        $pdf .= "xref\n0 " . (count($objs) + 1) . "\n0000000000 65535 f \n";
        for ($i = 1; $i <= count($objs); $i++) {
            $pdf .= sprintf("%010d 00000 n \n", $offsets[$i]);
        }
        $pdf .= "trailer\n<< /Size " . (count($objs) + 1) . " /Root 1 0 R >>\nstartxref\n{$xrefOffset}\n%%EOF\n";

        return $pdf;
    }

    /**
     * Render text centered at a specific horizontal point.
     *
     * @param string $text
     * @param float $centerX
     * @param float $y
     * @param string $font
     * @param float $fontSize
     * @param array{0: float, 1: float, 2: float} $color
     * @return string
     */
    private function renderTextCentered(string $text, float $centerX, float $y, string $font, float $fontSize, array $color): string
    {
        // Average character width factor for standard Helvetica
        $charWidthFactor = ($font === '/F2') ? 0.58 : (($font === '/F3') ? 0.60 : 0.52);
        $approxWidth = strlen($text) * $fontSize * $charWidthFactor;
        $x = $centerX - ($approxWidth / 2);

        $escaped = $this->escapePdf($text);

        return sprintf("BT %s %.2F Tf %.2F %.2F %.2F rg %.2F %.2F Td (%s) Tj ET\n",
            $font,
            $fontSize,
            $color[0], $color[1], $color[2],
            $x, $y,
            $escaped
        );
    }

    /**
     * Escape special PDF string characters.
     */
    private function escapePdf(string $str): string
    {
        return str_replace(
            ['\\', '(', ')'],
            ['\\\\', '\\(', '\\)'],
            $str
        );
    }
}
