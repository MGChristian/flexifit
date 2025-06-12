document.addEventListener("DOMContentLoaded", () => {
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
