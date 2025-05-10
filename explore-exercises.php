<?php
require_once("./includes/auth.php");
require_once("./includes/explore-exercises.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Classes</title>
    <?php require_once "./components/global_css.php" ?>
    <link rel="stylesheet" href="css/explore-classes.css">
</head>

<body>
    <!-- Navigation Header -->
    <?php require_once "./components/navbar.php" ?>


    <header class="header">
        <div class="header-content">
            <h1>EXPLORE CLASSES</h1>
            <p>Find the Perfect Fitness class for your Fitness Goal</p>
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
            <!-- Display all exercises -->
            <?php foreach (get_exercises($conn) as $rows): ?>
                <a href="./exercise.php?id=<?= htmlspecialchars($rows['ID']) ?>">
                    <div class="class-item">
                        <img src="../admin/images/exercises/<?= htmlspecialchars($rows['exercisePicUrl']) ?>">
                        <div>
                            <p><b><?= htmlspecialchars($rows['exerciseName']) ?></b></p>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </section>
        <div class="explore-button"><a href="all-exercises.php"><button type="button">VIEW ALL EXERCISES</button></a></div>
        <br>
        <h1>WORKOUTS BY MUSCLE AREA</h1>
        <section class="classes-grid">
            <?php for ($i = 1; $i <= 15; $i++) : ?>
                <div class="exercise-item">
                    <img src="https://picsum.photos/200/200">
                    <p><b>Muscle Name</b></p>
                </div>
            <?php endfor; ?>
        </section>
    </div>
    <?php require_once "./components/footer.php" ?>
    <?php require_once "./components/navbar_scripts.php" ?>
</body>

</html>