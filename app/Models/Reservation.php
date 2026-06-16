<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'email',
        'guests',
        'reservation_date',
        'reservation_time',
        'message',
        'status'
    ];

    public function user ():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function truncateText($text = null, $maxLength = 200)
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
}
