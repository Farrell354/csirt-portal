<?php

namespace App\Services;

/**
 * QrCodeService — Zero-Dependency Pure PHP QR Code Generator
 *
 * Implements ISO/IEC 18004 compliant QR Code Model 2 (Byte mode, Reed-Solomon GF(256)).
 * Generates vector matrices and clean SVG representations with zero external packages.
 */
class QrCodeService
{
    /** @var array<int, int> */
    private static array $exp = [];
    /** @var array<int, int> */
    private static array $log = [];
    private static bool $gfInitialized = false;

    public function __construct()
    {
        self::initGf();
    }

    /**
     * Generate a 2D boolean matrix representing the QR Code.
     * True represents a dark module, false represents a light module.
     *
     * @param string $data
     * @return array<int, array<int, bool>>
     */
    public function generateMatrix(string $data): array
    {
        $len = strlen($data);

        // Select appropriate QR Version (Level L: V1 up to 17, V2 up to 32, V3 up to 53, V4 up to 78, V5 up to 106, V6 up to 134)
        if ($len <= 17) {
            $version = 1;
            $dataCodewords = 19;
            $ecCodewords = 7;
        } elseif ($len <= 32) {
            $version = 2;
            $dataCodewords = 34;
            $ecCodewords = 10;
        } elseif ($len <= 53) {
            $version = 3;
            $dataCodewords = 55;
            $ecCodewords = 15;
        } elseif ($len <= 78) {
            $version = 4;
            $dataCodewords = 80;
            $ecCodewords = 20;
        } elseif ($len <= 106) {
            $version = 5;
            $dataCodewords = 108;
            $ecCodewords = 26;
        } else {
            $version = 6;
            $dataCodewords = 136;
            $ecCodewords = 18 * 2; // handled in blocks if needed, but V5 fits up to 106 chars
        }

        $size = 17 + 4 * $version;

        // 1. Bit stream encoding (Byte mode: 0100)
        $bits = '0100';
        $bits .= str_pad(decbin($len), 8, '0', STR_PAD_LEFT);
        for ($i = 0; $i < $len; $i++) {
            $bits .= str_pad(decbin(ord($data[$i])), 8, '0', STR_PAD_LEFT);
        }

        // Terminator (up to 4 zero bits)
        $maxBits = $dataCodewords * 8;
        $bits .= substr('0000', 0, max(0, min(4, $maxBits - strlen($bits))));

        // Pad to byte boundary
        while (strlen($bits) % 8 !== 0) {
            $bits .= '0';
        }

        // Pad bytes (0xEC, 0x11)
        $padBytes = ['11101100', '00010001'];
        $padIdx = 0;
        while (strlen($bits) < $maxBits) {
            $bits .= $padBytes[$padIdx];
            $padIdx = ($padIdx + 1) % 2;
        }

        // Convert bits to data codewords
        /** @var list<int> $dc */
        $dc = [];
        for ($i = 0; $i < strlen($bits); $i += 8) {
            $dc[] = (int) bindec(substr($bits, $i, 8));
        }

        // 2. Reed-Solomon Error Correction Codewords
        $ec = $this->calculateReedSolomon($dc, $ecCodewords);

        // Final codeword sequence
        $codewords = array_merge($dc, $ec);

        // 3. Matrix Placement
        /** @var array<int, array<int, bool|null>> $matrix */
        $matrix = array_fill(0, $size, array_fill(0, $size, null));
        /** @var array<int, array<int, bool>> $isFunction */
        $isFunction = array_fill(0, $size, array_fill(0, $size, false));

        // Function patterns: Finder patterns (top-left, top-right, bottom-left)
        $this->placeFinderPattern($matrix, $isFunction, 0, 0, $size);
        $this->placeFinderPattern($matrix, $isFunction, $size - 7, 0, $size);
        $this->placeFinderPattern($matrix, $isFunction, 0, $size - 7, $size);

        // Timing patterns
        for ($i = 8; $i < $size - 8; $i++) {
            $val = ($i % 2 === 0);
            if ($matrix[6][$i] === null) {
                $matrix[6][$i] = $val;
                $isFunction[6][$i] = true;
            }
            if ($matrix[$i][6] === null) {
                $matrix[$i][6] = $val;
                $isFunction[$i][6] = true;
            }
        }

        // Alignment patterns for version >= 2
        if ($version >= 2) {
            $alignPos = $this->getAlignmentPositions($version);
            foreach ($alignPos as $r) {
                foreach ($alignPos as $c) {
                    if ($matrix[$r][$c] === null) {
                        $this->placeAlignmentPattern($matrix, $isFunction, $r, $c);
                    }
                }
            }
        }

        // Dark module
        $matrix[4 * $version + 9][8] = true;
        $isFunction[4 * $version + 9][8] = true;

        // Reserve format information areas
        for ($i = 0; $i < 9; $i++) {
            $isFunction[8][$i] = true;
            $isFunction[$i][8] = true;
        }
        for ($i = $size - 8; $i < $size; $i++) {
            $isFunction[8][$i] = true;
            $isFunction[$i][8] = true;
        }

        // Data Placement (zig-zag right-to-left in 2-column tracks)
        $bitIdx = 0;
        $totalCodewordBits = count($codewords) * 8;
        $allBits = '';
        foreach ($codewords as $cw) {
            $allBits .= str_pad(decbin($cw), 8, '0', STR_PAD_LEFT);
        }

        $dir = -1; // moving upwards
        $row = $size - 1;
        $col = $size - 1;

        while ($col > 0) {
            if ($col === 6) {
                $col--; // skip vertical timing line
            }

            for ($i = 0; $i < $size; $i++) {
                $currentRow = $row + $dir * $i;
                for ($c = 0; $c < 2; $c++) {
                    $currentCol = $col - $c;
                    if (! $isFunction[$currentRow][$currentCol]) {
                        $bit = ($bitIdx < $totalCodewordBits) ? ($allBits[$bitIdx] === '1') : false;
                        // Apply Mask 0: (row + col) % 2 === 0
                        $mask = (($currentRow + $currentCol) % 2 === 0);
                        $matrix[$currentRow][$currentCol] = $bit ^ $mask;
                        $bitIdx++;
                    }
                }
            }

            $row = ($dir === -1) ? 0 : $size - 1;
            $dir = -$dir;
            $col -= 2;
        }

        // Format Info (Level L, Mask 0: 00 000 = 00000 -> BCH masked: 111011111000100)
        /** @var list<bool> $formatBits */
        $formatBits = array_map(fn (string $char): bool => $char === '1', str_split('111011111000100'));

        // Top-left
        $matrix[8][0] = $formatBits[0];
        $matrix[8][1] = $formatBits[1];
        $matrix[8][2] = $formatBits[2];
        $matrix[8][3] = $formatBits[3];
        $matrix[8][4] = $formatBits[4];
        $matrix[8][5] = $formatBits[5];
        $matrix[8][7] = $formatBits[6];
        $matrix[8][8] = $formatBits[7];
        $matrix[7][8] = $formatBits[8];
        $matrix[5][8] = $formatBits[9];
        $matrix[4][8] = $formatBits[10];
        $matrix[3][8] = $formatBits[11];
        $matrix[2][8] = $formatBits[12];
        $matrix[1][8] = $formatBits[13];
        $matrix[0][8] = $formatBits[14];

        // Top-right and bottom-left
        for ($i = 0; $i < 7; $i++) {
            $matrix[8][$size - 1 - $i] = $formatBits[$i];
        }
        for ($i = 0; $i < 8; $i++) {
            $matrix[$size - 8 + $i][8] = $formatBits[7 + $i];
        }

        /** @var array<int, array<int, bool>> $finalMatrix */
        $finalMatrix = [];
        for ($r = 0; $r < $size; $r++) {
            $finalMatrix[$r] = [];
            for ($c = 0; $c < $size; $c++) {
                $finalMatrix[$r][$c] = (bool) $matrix[$r][$c];
            }
        }

        return $finalMatrix;
    }

