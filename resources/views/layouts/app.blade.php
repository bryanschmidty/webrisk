<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>WebRisk</title>
</head>
<body>
    <nav>
        @if(session('player_id'))
            <a href="/games">Games</a> |
            @php($player = \App\Models\Player::find(session('player_id')))
            @if($player?->is_admin)
                <a href="/admin">Admin</a> |
            @endif
            <a href="/logout">Logout</a>
        @else
            <a href="/login">Login</a> |
            <a href="/register">Register</a>
        @endif
    </nav>
    <hr>
    @yield('content')
</body>
</html>
