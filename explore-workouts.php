<?php
require_once("./includes/auth.php");
require_once("./includes/class-all-workouts.php");
$workouts = new AllWorkout($conn);

//List of the recent 10
$recentWorkouts = $workouts->get_recent_workouts();

//filters
$muscles = $workouts->get_muscles();
$equipments = $workouts->get_equipments();
$categories = $workouts->get_categories();

if (isset($_GET['workout-name'])) {
  $workoutName = $_GET['workout-name'];
}

if (isset($_GET['muscle-id'])) {
  $muscleID = $_GET['muscle-id'];
  $muscleInfo = $workouts->get_muscle($muscleID);
  $muscleFilter = $workouts->get_workouts_by_muscle($muscleID);
}

if (isset($_GET['equipment-id'])) {
  $equipmentID = $_GET['equipment-id'];
  $equipmentInfo = $workouts->get_equipment($equipmentID);
  $equipmentFilter = $workouts->get_workouts_by_equipment($equipmentID);
}

if (isset($_GET['category-id'])) {
  $categoryID = $_GET['category-id'];
  $categoryInfo = $workouts->get_category($categoryID);
  $categoryFilter = $workouts->get_workouts_by_category($categoryID);
}

if (isset($_GET['instructor-id'])) {
  $instructorID = $_GET['instructor-id'];
  $instructorFilter = $workouts->get_workouts_by_instructor($instructorID);
  $instructorInfo = $workouts->get_instructor($instructorID);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Explore Workouts</title>
  <?php require_once "./components/global_css.php" ?>
  <link rel="stylesheet" href="css/header.css" />
  <link rel="stylesheet" href="./css/explore-page.css">
</head>

<body>
  <!-- Navigation Header -->
  <?php require_once "./components/navbar.php" ?>

  <header class="header">
    <div class="header-details">
      <div class="header-content">
        <div class="header-list">
          <h3>Explore Workouts</h3>
        </div>
        <h1>
          <?php
          if (isset($muscleFilter) && isset($muscleInfo)) {
            echo "WORKOUTS FOR - " . strtoupper(htmlspecialchars($muscleInfo['muscle_name']));
          } elseif (isset($equipmentFilter) && isset($equipmentInfo)) {
            echo "WORKOUTS WITH - " . strtoupper(htmlspecialchars($equipmentInfo['equipment_name']));
          } elseif (isset($categoryFilter) && isset($categoryInfo)) {
            echo "WORKOUTS IN - " . strtoupper(htmlspecialchars($categoryInfo['category_name']));
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
              echo "Browse and discover complete workout routines designed to match your goals. Whether you're aiming to target specific muscle groups, train with available equipment, or follow a workout category like strength, endurance, or mobility — we've made it easy to find what suits you. Use the filters or search to explore workouts tailored to your fitness journey.";
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
        <img src="<?= $imgSrc ?>" alt="Workout Visual">
      </div>
    </div>
  </header>


  <div class="search-container">
    <form method="GET">
      <input type="text" name="workout-name" id="searchInput" class="search-bar" placeholder="Search...">
      <button type="submit" class="search-btn"><i class="fa fa-search"></i></button>
      <button type="button" id="micButton" class="search-btn" title="Voice Search" style="margin-left: 8px;">
        <i class="fa fa-microphone"></i>
      </button>
    </form>
  </div>



  <!-- SETS THE MAXIMUM WIDTH TO 1200px -->
  <div class="main-container">
    <?php
    $filteredWorkouts = [];

    // If muscle filter is active
    if (isset($muscleFilter)) {
      $filteredWorkouts = $muscleFilter;
    } elseif (isset($equipmentFilter)) {
      $filteredWorkouts = $equipmentFilter;
    } elseif (isset($categoryFilter)) {
      $filteredWorkouts = $categoryFilter;
    } elseif (isset($instructorFilter)) {
      $filteredWorkouts = $instructorFilter;
    } elseif (isset($workoutName) && !empty($workoutName)) {
      $filteredWorkouts = $workouts->get_search_workouts($workoutName);
    } else {
      $filteredWorkouts = $recentWorkouts;
    }

    ?>
    <h2>
      <?php
      if (isset($muscleFilter)) echo "Workouts for: " . htmlspecialchars($muscleInfo['muscle_name']);
      elseif (isset($equipmentFilter)) echo "Workouts with: " . htmlspecialchars($equipmentInfo['equipment_name']);
      elseif (isset($categoryFilter)) echo "Workouts in: " . htmlspecialchars($categoryInfo['category_name']);
      elseif (isset($instructorFilter)) {
        echo "Workouts by: " . htmlspecialchars($instructorInfo['firstName'] . " " . $instructorInfo['lastName']);
      } elseif (isset($workoutName)) echo "Search Results for: " . htmlspecialchars($workoutName);
      else echo "Latest Workouts";
      ?>
    </h2>
    <section class="classes-grid">
      <?php if (!empty($filteredWorkouts)): ?>
        <?php foreach ($filteredWorkouts as $workout): ?>
          <a href="./workout.php?id=<?= htmlspecialchars($workout['ID']) ?>">
            <div class="class-item">
              <img src="./admin/images/workouts/<?= htmlspecialchars($workout['workoutPicUrl']) ?>" alt="">
              <div>
                <p><b><?= htmlspecialchars($workout['workoutName']) ?></b></p>
                <p><?= htmlspecialchars($workout['duration']) ?> • <?= htmlspecialchars($workout['difficulty']) ?></p>
              </div>
            </div>
          </a>
        <?php endforeach; ?>
      <?php else: ?>
        <p>No workouts found.</p>
      <?php endif; ?>
    </section>
    <div class="explore-button"><a href="all-workouts.php"><button type="button">VIEW ALL WORKOUTS</button></a></div>
    <br>
    <h1>WORKOUTS BY MUSCLE AREA</h1>
    <section class="classes-grid">
      <!-- Display all Workouts -->
      <?php foreach ($muscles as $rows): ?>
        <a href="./explore-workouts.php?muscle-id=<?= htmlspecialchars($rows['ID']) ?>">
          <div class="exercise-item muscle">
            <img src="./admin/images/muscles/<?= htmlspecialchars($rows['muscle_pic_url']) ?>">
            <p><b><?= htmlspecialchars($rows['muscle_name']) ?></b></p>
          </div>
        </a>
      <?php endforeach; ?>
    </section>
    <br>
    <h1>WORKOUTS BY EQUIPMENTS</h1>
    <section class="classes-grid">
      <!-- Display all Workouts -->
      <?php foreach ($equipments as $rows): ?>
        <a href="./explore-workouts.php?equipment-id=<?= htmlspecialchars($rows['ID']) ?>">
          <div class="exercise-item muscle">
            <img src="./admin/images/equipments/<?= htmlspecialchars($rows['equipment_pic_url']) ?>">
            <p><b><?= htmlspecialchars($rows['equipment_name']) ?></b></p>
          </div>
        </a>
      <?php endforeach; ?>
    </section>
    <br>
    <h1>WORKOUTS BY CATEGORIES</h1>
    <section class="classes-grid">
      <!-- Display all Workouts -->
      <?php foreach ($categories as $rows): ?>
        <a href="./explore-workouts.php?category-id=<?= htmlspecialchars($rows['ID']) ?>">
          <div class="exercise-item muscle">
            <img src="./admin/images/categories/<?= htmlspecialchars($rows['category_pic_url']) ?>">
            <p><b><?= htmlspecialchars($rows['category_name']) ?></b></p>
          </div>
        </a>
      <?php endforeach; ?>
    </section>
  </div>
  </div>
  <script src="./js/textToSpeech.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/speech-recognition-polyfill@1.0.0/dist/speech-recognition-polyfill.min.js"></script>
  <?php require_once "./components/footer.php" ?>
  <?php require_once "./components/navbar_scripts.php" ?>
</body>

</html>