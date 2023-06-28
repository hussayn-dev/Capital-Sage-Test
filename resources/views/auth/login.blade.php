@extends('layout.app')

@section('title', 'Login')

@section('content')
    <div class="w-full h-screen flex flex-col items-center justify-center px-4">
        <div class="max-w-sm w-full text-gray-600">
            <div class="text-center">
{{--                <img src="https://floatui.com/logo.svg" width={150} class="mx-auto" />--}}
                <div class="mt-5 space-y-2">
                    <h3 class="text-gray-800 text-2xl font-bold sm:text-3xl">Log in to your account</h3>
                    <p class="">Don't have an account? <a href="{{route('register')}}" class="font-medium text-indigo-600 hover:text-indigo-500">Sign up</a></p>
                </div>
            </div>
            <div class="shadow">
                @livewire('auth.login-form')
            </div>
        </div>
    </div>
@endsection
