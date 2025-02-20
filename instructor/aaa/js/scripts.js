const dropdown = document.querySelector(".booking-a");
const dropdown2 = document.querySelector(".refund-a");
const openDropdown = document.querySelector(".booking-m");
const openDropdown2 = document.querySelector(".refund-m");

dropdown.addEventListener("click", function(){
    openDropdown.classList.toggle("hidden");
});

dropdown2.addEventListener("click", function(){
    openDropdown2.classList.toggle("hidden");
});

const dropdowns = document.querySelector(".client-dropdown");
const cards = document.querySelector(".client-cards");

dropdowns.addEventListener("click", function() {
    console.log("clicked");
    cards.classList.toggle("hidden");
});