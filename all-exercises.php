<?php
require_once("./includes/auth.php");
// Placeholder for when checking available exercise
$exerciseLetters = range("A", "Z");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Classes</title>
    <?php require_once "./components/global_css.php" ?>
    <link rel="stylesheet" href="css/all-exercises.css">
</head>

<body>
    <!-- Navigation Header -->
    <?php require_once "./components/navbar.php"; ?>

    <!-- Get all exercise details -->
    <?php
    require_once "./includes/class-all-exercises.php";
    $exercises = new AllExercise($conn);
    ?>


    <header id="header" class="header">
        <div class="header-content">
            <h1>EXPLORE CLASSES</h1>
            <p>Find the Perfect Fitness class for your Fitness Goal</p>
        </div>
    </header>

    <div class="search-container">
        <input type="text" class="search-bar" placeholder="Search...">
        <button class="search-btn"><i class="fas fa-search"></i></button>
    </div>

    <!-- SCROLL TO TOP -->
    <div class="scroll-to-top">
        <a href="#header">
            <span>^</span>
        </a>
    </div>


    <!-- SETS THE MAXIMUM WIDTH TO 1200px -->
    <div class="main-container">
        <div class="exercise-letter-container">
            <?php

            foreach ($exerciseLetters as $letter) {
                echo "<a href='#{$letter}'> <p class='exercise-letters'> {$letter} </p> </a>";
            }

            ?>
        </div>
        <?php
        foreach ($exerciseLetters as $letter):
            $exerciseList = $exercises->get_exercises($letter);
            //Check if exercise List is not empty
            if (!empty($exerciseList)):
        ?>
                <h1 id="<?= $letter ?>"><?= $letter ?></h1>
                <section class="classes-grid">
                    <?php foreach ($exerciseList as $exercise): ?>
                        <a href="./view-exercise.php?id=<?= $exercise['ID'] ?>">
                            <div class="class-item">
                                <img src="./admin/images/exercises/<?= $exercise['exercisePicUrl'] ?>">
                                <div>
                                    <p><b><?= $exercise['exerciseName'] ?></b></p>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </section>
                <?php //else: 
                ?>
                <!-- <h1 id="<?= $letter ?>"><?= $letter ?></h1> -->
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <?php require_once "./components/footer.php" ?>
    <?php require_once "./components/navbar_scripts.php" ?>
</body>

</html>