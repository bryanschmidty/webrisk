@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-4">History for {{ $game->name }}</h1>
<ul class="space-y-1">
@foreach($logs as $log)
    <li class="bg-white p-2 rounded shadow">{{ $log->create_date }} - {{ $log->data }}</li>
@endforeach
</ul>
@endsection
