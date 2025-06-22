@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-4">Games</h1>
<table class="min-w-full bg-white divide-y divide-gray-300 shadow rounded">
    <thead class="bg-gray-50">
        <tr>
            <th class="px-4 py-2 text-left">Name</th>
            <th class="px-4 py-2 text-left">State</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
        @foreach($games as $game)
            <tr>
                <td class="px-4 py-2"><a href="/games/{{ $game->game_id }}" class="text-indigo-600 hover:underline">{{ $game->name }}</a></td>
                <td class="px-4 py-2">{{ $game->state }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
