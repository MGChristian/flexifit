<?php

// Check whether user has the authority to access this page.
require_once("./includes/auth.php");
require_once("./includes/class-user-dashboard.php");
$userID = $_SESSION['id'];
$dashboard = new UserDashboard($conn, $userID);
$dashboardWorkouts = $dashboard->get_total_workouts();
$dashboardCollections = $dashboard->get_total_collections();
$dashboardSavedWorkouts = $dashboard->get_total_saved_workouts();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlexiFit</title>
    <?php include "./components/css.php" ?>
    <link rel="stylesheet" href="css/dashboard-index.css">
</head>

<body>
    <?php require_once "./components/user-dashboard-nav.php" ?>

    <div class="grid-container">
        <!-- side -->
        <?php include "./components/user-dashboard-sidebar.php" ?>
        <!-- side -->
        <main class="main-container">
            <div class="page-title">
                <h1>DASHBOARD</h1>
            </div>
            <div class="card-section">
                <hr>
                <!-- cards -->
                <div class="cards">
                    <div class="yellow card shadow">
                        <div class="left-card"><i class="fa fa-user" aria-hidden="true"></i></div>
                        <div class="right-card">
                            <h2><?= $dashboardWorkouts; ?></h2>
                            <p>Total Workouts Completed</p>
                        </div>
                    </div>
                    <div class="red card shadow">
                        <div class="left-card"><i class="fa fa-users" aria-hidden="true"></i></div>
                        <div class="right-card">
                            <h2><?= $dashboardCollections; ?></h2>
                            <p>Collections</p>
                        </div>
                    </div>
                    <div class="green card shadow">
                        <div class="left-card"><i class="fa fa-star" aria-hidden="true"></i></div>
                        <div class="right-card">
                            <h2><?= $dashboardSavedWorkouts ?></h2>
                            <p>Saved Workouts</p>
                        </div>
                    </div>
                </div>
                <!-- cards -->
            </div>
        </main>
    </div>
    <script src="./js/scripts.js"></script>
</body>

</html>