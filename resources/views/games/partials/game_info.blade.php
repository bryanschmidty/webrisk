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
    @if($limit = $game->getConquerLimit())
    <h3 class="text-lg font-semibold mt-4">Conquer Limit Progress</h3>
    <table class="min-w-full mb-4">
        <thead>
            <tr>
                <th>Player</th>
                <th>Progress</th>
            </tr>
        </thead>
        <tbody>
            @foreach($players as $p)
            @php $width = $limit ? min(100, ($p['conquered'] / $limit) * 100) : 0; @endphp
            <tr class="border-t">
                <td>{{ $p['username'] }}</td>
                <td>
                    <div class="w-full bg-gray-200 h-2" title="{{ $p['conquered'] }} / {{ $limit }}">
                        <div class="bg-green-500 h-2" style="width: {{ $width }}%"></div>
                    </div>
                    <span class="sr-only">{{ $p['conquered'] }} / {{ $limit }}</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
