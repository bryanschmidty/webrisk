@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-4">Create Game</h1>
<form method="post" action="/games" class="space-y-4 bg-white p-6 rounded shadow max-w-lg mx-auto">
    @csrf
    <div class="flex flex-col">
        <label class="mb-1">Game Name</label>
        <input class="border rounded p-2" type="text" name="name" value="{{ old('name') }}">
    </div>
    <div class="flex flex-col">
        <label class="mb-1">Capacity</label>
        <select name="capacity" class="border rounded p-2">
            @for($i = 2; $i <= 6; $i++)
                <option value="{{ $i }}" @selected(old('capacity',6)==$i)>{{ $i }}</option>
            @endfor
        </select>
    </div>
    <div>
        <label class="flex items-center gap-2"><input type="checkbox" class="rounded" name="allow_kibitz" value="1" @checked(old('allow_kibitz'))>Allow Kibitz</label>
    </div>
    <div>
        <label class="block mb-1">Fortify</label>
        <div class="flex gap-2 flex-wrap">
            <label class="flex items-center gap-1"><input type="radio" class="rounded" name="fortify" value="1" @checked(old('fortify',1))>Yes</label>
            <label class="flex items-center gap-1"><input type="radio" class="rounded" name="fortify" value="0" @checked(old('fortify')==='0')>No</label>
            <label class="flex items-center gap-1"><input type="checkbox" class="rounded" name="multiple_fortify" value="1" @checked(old('multiple_fortify'))>Multiple</label>
            <label class="flex items-center gap-1"><input type="checkbox" class="rounded" name="connected_fortify" value="1" @checked(old('connected_fortify'))>Connected</label>
        </div>
    </div>
    <div>
        <label class="flex items-center gap-2"><input type="checkbox" class="rounded" name="kamikaze" value="1" @checked(old('kamikaze'))>Kamikaze</label>
    </div>
    <div>
        <label class="flex items-center gap-2"><input type="checkbox" class="rounded" name="warmonger" value="1" @checked(old('warmonger'))>Warmonger</label>
    </div>
    <div>
        <label class="block mb-1">Fog of War Armies</label>
        <div class="flex gap-2">
            <label class="flex items-center gap-1"><input type="radio" class="rounded" name="fog_of_war_armies" value="all" @checked(old('fog_of_war_armies','all')=='all')>All</label>
            <label class="flex items-center gap-1"><input type="radio" class="rounded" name="fog_of_war_armies" value="adjacent" @checked(old('fog_of_war_armies')=='adjacent')>Adjacent</label>
            <label class="flex items-center gap-1"><input type="radio" class="rounded" name="fog_of_war_armies" value="none" @checked(old('fog_of_war_armies')=='none')>None</label>
        </div>
    </div>
    <div>
        <label class="block mb-1">Fog of War Colors</label>
        <div class="flex gap-2">
            <label class="flex items-center gap-1"><input type="radio" class="rounded" name="fog_of_war_colors" value="all" @checked(old('fog_of_war_colors','all')=='all')>All</label>
            <label class="flex items-center gap-1"><input type="radio" class="rounded" name="fog_of_war_colors" value="adjacent" @checked(old('fog_of_war_colors')=='adjacent')>Adjacent</label>
            <label class="flex items-center gap-1"><input type="radio" class="rounded" name="fog_of_war_colors" value="none" @checked(old('fog_of_war_colors')=='none')>None</label>
        </div>
    </div>
    <div>
        <label class="block mb-1">Fog of War Cards</label>
        <div class="flex gap-2">
            <label class="flex items-center gap-1"><input type="radio" class="rounded" name="fog_of_war_cards" value="all" @checked(old('fog_of_war_cards','all')=='all')>All</label>
            <label class="flex items-center gap-1"><input type="radio" class="rounded" name="fog_of_war_cards" value="self" @checked(old('fog_of_war_cards')=='self')>Self Only</label>
        </div>
    </div>
    <div>
        <label class="flex items-center gap-2"><input type="checkbox" class="rounded" name="nuke" value="1" @checked(old('nuke'))>Nuclear War</label>
    </div>
    <div>
        <label class="flex items-center gap-2"><input type="checkbox" class="rounded" name="turncoat" value="1" @checked(old('turncoat'))>Turncoat</label>
    </div>
    <div>
        <label class="flex items-center gap-2"><input type="checkbox" class="rounded" name="place_initial_armies" value="1" @checked(old('place_initial_armies'))>Random Placement</label>
    </div>
    <div class="flex flex-col">
        <label class="mb-1">Placement Limit</label>
        <input class="border rounded p-2" type="number" name="initial_army_limit" value="{{ old('initial_army_limit',0) }}">
    </div>
    <div class="flex flex-col">
        <label class="mb-1">Password</label>
        <input class="border rounded p-2" type="password" name="password">
    </div>
    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">Create Game</button>
</form>
@endsection
