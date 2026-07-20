<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
    public static function format(string|\DateTime $date, string $format = 'date'): string
    {
        $date = Carbon::parse($date);

        return match ($format) {
            'date'      => $date->format('d/m/Y'),
            'datetime'  => $date->format('d/m/Y H:i'),
            'time'      => $date->format('H:i'),
            'short'     => $date->translatedFormat('d M Y'),
            'long'      => $date->translatedFormat('l d F Y'),
            'relative'  => $date->diffForHumans(),
            default     => $date->format('d/m/Y'),
        };
    }
}