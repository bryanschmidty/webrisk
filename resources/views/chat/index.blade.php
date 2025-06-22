@extends('layouts.app')

@section('content')
<h1>Chat</h1>
<div id="chat-container">
    <ul id="chat-messages"></ul>
</div>
<form id="chat-form" method="post" action="">
    @csrf
    <input type="text" name="message" id="chat-input">
    <button type="submit">Send</button>
</form>
<script>
    const messagesEl = document.getElementById('chat-messages');
    function loadMessages() {
        fetch(location.pathname + '/messages')
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
        fetch(location.pathname, {
            method: 'POST',
            headers: {'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value,
                      'Content-Type': 'application/json'},
            body: JSON.stringify({message: document.getElementById('chat-input').value})
        }).then(() => {
            document.getElementById('chat-input').value = '';
            loadMessages();
        });
    });
</script>
@endsection
