<?php

use App\Models\Game;
use App\Models\GameLand;

if (!function_exists('game_info')) {
    function game_info(Game $game): string
    {
        $players = $game->players()->with('player')->orderBy('order_num')->get();
        $info = $players->map(function ($gp) use ($game) {
            $lands = GameLand::where('game_id', $game->game_id)
                ->where('player_id', $gp->player_id)
                ->count();
            $cards = $gp->cards ? count(array_filter(explode(' ', $gp->cards))) : 0;
            return [
                'order' => $gp->order_num,
                'username' => $gp->player->username ?? '',
                'state' => $gp->state,
                'armies' => $gp->armies,
                'land' => $lands,
                'cards' => $cards,
            ];
        });

        return view('games.partials.game_info', [
            'game' => $game,
            'players' => $info,
        ])->render();
    }
}

