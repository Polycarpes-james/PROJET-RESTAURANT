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
}
