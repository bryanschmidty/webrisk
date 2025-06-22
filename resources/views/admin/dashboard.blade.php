@extends('layouts.app')

@section('content')
<h1>Admin Dashboard</h1>
<h2>Pending Players</h2>
<ul>
@foreach($players as $player)
    <li>
        {{ $player->username }}
        <form method="post" action="/admin/players/{{ $player->player_id }}/approve" style="display:inline">
            @csrf
            <button type="submit">Approve</button>
        </form>
    </li>
@endforeach
</ul>
<h2>Games</h2>
<ul>
@foreach($games as $game)
    <li>
        {{ $game->name }} ({{ $game->paused ? 'Paused' : 'Active' }})
        @if($game->paused)
            <form method="post" action="/admin/games/{{ $game->game_id }}/unpause" style="display:inline">
                @csrf
                <button type="submit">Unpause</button>
            </form>
        @else
            <form method="post" action="/admin/games/{{ $game->game_id }}/pause" style="display:inline">
                @csrf
                <button type="submit">Pause</button>
            </form>
        @endif
    </li>
@endforeach
</ul>
<a href="/admin/settings">Settings</a>
@endsection
