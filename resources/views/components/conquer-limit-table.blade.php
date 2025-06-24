<table class="datatable conquer_limits">
    <caption>{!! $equation !!}</caption>
    <thead>
        <tr>
            <th id="conquer_type_header">{{ ucwords(str_replace('_',' ', $type)) }}</th>
            <th>Conquer Limit</th>
        </tr>
    </thead>
    <tbody>
    @foreach($limits as $count => $value)
        <tr class="{{ $loop->iteration % 2 === 0 ? 'alt' : '' }}">
            <td>{{ $count }}</td>
            <td>{{ $value }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
