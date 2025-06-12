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
