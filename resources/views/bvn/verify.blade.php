@extends('layout.app')

@section('title', 'BVN Verification')

@section('content')

    <div id="modal" class=" min-h-screen bg-gray-100 inset-0 flex items-center z-50">
    <div class=" mx-auto p-8 flex flex-col rounded-lg shadow-md items-center  justify-center">
        @if (session()->has('success'))
            <p class="text-black-400 ml-5 text-sm text-center">{{ session('success') }}</p>
        @endif
        <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-gray-800 uppercase mb-6">OTP Verification</h2>
            <div class="mt-6">
                <label class="text-gray-600">
                    Verification code
                </label>
                <form method="POST" action="{{route('bvn.verify.submit')}}">
                    @csrf
                    <div class="flex">
                        <input type="text" placeholder="0" name="code1" class="w-12 h-12 rounded-lg border focus:border-indigo-600 outline-none text-center text-2xl" maxlength="1" oninput="moveToNextInput(this, 'code2')" onkeypress="return isNumeric(event)">
                        <input type="text" placeholder="0" name="code2" class="w-12 h-12 rounded-lg border focus:border-indigo-600 outline-none text-center text-2xl" maxlength="1" oninput="moveToNextInput(this, 'code3')" onkeypress="return isNumeric(event)">
                        <input type="text" placeholder="0" name="code3" class="w-12 h-12 rounded-lg border focus:border-indigo-600 outline-none text-center text-2xl" maxlength="1" oninput="moveToNextInput(this, 'code4')" onkeypress="return isNumeric(event)">
                        <input type="text" placeholder="0" name="code4" class="w-12 h-12 rounded-lg border focus:border-indigo-600 outline-none text-center text-2xl" maxlength="1" oninput="moveToNextInput(this, 'code5')" onkeypress="return isNumeric(event)">
                        <input type="text" placeholder="0" name="code5" class="w-12 h-12 rounded-lg border focus:border-indigo-600 outline-none text-center text-2xl" maxlength="1" oninput="moveToNextInput(this, 'code6')" onkeypress="return isNumeric(event)">
                        <input type="text" placeholder="0" name="code6" class="w-12 h-12 rounded-lg border focus:border-indigo-600 outline-none text-center text-2xl" maxlength="1" onkeypress="return isNumeric(event)">
                    </div>
                    <input type="hidden" name="otp" id="otpInput">
                    @error('otp')
                    <p class="text-red-400 text-sm mt-1">{{$message}}</p>
                    @enderror
                    @if (session()->has('error'))
                        <p class="text-red-400 ml-5 text-sm text-center">{{ session('error') }}</p>
                    @endif
                    <button type="submit" class="mt-6 mx-auto block px-4 py-2 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-500" onclick="concatenateOTP()">Submit</button>
                </form>

            </div>
        </div>
    </div>
</div>
    <script>


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




