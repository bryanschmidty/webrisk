<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GamePlayer extends Model
{
    use HasFactory;

    protected $table = 'game_players';

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
        'extra_info' => 'array',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id');
    }

    public function player()
    {
        return $this->belongsTo(Player::class, 'player_id');
    }

    public function getConquered(): int
    {
        return $this->extra_info['conquered'] ?? 0;
    }
}
