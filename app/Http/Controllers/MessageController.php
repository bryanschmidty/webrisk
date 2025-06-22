<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\MessageGlue;
use App\Models\Player;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $playerId = $request->session()->get('player_id');
        if (!$playerId) {
            return redirect('/login');
        }

        $inbox = MessageGlue::with(['fromPlayer', 'message'])
            ->where('to_id', $playerId)
            ->where('deleted', false)
            ->orderByDesc('send_date')
            ->get();

        $outbox = MessageGlue::with(['toPlayer', 'message'])
            ->where('from_id', $playerId)
            ->orderByDesc('send_date')
            ->get();

        return view('messages.inbox', compact('inbox', 'outbox'));
    }

    public function show(MessageGlue $messageGlue, Request $request)
    {
        $playerId = $request->session()->get('player_id');
        if (!$playerId || ($messageGlue->to_id !== $playerId && $messageGlue->from_id !== $playerId)) {
            return redirect('/login');
        }

        if ($messageGlue->to_id === $playerId && $messageGlue->view_date === null) {
            $messageGlue->view_date = now();
            $messageGlue->save();
        }

        return view('messages.show', ['messageGlue' => $messageGlue]);
    }

    public function create(Request $request)
    {
        $playerId = $request->session()->get('player_id');
        if (!$playerId) {
            return redirect('/login');
        }
        $players = Player::orderBy('username')->get();
        return view('messages.form', compact('players'));
    }

    public function store(Request $request)
    {
        $playerId = $request->session()->get('player_id');
        if (!$playerId) {
            return redirect('/login');
        }

        $data = $request->validate([
            'to_id' => 'required|exists:player,player_id',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $message = Message::create([
            'subject' => $data['subject'],
            'message' => $data['message'],
        ]);

        MessageGlue::create([
            'message_id' => $message->message_id,
            'from_id' => $playerId,
            'to_id' => $data['to_id'],
            'send_date' => now(),
        ]);

        return redirect('/messages');
    }

    public function destroy(MessageGlue $messageGlue, Request $request)
    {
        $playerId = $request->session()->get('player_id');
        if (!$playerId || $messageGlue->to_id !== $playerId) {
            return redirect('/login');
        }

        $messageGlue->deleted = true;
        $messageGlue->save();

        return redirect('/messages');
    }
}
