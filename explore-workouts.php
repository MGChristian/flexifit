<?php
require_once("./includes/auth.php");
require_once("./includes/explore-workouts.php");
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
    <input type="text" class="search-bar" placeholder="Search...">
    <button class="search-btn"><i class="fa fa-search" aria-hidden="true"></i></button>
  </div>

  <!-- SETS THE MAXIMUM WIDTH TO 1200px -->
  <div class="main-container">
    <h1>FEATURED WORKOUTS</h1>
    <section class="classes-grid">
      <?php foreach (get_workouts($conn) as $rows): ?>
        <a href="./workout.php?id=<?= htmlspecialchars($rows['ID']) ?>">
          <div class="class-item">
            <img src="./admin/images/workouts/<?= htmlspecialchars($rows['workoutPicUrl']) ?>">
            <div>
              <p><b><?= htmlspecialchars($rows['workoutName']) ?></b></p>
              <p>Duration: <?= htmlspecialchars($rows['duration']) ?>, <?= htmlspecialchars($rows['difficulty']) ?></p>
            </div>
          </div>
        </a>
      <?php endforeach; ?>
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
  <?php require_once "./components/footer.php" ?>
  <?php require_once "./components/navbar_scripts.php" ?>
</body>

</html>