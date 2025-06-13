<?php
require_once("./includes/auth.php");
require_once("./includes/class-all-exercises.php");
$exercises = new AllExercise($conn);

//List of the recent 10
$recentExercises = $exercises->get_recent_exercises();

//filters
$muscles = $exercises->get_muscles();
$equipments = $exercises->get_equipments();
$categories = $exercises->get_categories();

if (isset($_GET['exercise-name'])) {
    $exerciseName = $_GET['exercise-name'];
}

if (isset($_GET['muscle-id'])) {
    $muscleID = $_GET['muscle-id'];
    $muscleInfo = $exercises->get_muscle($muscleID);
    $muscleFilter = $exercises->get_exercises_by_muscle($muscleID);
}

if (isset($_GET['equipment-id'])) {
    $equipmentID = $_GET['equipment-id'];
    $equipmentInfo = $exercises->get_equipment($equipmentID);
    $equipmentFilter = $exercises->get_exercises_by_equipment($equipmentID);
}

if (isset($_GET['category-id'])) {
    $categoryID = $_GET['category-id'];
    $categoryInfo = $exercises->get_category($categoryID);
    $categoryFilter = $exercises->get_exercises_by_category($categoryID);
}

if (isset($_GET['instructor-id'])) {
    $instructorID = $_GET['instructor-id'];
    $instructorFilter = $exercises->get_exercises_by_instructor($instructorID);
    $instructorInfo = $exercises->get_instructor($instructorID);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Exercises</title>
    <?php require_once "./components/global_css.php" ?>
    <link rel="stylesheet" href="css/header.css" />
    <link rel="stylesheet" href="css/explore-page.css">
</head>

<body>
    <!-- Navigation Header -->
    <?php require_once "./components/navbar.php" ?>


    <header class="header">
        <div class="header-details">
            <div class="header-content">
                <div class="header-list">
                    <h3>Explore Exercise</h3>
                </div>
                <h1>
                    <?php
                    if (isset($muscleFilter) && isset($muscleInfo)) {
                        echo "EXERCISES FOR - " . strtoupper(htmlspecialchars($muscleInfo['muscle_name']));
                    } elseif (isset($equipmentFilter) && isset($equipmentInfo)) {
                        echo "EXERCISES WITH - " . strtoupper(htmlspecialchars($equipmentInfo['equipment_name']));
                    } elseif (isset($categoryFilter) && isset($categoryInfo)) {
                        echo "EXERCISES IN - " . strtoupper(htmlspecialchars($categoryInfo['category_name']));
                    } else {
                        echo "SHOW ALL";
                    }
                    ?>
                </h1>
                <div class="header-list">
                    <p>Description: </p>
                    <p>
                        <?php
                        if (isset($muscleFilter) && isset($muscleInfo)) {
                            echo htmlspecialchars($muscleInfo['muscle_description']);
                        } elseif (isset($equipmentFilter) && isset($equipmentInfo)) {
                            echo htmlspecialchars($equipmentInfo['equipment_description']);
                        } elseif (isset($categoryFilter) && isset($categoryInfo)) {
                            echo htmlspecialchars($categoryInfo['category_description']);
                        } else {
                            echo "Browse and discover a wide range of exercises designed to target specific muscle groups, use different equipment, and fit your fitness goals. Whether you're a beginner or experienced, use the search bar or filter by category, muscle area, or equipment to find the perfect exercise for your workout plan.";
                        }
                        ?>
                    </p>
                </div>
            </div>
            <div class="header-background">
                <?php
                if (isset($muscleInfo)) {
                    $imgSrc = './admin/images/muscles/' . htmlspecialchars($muscleInfo['muscle_pic_url']);
                } elseif (isset($equipmentInfo)) {
                    $imgSrc = './admin/images/equipments/' . htmlspecialchars($equipmentInfo['equipment_pic_url']);
                } elseif (isset($categoryInfo)) {
                    $imgSrc = './admin/images/categories/' . htmlspecialchars($categoryInfo['category_pic_url']);
                } else {
                    $imgSrc = './assets/bg.jpg';
                }
                ?>
                <img src="<?= $imgSrc ?>" alt="Exercise Visual">
            </div>
        </div>
    </header>

    <div class="search-container">
        <form method="GET">
            <input type="text" name="exercise-name" id="searchInput" class="search-bar" placeholder="Search...">
            <button type="submit" class="search-btn"><i class="fa fa-search"></i></button>
            <button type="button" id="micButton" class="search-btn" title="Voice Search" style="margin-left: 8px;">
                <i class="fa fa-microphone"></i>
            </button>
        </form>
    </div>

    <!-- SETS THE MAXIMUM WIDTH TO 1200px -->
    <div class="main-container">
        <?php
        $filteredExercises = [];

        // If muscle filter is active
        if (isset($muscleFilter)) {
            $filteredExercises = $muscleFilter;
        } elseif (isset($equipmentFilter)) {
            $filteredExercises = $equipmentFilter;
        } elseif (isset($categoryFilter)) {
            $filteredExercises = $categoryFilter;
        } elseif (isset($instructorFilter)) {
            $filteredExercises = $instructorFilter;
        } elseif (isset($exerciseName) && !empty($exerciseName)) {
            $filteredExercises = $exercises->get_search_exercise($exerciseName);
        } else {
            $filteredExercises = $recentExercises;
        }

        ?>
        <h2>
            <?php
            if (isset($muscleFilter)) echo "Exercises for: " . htmlspecialchars($muscleInfo['muscle_name']);
            elseif (isset($equipmentFilter)) echo "Exercises with: " . htmlspecialchars($equipmentInfo['equipment_name']);
            elseif (isset($categoryFilter)) echo "Exercises in: " . htmlspecialchars($categoryInfo['category_name']);
            elseif (isset($exerciseName)) echo "Search Results for: " . htmlspecialchars($exerciseName);
            elseif (isset($instructorFilter)) {
                echo "Exercises by: " . htmlspecialchars($instructorInfo['firstName'] . " " . $instructorInfo['lastName']);
            } else echo "Latest Exercises";
            ?>
        </h2>
        <section class="classes-grid">
            <?php if (!empty($filteredExercises)): ?>
                <?php foreach ($filteredExercises as $rows): ?>
                    <a href="./exercise.php?id=<?= htmlspecialchars($rows['exerciseID'] ?? $rows['ID']) ?>">
                        <div class="class-item">
                            <img src="./admin/images/exercises/<?= htmlspecialchars($rows['exercisePicUrl']) ?>" alt="">
                            <div>
                                <p><b><?= htmlspecialchars($rows['exerciseName']) ?></b></p>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No exercises found.</p>
            <?php endif; ?>
        </section>
        <div class="explore-button"><a href="all-exercises.php"><button type="button">VIEW ALL EXERCISES</button></a></div>
        <br>
        <h1>EXERCISES BY MUSCLE AREA</h1>
        <section class="classes-grid">
            <!-- Display all exercises -->
            <?php foreach ($muscles as $rows): ?>
                <a href="./explore-exercises.php?muscle-id=<?= htmlspecialchars($rows['ID']) ?>">
                    <div class="exercise-item muscle">
                        <img src="./admin/images/muscles/<?= htmlspecialchars($rows['muscle_pic_url']) ?>">
                        <p><b><?= htmlspecialchars($rows['muscle_name']) ?></b></p>
                    </div>
                </a>
            <?php endforeach; ?>
        </section>
        <br>
        <h1>EXERCISES BY EQUIPMENTS</h1>
        <section class="classes-grid">
            <!-- Display all exercises -->
            <?php foreach ($equipments as $rows): ?>
                <a href="./explore-exercises.php?equipment-id=<?= htmlspecialchars($rows['ID']) ?>">
                    <div class="exercise-item muscle">
                        <img src="./admin/images/equipments/<?= htmlspecialchars($rows['equipment_pic_url']) ?>">
                        <p><b><?= htmlspecialchars($rows['equipment_name']) ?></b></p>
                    </div>
                </a>
            <?php endforeach; ?>
        </section>
        <br>
        <h1>EXERCISES BY CATEGORIES</h1>
        <section class="classes-grid">
            <!-- Display all exercises -->
            <?php foreach ($categories as $rows): ?>
                <a href="./explore-exercises.php?category-id=<?= htmlspecialchars($rows['ID']) ?>">
                    <div class="exercise-item muscle">
                        <img src="./admin/images/categories/<?= htmlspecialchars($rows['category_pic_url']) ?>">
                        <p><b><?= htmlspecialchars($rows['category_name']) ?></b></p>
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