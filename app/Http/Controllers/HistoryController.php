<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\GameLog;

class HistoryController extends Controller
{
    public function index(Game $game)
    {
        $logs = GameLog::where('game_id', $game->game_id)
            ->orderByDesc('create_date')
            ->orderByDesc('microsecond')
            ->get();

        return view('history.index', compact('game', 'logs'));
    }

    public function review(string $file)
    {
        $path = storage_path('app/private/' . $file);
        abort_unless(file_exists($path), 404);
        $content = file_get_contents($path);

        return view('review.show', compact('file', 'content'));
    }
}
