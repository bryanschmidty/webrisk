@extends('layouts.app')

@section('content')
<h1>Create Game</h1>
<form method="post" action="/games">
    @csrf
    <div>
        <label>Game Name</label>
        <input type="text" name="name" value="{{ old('name') }}">
    </div>
    <div>
        <label>Capacity</label>
        <select name="capacity">
            @for($i = 2; $i <= 6; $i++)
                <option value="{{ $i }}" @selected(old('capacity',6)==$i)>{{ $i }}</option>
            @endfor
        </select>
    </div>
    <div>
        <label>Allow Kibitz</label>
        <input type="checkbox" name="allow_kibitz" value="1" @checked(old('allow_kibitz'))>
    </div>
    <div>
        <label>Fortify</label>
        <label><input type="radio" name="fortify" value="1" @checked(old('fortify',1))>Yes</label>
        <label><input type="radio" name="fortify" value="0" @checked(old('fortify')==='0')>No</label>
        <label><input type="checkbox" name="multiple_fortify" value="1" @checked(old('multiple_fortify'))>Multiple</label>
        <label><input type="checkbox" name="connected_fortify" value="1" @checked(old('connected_fortify'))>Connected</label>
    </div>
    <div>
        <label><input type="checkbox" name="kamikaze" value="1" @checked(old('kamikaze'))>Kamikaze</label>
    </div>
    <div>
        <label><input type="checkbox" name="warmonger" value="1" @checked(old('warmonger'))>Warmonger</label>
    </div>
    <div>
        <label>Fog of War Armies</label>
        <label><input type="radio" name="fog_of_war_armies" value="all" @checked(old('fog_of_war_armies','all')=='all')>All</label>
        <label><input type="radio" name="fog_of_war_armies" value="adjacent" @checked(old('fog_of_war_armies')=='adjacent')>Adjacent</label>
        <label><input type="radio" name="fog_of_war_armies" value="none" @checked(old('fog_of_war_armies')=='none')>None</label>
    </div>
    <div>
        <label>Fog of War Colors</label>
        <label><input type="radio" name="fog_of_war_colors" value="all" @checked(old('fog_of_war_colors','all')=='all')>All</label>
        <label><input type="radio" name="fog_of_war_colors" value="adjacent" @checked(old('fog_of_war_colors')=='adjacent')>Adjacent</label>
        <label><input type="radio" name="fog_of_war_colors" value="none" @checked(old('fog_of_war_colors')=='none')>None</label>
    </div>
    <div>
        <label><input type="checkbox" name="nuke" value="1" @checked(old('nuke'))>Nuclear War</label>
    </div>
    <div>
        <label><input type="checkbox" name="turncoat" value="1" @checked(old('turncoat'))>Turncoat</label>
    </div>
    <div>
        <label><input type="checkbox" name="place_initial_armies" value="1" @checked(old('place_initial_armies'))>Random Placement</label>
    </div>
    <div>
        <label>Placement Limit</label>
        <input type="number" name="initial_army_limit" value="{{ old('initial_army_limit',0) }}">
    </div>
    <div>
        <label>Password</label>
        <input type="password" name="password">
    </div>
    <button type="submit">Create Game</button>
</form>
@endsection
