@extends('layouts.app')

@section('content')
<h1>Games</h1>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>State</th>
        </tr>
    </thead>
    <tbody>
        @foreach($games as $game)
            <tr>
                <td><a href="/games/{{ $game->game_id }}">{{ $game->name }}</a></td>
                <td>{{ $game->state }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
