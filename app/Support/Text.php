<?php
namespace App\Support;

class Text {

    public static function truncateText($text = null, $maxLength = 200)
    {
        $text = mb_convert_encoding($text ?? '', 'UTF-8', 'auto');
        // Si le texte est plus court que la limite → on le retourne tel quel
        if (mb_strlen($text, 'UTF-8') <= $maxLength) {
            return $text;
        }
        // On tronque d'abord grossièrement à la limite
        $truncated = mb_substr($text, 0, $maxLength, 'UTF-8');
        // Trouver le dernier espace pour ne pas couper un mot
        $lastSpace = mb_strrpos($truncated, ' ', 0, 'UTF-8');

        if ($lastSpace !== false) {
            $truncated = mb_substr($truncated, 0, $lastSpace, 'UTF-8');
        }
        // Ajoute les points de suspension
        return rtrim($truncated) . '...';
    }


    public static function convertSecondsToText(int $time)
    {
        $totalMinutes = $time;
        // dd($totalMinutes);

        $hours = floor($totalMinutes / 3600);   
        $rest = $totalMinutes % 3600;

        $parts = [];

        if ($hours > 0) {
            if ($rest === 0) {
                $parts[] = $hours . 'h';
            } else {
                $parts[] = $hours . 'h' . floor($rest / 60);
            }
        } else {
            $minutes = floor($totalMinutes / 60);
            $rest_sec = $totalMinutes % 60;

            if ($minutes > 1) {
                if ($rest_sec === 0 ) {
                    $parts[] = $minutes . ' mins';
                } else {
                    $parts[] = $minutes . ' mins';
                }
                
            } else {
                $parts[] = $minutes . "s";
            }
        }
    
        return implode('', $parts);
    }
}
