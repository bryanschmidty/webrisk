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
        'extra_info' => 'array',
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
        $html = '<div id="players" class="absolute bottom-0 left-0 z-10 w-36 bg-black/80 text-white border-2 border-gray-300 border-b-0 overflow-hidden"><ul class="ml-6 space-y-1">';
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
            $html .= '<li id="p_'.$gp->player_id.'" class="'.$class.' text-left border border-gray-600 px-1 text-xs font-bold list-none" title="'.$gp->state.'"><span class="cards">'.$numCards.'</span>'.$username.'</li>';
        }
        return $html.'</ul></div>';
    }

    public function getConquerLimit(): ?int
    {
        return $this->extra_info['conquer_limit'] ?? null;
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

    public function get_dice(): array
    {
        $log = RollLog::orderByDesc('id')->first();
        if (!$log) {
            return [];
        }
        $attack = array_filter([$log->attack_1, $log->attack_2, $log->attack_3]);
        $defend = array_filter([$log->defend_1, $log->defend_2]);
        return ['attack' => $attack, 'defend' => $defend];
    }

    public function draw_action(): string
    {
        $playerId = session('player_id');
        $player = $this->players()->where('player_id', $playerId)->first();
        if (!$player) {
            return '<div id="action">You are watching</div>';
        }

        if ($this->paused) {
            return '<div id="action">This game is paused</div>';
        }

        if ($this->state === 'Finished') {
            return '<div id="action">The game is over</div>';
        }

        $label = match ($player->state) {
            'Waiting' => 'It is not your turn',
            'Trading' => 'Trade cards',
            'Placing' => 'Place your armies',
            'Attacking' => 'Attack opponent',
            'Occupying' => 'Occupy territory',
            'Fortifying' => 'Fortify position',
            default => '',
        };

        return '<div id="action">'.$label.'</div>';
    }
}
