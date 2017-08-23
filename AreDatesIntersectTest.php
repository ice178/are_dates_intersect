<?php

use PHPUnit\Framework\TestCase;


/**
 * Test cases for are_dates_intersect function
 */
class AreDatesIntersectTest extends TestCase
{
    /**
     * Test validation of input dates
     */
    public function testInvalidDates()
    {
        $date        = 'now';
        $dateInvalid = 'Invalid date string';

        $this->expectException(InvalidArgumentException::class);

        are_dates_intersect($dateInvalid, $date, $date, $date);
    }

    /**
     * Test validation on interval
     */
    public function testInvalidInterval()
    {
        $start = 'now';
        $end   = '-1 hour';

        $this->expectException(InvalidArgumentException::class);

        are_dates_intersect($start, $end, $start, $end);
    }

    /**
     * Test that dates intersect
     */
    public function testIntersect()
    {
        $firstStart = 'now';
        $firstEnd   = '+2 hour';

        $secondStart = '+1 hour';
        $secondEnd   = '+3 hour';

        $result = are_dates_intersect($firstStart, $firstEnd, $secondStart, $secondEnd);

        $this->assertTrue($result === true);

        $firstStart = 'now';
        $firstEnd   = '+2 hour';

        $secondStart = '-1 hour';
        $secondEnd   = '+1 hour';

        $result = are_dates_intersect($firstStart, $firstEnd, $secondStart, $secondEnd);

        $this->assertTrue($result === true);
    }

    /**
     * Test that dates not intersect
     */
    public function testNotIntersect()
    {
        $firstStart = 'now';
        $firstEnd   = '+2 hour';

        $secondStart = '+3 hour';
        $secondEnd   = '+4 hour';

        $result = are_dates_intersect($firstStart, $firstEnd, $secondStart, $secondEnd);

        $this->assertTrue($result === false);
    }
}