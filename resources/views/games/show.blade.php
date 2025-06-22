@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-4">{{ $game->name }}</h1>
<p class="mb-4">State: {{ $game->state }}</p>
@if(isset($canNudge) && $canNudge)
<form method="post" action="/games/{{ $game->game_id }}/nudge" class="mb-4">
    @csrf
    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">Nudge</button>
</form>
@endif
@endsection
