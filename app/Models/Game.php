<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GameLog;

class Game extends Model
{
    use HasFactory;

    protected $table = 'games';

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
        return $this->hasMany(GamePlayer::class, 'game_id');
    }

    public function chat()
    {
        return $this->hasMany(Chat::class, 'game_id');
    }

    
    public function draw_players(): string
    {
        $players = $this->players()->with('player')->orderBy('order_num')->get();
        $html = '<div id="players"><ul>';
        foreach ($players as $gp) {
            $class = substr($gp->color, 0, 3);
            if ($gp->player_id == session('player_id')) {
                $class .= ' me';
            }
            if ($gp->player_id == $this->host_id) {
                $class .= ' host';
            }
            $class .= ' '.strtolower($gp->state);
            $numCards = $gp->cards ? count(array_filter(explode(' ', $gp->cards))) : 0;
            $username = $gp->player->username ?? '';
            $html .= '<li id="p_'.$gp->player_id.'" class="'.$class.'" title="'.$gp->state.'"><span class="cards">'.$numCards.'</span>'.$username.'</li>';
        }
        return $html.'</ul></div>';
    }

    public static function hashPassword(string $password): string
    {
        return md5($password.'s41Ty!S7uFF');
    }

    public function get_trade_value(): int
    {
        $log = GameLog::where('game_id', $this->game_id)
            ->where('data', 'like', 'V -%')
            ->orderByDesc('create_date')
            ->orderByDesc('microsecond')
            ->first();

        if ($log && preg_match('/\[(\d+)\]/', $log->data, $match)) {
            return (int) $match[1];
        }

        return 0;
    }
}
