// MODAL JS
document.addEventListener("DOMContentLoaded", function () {
  const modals = document.querySelectorAll(".modal-wrapper");
  const openModal = document.querySelectorAll(".openModal");

  openModal.forEach(function (btn) {
    const modalId = btn.getAttribute("data-target");
    const modal = document.getElementById(modalId);
    openClose(btn, modal);
  });

  modals.forEach(function (modal, index) {
    modal.addEventListener("click", (e) => {
      console.log(e.target);
    });
    const closeModal = modal.querySelectorAll(".closeModal");
    closeModal.forEach(function (close) {
      openClose(close, modal);
    });

    document.onkeydown = (event) => {
      if (event.keyCode == 27 && !modal.classList.contains("hidden")) {
        modal.classList.add("hidden");
      }
    };
  });

  function openClose(toggler, modal) {
    toggler.addEventListener("click", () => {
      modal.classList.toggle("hidden");
      if (toggler.id) {
        const categoryID = toggler.id;
        sendIdToForm(categoryID, modal);
      }
    });
  }

  function sendIdToForm(ID, modal) {
    const addID = document.getElementById("category-id");
    addID.value = ID;
  }
});
