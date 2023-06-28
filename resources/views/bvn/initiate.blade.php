@extends('layout.app')

@section('title', 'BVN Verification')

@section('content')

    <div class="flex items-center justify-center h-screen bg-gray-100">
        <div class="max-w-md w-full px-4">
            <h2 class="text-gray-800 text-3xl text-center font-bold mb-8 sm:text-3xl">BVN Verification</h2>

            <form class="bg-white shadow-md rounded-lg px-8 py-6" method="POST"
                  action="{{route('bvn.initiate.submit')}}">
                @csrf
                @if (session()->has('error'))
                    <p class="text-red-400 ml-5 text-sm text-center">{{ session('error') }}</p>
                @endif
                <div class="mb-6">
                    <label for="bvn" class="block text-gray-800 font-medium mb-2">Enter your BVN number:</label>
                    <input id="bvn" name="bvn" type="text"
                           class="w-full px-3 py-2 text-gray-700 border border-gray-300 rounded-lg focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                           placeholder="BVN number" required>
                    @error('bvn')
                    <p class="text-red-400 text-sm mt-1">{{$message}}</p>
                    @enderror
                    <p class="text-red-400 text-sm text-center mt-2">Ensure the BVN is accurate.</p>
                </div>
                <input type="hidden" name="otp" id="otpInput">
                <button type="submit"
                        class="mt-6 mx-auto block px-4 py-2 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-500"
                        onclick="concatenateOTP()">Submit
                </button>
            </form>
        </div>
    </div>


    <script>
        @if(session()->has('success'))
        document.addEventListener('DOMContentLoaded', function () {
            var otpModal = document.getElementById('modal');
            otpModal.classList.remove('hidden');
        });
        @endif

        function moveToNextInput(input, nextInputName) {
            const inputValue = input.value;

            if (inputValue.length === 1) {
                const nextInput = document.getElementsByName(nextInputName)[0];

                if (nextInput) {
                    nextInput.focus();
                }
            }
        }

        function isNumeric(event) {
            const keyCode = event.which ? event.which : event.keyCode;
            const input = String.fromCharCode(keyCode);

            if (!/^\d+$/.test(input)) {
                event.preventDefault();
                return false;
            }
        }

        function concatenateOTP() {
            const inputElements = document.querySelectorAll('input[name^="code"]');
            const otpValue = Array.from(inputElements)
                .map(input => input.value)
                .join('');
            document.getElementById('otpInput').value = otpValue;
        }
    </script>
@endsection
