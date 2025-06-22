<h1 class="text-2xl font-semibold mb-4">Outbox</h1>
<table class="min-w-full bg-white divide-y divide-gray-300 shadow rounded">
    <thead class="bg-gray-50">
        <tr>
            <th class="px-4 py-2 text-left">To</th>
            <th class="px-4 py-2 text-left">Subject</th>
            <th class="px-4 py-2 text-left">Sent</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
        @foreach($outbox as $glue)
        <tr>
            <td class="px-4 py-2">{{ $glue->toPlayer->username }}</td>
            <td class="px-4 py-2">{{ $glue->message->subject }}</td>
            <td class="px-4 py-2">{{ $glue->send_date }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
