<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WrChat extends Model
{
    use HasFactory;

    protected $table = 'wr_chat';

    protected $primaryKey = 'chat_id';

    public $timestamps = false;

    protected $fillable = [
        'message',
        'from_id',
        'game_id',
        'private',
    ];

    protected $casts = [
        'private' => 'boolean',
    ];

    public function game()
    {
        return $this->belongsTo(WrGame::class, 'game_id');
    }

    public function fromPlayer()
    {
        return $this->belongsTo(Player::class, 'from_id');
    }
}
