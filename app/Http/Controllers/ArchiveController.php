<?php

namespace App\Http\Controllers;

use App\Models\Game;

class ArchiveController extends Controller
{
    public function index()
    {
        $games = Game::where('state', 'Finished')
            ->orderByDesc('modify_date')
            ->get();
        return view('archive.index', compact('games'));
    }
}
