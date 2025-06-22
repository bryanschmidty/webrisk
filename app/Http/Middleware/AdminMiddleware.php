<?php

namespace App\Http\Middleware;

use App\Models\Player;
use Closure;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        $playerId = $request->session()->get('player_id');
        $player = $playerId ? Player::find($playerId) : null;
        if (! $player || ! $player->is_admin) {
            return redirect('/login');
        }
        return $next($request);
    }
}
