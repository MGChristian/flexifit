document.addEventListener("DOMContentLoaded", () => {
  // SIDEBAR DROPDOWN
  const dropdown = document.querySelector(".content-a");
  const openDropdown = document.querySelector(".content-m");

  dropdown.addEventListener("click", function () {
    openDropdown.classList.toggle("hidden");
  });

  // DROPDOWN FOR THE NUMBER OF CLIENTS BOOKED (MIGHT BE REMOVED)
  const dropdowns = document.querySelector(".client-dropdown");
  const cards = document.querySelector(".client-cards");

  if (dropdowns && cards) {
    dropdowns.addEventListener("click", function () {
      console.log("clicked");
      cards.classList.toggle("show");
    });
  }

  // MODAL OPENER
  const filters = document.querySelectorAll(".filterOpen");
  console.log(filters);
  if (filters) {
    filters.forEach((filter) => {
      filter.addEventListener("click", () => {
        const dataTarget = filter.getAttribute("data-target");
        const modalTarget = document.querySelector(`#${dataTarget}`);
        modalTarget.classList.toggle("hidden");
      });
    });
  }

  // NAVBAR HAMBUGER
  const hamburger = document.querySelector(".navbar-hamburger");
  const sidebar = document.querySelector(".sidebar");
  hamburger.addEventListener("click", () => {
    sidebar.classList.toggle("clicked");
  });
});
