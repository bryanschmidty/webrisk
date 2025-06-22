<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WrRollLog extends Model
{
    use HasFactory;

    protected $table = 'wr_roll_log';

    public $timestamps = false;

    protected $fillable = [
        'attack_1',
        'attack_2',
        'attack_3',
        'defend_1',
        'defend_2',
    ];
}
