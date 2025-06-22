<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        $player = Player::findOrFail($request->session()->get('player_id'));
        $timezones = timezone_identifiers_list();
        return view('profile.edit', compact('player', 'timezones'));
    }

    public function update(Request $request)
    {
        $player = Player::findOrFail($request->session()->get('player_id'));

        $data = $request->validate([
            'first_name' => 'nullable|string|max:20',
            'last_name' => 'nullable|string|max:20',
            'email' => 'required|email|unique:player,email,'.$player->player_id.',player_id',
            'timezone' => 'nullable|string',
            'password' => 'nullable|confirmed',
            'current_password' => 'required_with:password',
        ]);

        if ($data['password'] ?? false) {
            if ($player->password !== Player::hashPassword($data['current_password'])) {
                return back()->withErrors(['current_password' => 'Invalid password'])->withInput();
            }
            $player->password = Player::hashPassword($data['password']);
            $player->alt_pass = Player::hashAltPass($data['password']);
        }

        $player->first_name = $data['first_name'];
        $player->last_name = $data['last_name'];
        $player->email = $data['email'];
        $player->timezone = $data['timezone'] ?: 'UTC';
        $player->save();

        return redirect('/profile')->with('status', 'Profile updated');
    }
}
