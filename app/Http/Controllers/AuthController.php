<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $player = Player::where('username', $data['username'])->first();
        if ($player && $player->password === Player::hashPassword($data['password'])) {
            $request->session()->put('player_id', $player->player_id);
            return redirect('/games');
        }

        return back()->withErrors(['username' => 'Invalid credentials'])->withInput();
    }

    public function logout(Request $request)
    {
        $request->session()->forget('player_id');
        return redirect('/login');
    }
}
