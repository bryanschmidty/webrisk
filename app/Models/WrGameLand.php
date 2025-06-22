<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WrGameLand extends Model
{
    use HasFactory;

    protected $table = 'wr_game_land';

    public $timestamps = false;

    public $incrementing = false;

    protected $primaryKey = null;

    protected $fillable = [
        'game_id',
        'land_id',
        'player_id',
        'armies',
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
