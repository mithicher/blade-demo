@extends('layouts.base')

@section('content')
<x-section-centered class="min-h-screen flex items-center">
    <x-card class="flex-1 md:max-w-lg md:mx-auto">
        <x-form method="POST" action="{{ route('login') }}">
    
            <x-text-input label="Email" name="email" type="email" />
            <x-text-input label="Password" name="password" type="password" />

            <x-button type="submit" class="w-full justify-center bg-indigo-600 hover:bg-indigo-700 text-white">Log in</x-button>
        </x-form>
    </x-card>
</x-section-centered>
@endsection
