<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/colors.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/table-design.css">
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
                    <p><a href="index.php"> HOME </a> > UPCOMING BOOKINGS</p>
                </div>
            </div>
            <div class="main-content">
                <div class="table-desc">
                    <h3>LATEST BOOKINGS SUMMARY</h3>
                </div>
                <hr>
                <div class="refunds-table">
                    <table id="myTable" class="display" style="width:100%">
                        <thead>
                            <tr class="table-header">
                                <th>#</th>
                                <th>Class Name</th>
                                <th>Instructor</th>
                                <th>Date</th>
                                <th>Session</th>
                                <th>Time</th>
                                <th>Slot</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 1; $i <= 30; $i++) { ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td>Yoga Class</td>
                                    <td>Instructor Name</td>
                                    <td>MM/DD/YYYY</td>
                                    <td>Morning</td>
                                    <td>7:3<?php echo $i ?></td>
                                    <td>15/20</td>
                                    <td><a href="upcomingbook.php"><button type="button"><i class="fa fa-eye" aria-hidden="true"></i></a></button><button type="button"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
                                </tr>
                            <?php } ?>
                    </table>
                </div>
            </div>
        </main>
    </div>
    <script src="js/scripts.js"> </script>
    <script src="js/datatables.js"></script>
</body>

</html>