<?php
require_once("./includes/auth.php");
// Check if id is set, if it is not go back to explore exercise page
isset($_GET['id']) && !empty($_GET['id']) ? $exerciseId = $_GET['id'] : header("location: ./explore-exercises.php");
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

    <!-- Get all exercise details -->
    <?php
    require_once "./includes/exercise.php";
    $exercise = new Exercise($conn, $exerciseId);
    if ($exercise->check_id() === true) {
        $exerciseDetails = $exercise->get_exercise();
        $muscleList = $exercise->get_muscles();
        $equipmentList = $exercise->get_equipments();
        $categoryList = $exercise->get_categories();
        $stepsList = $exercise->get_exercise_steps();
    } else {
        header("location: ./explore-exercises.php");
        exit();
    };
    ?>

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
                    <a href="<?= htmlspecialchars($muscle['ID']) ?>">
                        <u><?= htmlspecialchars($muscle['muscle_name']) ?></u>
                    </a>
                <?php endforeach; ?>
            </div>
            <div class="header-list">
                <p>Required Equipments: </p>
                <?php echo (empty($equipmentList) ? "<a>No Equipments</a>" : '') ?>
                <?php foreach ($equipmentList as $equipment): ?>
                    <a href="<?= htmlspecialchars($equipment['ID']) ?>">
                        <u><?= htmlspecialchars($equipment['equipment_name']) ?></u>,
                    </a>
                <?php endforeach; ?>
            </div>
            <div class="header-list">
                <p>Categories: </p>
                <?php echo (empty($categoryList) ? "<a>No Categories</a>" : '') ?>
                <?php foreach ($categoryList as $category): ?>
                    <a href="<?= htmlspecialchars($category['ID']) ?>">
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
            <img src="./admin/images<?= htmlspecialchars($exerciseDetails['exercisePicUrl']) ?>">
        </div>
    </header>

    <!-- SETS THE MAXIMUM WIDTH TO 1200px -->
    <div class="main-container">
        <div class="exercise-content">
            <div class="exercise-left">
                <p><b>Step by Step</b></p>
                <?php echo empty($stepsList) ? '<p>No steps provided for this exercise</p>' : ''; ?>
                <?php foreach ($stepsList as $step): ?>
                    <div class="step">
                        <?php $stepImage = $step['step_pic_url']; ?>
                        <?= empty($stepImage) ? '' : "<img src='{$stepImage}'; ?>" ?>
                        <p><?= htmlspecialchars($step['step_instruction']) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="exercise-right">
                <p>Watch & Learn</p>
                <?php echo empty($exerciseDetails['exerciseVidUrl']) ? '<p>No video provided for this exercise</p>' : "<img src='" . $exerciseDetails['exercise_vid_url'] . "'/>"; ?>
            </div>
        </div>
    </div>
    <?php require_once "./components/footer.php" ?>
    <?php require_once "./components/navbar_scripts.php" ?>
</body>

</html>