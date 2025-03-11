<?php if ($isLoggedIn): ?>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // OPEN USER PROFILE DROPDOWN
            const filters = document.querySelectorAll(".filterOpen");

            filters.forEach((filter) => {
                filter.addEventListener("click", () => {
                    const dataTarget = filter.getAttribute("data-target");
                    const modalTarget = document.querySelector(`#${dataTarget}`);
                    modalTarget.classList.toggle("hidden");
                });
            });
        });
    </script>
<?php endif; ?>