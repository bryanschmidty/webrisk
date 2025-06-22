@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-4">Inbox</h1>
<a href="/messages/create" class="text-indigo-600 hover:underline">Compose</a>
<div class="overflow-x-auto mt-4">
<table class="min-w-full bg-white divide-y divide-gray-300 shadow rounded">
    <thead class="bg-gray-50">
        <tr>
            <th class="px-4 py-2 text-left">From</th>
            <th class="px-4 py-2 text-left">Subject</th>
            <th class="px-4 py-2 text-left">Sent</th>
            <th class="px-4 py-2"></th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
        @foreach($inbox as $glue)
        <tr>
            <td class="px-4 py-2">{{ $glue->fromPlayer->username }}</td>
            <td class="px-4 py-2"><a href="/messages/{{ $glue->message_glue_id }}" class="text-indigo-600 hover:underline">{{ $glue->message->subject }}</a></td>
            <td class="px-4 py-2">{{ $glue->send_date }}</td>
            <td class="px-4 py-2">
                <form method="post" action="/messages/{{ $glue->message_glue_id }}">
                    @csrf
                    @method('delete')
                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@include('messages.outbox', ['outbox' => $outbox])
@endsection
