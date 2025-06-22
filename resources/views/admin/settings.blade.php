@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-4">Settings</h1>
<form method="post" action="/admin/settings" class="space-y-4">
    @csrf
    <div class="overflow-x-auto">
    <table class="min-w-full bg-white divide-y divide-gray-300 shadow rounded">
        <thead class="bg-gray-50">
            <tr><th class="px-4 py-2 text-left">Setting</th><th class="px-4 py-2 text-left">Value</th></tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
        @foreach($settings as $setting)
            <tr>
                <td class="px-4 py-2">{{ $setting->setting }}</td>
                <td class="px-4 py-2"><input class="border rounded p-2 w-full" type="text" name="settings[{{ $setting->setting }}]" value="{{ $setting->value }}"></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">Save</button>
</form>
@endsection
