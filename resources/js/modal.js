
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
