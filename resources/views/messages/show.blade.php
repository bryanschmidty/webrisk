@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-4">{{ $messageGlue->message->subject }}</h1>
<p class="mb-2">From: {{ $messageGlue->fromPlayer->username }}</p>
<p class="bg-white p-4 rounded shadow">{{ $messageGlue->message->message }}</p>
@endsection
