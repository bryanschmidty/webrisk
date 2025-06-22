@extends('layouts.app')

@section('content')
<h1>History for {{ $game->name }}</h1>
<ul>
@foreach($logs as $log)
    <li>{{ $log->create_date }} - {{ $log->data }}</li>
@endforeach
</ul>
@endsection
