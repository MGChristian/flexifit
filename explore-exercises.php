<?php
require_once("./includes/auth.php");
require_once("./includes/class-all-exercises.php");
$exercises = new AllExercise($conn);
$recentExercises = $exercises->get_recent_exercises();
$muscles = $exercises->get_muscles();
if (isset($_SESSION['query_error'])) {
    unset($_SESSION['query_error']);
}
if (isset($_GET['exerciseName'])) {
    $exerciseName = $_GET['exerciseName'];
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Exercises</title>
    <?php require_once "./components/global_css.php" ?>
    <link rel="stylesheet" href="css/explore-workouts.css">
</head>

<body>
    <!-- Navigation Header -->
    <?php require_once "./components/navbar.php" ?>


    <header class="header">
        <img src="./assets/explore.jpg" />
        <div class="header-content">
            <h1>EXPLORE EXERCISES</h1>
            <p>Find the Perfect Fitness class for your Fitness Goal</p>
        </div>
    </header>

    <div class="search-container">
        <form method="GET">
            <input type="text" name="exerciseName" id="searchInput" class="search-bar" placeholder="Search...">
            <button type="submit" class="search-btn"><i class="fa fa-search"></i></button>
            <button type="button" id="micButton" class="search-btn" title="Voice Search"
                style="margin-left: 8px;">
                <i class="fa fa-microphone"></i>
            </button>
        </form>
    </div>

    <!-- SETS THE MAXIMUM WIDTH TO 1200px -->
    <div class="main-container">
        <h1>NEW EXERCISES</h1>
        <section class="classes-grid">
            <!-- Display all exercises -->
            <?php if (isset($exerciseName) && !empty($exerciseName)): ?>
                <?php foreach ($exercises->get_search_exercise($exerciseName) as $rows): ?>
                    <a href="./exercise.php?id=<?= htmlspecialchars($rows['ID']) ?>">
                        <div class="class-item">
                            <img src="./admin/images/exercises/<?= htmlspecialchars($rows['exercisePicUrl']) ?>">
                            <div>
                                <p><b><?= htmlspecialchars($rows['exerciseName']) ?></b></p>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <?php foreach ($recentExercises as $rows): ?>
                    <a href="./exercise.php?id=<?= htmlspecialchars($rows['ID']) ?>">
                        <div class="class-item">
                            <img src="./admin/images/exercises/<?= htmlspecialchars($rows['exercisePicUrl']) ?>">
                            <div>
                                <p><b><?= htmlspecialchars($rows['exerciseName']) ?></b></p>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
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
        <br>
        <h1>WORKOUTS BY MUSCLE AREA</h1>
        <section class="classes-grid">
            <!-- Display all exercises -->
            <?php foreach ($muscles as $rows): ?>
                <a href="./exercise.php?id=<?= htmlspecialchars($rows['ID']) ?>">
                    <div class="exercise-item muscle">
                        <img src="./admin/images/muscles/<?= htmlspecialchars($rows['muscle_pic_url']) ?>">
                        <p><b><?= htmlspecialchars($rows['muscle_name']) ?></b></p>
                    </div>
                </a>
            <?php endforeach; ?>
        </section>
    </div>
    <script src="./js/textToSpeech.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/speech-recognition-polyfill@1.0.0/dist/speech-recognition-polyfill.min.js"></script>
    <?php require_once "./components/footer.php" ?>
    <?php require_once "./components/navbar_scripts.php" ?>
</body>

</html>