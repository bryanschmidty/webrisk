<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use Illuminate\Support\Str;
use App\Models\PlayerSettings;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|unique:player,username',
            'email' => 'required|email|unique:player,email',
            'password' => 'required|confirmed',
        ]);

        $player = Player::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Player::hashPassword($data['password']),
            'alt_pass' => Player::hashAltPass($data['password']),
            'ident' => Str::random(32),
            'is_approved' => 1,
        ]);

        PlayerSettings::create([
            'player_id' => $player->player_id,
        ]);

        $request->session()->put('player_id', $player->player_id);
        return redirect('/games');
    }
}
