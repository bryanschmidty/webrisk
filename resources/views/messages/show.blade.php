@extends('layouts.app')

@section('content')
<h1>{{ $messageGlue->message->subject }}</h1>
<p>From: {{ $messageGlue->fromPlayer->username }}</p>
<p>{{ $messageGlue->message->message }}</p>
@endsection
