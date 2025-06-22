<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WebRisk</title>
    @if (file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
</head>
<body class="bg-slate-100 text-gray-900 min-h-screen flex flex-col">
    <nav class="bg-indigo-700 text-white">
        <div class="container mx-auto max-w-screen-lg flex flex-wrap items-center justify-between p-4">
            <a href="/" class="font-bold text-xl">WebRisk</a>
            <button id="nav-toggle" class="sm:hidden" aria-controls="nav-menu" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <ul id="nav-menu" class="hidden w-full flex-col gap-2 mt-2 list-none sm:flex sm:w-auto sm:flex-row sm:gap-4 sm:mt-0 items-center">
                @if(session('player_id'))
                    <li><a href="/games" class="hover:underline">Games</a></li>
                    <li><a href="/games/create" class="hover:underline">Create Game</a></li>
                    <li><a href="/archive" class="hover:underline">Archive</a></li>
                    <li><a href="/messages" class="hover:underline">Messages</a></li>
                    <li><a href="/stats" class="hover:underline">Stats</a></li>
                    <li><a href="/prefs" class="hover:underline">Prefs</a></li>
                    <li><a href="/profile" class="hover:underline">Profile</a></li>
                    @php($player = \App\Models\Player::find(session('player_id')))
                    @if($player?->is_admin)
                        <li><a href="/admin" class="hover:underline">Admin</a></li>
                    @endif
                    <li><a href="/logout" class="hover:underline">Logout</a></li>
                @else
                    <li><a href="/login" class="hover:underline">Login</a></li>
                    <li><a href="/register" class="hover:underline">Register</a></li>
                @endif
            </ul>
        </div>
    </nav>
    <main class="flex-1 container mx-auto max-w-screen-lg p-4">
        @yield('content')
    </main>
    <script>
        const toggle = document.getElementById('nav-toggle');
        toggle.addEventListener('click', () => {
            const menu = document.getElementById('nav-menu');
            const expanded = toggle.getAttribute('aria-expanded') === 'true';
            menu.classList.toggle('hidden');
            toggle.setAttribute('aria-expanded', expanded ? 'false' : 'true');
        });
    </script>
</body>
</html>
