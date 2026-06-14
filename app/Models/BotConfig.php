<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BotConfig extends Model {
    use HasFactory;

    protected $table = 'bot_configs';

    protected $casts = [
        'start_time' => 'datetime:H:i',
        'end_time'   => 'datetime:H:i',
        'last_sent_at' => 'datetime',
    ];
    
    protected $fillable = [
        'start_time',
        'end_time',
        'frequency_minutes',
        'active',
        'last_sent_at',
    ];
}