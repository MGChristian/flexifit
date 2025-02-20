<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/colors.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/upcomingbook.css">
    <link href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.2.1/af-2.7.0/b-3.2.0/b-colvis-3.2.0/b-html5-3.2.0/b-print-3.2.0/cr-2.0.4/date-1.5.5/fc-5.0.4/fh-4.0.1/kt-2.12.1/r-3.0.3/rg-1.5.1/rr-1.5.0/sc-2.4.3/sb-1.8.1/sp-2.3.3/sl-3.0.0/sr-1.4.1/datatables.min.css" rel="stylesheet">
    <?php include "includes/css.php" ?>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.2.1/af-2.7.0/b-3.2.0/b-colvis-3.2.0/b-html5-3.2.0/b-print-3.2.0/cr-2.0.4/date-1.5.5/fc-5.0.4/fh-4.0.1/kt-2.12.1/r-3.0.3/rg-1.5.1/rr-1.5.0/sc-2.4.3/sb-1.8.1/sp-2.3.3/sl-3.0.0/sr-1.4.1/datatables.min.js"></script>
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
                <h1>UPCOMING BOOKINGS</h1>
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
</body>

</html>