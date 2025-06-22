<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WrWrPlayer extends Model
{
    use HasFactory;

    protected $table = 'wr_wr_player';

    protected $primaryKey = 'player_id';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'player_id',
        'game_settings',
        'is_admin',
        'allow_email',
        'color',
        'invite_opt_out',
        'max_games',
        'wins',
        'kills',
        'losses',
        'last_online',
    ];

    protected $casts = [
        'is_admin' => 'boolean',
        'allow_email' => 'boolean',
        'invite_opt_out' => 'boolean',
        'last_online' => 'datetime',
    ];

    public function player()
    {
        return $this->belongsTo(Player::class, 'player_id');
    }
}
