@extends('layouts.app')

@section('content')
<h1>Edit Profile</h1>
@if(session('status'))
    <div>{{ session('status') }}</div>
@endif
<form method="post" action="/profile">
    @csrf
    <div>
        <label>Username</label>
        <span>{{ $player->username }}</span>
    </div>
    <div>
        <label>First Name</label>
        <input type="text" name="first_name" value="{{ old('first_name', $player->first_name) }}">
    </div>
    <div>
        <label>Last Name</label>
        <input type="text" name="last_name" value="{{ old('last_name', $player->last_name) }}">
    </div>
    <div>
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email', $player->email) }}">
    </div>
    <div>
        <label>Timezone</label>
        <select name="timezone">
            <option value="">Use Game Default (UTC)</option>
            @foreach($timezones as $zone)
                <option value="{{ $zone }}" @selected(old('timezone', $player->timezone) === $zone)>{{ $zone }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label>Current Password</label>
        <input type="password" name="current_password">
    </div>
    <div>
        <label>New Password</label>
        <input type="password" name="password">
    </div>
    <div>
        <label>Confirm Password</label>
        <input type="password" name="password_confirmation">
    </div>
    <button type="submit">Update Profile</button>
</form>
@endsection
