<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/colors.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/ratings.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
    <?php include "includes/css.php" ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    start: 'prev,today,next', // will normally be on the left. if RTL, will be on the right
                    center: 'title',
                    end: 'dayGridMonth,timeGridWeek,timeGridDay' // will normally be on the right. if RTL, will be on the left
                },
            });
            calendar.render();
        });
    </script>

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
                <h1>CALENDAR</h1>
                <div class="quick-link">
                    <p><a href="index.php"> HOME </a> > CALENDAR</p>
                </div>
            </div>
            <div class="main-content">
                <div class="table-desc">
                    <h3>CALENDAR</h3>
                    <hr>
                    <br>
                    <div class="calendar-content">
                        <div id='calendar'></div>
                    </div>
                </div>
                <hr>
                <div class="ratings-table">
                </div>
            </div>
        </main>
    </div>
    <script src="js/scripts.js"> </script>
</body>

</html>