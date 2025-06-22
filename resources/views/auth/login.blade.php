@extends('layouts.app')

@section('content')
<h1>Login</h1>
<form method="post" action="/login">
    @csrf
    <div>
        <label>Username</label>
        <input type="text" name="username" value="{{ old('username') }}">
    </div>
    <div>
        <label>Password</label>
        <input type="password" name="password">
    </div>
    <button type="submit">Login</button>
</form>
@endsection
