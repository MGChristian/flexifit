<?php
require_once("./includes/auth.php");
require_once("./includes/get-index-data.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "./components/css.php" ?>
    <link rel="stylesheet" href="css/dashboard-index.css">
    <title>FlexiFit</title>
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
                            <h2><?php
                                $workout = get_total_workouts($conn, $_SESSION['id']);
                                echo $workout;
                                ?></h2>
                            <p>Total Workouts Completed</p>
                        </div>
                    </div>
                    <div class="red card shadow">
                        <div class="left-card"><i class="fa fa-users" aria-hidden="true"></i></div>
                        <div class="right-card">
                            <h2>69</h2>
                            <p>Collections</p>
                        </div>
                    </div>
                    <div class="green card shadow">
                        <div class="left-card"><i class="fa fa-star" aria-hidden="true"></i></div>
                        <div class="right-card">
                            <h2>32</h2>
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