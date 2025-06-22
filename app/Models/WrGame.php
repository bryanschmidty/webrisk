<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WrGame extends Model
{
    use HasFactory;

    protected $table = 'wr_game';

    protected $primaryKey = 'game_id';

    public $timestamps = false;

    protected $fillable = [
        'host_id',
        'name',
        'password',
        'capacity',
        'time_limit',
        'allow_kibitz',
        'game_type',
        'next_bonus',
        'state',
        'extra_info',
        'game_settings',
        'paused',
    ];

    protected $casts = [
        'allow_kibitz' => 'boolean',
        'paused' => 'boolean',
    ];

    public function host()
    {
        return $this->belongsTo(Player::class, 'host_id');
    }

    public function players()
    {
        return $this->hasMany(WrGamePlayer::class, 'game_id');
    }

    public function chat()
    {
        return $this->hasMany(WrChat::class, 'game_id');
    }
}
