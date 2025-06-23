@extends('layouts.app')

@section('content')
<ul id="buttons" class="flex gap-4 mb-4">
    <li><a href="{{ route('games.index') }}" class="text-indigo-600 hover:underline">Main Page</a></li>
    <li><a href="{{ route('games.show', $game->game_id) }}" class="text-indigo-600 hover:underline">Reload Game Board</a></li>
</ul>
<h1 class="text-2xl font-semibold mb-4">{{ $game->name }}</h1>
<p class="mb-4">State: {{ $game->state }}</p>
@if(isset($canNudge) && $canNudge)
<form method="post" action="/games/{{ $game->game_id }}/nudge" class="mb-4">
    @csrf
    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">Nudge</button>
</form>
@endif

<div id="board">
    <div id="pathmarkers">
@for($i = 1; $i <= 44; $i++)
        <div id="pm{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}"></div>
@endfor
    </div>
    <img src="/images/blank.gif" width="800" height="449" usemap="#gamemap" alt="" />
    {!! App\Helpers\BoardHelper::render($game) !!}
    <div id="next">{{ $game->get_trade_value() }}</div>
</div>
@endsection
