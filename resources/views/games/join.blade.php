@extends('layouts.app')

@section('content')
<h1>Join {{ $game->name }}</h1>
<form method="post" action="/games/{{ $game->game_id }}/join">
    @csrf
    <div>
        <label>Your Color</label>
        <select name="color">
            @foreach(['red','blue','green','yellow','brown','black'] as $color)
                <option value="{{ $color }}" @selected(old('color')==$color)>{{ ucfirst($color) }}</option>
            @endforeach
        </select>
    </div>
    @if($game->password)
    <div>
        <label>Password</label>
        <input type="password" name="password">
    </div>
    @endif
    <button type="submit">Join Game</button>
</form>
@endsection
