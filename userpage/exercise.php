<?php

$isLoggedIn = isset($_SESSION['id']);

isset($_GET['id']) && !empty($_GET['id']) ? $exerciseId = $_GET['id'] : header("location: ./ExploreExercises.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Classes</title>
    <?php require_once "./components/global_css.php" ?>
    <link rel="stylesheet" href="css/ExercisesPage.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>
    <!-- Navigation Header -->
    <?php
    require_once "./components/navbar.php";
    require_once "./includes/exercise.php";
    $exercise = new Exercise($conn, $exerciseId);
    if ($exercise->check_id() === true) {
        // get all exercise details
        $exerciseDetails = $exercise->get_exercise();
        $test = $exercise->get_test();
    } else {
        header("location: ./ExploreExercises.php");
        exit();
    };
    ?>


    <header class="header">
        <div class="header-content">
            <h1>How to do: <?= htmlspecialchars($exerciseDetails['exerciseName']) ?></h1>
            <div class="header-list">
                <p>Muscle Groups: </p>
                <?php for ($i = 0; $i <= 10; $i++): ?>
                    <a href="#">Muscle</a>
                <?php endfor; ?>
            </div>
            <div class="header-list">
                <p>Required Equipments: </p>
                <?php echo (empty($test) ? "<p>No Equipments</p>" : '') ?>
                <?php foreach ($test as $t): ?>
                    <a href="#"><?= $t['exerciseName'] ?>,</a>
                <?php endforeach; ?>
            </div>
            <div class="header-list">
                <p>Categories: </p>
                <?php for ($i = 0; $i <= 5; $i++): ?>
                    <a href="#">Muscle</a>
                <?php endfor; ?>
            </div>
        </div>
        <div class="header-background">
            <!-- fix exercises picture location -->
            <img src="../admin/images<?= htmlspecialchars($exerciseDetails['exercisePicUrl']) ?>">
        </div>
    </header>

    <div class="search-container">
        <input type="text" class="search-bar" placeholder="Search...">
        <button class="search-btn"><i class="fas fa-search"></i></button>
    </div>

    <!-- SETS THE MAXIMUM WIDTH TO 1200px -->
    <div class="main-container">
        <h1>EXERCISES</h1>
        <section class="classes-grid">
            <?php foreach ($rows = [] as $row): ?>

            <?php endforeach; ?>
        </section>
    </div>
    <?php require_once "./components/footer.php" ?>
    <?php require_once "./components/navbar_scripts.php" ?>
</body>

</html>