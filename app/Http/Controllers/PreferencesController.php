<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use App\Models\PlayerSettings;

class PreferencesController extends Controller
{
    public function edit(Request $request)
    {
        $player = Player::findOrFail($request->session()->get('player_id'));
        $prefs = $player->settings ?? PlayerSettings::create(['player_id' => $player->player_id]);
        $colorFiles = glob(base_path('legacy/css/c_*.css'));
        $colors = array_map(fn($path) => substr(basename($path, '.css'), 2), $colorFiles);
        sort($colors);
        return view('prefs.edit', compact('prefs', 'colors'));
    }

    public function update(Request $request)
    {
        $player = Player::findOrFail($request->session()->get('player_id'));
        $prefs = $player->settings ?? PlayerSettings::create(['player_id' => $player->player_id]);

        $data = $request->validate([
            'allow_email' => 'nullable|boolean',
            'invite_opt_out' => 'nullable|boolean',
            'max_games' => 'nullable|integer|min:0',
            'color' => 'nullable|string',
        ]);

        $prefs->allow_email = $data['allow_email'] ?? false;
        $prefs->invite_opt_out = $data['invite_opt_out'] ?? false;
        $prefs->max_games = $data['max_games'] ?? 0;
        $prefs->color = $data['color'] ?? '';
        $prefs->save();

        return redirect('/prefs')->with('status', 'Preferences updated');
    }
}
