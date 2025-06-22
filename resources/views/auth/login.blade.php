@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-4">Login</h1>
<form method="post" action="/login" class="space-y-4 bg-white p-6 rounded shadow max-w-md mx-auto">
    @csrf
    <div class="flex flex-col">
        <label class="mb-1">Username</label>
        <input class="border rounded p-2" type="text" name="username" value="{{ old('username') }}">
    </div>
    <div class="flex flex-col">
        <label class="mb-1">Password</label>
        <input class="border rounded p-2" type="password" name="password">
    </div>
    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">Login</button>
</form>
@endsection
