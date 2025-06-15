<?php
require_once("./includes/auth.php");
check_if_correct_role();
require_once("./includes/class-saved-workouts.php");
$userID = $_SESSION['id'];
$savedWorkouts = new Saved($conn, $userID);
$savedWorkoutsList = $savedWorkouts->get_all_saved_workouts();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "./components/css.php" ?>
    <?php require_once "./components/global_css.php" ?>
    <link rel="stylesheet" href="./admin/css/admin-modals.css">
    <link rel="stylesheet" href="./css/user-all-collection.css">
    <title>Flexifit</title>
</head>

<body>
    <!-- MODALS -->
    <?php include "./modals/collection-modal.php" ?>
    <!-- HEADER -->
    <?php require_once "./components/user-dashboard-nav.php" ?>

    <div class="grid-container">
        <!-- side -->
        <?php include "./components/user-dashboard-sidebar.php" ?>
        <div class="main-container">
            <div class="page-title">
                <h1>MY SAVED WORKOUTS</h1>
                <div class="quick-link">
                    <p><a href="user-my-collection.php"> HOME </a> > MY SAVED WORKOUTS</p>
                </div>
            </div>
            <div class="main-content">
                <div class="main-title-button">
                    <h3>CURRENT SAVED WORKOUTS LIST</h3>
                </div>
                <hr>
                <div class="table-container">
                    <div class="collection-list">
                        <?php foreach ($savedWorkoutsList as $savedWorkout): ?>
                            <a href="./view-workout.php?id=<?= htmlspecialchars($savedWorkout['workoutID']) ?>">
                                <div class="collection">
                                    <h3><?= htmlspecialchars($savedWorkout['workoutName']) ?></h3>
                                    <p>Description: <?= htmlspecialchars($savedWorkout['workoutDescription']) ?></p>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./js/scripts.js"></script>
</body>

</html>