@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-4">Player Stats</h1>
<div class="overflow-x-auto">
<table class="min-w-full bg-white divide-y divide-gray-300 shadow rounded">
    <thead class="bg-gray-50">
    <tr>
        <th class="px-2 py-1 text-left">Player</th>
        <th class="px-2 py-1 text-left">Wins</th>
        <th class="px-2 py-1 text-left">Kills</th>
        <th class="px-2 py-1 text-left">Losses</th>
        <th class="px-2 py-1 text-left">Win-Loss</th>
        <th class="px-2 py-1 text-left">Win %</th>
        <th class="px-2 py-1 text-left">Kill-Loss</th>
        <th class="px-2 py-1 text-left">Kill-Win</th>
        <th class="px-2 py-1 text-left">Kill %</th>
        <th class="px-2 py-1 text-left">Last Online</th>
    </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
    @foreach($players as $p)
        <tr>
            <td class="px-2 py-1">{{ $p->username }}</td>
            <td class="px-2 py-1">{{ $p->wins }}</td>
            <td class="px-2 py-1">{{ $p->kills }}</td>
            <td class="px-2 py-1">{{ $p->losses }}</td>
            <td class="px-2 py-1">{{ $p->wins - $p->losses }}</td>
            <td class="px-2 py-1">{{ $p->wins + $p->losses ? number_format($p->wins / ($p->wins + $p->losses) * 100, 1) : 0 }}%</td>
            <td class="px-2 py-1">{{ $p->kills - $p->losses }}</td>
            <td class="px-2 py-1">{{ $p->kills - $p->wins }}</td>
            <td class="px-2 py-1">{{ $p->wins + $p->losses ? number_format($p->kills / ($p->wins + $p->losses) * 100, 1) : 0 }}%</td>
            <td class="px-2 py-1">{{ $p->last_online }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>

<h2 class="text-xl font-semibold mt-8 mb-2">Dice Percentages</h2>
<div class="overflow-x-auto">
<table class="min-w-full bg-white divide-y divide-gray-300 shadow rounded">
    <thead class="bg-gray-50">
    <tr>
        <th class="px-2 py-1 text-left">Fight</th>
        <th class="px-2 py-1 text-left">Attack</th>
        <th class="px-2 py-1 text-left">Defend</th>
        <th class="px-2 py-1 text-left">Both</th>
    </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
    @foreach($actual as $fight => $data)
        <tr>
            <td class="px-2 py-1">{{ $fight }}</td>
            <td class="px-2 py-1">{{ number_format($data['attack'] * 100, 1) }}%</td>
            <td class="px-2 py-1">{{ number_format($data['defend'] * 100, 1) }}%</td>
            <td class="px-2 py-1">{{ isset($data['both']) ? number_format($data['both'] * 100, 1).'%' : '-' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>

<h2 class="text-xl font-semibold mt-8 mb-2">Theoretical Dice Percentages</h2>
<div class="overflow-x-auto">
<table class="min-w-full bg-white divide-y divide-gray-300 shadow rounded">
    <thead class="bg-gray-50">
    <tr>
        <th class="px-2 py-1 text-left">Fight</th>
        <th class="px-2 py-1 text-left">Attack</th>
        <th class="px-2 py-1 text-left">Defend</th>
        <th class="px-2 py-1 text-left">Both</th>
    </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
    @foreach($theoretical as $fight => $data)
        <tr>
            <td class="px-2 py-1">{{ $fight }}</td>
            <td class="px-2 py-1">{{ number_format($data['attack'] * 100, 1) }}%</td>
            <td class="px-2 py-1">{{ number_format($data['defend'] * 100, 1) }}%</td>
            <td class="px-2 py-1">{{ isset($data['both']) ? number_format($data['both'] * 100, 1).'%' : '-' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>

<h2 class="text-xl font-semibold mt-8 mb-2">Fight Counts</h2>
<div class="overflow-x-auto">
<table class="min-w-full bg-white divide-y divide-gray-300 shadow rounded">
    <thead class="bg-gray-50">
    <tr>
        <th class="px-2 py-1 text-left">Fight</th>
        <th class="px-2 py-1 text-left">Count</th>
    </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
    @foreach($count as $fight => $c)
        @if($fight !== 'total')
            <tr>
                <td class="px-2 py-1">{{ $fight }}</td>
                <td class="px-2 py-1">{{ $c }}</td>
            </tr>
        @endif
    @endforeach
    <tr>
        <td class="px-2 py-1">Total</td>
        <td class="px-2 py-1">{{ $count['total'] }}</td>
    </tr>
    </tbody>
</table>
</div>
@endsection
