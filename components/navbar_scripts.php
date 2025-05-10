<?php
// Check if user is logged in, to add the profile dropdown script
if ($isLoggedIn):
?>
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

<script>
    document.addEventListener("DOMContentLoaded", () => {
        // MOBILE NAV LINKS
        const hamburger = document.querySelector(".navbar-hamburger");
        const navLinksMobile = document.querySelector(".nav-links-mobile");
        hamburger.addEventListener("click", () => {
            navLinksMobile.classList.toggle("clicked");
            console.log("hello")
        });
    });
</script>