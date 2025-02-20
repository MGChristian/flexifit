<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/colors.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/upcomingbook.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <?php include "includes/css.php" ?>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

</head>

<body>
    <div class="grid-container">
        <!-- header -->
        <?php include "includes/header.php" ?>
        <!-- header -->

        <!-- side -->
        <?php include "includes/sidebar.php" ?>
        <!-- side -->

        <!-- main -->
        <main class="main-container">
            <div class="page-title">
                <h1>BOOKINGS RECORD || CLIENT</h1>
                <div class="quick-link">
                    <p><a href="index.php"> HOME </a> > <a href="newbooking.php">UPCOMING BOOKINGS</a> > UPCOMING BOOKINGS DESCRIPTION</p>
                </div>
            </div>
            <div class="main-content">
                <div class="table-desc">
                    <h3>LATEST BOOKINGS SUMMARY</h3>
                </div>
                <hr>
                <div class="book-desc">
                    <img src="https://picsum.photos/400/100" style="width:100%">
                    <p>Class Name:</p>
                    <p>Instructor Name:</p>
                    <p>Date and Time: </p>
                    <p>Session: </p>
                    <p>Slot: </p>
                </div>
                <div class="upcoming-clients">
                    <div class="client-dropdown">
                        <p>VIEW CLIENTS</p>
                        <div><box-icon name='chevron-down'></box-icon></div>
                    </div>
                    <div class="client-cards hidden">
                        <?php for ($i = 1; $i <= 10; $i++) { ?>
                            <div class="client-card">
                                <img src="images/1.jpg" class="lazy" data-src="images/test.jpg">
                                <p>Surname, Name M.I</p>
                                <p>DATE BOOKED: MM-DD-YYYY</p>
                                <p style="background-color:var(--green); padding:0.5em; color:white;"> PRESENT </p>
                                <a href="userpage.php" class="view-profile"><button type="button">VIEW PROFILE</button></a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>


        </main>
        <!-- side -->
    </div>
    <script src="js/scripts.js"></script>
    <!-- <script>
        let users = document.querySelectorAll(".lazy");

        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                entry.target.classList.toggle("hidden", entry.isIntersecting);
            });
        });

        users.forEach(user => {
            observer.observe(users[0]);
        })
    </script> -->
</body>

</html>