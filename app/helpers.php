<?php

if (!function_exists('formatNumber')) {
    function formatNumber($number): string
    {
        $suffix = '';
        if ($number >= 1000 && $number < 1000000) {
            $number = round($number / 1000, 2);
            $suffix = 'k';
        } elseif ($number >= 1000000) {
            $number = round($number / 1000000, 2);
            $suffix = 'M';
        }

        return number_format($number, 2) . $suffix;
    }
}
