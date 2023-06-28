@extends('layout.app')

@section('title', 'Register')

@section('content')
    <main class="w-full h-screen flex flex-col items-center justify-center bg-gray-50 sm:px-4">
        <div class="w-full space-y-6 text-gray-600 sm:max-w-md">
            <div class="text-center">
{{--                <img src="https://floatui.com/logo.svg" width={150} class="mx-auto" />--}}
                <div class="mt-5 space-y-2">
                    <h3 class="text-gray-800 text-2xl font-bold sm:text-3xl">Create an account</h3>
                    <p class="">Already have an account? <a href="{{route('login')}}" class="font-medium text-indigo-600 hover:text-indigo-500">Log in</a></p>
                </div>
            </div>
            <div class=" shadow p-6 py-6 sm:p-6 sm:rounded-lg">
                @livewire('auth.register-form')
            </div>
        </div>
    </main>
@endsection
