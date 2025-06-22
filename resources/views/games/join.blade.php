@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-4">Join {{ $game->name }}</h1>
<form method="post" action="/games/{{ $game->game_id }}/join" class="space-y-4 bg-white p-6 rounded shadow max-w-lg mx-auto">
    @csrf
    <div class="flex flex-col">
        <label class="mb-1">Your Color</label>
        <select name="color" class="border rounded p-2">
            @foreach(['red','blue','green','yellow','brown','black'] as $color)
                <option value="{{ $color }}" @selected(old('color')==$color)>{{ ucfirst($color) }}</option>
            @endforeach
        </select>
    </div>
    @if($game->password)
    <div class="flex flex-col">
        <label class="mb-1">Password</label>
        <input class="border rounded p-2" type="password" name="password">
    </div>
    @endif
    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">Join Game</button>
</form>
@endsection
