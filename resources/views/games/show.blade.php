@extends('layouts.app')

@section('content')
<h1>{{ $game->name }}</h1>
<p>State: {{ $game->state }}</p>
@if(isset($canNudge) && $canNudge)
<form method="post" action="/games/{{ $game->game_id }}/nudge">
    @csrf
    <button type="submit">Nudge</button>
</form>
@endif
@endsection
