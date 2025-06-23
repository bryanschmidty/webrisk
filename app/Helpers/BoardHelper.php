<?php

namespace App\Helpers;

use App\Models\Game;
use App\Models\GameLand;
use App\Models\GamePlayer;

class BoardHelper
{
    public static function render(Game $game): string
    {
        $lands = GameLand::where('game_id', $game->game_id)->get()->keyBy('land_id');
        $players = GamePlayer::where('game_id', $game->game_id)->get()->keyBy('player_id');
        $html = '';
        for ($landId = 1; $landId <= 42; $landId++) {
            $land = $lands->get($landId);
            $player = $land ? $players->get($land->player_id) : null;
            $color = $player ? $player->color : 'gray';
            $resigned = ($player && $player->state === 'Resigned') ? ' res' : '';
            $armies = $land ? $land->armies : 0;
            $html .= '<span class="'.substr($color, 0, 3).$resigned.'" id="sl'.str_pad($landId, 2, '0', STR_PAD_LEFT).'" title="'.str_pad($landId, 2, '0', STR_PAD_LEFT).'">'.$armies.'</span>';
        }
        return $html;
    }
}
