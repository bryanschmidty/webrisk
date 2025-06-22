@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-4">New Message</h1>
<form method="post" action="/messages" class="space-y-4 bg-white p-6 rounded shadow max-w-lg mx-auto">
    @csrf
    <div class="flex flex-col">
        <label class="mb-1">Recipient</label>
        <select name="to_id" class="border rounded p-2">
            @foreach($players as $player)
                <option value="{{ $player->player_id }}">{{ $player->username }}</option>
            @endforeach
        </select>
    </div>
    <div class="flex flex-col">
        <label class="mb-1">Subject</label>
        <input class="border rounded p-2" type="text" name="subject" value="{{ old('subject') }}">
    </div>
    <div class="flex flex-col">
        <label class="mb-1">Message</label>
        <textarea class="border rounded p-2" name="message">{{ old('message') }}</textarea>
    </div>
    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">Send</button>
</form>
@endsection
