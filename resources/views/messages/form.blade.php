@extends('layouts.app')

@section('content')
<h1>New Message</h1>
<form method="post" action="/messages">
    @csrf
    <div>
        <label>Recipient</label>
        <select name="to_id">
            @foreach($players as $player)
                <option value="{{ $player->player_id }}">{{ $player->username }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label>Subject</label>
        <input type="text" name="subject" value="{{ old('subject') }}">
    </div>
    <div>
        <label>Message</label>
        <textarea name="message">{{ old('message') }}</textarea>
    </div>
    <button type="submit">Send</button>
</form>
@endsection
