<?php

namespace App\Services;

use InvalidArgumentException;

/**
 * CvssCalculatorService — CVSS v3.1 Base Score Calculator
 *
 * Implements the CVSS v3.1 Base Score formula as published by FIRST.org
 * (https://www.first.org/cvss/v3.1/specification-document).
 *
 * Compliant with ISO/IEC 30111 (Vulnerability Handling Processes) §7.3
 * which requires standardised severity scoring for triage decisions.
 *
 * This service is a pure calculation engine — it has no database access,
 * no I/O, and no side effects. It can be unit-tested in total isolation.
 *
 * Metric abbreviations (CVSS v3.1):
 *   AV  — Attack Vector        (N=Network, A=Adjacent, L=Local, P=Physical)
 *   AC  — Attack Complexity    (L=Low, H=High)
 *   PR  — Privileges Required  (N=None, L=Low, H=High)
 *   UI  — User Interaction     (N=None, R=Required)
 *   S   — Scope                (U=Unchanged, C=Changed)
 *   C   — Confidentiality      (N=None, L=Low, H=High)
 *   I   — Integrity            (N=None, L=Low, H=High)
 *   A   — Availability         (N=None, L=Low, H=High)
 */
class CvssCalculatorService
{
    // ── Metric numeric weights per CVSS v3.1 spec ────────────────────────────

    private const AV_WEIGHTS = [
        'N' => 0.85, // Network
        'A' => 0.62, // Adjacent
        'L' => 0.55, // Local
        'P' => 0.20, // Physical
    ];

    private const AC_WEIGHTS = [
        'L' => 0.77, // Low
        'H' => 0.44, // High
    ];

    /**
     * PR weights differ when Scope is Changed (C) vs Unchanged (U).
     */
    private const PR_WEIGHTS = [
        'U' => ['N' => 0.85, 'L' => 0.62, 'H' => 0.27], // Scope Unchanged
        'C' => ['N' => 0.85, 'L' => 0.68, 'H' => 0.50], // Scope Changed
    ];

    private const UI_WEIGHTS = [
        'N' => 0.85, // None
        'R' => 0.62, // Required
    ];

    private const CIA_WEIGHTS = [
        'N' => 0.00, // None
        'L' => 0.22, // Low
        'H' => 0.56, // High
    ];

    // ── Allowed metric values (for validation) ────────────────────────────────

    private const VALID_METRICS = [
        'AV' => ['N', 'A', 'L', 'P'],
        'AC' => ['L', 'H'],
        'PR' => ['N', 'L', 'H'],
        'UI' => ['N', 'R'],
        'S'  => ['U', 'C'],
        'C'  => ['N', 'L', 'H'],
        'I'  => ['N', 'L', 'H'],
        'A'  => ['N', 'L', 'H'],
    ];

    // ── Public API ────────────────────────────────────────────────────────────

    /**
     * Calculate the CVSS v3.1 Base Score from metric abbreviations.
     *
     * @param  array<string, string>  $metrics  e.g. ['AV'=>'N','AC'=>'L',...]
     * @return float  Base Score rounded to 1 decimal (0.0–10.0)
     *
     * @throws InvalidArgumentException  if any metric key/value is invalid
     */
    public function calculate(array $metrics): float
    {
        $this->validateMetrics($metrics);

        $av = self::AV_WEIGHTS[$metrics['AV']];
        $ac = self::AC_WEIGHTS[$metrics['AC']];
        $pr = self::PR_WEIGHTS[$metrics['S']][$metrics['PR']];
        $ui = self::UI_WEIGHTS[$metrics['UI']];
        $s  = $metrics['S'];
        $c  = self::CIA_WEIGHTS[$metrics['C']];
        $i  = self::CIA_WEIGHTS[$metrics['I']];
        $a  = self::CIA_WEIGHTS[$metrics['A']];

        // Exploitability sub-score
        $ess = 8.22 * $av * $ac * $pr * $ui;

        // Impact sub-score
        $iscBase = 1.0 - ((1.0 - $c) * (1.0 - $i) * (1.0 - $a));

        if ($s === 'U') {
            $iss = 6.42 * $iscBase;
        } else {
            $iss = 7.52 * ($iscBase - 0.029) - 3.25 * (($iscBase - 0.02) ** 15);
        }

        // If impact is zero, score is 0
        if ($iss <= 0) {
            return 0.0;
        }

        // Base Score formula
        if ($s === 'U') {
            $raw = min(($iss + $ess), 10.0);
        } else {
            $raw = min(1.08 * ($iss + $ess), 10.0);
        }

        // Round up to nearest 0.1 (CVSS spec §7.4 rounding rule)
        return $this->roundUpToOneTenth($raw);
    }

