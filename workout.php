<?php
require_once("./includes/auth.php");
// Check if id is set, if it is not go back to explore exercise page
isset($_GET['id']) && !empty($_GET['id']) ? $workoutID = $_GET['id'] : header("location: ./explore-workouts.php");
?>


<!-- Get all exercise details -->
<?php
require_once "./includes/workout.php";
$workout = new Workout($conn, $workoutID);
if ($workout->check_id() === true) {
    $workoutSetsList = $workout->get_workout_sets();
    $workoutDetails = $workout->get_workout();
    $creatorDetails = $workout->get_workout_creator_info();
    $muscleList = $workout->get_muscles();
    $equipmentList = $workout->get_equipments();
    $categoryList = $workout->get_categories();
    if ($isLoggedIn) {
        $savedStatus = $workout->get_saved_status($user_id);
        $collectionList = $workout->get_collections_list($user_id);
    }
} else {
    header("location: ./explore-workouts.php");
    exit();
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Classes</title>
    <?php require_once "./components/global_css.php" ?>
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/admin-modals.css">
    <link rel="stylesheet" href="./css/workout-page.css">
</head>

<body>
    <!-- MODALS -->
    <?php require_once "./modals/add-collection-modal.php" ?>
    <!-- Navigation Header -->
    <?php require_once "./components/navbar.php"; ?>

    <header class="header">
        <div class="header-details">
            <div class="header-content">
                <div class="header-list">
                    <h3>Added By: <?= $creatorDetails['creator_name'] ?></h3>
                </div>
                <h1><?= htmlspecialchars($workoutDetails['workoutName']) ?></h1>
                <div class="header-list">
                    <p>Difficulty: </p>
                    <?= strtoupper($workoutDetails['difficulty']) ?>
                </div>
                <div class="header-list">
                    <p>Muscle Groups: </p>
                    <?php echo (empty($muscleList) ? "<a>Empty muscle list</a>" : '') ?>
                    <?php foreach ($muscleList as $muscle): ?>
                        <a href="./explore-workouts.php?muscle-id=<?= htmlspecialchars($muscle['ID']) ?>">
                            <u><?= htmlspecialchars($muscle['muscle_name']) ?></u>
                        </a>
                    <?php endforeach; ?>
                </div>
                <div class="header-list">
                    <p>Required Equipments: </p>
                    <?php echo (empty($equipmentList) ? "<a>No Equipments</a>" : '') ?>
                    <?php foreach ($equipmentList as $equipment): ?>
                        <a href="./explore-workouts.php?equipment-id=<?= htmlspecialchars($equipment['ID']) ?>">
                            <u><?= htmlspecialchars($equipment['equipment_name']) ?></u>,
                        </a>
                    <?php endforeach; ?>
                </div>
                <div class="header-list">
                    <p>Categories: </p>
                    <?php echo (empty($categoryList) ? "<a>No Categories</a>" : '') ?>
                    <?php foreach ($categoryList as $category): ?>
                        <a href="./explore-workouts.php?category-id=<?= htmlspecialchars($category['ID']) ?>">
                            <u><?= htmlspecialchars($category['category_name']) ?></u>,
                        </a>
                    <?php endforeach; ?>
                </div>
                <div class="header-list">
                    <p>Description: </p>
                    <?php echo (empty($workoutDetails['workoutDescription']) ? "No Description" : htmlspecialchars($workoutDetails['workoutDescription'])) ?>
                </div>
            </div>
            <div class="header-background">
                <!-- fix exercises picture location -->
                <a href="workout-play.php?id=<?= htmlspecialchars($workoutID) ?>">
                    <img src="./admin/images/workouts/play-button.png" class="absolute" />
                </a>
                <img src="./admin/images/workouts/<?= htmlspecialchars($workoutDetails['workoutPicUrl']) ?>">
            </div>
        </div>
    </header>

    <!-- SETS THE MAXIMUM WIDTH TO 1200px -->
    <div class="main-container">
        <?php if ($isLoggedIn): ?>
            <input type="text" class='hidden' value="<?= $user_id ?>" id="user-id" />
            <input type="text" class='hidden' value="<?= $workoutID ?>" id="workout-id" />
        <?php endif; ?>
        <div class="workout-content">
            <div class="workout-left">
                <p><b>Instructions</b></p>
                <div class="exercise-container">
                    <?php
                    echo empty($workoutSetsList) ? "There are no exercises yet for this workout" : '';
                    foreach ($workoutSetsList as $workoutSet):
                        $workoutSetNumber = $workoutSet['workoutSet'];
                        $workoutExerciseList = $workout->get_exercise($workoutSetNumber);
                    ?>
                        <h3>SET <?= $workoutSetNumber ?></h3>
                        <?php foreach ($workoutExerciseList as $workoutExercise): ?>
                            <div class="exercise">
                                <p><?= $workoutExercise['exerciseName'] ?></p>
                                <div class="exercise-description">
                                    <p><?= $workoutExercise['reps'] !== 0 ? $workoutExercise['reps'] . "x" : 'No reps' ?></p>
                                    <p><?= $workoutExercise['duration'] !== "00:00:00" ? $workoutExercise['duration'] : 'No duration'  ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="workout-right">
                <p>Actions</p>
                <div class="action-list">
                    <div class="action-button <?= $isLoggedIn ? 'filterOpen' : '' ?>" data-target="add-workout-collection" id="save-to-collection">
                        <i class="fa fa-book" aria-hidden="true" id="add-to-collection"></i>
                        <p>Add to collection</p>
                    </div>
                    <div class="action-button <?= isset($savedStatus) && $savedStatus === true ? 'saved' : '' ?>" id="save-workout">
                        <i class="fa fa-heart" aria-hidden="true"></i>
                        <p>Save Workout</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once "./components/footer.php" ?>
    <?php require_once "./components/navbar_scripts.php" ?>
    <?php
    if (isset($_SESSION['login_first'])) {
        echo "<script> alert('Please log in first.') </script>";
        unset($_SESSION['login_first']);
    }
    ?>
    <?php if ($isLoggedIn): ?>
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const saveWorkoutEl = document.getElementById("save-workout");
                saveWorkoutEl.addEventListener("click", () => {
                    const userID = document.getElementById("user-id").value;
                    const workoutID = document.getElementById("workout-id").value;
                    saveWorkout(userID, workoutID);

                })
                async function saveWorkout(userID, workoutID) {
                    try {
                        const url = "./includes/add-save-workout.php";
                        const response = await fetch(url, {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                            },
                            body: JSON.stringify({
                                userID: userID,
                                workoutID: workoutID
                            })
                        })
                        if (!response.ok) {
                            throw new Error("Response was not ok");
                        }
                        const result = await response.json();
                        if (result.success) {
                            if (result.action === "saved") {
                                saveWorkoutEl.classList.add("saved");
                            } else if (result.action === "unsaved") {
                                saveWorkoutEl.classList.remove("saved");
                            } else {
                                alert("Error: " + (result.message || "Something went wrong"));
                            }
                        } else {
                            alert('Error saving workout: ' + (result.message || 'Unknown error'));
                        }
                    } catch (error) {
                        console.error('Error saving workout:', error);
                        alert('There was an error saving your workout.');
                    }
                }
            })
        </script>
    <?php else: ?>
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const saveWorkoutEl = document.getElementById("save-workout");
                const addToCollectionEl = document.getElementById("save-to-collection");

                if (saveWorkoutEl) {
                    saveWorkoutEl.addEventListener("click", () => {
                        alert("Please log in to save this workout.");
                    });
                }

                if (addToCollectionEl) {
                    addToCollectionEl.addEventListener("click", () => {
                        alert("Please log in to add this workout to a collection.");
                    });
                }
            });
        </script>
    <?php endif; ?>
</body>

</html>