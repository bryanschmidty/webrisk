<table class="datatable custom_trades">
    <thead>
        <tr>
            <th>Trade #</th>
            <th>Value</th>
        </tr>
    </thead>
    <tbody>
    @foreach($rows as $row)
        <tr class="{{ $loop->iteration % 2 === 0 ? 'alt' : '' }}{{ $row['highlight'] ? ' highlight' : '' }}">
            <td>{{ $row['idx'] }}</td>
            <td>{{ $row['value'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
