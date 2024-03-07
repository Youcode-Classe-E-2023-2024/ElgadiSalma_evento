<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $table = 'reservation';
    protected $fillable = [
        'user_id',
        'event_id',
        'status',
        'email'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}
