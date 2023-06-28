@extends('layout.app')

@section('title', 'Home')

@section('content')
        <div class="max-w-screen-xl mx-auto px-4 py-28 gap-12 text-gray-600 md:px-8">
            <div class="flex items-start justify-between space-x-4 pt-2 pr-2">
                <div>
                    <!-- Replace "your-logo.png" with the path to your logo image -->
                    <img src="your-logo.png" alt="Your Logo" class="h-8">
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="block py-2 px-4 text-gray-700 hover:text-gray-500 font-medium duration-150 active:bg-gray-100 border rounded-lg">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="block py-2 px-4 text-white font-medium bg-indigo-600 duration-150 hover:bg-indigo-500 active:bg-indigo-700 rounded-lg shadow-lg hover:shadow-none">
                        Register
                    </a>
                </div>
            </div>
            <div class="space-y-5 max-w-4xl mx-auto text-center">
                <h1 class="text-sm text-indigo-600 font-medium">
                    Building a Secure Future
                </h1>
                <h2 class="text-4xl text-gray-800 font-extrabold mx-auto md:text-5xl">
                    Protecting Your Identity<br> with Confidence and Peace of Mind
                </h2>
                <p class="max-w-2xl mx-auto">
                    Our security solutions ensure comprehensive protection by incorporating user identity verification, advanced biometrics, and state-of-the-art encryption.
                </p>
                <div class="items-center justify-center gap-x-3 space-y-3 sm:flex sm:space-y-0">
                    <a href="javascript:void(0)" class="block py-2 px-4 text-white font-medium bg-indigo-600 duration-150 hover:bg-indigo-500 active:bg-indigo-700 rounded-lg shadow-lg hover:shadow-none">
                        Get Started
                    </a>
                </div>
            </div>
        </div>
@endsection
