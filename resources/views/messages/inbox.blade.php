@extends('layouts.app')

@section('content')
<h1>Inbox</h1>
<a href="/messages/create">Compose</a>
<table>
    <thead>
        <tr>
            <th>From</th>
            <th>Subject</th>
            <th>Sent</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($inbox as $glue)
        <tr>
            <td>{{ $glue->fromPlayer->username }}</td>
            <td><a href="/messages/{{ $glue->message_glue_id }}">{{ $glue->message->subject }}</a></td>
            <td>{{ $glue->send_date }}</td>
            <td>
                <form method="post" action="/messages/{{ $glue->message_glue_id }}">
                    @csrf
                    @method('delete')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@include('messages.outbox', ['outbox' => $outbox])
@endsection