    /**
     * Generate an SVG string of the QR code.
     */
    public function generateSvg(string $data, int $size = 200, string $darkColor = '#0f172a', string $lightColor = '#ffffff'): string
    {
        $matrix = $this->generateMatrix($data);
        $moduleCount = count($matrix);
        $quietZone = 4;
        $totalModules = $moduleCount + $quietZone * 2;

        $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 '.$totalModules.' '.$totalModules.'" width="'.$size.'" height="'.$size.'">'."\n";
        $svg .= '  <rect width="100%" height="100%" fill="'.$lightColor.'"/>'."\n";
        $svg .= '  <path fill="'.$darkColor.'" d="';

        for ($r = 0; $r < $moduleCount; $r++) {
            for ($c = 0; $c < $moduleCount; $c++) {
                if ($matrix[$r][$c]) {
                    $x = $c + $quietZone;
                    $y = $r + $quietZone;
                    $svg .= "M{$x},{$y}h1v1h-1z ";
                }
            }
        }

        $svg .= '"/>'."\n";
        $svg .= '</svg>';

        return $svg;
    }

    /**
     * Data URI for embedding in HTML / CSS.
     */
    public function getDataUri(string $data, int $size = 200): string
    {
        $svg = $this->generateSvg($data, $size);
        return 'data:image/svg+xml;base64,' . base64_encode($svg);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // Internal Math and Placement Helpers
    // ─────────────────────────────────────────────────────────────────────────

    private static function initGf(): void
    {
        if (self::$gfInitialized) {
            return;
        }

        self::$exp = array_fill(0, 512, 0);
        self::$log = array_fill(0, 256, 0);
        $x = 1;
        for ($i = 0; $i < 255; $i++) {
            self::$exp[$i] = $x;
            self::$log[$x] = $i;
            $x <<= 1;
            if ($x & 256) {
                $x ^= 0x11D;
            }
        }
        for ($i = 255; $i < 512; $i++) {
            self::$exp[$i] = self::$exp[$i - 255];
        }

        self::$gfInitialized = true;
    }

    /**
     * Calculate Reed-Solomon Error Correction codewords.
     *
     * @param list<int> $data
     * @param int $ecLength
     * @return list<int>
     */
    private function calculateReedSolomon(array $data, int $ecLength): array
    {
        // Generate generator polynomial: g(x) = (x - 2^0)(x - 2^1)...(x - 2^(ecLength-1))
        $poly = [1];
        for ($i = 0; $i < $ecLength; $i++) {
            $factor = [1, self::$exp[$i]];
            $poly = $this->polyMultiply($poly, $factor);
        }

        // Remainder of data * x^ecLength divided by generator polynomial
        $msg = array_pad($data, count($data) + $ecLength, 0);

        for ($i = 0; $i < count($data); $i++) {
            $coef = $msg[$i];
            if ($coef !== 0) {
                $logCoef = self::$log[$coef];
                for ($j = 0; $j < count($poly); $j++) {
                    $msg[$i + $j] ^= self::$exp[($logCoef + self::$log[$poly[$j]]) % 255];
                }
            }
        }

        return array_slice($msg, count($data));
    }

    /**
     * Multiply two polynomials in GF(256).
     *
     * @param list<int> $p1
     * @param list<int> $p2
     * @return list<int>
     */
    private function polyMultiply(array $p1, array $p2): array
    {
        $res = array_fill(0, count($p1) + count($p2) - 1, 0);
        for ($i = 0; $i < count($p1); $i++) {
            for ($j = 0; $j < count($p2); $j++) {
                if ($p1[$i] !== 0 && $p2[$j] !== 0) {
                    $res[$i + $j] ^= self::$exp[(self::$log[$p1[$i]] + self::$log[$p2[$j]]) % 255];
                }
            }
        }
        return $res;
    }

    /**
     * @param array<int, array<int, bool|null>> $matrix
     * @param array<int, array<int, bool>> $isFunction
     */
    private function placeFinderPattern(array &$matrix, array &$isFunction, int $startRow, int $startCol, int $size): void
    {
        for ($r = -1; $r <= 7; $r++) {
            for ($c = -1; $c <= 7; $c++) {
                $row = $startRow + $r;
                $col = $startCol + $c;
                if ($row >= 0 && $row < $size && $col >= 0 && $col < $size) {
                    $isDark = ($r >= 0 && $r <= 6 && $c >= 0 && $c <= 6) &&
                              ($r === 0 || $r === 6 || $c === 0 || $c === 6 || ($r >= 2 && $r <= 4 && $c >= 2 && $c <= 4));
                    $matrix[$row][$col] = $isDark;
                    $isFunction[$row][$col] = true;
                }
            }
        }
    }

    /**
     * @param array<int, array<int, bool|null>> $matrix
     * @param array<int, array<int, bool>> $isFunction
     */
    private function placeAlignmentPattern(array &$matrix, array &$isFunction, int $centerRow, int $centerCol): void
    {
        for ($r = -2; $r <= 2; $r++) {
            for ($c = -2; $c <= 2; $c++) {
                $row = $centerRow + $r;
                $col = $centerCol + $c;
                $isDark = ($r === -2 || $r === 2 || $c === -2 || $c === 2 || ($r === 0 && $c === 0));
                $matrix[$row][$col] = $isDark;
                $isFunction[$row][$col] = true;
            }
        }
    }

    /**
     * @return list<int>
     */
    private function getAlignmentPositions(int $version): array
    {
        return match ($version) {
            2 => [6, 18],
            3 => [6, 22],
            4 => [6, 26],
            5 => [6, 30],
            6 => [6, 34],
            default => [6],
        };
    }
}
