<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RollLog extends Model
{
    use HasFactory;

    protected $table = 'roll_logs';

    public $timestamps = false;

    protected $fillable = [
        'attack_1',
        'attack_2',
        'attack_3',
        'defend_1',
        'defend_2',
    ];
}
