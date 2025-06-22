@extends('layouts.app')

@section('content')
<h1>Archived Games</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Start Date</th>
            <th>End Date</th>
        </tr>
    </thead>
    <tbody>
        @forelse($games as $game)
        <tr>
            <td>{{ $game->game_id }}</td>
            <td>{{ $game->name }}</td>
            <td>{{ $game->create_date }}</td>
            <td>{{ $game->modify_date }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="4">There are no games to show</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
