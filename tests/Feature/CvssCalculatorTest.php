<?php

namespace Tests\Feature;

use App\Services\CvssCalculatorService;
use InvalidArgumentException;
use Tests\TestCase;

/**
 * CvssCalculatorTest — Validates CVSS v3.1 formula accuracy.
 *
 * Reference vectors and expected scores taken from the official FIRST.org
 * CVSS v3.1 calculator (https://www.first.org/cvss/calculator/3.1) and
 * the NVD score lookup service.
 */
class CvssCalculatorTest extends TestCase
{
    private CvssCalculatorService $cvss;

    protected function setUp(): void
    {
        parent::setUp();
        $this->cvss = new CvssCalculatorService();
    }

    /**
     * CVE-2021-44228 (Log4Shell) vector — Critical 10.0
     * CVSS:3.1/AV:N/AC:L/PR:N/UI:N/S:C/C:H/I:H/A:H
     */
    public function test_critical_score_log4shell(): void
    {
        $score = $this->cvss->calculate([
            'AV' => 'N', 'AC' => 'L', 'PR' => 'N',
            'UI' => 'N', 'S'  => 'C', 'C'  => 'H',
            'I'  => 'H', 'A'  => 'H',
        ]);

        $this->assertEquals(10.0, $score);
        $this->assertEquals('Critical', $this->cvss->severityRating($score));
    }

    /**
     * High severity example
     * CVSS:3.1/AV:N/AC:L/PR:N/UI:N/S:U/C:H/I:H/A:H → 9.8
     */
    public function test_high_score_unauthenticated_rce(): void
    {
        $score = $this->cvss->calculate([
            'AV' => 'N', 'AC' => 'L', 'PR' => 'N',
            'UI' => 'N', 'S'  => 'U', 'C'  => 'H',
            'I'  => 'H', 'A'  => 'H',
        ]);

        $this->assertEquals(9.8, $score);
        $this->assertEquals('Critical', $this->cvss->severityRating($score));
    }

    /**
     * Medium severity example
     * CVSS:3.1/AV:N/AC:L/PR:L/UI:N/S:U/C:L/I:L/A:N → 5.4
     */
    public function test_medium_score(): void
    {
        $score = $this->cvss->calculate([
            'AV' => 'N', 'AC' => 'L', 'PR' => 'L',
            'UI' => 'N', 'S'  => 'U', 'C'  => 'L',
            'I'  => 'L', 'A'  => 'N',
        ]);

        $this->assertEquals(5.4, $score);
        $this->assertEquals('Medium', $this->cvss->severityRating($score));
    }

    /**
     * Zero impact → score must be 0.0
     */
    public function test_zero_impact_score(): void
    {
        $score = $this->cvss->calculate([
            'AV' => 'N', 'AC' => 'L', 'PR' => 'N',
            'UI' => 'N', 'S'  => 'U', 'C'  => 'N',
            'I'  => 'N', 'A'  => 'N',
        ]);

        $this->assertEquals(0.0, $score);
        $this->assertEquals('None', $this->cvss->severityRating($score));
    }

    /**
     * buildVector produces canonical string format.
     */
    public function test_build_vector_format(): void
    {
        $vector = $this->cvss->buildVector([
            'AV' => 'N', 'AC' => 'L', 'PR' => 'N',
            'UI' => 'N', 'S'  => 'C', 'C'  => 'H',
            'I'  => 'H', 'A'  => 'H',
        ]);

        $this->assertEquals('CVSS:3.1/AV:N/AC:L/PR:N/UI:N/S:C/C:H/I:H/A:H', $vector);
    }

    /**
     * parseVector roundtrips back to the original metric array.
     */
    public function test_parse_vector_roundtrip(): void
    {
        $original = ['AV'=>'N','AC'=>'L','PR'=>'N','UI'=>'N','S'=>'C','C'=>'H','I'=>'H','A'=>'H'];
        $vector   = $this->cvss->buildVector($original);
        $parsed   = $this->cvss->parseVector($vector);

        $this->assertEquals($original, $parsed);
    }

    /**
     * Invalid metric key throws InvalidArgumentException.
     */
    public function test_invalid_metric_throws_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->cvss->calculate([
            'AV' => 'X', // Invalid value
            'AC' => 'L', 'PR' => 'N',
            'UI' => 'N', 'S'  => 'U',
            'C'  => 'H', 'I'  => 'H', 'A' => 'H',
        ]);
    }

    /**
     * Missing metric key throws InvalidArgumentException.
     */
    public function test_missing_metric_throws_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->cvss->calculate([
            'AV' => 'N', 'AC' => 'L', // PR, UI, S, C, I, A missing
        ]);
    }

    /**
     * Severity rating covers all 5 tiers.
     */
    public function test_severity_rating_tiers(): void
    {
        $this->assertEquals('None',     $this->cvss->severityRating(0.0));
        $this->assertEquals('Low',      $this->cvss->severityRating(2.0));
        $this->assertEquals('Medium',   $this->cvss->severityRating(5.0));
        $this->assertEquals('High',     $this->cvss->severityRating(8.0));
        $this->assertEquals('Critical', $this->cvss->severityRating(9.5));
    }
}
