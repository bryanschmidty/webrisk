<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $table = 'player';

    protected $primaryKey = 'player_id';

    public $timestamps = false;

    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'email',
        'timezone',
        'is_admin',
        'password',
        'alt_pass',
        'ident',
        'token',
        'is_approved',
    ];

    protected $casts = [
        'is_admin' => 'boolean',
        'is_approved' => 'boolean',
    ];

    public function profile()
    {
        return $this->hasOne(WrWrPlayer::class, 'player_id');
    }

    public function games()
    {
        return $this->belongsToMany(WrGame::class, 'wr_game_player', 'player_id', 'game_id');
    }

    public function messages()
    {
        return $this->hasMany(WrMessageGlue::class, 'to_id');
    }
}
