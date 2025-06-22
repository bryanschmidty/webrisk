<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WrGamePlayer extends Model
{
    use HasFactory;

    protected $table = 'wr_game_player';

    public $timestamps = false;

    public $incrementing = false;

    protected $primaryKey = null;

    protected $fillable = [
        'game_id',
        'player_id',
        'order_num',
        'color',
        'cards',
        'armies',
        'state',
        'get_card',
        'forced',
        'extra_info',
        'move_date',
    ];

    protected $casts = [
        'move_date' => 'datetime',
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
