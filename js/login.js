const logInputPass = document.getElementById('logPassword');
const logInputIcon = document.getElementById('logPass-icon');

function myLogPassword() {
    if (logInputPass.type === "password") {
    logInputPass.type = "text";

    logInputIcon.name = "eye-off-outline";
    logInputIcon.style.cursor = "pointer";
    } else {
    logInputPass.type = "password";

    logInputIcon.name = "eye-outline";
    logInputIcon.style.cursor = "pointer";
    }
}

function changeIcon(value) {
    if (value.length > 0) {
    logInputIcon.name = "eye-outline";
    } else {
    logInputIcon.name = "lock-closed-outline"
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('.form-container form');
    const usernameInput = form.querySelector('input[name="username"]');
    const passwordInput = form.querySelector('input[name="password"]');
    const errorWrapper = form.querySelector('.error-wrapper');

    const validationMsg = document.createElement('p');
    validationMsg.className = 'form-error';
    validationMsg.textContent = 'Please fill in all fields';
    validationMsg.style.display = 'none';
    errorWrapper.appendChild(validationMsg);

    const inputs = [usernameInput, passwordInput];

    function validateInputs(e) {
    let hasError = false;

    inputs.forEach(input => {
        if (input.value.trim() === '') {
        input.classList.add('input-error');
        hasError = true;
        } else {
        input.style.borderColor = 'var (--red)';
        }
    });

    if (hasError) {
        e.preventDefault(); // Prevent form submission
        validationMsg.style.display = 'block';
    } else {
        validationMsg.style.display = 'none';
    }
    }

    function clearValidationOnInput() {
    inputs.forEach(input => {
        input.addEventListener('input', () => {
        if (input.value.trim() === '') {
            input.classList.add('input-error');
        } else {
            input.style.borderColor = 'var (--red)';
        }

        // Hide message if both have values
        if (usernameInput.value.trim() || passwordInput.value.trim()) {
            validationMsg.style.display = 'none';
        }
        });
    });
    }

    form.addEventListener('submit', validateInputs);
    clearValidationOnInput();
});