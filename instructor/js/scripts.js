const dropdown = document.querySelector(".booking-a");
const openDropdown = document.querySelector(".booking-m");

dropdown.addEventListener("click", function () {
  openDropdown.classList.toggle("hidden");
});

const dropdowns = document.querySelector(".client-dropdown");
const cards = document.querySelector(".client-cards");

dropdowns.addEventListener("click", function () {
  console.log("clicked");
  cards.classList.toggle("hidden");
});
