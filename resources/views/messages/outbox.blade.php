<h1>Outbox</h1>
<table>
    <thead>
        <tr>
            <th>To</th>
            <th>Subject</th>
            <th>Sent</th>
        </tr>
    </thead>
    <tbody>
        @foreach($outbox as $glue)
        <tr>
            <td>{{ $glue->toPlayer->username }}</td>
            <td>{{ $glue->message->subject }}</td>
            <td>{{ $glue->send_date }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
