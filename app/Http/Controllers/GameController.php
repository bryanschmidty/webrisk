<?php

namespace App\Http\Controllers;

use App\Models\WrGame;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        $games = WrGame::all();
        return view('games.index', compact('games'));
    }

    public function show(WrGame $game)
    {
        return view('games.show', compact('game'));
    }
}
