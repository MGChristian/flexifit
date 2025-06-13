document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector("form");

  const inputEl = form.querySelectorAll("input");
  const selectEl = form.querySelectorAll("select");

  inputEl.forEach((input) => {
    input.addEventListener("input", () => {
      if (input.value.trim() !== "") {
        input.style.borderColor = ""; // reset back to normal
      }
    });
  });

  selectEl.forEach((select) => {
    select.addEventListener("input", () => {
      if (select.value.trim() !== "") {
        select.style.borderColor = ""; // reset back to normal
      }
    });
  });

  form.addEventListener("submit", (e) => {
    let emptyElementList = [];
    let hasEmpty = false;

    inputEl.forEach((input) => {
      const inputValue = input.value.trim();

      if (inputValue === "") {
        input.style.borderColor = "var(--red)";
        emptyElementList.push(input.name);
        hasEmpty = true;
      } else {
        input.style.borderColor = ""; // reset border
      }
    });

    selectEl.forEach((select) => {
      const selectValue = select.value.trim();

      if (selectValue === "") {
        select.style.borderColor = "var(--red)";
        emptyElementList.push(select.name);
        hasEmpty = true;
      } else {
        select.style.borderColor = ""; // reset border
      }
    });

    if (hasEmpty) {
      e.preventDefault(); // block form submission
      console.log("Empty fields:", emptyElementList); // or show a message
    }
  });
});

const signInputPass = document.getElementById('signPass');
const signInputConfirmPass = document.getElementById('signConfirmPass');
const signInputPassIcon = document.getElementById('signPass-icon');
const signInputConfirmPassIcon = document.getElementById('signConfirmPass-icon');

function mySignPassword() {
  if (signInputPass.type === "password") {
    signInputPass.type = "text";

    signInputPassIcon.name = "eye-off-outline";
    signInputPassIcon.style.cursor = "pointer";
  } else {
    signInputPass.type = "password";

    signInputPassIcon.name = "eye-outline";
    signInputPassIcon.style.cursor = "pointer";
  }
}

function mySignConfirmPassword() {
  if (signInputConfirmPass.type === "password") {
    signInputConfirmPass.type = "text";

    signInputConfirmPassIcon.name = "eye-off-outline";
    signInputConfirmPassIcon.style.cursor = "pointer";
  } else {
    signInputConfirmPass.type = "password";

    signInputConfirmPassIcon.name = "eye-outline";
    signInputConfirmPassIcon.style.cursor = "pointer";
  }
}

function changeIcon(value) {
  if (value.length > 0) {
    signInputPassIcon.name = "eye-outline";
  } else {
    signInputPassIcon.name = "lock-closed-outline";
  }
}

function changeConfirmPassIcon(value) {
  if (value.length > 0) {
    signInputConfirmPassIcon.name = "eye-outline";
  } else {
    signInputConfirmPassIcon.name = "lock-closed-outline";
  }
}

const pass = document.getElementById('signPass');
const confirm = document.getElementById('signConfirmPass');
const message = document.getElementById('matchMessage');

function checkPasswords() {
  const passVal = pass.value.trim();
  const confirmVal = confirm.value.trim();

  if (passVal === '' && confirmVal === '') {
    message.textContent = '';
    message.classList.remove('success', 'error');
    pass.style.borderColor = '';
    confirm.style.borderColor = '';
    return;
  }

  if (passVal === confirmVal) {
    message.textContent = 'Passwords match';
    message.classList.remove('error');
    message.classList.add('success');
    pass.style.borderColor = '';
    confirm.style.borderColor = '';
  } else {
    message.textContent = 'Passwords don’t match';
    message.classList.remove('success');
    message.classList.add('error');
    pass.style.borderColor = 'var(--red)';
    confirm.style.borderColor = 'var(--red)';
  }
}

pass.addEventListener('input', checkPasswords);
confirm.addEventListener('input', checkPasswords);

