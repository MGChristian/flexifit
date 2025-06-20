<?php
require_once("./includes/auth.php");
// Check if id is set, if it is not go back to explore exercise page
isset($_GET['id']) && !empty($_GET['id']) ? $exerciseId = $_GET['id'] : header("location: ./explore-exercises.php");
?>

<!-- Get all exercise details -->
<?php
require_once "./includes/class-exercise.php";
$exercise = new Exercise($conn, $exerciseId, $secretKey);
if (!$exercise->check_id() === true) {
    header("location: ./explore-exercises.php");
    exit();
}
if (!$exercise->is_mac_valid()) {
    die("This exercise record may have been tampered with.");
}

$exerciseDetails = $exercise->get_exercise();
$muscleList = $exercise->get_muscles();
$equipmentList = $exercise->get_equipments();
$categoryList = $exercise->get_categories();
$stepsList = $exercise->get_exercise_steps();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Classes</title>
    <?php require_once "./components/global_css.php" ?>
    <link rel="stylesheet" href="./css/exercise-page.css">
</head>

<body>
    <!-- Navigation Header -->
    <?php require_once "./components/navbar.php"; ?>


    <header class="header">
        <div class="header-content">
            <div class="header-list">
                <h3>Added By: </h3>
            </div>
            <h1>How to do: <?= htmlspecialchars($exerciseDetails['exerciseName']) ?></h1>
            <div class="header-list">
                <p>Muscle Groups: </p>
                <?php echo (empty($muscleList) ? "<a>Empty muscle list</a>" : '') ?>
                <?php foreach ($muscleList as $muscle): ?>
                    <a href="./explore-exercises.php?muscle-id=<?= htmlspecialchars($muscle['ID']) ?>">
                        <u><?= htmlspecialchars($muscle['muscle_name']) ?></u>
                    </a>
                <?php endforeach; ?>
            </div>
            <div class="header-list">
                <p>Required Equipments: </p>
                <?php echo (empty($equipmentList) ? "<a>No Equipments</a>" : '') ?>
                <?php foreach ($equipmentList as $equipment): ?>
                    <a href="./explore-exercises.php?equipment-id=<?= htmlspecialchars($equipment['ID']) ?>">
                        <u><?= htmlspecialchars($equipment['equipment_name']) ?></u>,
                    </a>
                <?php endforeach; ?>
            </div>
            <div class="header-list">
                <p>Categories: </p>
                <?php echo (empty($categoryList) ? "<a>No Categories</a>" : '') ?>
                <?php foreach ($categoryList as $category): ?>
                    <a href="./explore-exercises.php?category-id=<?= htmlspecialchars($category['ID']) ?>">
                        <u><?= htmlspecialchars($category['category_name']) ?></u>,
                    </a>
                <?php endforeach; ?>
            </div>
            <div class="header-list">
                <p>Description: </p>
                <?php echo (empty($exerciseDetails['description']) ? "No Description" : htmlspecialchars($exerciseDetails['description'])) ?>
            </div>
        </div>
        <div class="header-background">
            <!-- fix exercises picture location -->
            <img src="./admin/images/exercises/<?= htmlspecialchars($exerciseDetails['exercisePicUrl']) ?>">
        </div>
    </header>

    <!-- SETS THE MAXIMUM WIDTH TO 1200px -->
    <div class="main-container">
        <div class="exercise-content">
            <div class="exercise-left">
                <p><b>Step by Step</b></p>
                <?php echo empty($stepsList) ? '<p>No steps provided for this exercise</p>' : ''; ?>
                <?php foreach ($stepsList as $count => $step): ?>
                    <div class="step">
                        <div>
                            <strong>Step <?= $count + 1 ?>: </strong>
                            <p><?= htmlspecialchars($step['step_instruction']) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="exercise-right">
                <p>Watch & Learn</p>
                <?php echo
                empty($exerciseDetails['exerciseVidUrl'])
                    ? '<p>No video provided for this exercise</p>'
                    : "<video class='video-container' width='100%' loop autoplay muted>
                            <source src='./admin/images/exercises/videos/" . $exerciseDetails["exerciseVidUrl"] . "'></source>
                        </video>
                    "; ?>
            </div>
        </div>
    </div>
    <?php require_once "./components/footer.php" ?>
    <?php require_once "./components/navbar_scripts.php" ?>
</body>

</html>