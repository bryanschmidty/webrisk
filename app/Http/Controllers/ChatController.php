<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Game;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index(Game $game = null)
    {
        return view('chat.index', ['game' => $game]);
    }

    public function fetch(Game $game = null)
    {
        $query = Chat::with('fromPlayer')->where('private', false);
        if ($game) {
            $query->where('game_id', $game->game_id);
        }
        $messages = $query->orderByDesc('chat_id')->limit(20)->get();
        return response()->json($messages);
    }

    public function store(Request $request, Game $game = null)
    {
        $data = $request->validate(['message' => 'required|string']);
        $playerId = $request->session()->get('player_id');
        if (!$playerId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $chat = Chat::create([
            'message' => $data['message'],
            'from_id' => $playerId,
            'game_id' => $game ? $game->game_id : 0,
            'private' => false,
        ]);
        return response()->json($chat);
    }
}
