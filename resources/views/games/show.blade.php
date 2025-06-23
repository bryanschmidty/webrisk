@extends('layouts.app')

@section('content')
<ul id="buttons" class="flex gap-4 mb-4">
    <li><a href="{{ route('games.index') }}" class="text-indigo-600 hover:underline">Main Page</a></li>
    <li><a href="{{ route('games.show', $game->game_id) }}" class="text-indigo-600 hover:underline">Reload Game Board</a></li>
</ul>
<h1 class="text-2xl font-semibold mb-4">{{ $game->name }}</h1>
<p class="mb-4">State: {{ $game->state }}</p>
@if(isset($canNudge) && $canNudge)
<form method="post" action="/games/{{ $game->game_id }}/nudge" class="mb-4">
    @csrf
    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">Nudge</button>
</form>
@endif

<div id="board">
    <div id="pathmarkers">
@for($i = 1; $i <= 44; $i++)
        <div id="pm{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}"></div>
@endfor
    </div>
    <img src="/images/blank.gif" width="800" height="449" usemap="#gamemap" alt="" />
    {!! App\Helpers\BoardHelper::render($game) !!}
    <div id="next">{{ $game->get_trade_value() }}</div>
    {!! $game->draw_players() !!}
    <div id="dice">
        @php $dice = $game->get_dice(); @endphp
        @if(!empty($dice))
            <p>Attack: {{ implode(',', $dice['attack']) }}</p>
            <p>Defend: {{ implode(',', $dice['defend']) }}</p>
        @endif
    </div>
</div>
<div id="controls">
    {!! $game->draw_action() !!}
    <hr />
    <div id="chat-panel" class="mt-4">
        <div id="chat-container" class="mb-4 bg-white p-4 rounded shadow h-64 overflow-y-auto">
            <ul id="chat-messages" class="space-y-1"></ul>
        </div>
        <form id="chat-form" method="post" action="/chat/{{ $game->game_id }}" class="flex gap-2">
            @csrf
            <input type="text" name="message" id="chat-input" class="flex-1 border rounded p-2">
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">Send</button>
        </form>
    </div>
</div>
<script>
const messagesEl = document.getElementById('chat-messages');
function loadMessages() {
    fetch('/chat/{{ $game->game_id }}/messages')
        .then(r => r.json())
        .then(data => {
            messagesEl.innerHTML = '';
            data.reverse().forEach(m => {
                const li = document.createElement('li');
                li.textContent = `${m.from_player.username}: ${m.message}`;
                messagesEl.appendChild(li);
            });
        });
}
loadMessages();
setInterval(loadMessages, 3000);
document.getElementById('chat-form').addEventListener('submit', e => {
    e.preventDefault();
    const form = e.target;
    fetch('/chat/{{ $game->game_id }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value,
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({message: document.getElementById('chat-input').value})
    }).then(() => {
        document.getElementById('chat-input').value = '';
        loadMessages();
    });
});
</script>
@endsection
