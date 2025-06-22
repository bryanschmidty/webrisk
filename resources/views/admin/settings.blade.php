@extends('layouts.app')

@section('content')
<h1>Settings</h1>
<form method="post" action="/admin/settings">
    @csrf
    <table>
        <thead>
            <tr><th>Setting</th><th>Value</th></tr>
        </thead>
        <tbody>
        @foreach($settings as $setting)
            <tr>
                <td>{{ $setting->setting }}</td>
                <td><input type="text" name="settings[{{ $setting->setting }}]" value="{{ $setting->value }}"></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <button type="submit">Save</button>
</form>
@endsection
