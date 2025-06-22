@extends('layouts.app')

@section('content')
<h1>Edit Preferences</h1>
@if(session('status'))
    <div>{{ session('status') }}</div>
@endif
<form method="post" action="/prefs">
    @csrf
    <div>
        <label><input type="checkbox" name="allow_email" value="1" @checked(old('allow_email', $prefs->allow_email))>Allow email</label>
    </div>
    <div>
        <label><input type="checkbox" name="invite_opt_out" value="1" @checked(old('invite_opt_out', $prefs->invite_opt_out))>Opt out of invites</label>
    </div>
    <div>
        <label>Max games</label>
        <input type="number" name="max_games" value="{{ old('max_games', $prefs->max_games) }}">
    </div>
    <div>
        <label>Theme color</label>
        <select name="color">
            <option value="">Use Default</option>
            @foreach($colors as $color)
                <option value="{{ $color }}" @selected(old('color', $prefs->color)===$color)>{{ ucwords(str_replace('_',' ',$color)) }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit">Save Preferences</button>
</form>
@endsection
