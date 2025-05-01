<?php


require_once "./includes/config_session.inc.php";

$isLoggedIn = isset($_SESSION['id']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Explore Classes</title>
  <?php require_once "./components/global_css.php" ?>
  <link rel="stylesheet" href="css/ExploreClasses.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
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
    <h1>FEATURED WORKOUTS</h1>
    <section class="classes-grid">
      <?php for ($i = 1; $i <= 10; $i++) : ?>
        <a href="#">
          <div class="class-item">
            <img src="https://picsum.photos/200/200">
            <div>
              <p><b>Workout Name</b></p>
              <p>30 Minutes, Beginner</p>
            </div>
          </div>
        </a>
      <?php endfor; ?>
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