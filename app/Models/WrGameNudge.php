<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WrGameNudge extends Model
{
    use HasFactory;

    protected $table = 'wr_game_nudge';

    public $timestamps = false;

    public $incrementing = false;

    protected $primaryKey = null;

    protected $fillable = [
        'game_id',
        'player_id',
        'nudged',
    ];

    protected $casts = [
        'nudged' => 'datetime',
    ];

    public function game()
    {
        return $this->belongsTo(WrGame::class, 'game_id');
    }

    public function player()
    {
        return $this->belongsTo(Player::class, 'player_id');
    }
}
