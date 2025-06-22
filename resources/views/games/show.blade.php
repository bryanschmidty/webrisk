@extends('layouts.app')

@section('content')
<h1>{{ $game->name }}</h1>
<p>State: {{ $game->state }}</p>
@endsection
