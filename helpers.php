<?php
use App\Support\Image;
use App\Support\Text;
use Carbon\Carbon;

if (!function_exists('image_url')) {
    function image_url(?string $path, ?int $width = null, ?int $height = null, string $fit = 'crop'): string {
        return Image::url($path, $width, $height, $fit);
    }
}

if (!function_exists('truncateText')) {
    function truncateText(?string $text, $maxLength): string {
        return Text::truncateText($text, $maxLength);
    }
}

if (!function_exists('convertSecondsToText')) {
    function convertSecondsToText(?int $time): string {
        return Text::convertSecondsToText($time);
    }
}

if (! function_exists('format_date')) {
    function format_date(string|\DateTime $date, string $format = 'date'): string
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