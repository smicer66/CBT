<?php namespace App\Core;


/** Written by Michael Obi of Emerging Platforms Limited for the KUST CBT Application
 *
 * */
class TimeTools
{
    public static function millisecondsToTimeStr($milliseconds)
    {
        $seconds = $milliseconds / 1000;

        // extract hours
        $hours = floor($seconds / (60 * 60));

        // extract minutes
        $divisor_for_minutes = $seconds % (60 * 60);
        $minutes = floor($divisor_for_minutes / 60);

        // extract the remaining seconds
        $divisor_for_seconds = $divisor_for_minutes % 60;
        $seconds = ceil($divisor_for_seconds);

        $timeStr = '';
        if ($hours != 0) {
            $timeStr .= $hours . ' hour';
            if ($hours > 1 || -1) {
                $timeStr .= 's';
            }
        }

        if ($minutes != 0) {
            $timeStr .= ' ' . $minutes . ' minute';
            if ($minutes > 1 || -1) {
                $timeStr .= 's';
            }
        }

        if ($seconds != 0) {
            $timeStr .= ' ' . $seconds . ' second';
            if ($seconds > 1 || -1) {
                $timeStr .= 's';
            }
        }

        return $timeStr;
    }
}
