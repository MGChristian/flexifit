<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/colors.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/table-design.css">
    <link rel="stylesheet" href="css/create-instructor.css">
    <link rel="stylesheet" href="css/user-page.css">
    <?php include "includes/css.php" ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
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
                <h1>USER PROFILE</h1>
                <div class="quick-link">
                    <p><a href="index.php"> HOME </a> > USER PROFILE</p>
                </div>
            </div>
            <div class="main-content">
                <div class="table-desc">
                    <div class="user-actions">
                        <a href="userpage.php">
                            <h3>VIEW USER PROFILE</h3>
                        </a>
                        <a href="user-history.php">
                            <h3>BOOKING HISTORY</h3>
                        </a>
                    </div>
                </div>
                <hr>
                <ul class="history-list">
                    <a href="recordsbook-view.php">
                        <li class="history-item shadow">
                            <div class="history-day">
                                <h3>12 January 2025</h2>
                            </div>
                            <div class="history-content">
                                <p>Yoga Class</p>
                                <p><span id="history-status">PRESENT</span></p>
                            </div>
                        </li>
                    </a>

                    <a href="recordsbook-view.php">
                        <li class="history-item shadow">
                            <div class="history-day">
                                <h3>12 January 2025</h2>
                            </div>
                            <div class="history-content">
                                <p>Yoga Class</p>
                                <p><span id="history-status" style="background-color:var(--red);">NO SHOW</span></p>
                            </div>
                        </li>
                    </a>
                </ul>
            </div>
        </main>
    </div>
    <script src="js/scripts.js"> </script>
    <script src="js/datatables.js"></script>
</body>

</html>