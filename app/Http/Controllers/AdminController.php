<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Game;
use App\Models\Setting;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $players = Player::where('is_approved', false)->get();
        $games = Game::all();
        return view('admin.dashboard', compact('players', 'games'));
    }

    public function approvePlayer(Player $player)
    {
        $player->update(['is_approved' => true]);
        return redirect('/admin');
    }

    public function pauseGame(Game $game)
    {
        $game->update(['paused' => true]);
        return redirect('/admin');
    }

    public function unpauseGame(Game $game)
    {
        $game->update(['paused' => false]);
        return redirect('/admin');
    }

    public function settingsForm()
    {
        $settings = Setting::orderBy('sort')->get();
        return view('admin.settings', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        $data = $request->validate(['settings' => 'array']);
        foreach ($data['settings'] ?? [] as $key => $value) {
            Setting::where('setting', $key)->update(['value' => $value]);
        }
        return redirect('/admin/settings');
    }
}
