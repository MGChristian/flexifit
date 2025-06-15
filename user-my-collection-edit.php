<?php
require_once("./includes/auth.php");
check_if_correct_role();
require_once("./includes/class-collection.php");
$userID = $_SESSION['id'];
isset($_GET['id']) && !empty($_GET['id']) ? $collectionId = $_GET['id'] : header("location: ./user-my-collection.php");
$collections = new Collection($conn, $userID);
$collections->initialize_id($collectionId);
if ($collections->check_id()) {
    $collectionInfo = $collections->get_collection();
    $collectionWorkoutList = $collections->get_collection_workouts();
} else {
    header("location: ./user-my-collection.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "./components/css.php" ?>
    <?php require_once "./components/global_css.php" ?>
    <link rel="stylesheet" href="./admin/css/admin-modals.css">
    <link rel="stylesheet" href="./css/user-collection.css">
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
                <h1><?= $collectionInfo['collectionName'] ?></h1>
                <div class="quick-link">
                    <p><a href="user-my-collection.php"> HOME </a> > MY COLLECTIONS</p>
                </div>
            </div>
            <div class="main-content">
                <div class="main-title-button">
                    <h3>CURRENT WORKOUTS LIST</h3>
                    <div class="main-title-button-container">
                        <button type="button" class="filterOpen add-button" data-target="add-collection">+ CREATE COLLECTION</button>
                    </div>
                </div>
                <hr>
                <div class="table-container">
                    <div class="workout-list">
                        <?php foreach ($collectionWorkoutList as $workout): ?>
                            <div class="workout">
                                <a href="./view-workout.php?id=<?= $workout['workoutID'] ?>">
                                    <div class="class-item">
                                        <img src="./admin/images/workouts/<?= $workout['workoutPicUrl'] ?>" alt="">
                                        <div>
                                            <p><b><?= $workout['workoutName'] ?></b></p>
                                            <p><?= $workout['duration'] ?> • <?= $workout['difficulty'] ?></p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./js/scripts.js"></script>
</body>

</html>