@extends('layouts.app')

@section('content')
<h1>Player Stats</h1>
<table>
    <thead>
    <tr>
        <th>Player</th>
        <th>Wins</th>
        <th>Kills</th>
        <th>Losses</th>
        <th>Win-Loss</th>
        <th>Win %</th>
        <th>Kill-Loss</th>
        <th>Kill-Win</th>
        <th>Kill %</th>
        <th>Last Online</th>
    </tr>
    </thead>
    <tbody>
    @foreach($players as $p)
        <tr>
            <td>{{ $p->username }}</td>
            <td>{{ $p->wins }}</td>
            <td>{{ $p->kills }}</td>
            <td>{{ $p->losses }}</td>
            <td>{{ $p->wins - $p->losses }}</td>
            <td>{{ $p->wins + $p->losses ? number_format($p->wins / ($p->wins + $p->losses) * 100, 1) : 0 }}%</td>
            <td>{{ $p->kills - $p->losses }}</td>
            <td>{{ $p->kills - $p->wins }}</td>
            <td>{{ $p->wins + $p->losses ? number_format($p->kills / ($p->wins + $p->losses) * 100, 1) : 0 }}%</td>
            <td>{{ $p->last_online }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<h2>Dice Percentages</h2>
<table>
    <thead>
    <tr>
        <th>Fight</th>
        <th>Attack</th>
        <th>Defend</th>
        <th>Both</th>
    </tr>
    </thead>
    <tbody>
    @foreach($actual as $fight => $data)
        <tr>
            <td>{{ $fight }}</td>
            <td>{{ number_format($data['attack'] * 100, 1) }}%</td>
            <td>{{ number_format($data['defend'] * 100, 1) }}%</td>
            <td>{{ isset($data['both']) ? number_format($data['both'] * 100, 1).'%' : '-' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<h2>Theoretical Dice Percentages</h2>
<table>
    <thead>
    <tr>
        <th>Fight</th>
        <th>Attack</th>
        <th>Defend</th>
        <th>Both</th>
    </tr>
    </thead>
    <tbody>
    @foreach($theoretical as $fight => $data)
        <tr>
            <td>{{ $fight }}</td>
            <td>{{ number_format($data['attack'] * 100, 1) }}%</td>
            <td>{{ number_format($data['defend'] * 100, 1) }}%</td>
            <td>{{ isset($data['both']) ? number_format($data['both'] * 100, 1).'%' : '-' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<h2>Fight Counts</h2>
<table>
    <thead>
    <tr>
        <th>Fight</th>
        <th>Count</th>
    </tr>
    </thead>
    <tbody>
    @foreach($count as $fight => $c)
        @if($fight !== 'total')
            <tr>
                <td>{{ $fight }}</td>
                <td>{{ $c }}</td>
            </tr>
        @endif
    @endforeach
    <tr>
        <td>Total</td>
        <td>{{ $count['total'] }}</td>
    </tr>
    </tbody>
</table>
@endsection