    /**
     * Build the canonical CVSS v3.1 vector string from metric abbreviations.
     *
     * @param  array<string, string>  $metrics
     * @return string  e.g. "CVSS:3.1/AV:N/AC:L/PR:N/UI:N/S:U/C:H/I:H/A:H"
     */
    public function buildVector(array $metrics): string
    {
        $this->validateMetrics($metrics);

        return sprintf(
            'CVSS:3.1/AV:%s/AC:%s/PR:%s/UI:%s/S:%s/C:%s/I:%s/A:%s',
            $metrics['AV'],
            $metrics['AC'],
            $metrics['PR'],
            $metrics['UI'],
            $metrics['S'],
            $metrics['C'],
            $metrics['I'],
            $metrics['A'],
        );
    }

    /**
     * Parse a canonical CVSS v3.1 vector string into metric abbreviations.
     * Useful for pre-filling the calculator modal when a vector is already stored.
     *
     * @param  string  $vector  e.g. "CVSS:3.1/AV:N/AC:L/PR:N/UI:N/S:U/C:H/I:H/A:H"
     * @return array<string, string>
     *
     * @throws InvalidArgumentException  if the vector format is invalid
     */
    public function parseVector(string $vector): array
    {
        if (! str_starts_with($vector, 'CVSS:3.1/')) {
            throw new InvalidArgumentException('Invalid CVSS vector prefix. Expected "CVSS:3.1/".');
        }

        $parts = explode('/', ltrim($vector, 'CVSS:3.1/'));
        $metrics = [];

        foreach ($parts as $part) {
            [$key, $value] = explode(':', $part, 2);
            $metrics[$key] = $value;
        }

        $this->validateMetrics($metrics);

        return $metrics;
    }

    /**
     * Return a human-readable severity rating for a given Base Score.
     * Per CVSS v3.1 spec §2.
     */
    public function severityRating(float $score): string
    {
        return match (true) {
            $score === 0.0         => 'None',
            $score < 4.0           => 'Low',
            $score < 7.0           => 'Medium',
            $score < 9.0           => 'High',
            default                => 'Critical',
        };
    }

    // ── Private helpers ───────────────────────────────────────────────────────

    /**
     * @param  array<string, string>  $metrics
     * @throws InvalidArgumentException
     */
    private function validateMetrics(array $metrics): void
    {
        foreach (self::VALID_METRICS as $key => $allowed) {
            if (! isset($metrics[$key])) {
                throw new InvalidArgumentException("Missing CVSS metric: {$key}");
            }
            if (! in_array($metrics[$key], $allowed, true)) {
                throw new InvalidArgumentException(
                    "Invalid value '{$metrics[$key]}' for CVSS metric {$key}. "
                    . "Allowed: " . implode(', ', $allowed)
                );
            }
        }
    }

    /**
     * CVSS v3.1 "round up" function: ceiling to nearest 0.1.
     * This matches the reference Python implementation published by FIRST.
     */
    private function roundUpToOneTenth(float $value): float
    {
        $int = (int) round($value * 100000);
        if ($int % 10000 === 0) {
            return $int / 100000;
        }
        return (floor($int / 10000) + 1) / 10;
    }
}
