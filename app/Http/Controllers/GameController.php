<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\GamePlayer;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::all();
        return view('games.index', compact('games'));
    }

    public function show(Game $game)
    {
        return view('games.show', compact('game'));
    }

    public function create()
    {
        return view('games.create');
    }

    public function store(Request $request)
    {
        $playerId = $request->session()->get('player_id');
        $data = $request->validate([
            'name' => 'required|max:255',
            'capacity' => 'required|integer|between:2,6',
            'password' => 'nullable|string',
            'allow_kibitz' => 'boolean',
            'fortify' => 'required|boolean',
            'multiple_fortify' => 'boolean',
            'connected_fortify' => 'boolean',
            'kamikaze' => 'boolean',
            'warmonger' => 'boolean',
            'fog_of_war_armies' => 'required|in:all,adjacent,none',
            'fog_of_war_colors' => 'required|in:all,adjacent,none',
            'nuke' => 'boolean',
            'turncoat' => 'boolean',
            'place_initial_armies' => 'boolean',
            'initial_army_limit' => 'required|integer|min:0',
        ]);

        $extra = [
            'fortify' => (bool) $data['fortify'],
            'multiple_fortify' => (bool) ($data['multiple_fortify'] ?? false),
            'connected_fortify' => (bool) ($data['connected_fortify'] ?? false),
            'kamikaze' => (bool) ($data['kamikaze'] ?? false),
            'warmonger' => (bool) ($data['warmonger'] ?? false),
            'fog_of_war_armies' => $data['fog_of_war_armies'],
            'fog_of_war_colors' => $data['fog_of_war_colors'],
            'nuke' => (bool) ($data['nuke'] ?? false),
            'turncoat' => (bool) ($data['turncoat'] ?? false),
            'place_initial_armies' => (bool) ($data['place_initial_armies'] ?? false),
            'initial_army_limit' => (int) $data['initial_army_limit'],
        ];

        $game = Game::create([
            'host_id' => $playerId,
            'name' => $data['name'],
            'password' => isset($data['password']) && $data['password'] !== '' ? Game::hashPassword($data['password']) : null,
            'capacity' => $data['capacity'],
            'allow_kibitz' => $data['allow_kibitz'] ?? false,
            'extra_info' => json_encode($extra),
        ]);

        GamePlayer::create([
            'game_id' => $game->game_id,
            'player_id' => $playerId,
            'order_num' => 1,
            'color' => 'red',
            'state' => 'Waiting',
        ]);

        return redirect('/games/' . $game->game_id);
    }

    public function join(Request $request, Game $game)
    {
        if ($request->isMethod('post')) {
            $playerId = $request->session()->get('player_id');
            $data = $request->validate([
                'color' => 'required|in:red,blue,green,yellow,brown,black',
                'password' => 'nullable|string',
            ]);

            if ($game->password && Game::hashPassword($data['password'] ?? '') !== $game->password) {
                return back()->withErrors(['password' => 'Invalid password'])->withInput();
            }

            if ($game->players()->count() >= $game->capacity) {
                return back()->withErrors(['color' => 'Game full']);
            }

            if ($game->players()->where('color', $data['color'])->exists()) {
                return back()->withErrors(['color' => 'Color taken']);
            }

            GamePlayer::create([
                'game_id' => $game->game_id,
                'player_id' => $playerId,
                'order_num' => $game->players()->count() + 1,
                'color' => $data['color'],
                'state' => 'Waiting',
            ]);

            return redirect('/games/' . $game->game_id);
        }

        return view('games.join', compact('game'));
    }
}
