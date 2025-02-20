document.addEventListener("DOMContentLoaded", () => {
  // Initialize elements
  const firstNameEl = document.querySelector("#firstName");
  const lastNameEl = document.querySelector("lastName");
  const dateEl = document.querySelector("#birthdate");
  const emailEl = document.querySelector("#email");
  const contactNumberEl = document.querySelector("#contactNumber");
  const genderEl = document.querySelector("#gender");
  const allInputs = document.querySelectorAll("input");
  const allSelect = document.querySelectorAll("select");
  const form = document.querySelector("form");

  // Change Date Color When Empty

  checkDate(dateEl);
  dateEl.addEventListener("input", () => {
    checkDate(dateEl);
  });

  // Check if date input is empty
  function checkDate() {
    if (dateEl.value == "") {
      dateEl.classList.add("date-empty");
    } else if (dateEl.value != "") {
      dateEl.classList.remove("date-empty");
    }
  }

  // Check if email is already in use
  form.addEventListener("submit", (e) => {
    async function emailIsDuplicate(emailValue) {
      const emailJSON = {
        email: emailValue,
      };
      const jsonString = JSON.stringify(emailJSON);
      const response = await fetch("handlers/signup-handler.php", {
        method: "POST",
        body: jsonString,
        header: {
          "Content-Type": "application/json",
        },
      });
      if (!response.ok) {
        throw new Error(`Response status: ${response.status}`);
      }
      const emailStatus = await response.json();
      if(emailStatus == "")
    }
    e.preventDefault();
  });
});
