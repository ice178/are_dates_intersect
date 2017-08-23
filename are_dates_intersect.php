<?php

/**
 * Calculates whether the dates intersect
 *
 * @param string $firstStart  Start date of first interval
 * @param string $firstEnd    End date of first interval
 * @param string $secondStart Start of second interval
 * @param string $secondEnd   End of second interval
 *
 * @return bool
 *
 * @throws InvalidArgumentException
 */
function are_dates_intersect($firstStart, $firstEnd, $secondStart, $secondEnd)
{
    try {
        $firstStart = new DateTime($firstStart);
        $firstEnd   = new DateTime($firstEnd);

        $secondStart = new DateTime($secondStart);
        $secondEnd   = new DateTime($secondEnd);
    } catch (Exception $e) {
        throw new InvalidArgumentException("Invalid date format given '{$e->getMessage()}'", 0, $e);
    }

    $first  = ['start' => $firstStart->getTimestamp(), 'end' => $firstEnd->getTimestamp()];
    $second = ['start' => $secondStart->getTimestamp(), 'end' => $secondEnd->getTimestamp()];

    foreach ([$first, $second] as $interval) {
        if ($interval['start'] > $interval['end']) {
            throw new InvalidArgumentException("Invalid interval given, start should be grater than end");
        }
    }

    $isIntersected = !($first['end'] < $second['start'] || $first['start'] > $second['end']);

    return $isIntersected;
}