@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-4">Edit Profile</h1>
@if(session('status'))
    <div class="mb-4 p-2 bg-green-200 border border-green-300 rounded">{{ session('status') }}</div>
@endif
<form method="post" action="/profile" class="space-y-4 bg-white p-6 rounded shadow max-w-lg mx-auto">
    @csrf
    <div class="flex flex-col">
        <label class="mb-1">Username</label>
        <span class="p-2">{{ $player->username }}</span>
    </div>
    <div class="flex flex-col">
        <label class="mb-1">First Name</label>
        <input class="border rounded p-2" type="text" name="first_name" value="{{ old('first_name', $player->first_name) }}">
    </div>
    <div class="flex flex-col">
        <label class="mb-1">Last Name</label>
        <input class="border rounded p-2" type="text" name="last_name" value="{{ old('last_name', $player->last_name) }}">
    </div>
    <div class="flex flex-col">
        <label class="mb-1">Email</label>
        <input class="border rounded p-2" type="email" name="email" value="{{ old('email', $player->email) }}">
    </div>
    <div class="flex flex-col">
        <label class="mb-1">Timezone</label>
        <select class="border rounded p-2" name="timezone">
            <option value="">Use Game Default (UTC)</option>
            @foreach($timezones as $zone)
                <option value="{{ $zone }}" @selected(old('timezone', $player->timezone) === $zone)>{{ $zone }}</option>
            @endforeach
        </select>
    </div>
    <div class="flex flex-col">
        <label class="mb-1">Current Password</label>
        <input class="border rounded p-2" type="password" name="current_password">
    </div>
    <div class="flex flex-col">
        <label class="mb-1">New Password</label>
        <input class="border rounded p-2" type="password" name="password">
    </div>
    <div class="flex flex-col">
        <label class="mb-1">Confirm Password</label>
        <input class="border rounded p-2" type="password" name="password_confirmation">
    </div>
    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">Update Profile</button>
</form>
@endsection
