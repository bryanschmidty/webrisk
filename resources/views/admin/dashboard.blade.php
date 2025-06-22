@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-4">Admin Dashboard</h1>
<h2 class="text-xl font-semibold mt-6 mb-2">Pending Players</h2>
<ul class="space-y-2">
@foreach($players as $player)
    <li class="bg-white p-2 rounded shadow flex items-center justify-between">
        <span>{{ $player->username }}</span>
        <form method="post" action="/admin/players/{{ $player->player_id }}/approve">
            @csrf
            <button type="submit" class="px-2 py-1 bg-indigo-600 text-white rounded">Approve</button>
        </form>
    </li>
@endforeach
</ul>
<h2 class="text-xl font-semibold mt-8 mb-2">Games</h2>
<ul class="space-y-2">
@foreach($games as $game)
    <li class="bg-white p-2 rounded shadow flex items-center justify-between">
        <span>{{ $game->name }} ({{ $game->paused ? 'Paused' : 'Active' }})</span>
        <form method="post" action="/admin/games/{{ $game->game_id }}/{{ $game->paused ? 'unpause' : 'pause' }}">
            @csrf
            <button type="submit" class="px-2 py-1 bg-indigo-600 text-white rounded">{{ $game->paused ? 'Unpause' : 'Pause' }}</button>
        </form>
    </li>
@endforeach
</ul>
<a href="/admin/settings" class="inline-block mt-6 text-indigo-600 hover:underline">Settings</a>
@endsection
