<div id="game_info">
    <h2 class="text-xl font-semibold mb-2">Game Info</h2>
    <table class="min-w-full mb-4">
        <thead>
            <tr>
                <th>Order</th>
                <th>Player</th>
                <th>State</th>
                <th>Armies</th>
                <th>Land</th>
                <th>Cards</th>
            </tr>
        </thead>
        <tbody>
            @foreach($players as $p)
            <tr class="border-t">
                <td>{{ $p['order'] }}</td>
                <td>{{ $p['username'] }}</td>
                <td>{{ $p['state'] }}</td>
                <td>{{ $p['armies'] }}</td>
                <td>{{ $p['land'] }}</td>
                <td>{{ $p['cards'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <table class="min-w-full">
        <tbody>
            <tr>
                <th class="text-left pr-2">Game Type</th>
                <td>{{ $game->game_type }}</td>
            </tr>
            <tr>
                <th class="text-left pr-2">Paused</th>
                <td>{{ $game->paused ? 'Yes' : 'No' }}</td>
            </tr>
            <tr>
                <th class="text-left pr-2">Next Bonus</th>
                <td>{{ $game->next_bonus }}</td>
            </tr>
        </tbody>
    </table>
    @if(!empty($tradeHtml))
        {!! $tradeHtml !!}
    @endif
    @if(!empty($conquerHtml))
        {!! $conquerHtml !!}
    @endif
</div>
