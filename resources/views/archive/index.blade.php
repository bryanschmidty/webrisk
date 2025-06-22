@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-4">Archived Games</h1>
<div class="overflow-x-auto">
<table class="min-w-full bg-white divide-y divide-gray-300 shadow rounded">
    <thead class="bg-gray-50">
        <tr>
            <th class="px-4 py-2 text-left">ID</th>
            <th class="px-4 py-2 text-left">Name</th>
            <th class="px-4 py-2 text-left">Start Date</th>
            <th class="px-4 py-2 text-left">End Date</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
        @forelse($games as $game)
        <tr>
            <td class="px-4 py-2">{{ $game->game_id }}</td>
            <td class="px-4 py-2">{{ $game->name }}</td>
            <td class="px-4 py-2">{{ $game->create_date }}</td>
            <td class="px-4 py-2">{{ $game->modify_date }}</td>
        </tr>
        @empty
        <tr>
            <td class="px-4 py-2" colspan="4">There are no games to show</td>
        </tr>
        @endforelse
    </tbody>
</table>
</div>
@endsection
