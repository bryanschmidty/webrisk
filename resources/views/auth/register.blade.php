@extends('layouts.app')

@section('content')
<h1>Register</h1>
<form method="post" action="/register">
    @csrf
    <div>
        <label>Username</label>
        <input type="text" name="username" value="{{ old('username') }}">
    </div>
    <div>
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}">
    </div>
    <div>
        <label>Password</label>
        <input type="password" name="password">
    </div>
    <div>
        <label>Confirm Password</label>
        <input type="password" name="password_confirmation">
    </div>
    <button type="submit">Register</button>
</form>
@endsection
