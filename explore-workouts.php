<?php
require_once("./includes/auth.php");
require_once("./includes/explore-workouts.php");

if (isset($_GET['workoutName'])) {
  $workoutName = $_GET['workoutName'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Explore Workouts</title>
  <?php require_once "./components/global_css.php" ?>
  <link rel="stylesheet" href="./css/explore-workouts.css">
</head>

<body>
  <!-- Navigation Header -->
  <?php require_once "./components/navbar.php" ?>

  <header class="header">
    <img src="./assets/explore.jpg" />
    <div class="header-content">
      <h1>EXPLORE WORKOUTS</h1>
      <p>Find the Perfect Fitness class for your Fitness Goal</p>
    </div>
  </header>

  <div class="search-container">
    <form method="GET">
      <input type="text" name="workoutName" id="searchInput" class="search-bar" placeholder="Search..." value="<?= isset($workoutName) ? htmlspecialchars($workoutName) : '' ?>">
      <button type="submit" class="search-btn"><i class="fa fa-search"></i></button>
      <button type="button" id="micButton" class="search-btn" title="Voice Search" style="margin-left: 8px;">
        <i class="fa fa-microphone"></i>
      </button>
    </form>
  </div>



  <!-- SETS THE MAXIMUM WIDTH TO 1200px -->
  <div class="main-container">
    <h1>NEW WORKOUTS</h1>
    <section class="classes-grid">
      <?php
      $workouts = isset($workoutName) && !empty($workoutName)
        ? get_search_workouts($conn, $workoutName)
        : get_workouts($conn);

      if (count($workouts) > 0):
        foreach ($workouts as $rows):
      ?>
          <a href="./workout.php?id=<?= htmlspecialchars($rows['ID']) ?>">
            <div class="class-item">
              <img src="./admin/images/workouts/<?= htmlspecialchars($rows['workoutPicUrl']) ?>">
              <div>
                <p><b><?= htmlspecialchars($rows['workoutName']) ?></b></p>
                <p>Duration: <?= htmlspecialchars($rows['duration']) ?></p>
                <p>Difficulty: <?= htmlspecialchars($rows['difficulty']) ?></p>
              </div>
            </div>
          </a>
      <?php
        endforeach;
      else:
        echo "<p>No workouts found.</p>";
      endif;
      ?>
    </section>

    <div class="explore-button"><a href="all-workouts.php"><button type="button">VIEW ALL WORKOUTS</button></a></div>
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
  <script src="./js/textToSpeech.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/speech-recognition-polyfill@1.0.0/dist/speech-recognition-polyfill.min.js"></script>
  <?php require_once "./components/footer.php" ?>
  <?php require_once "./components/navbar_scripts.php" ?>
</body>

</html>