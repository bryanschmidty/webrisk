@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-4">Edit Preferences</h1>
@if(session('status'))
    <div class="mb-4 p-2 bg-green-200 border border-green-300 rounded">{{ session('status') }}</div>
@endif
<form method="post" action="/prefs" class="space-y-4 bg-white p-6 rounded shadow max-w-lg mx-auto">
    @csrf
    <div>
        <label class="flex items-center gap-2"><input type="checkbox" class="rounded" name="allow_email" value="1" @checked(old('allow_email', $prefs->allow_email))>Allow email</label>
    </div>
    <div>
        <label class="flex items-center gap-2"><input type="checkbox" class="rounded" name="invite_opt_out" value="1" @checked(old('invite_opt_out', $prefs->invite_opt_out))>Opt out of invites</label>
    </div>
    <div class="flex flex-col">
        <label class="mb-1">Max games</label>
        <input class="border rounded p-2" type="number" name="max_games" value="{{ old('max_games', $prefs->max_games) }}">
    </div>
    <div class="flex flex-col">
        <label class="mb-1">Theme color</label>
        <select class="border rounded p-2" name="color">
            <option value="">Use Default</option>
            @foreach($colors as $color)
                <option value="{{ $color }}" @selected(old('color', $prefs->color)===$color)>{{ ucwords(str_replace('_',' ',$color)) }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">Save Preferences</button>
</form>
@endsection
