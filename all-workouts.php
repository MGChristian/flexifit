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
  <link rel="stylesheet" href="css/all-workouts.css">
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

  <section class="classes-grid">
    <!-- Single Class -->
    <div class="class-item">
      <img src="assets/grit.png" alt="Grit Strength" class="class-image">
      <div class="class-details">
        <h3>GRIT STRENGTH</h3>
        <p><strong>DIFFICULTY:</strong> <span class="green-text">BEGINNER</span></p>
        <p>
          A fast, 30-minute HIIT workout using weights and bodyweight to build strength, tone muscles, and boost endurance. Perfect for quick, powerful results!
        </p>
        <button class="view-btn">VIEW</button>
      </div>
    </div>

    <div class="class-item">
      <img src="assets/back.jpg" alt="Cycling" class="class-image">
      <div class="class-details">
        <h3>CYCLING</h3>
        <p><strong>DIFFICULTY:</strong> <span class="orange-text">MODERATE</span></p>
        <p>
          A fast, 30-minute HIIT workout using weights and bodyweight to build strength, tone muscles, and boost endurance. Perfect for quick, powerful results!</p>
        <button class="view-btn">VIEW</button>
      </div>
    </div>

    <div class="class-item">
      <img src="assets/gritcardio.png" alt="Grit Strength" class="class-image">
      <div class="class-details">
        <h3>GRIT CARDIO</h3>
        <p><strong>DIFFICULTY:</strong> <span class="red-text">INTERMEDIATE</span></p>
        <p>
          A fast, 30-minute HIIT workout using weights and bodyweight to build strength, tone muscles, and boost endurance. Perfect for quick, powerful results!</p>
        <button class="view-btn">VIEW</button>
      </div>
    </div>

    <div class="class-item">
      <img src="assets/peloton.png" alt="Cycling" class="class-image">
      <div class="class-details">
        <h3>PELOTON</h3>
        <p><strong>DIFFICULTY:</strong> <span class="green-text">BEGINNER</span></p>
        <p>
          A fast, 30-minute HIIT workout using weights and bodyweight to build strength, tone muscles, and boost endurance. Perfect for quick, powerful results!</p>
        <button class="view-btn">VIEW</button>
      </div>
    </div>

    <div class="class-item">
      <img src="assets/back.jpg" alt="Grit Strength" class="class-image">
      <div class="class-details">
        <h3>RPM</h3>
        <p><strong>DIFFICULTY:</strong> <span class="green-text">BEGINNER</span></p>
        <p>
          A fast, 30-minute HIIT workout using weights and bodyweight to build strength, tone muscles, and boost endurance. Perfect for quick, powerful results!</p>
        <button class="view-btn">VIEW</button>
      </div>
    </div>

    <div class="class-item">
      <img src="assets/grit.png" alt="Cycling" class="class-image">
      <div class="class-details">
        <h3>BODY ATTACK</h3>
        <p><strong>DIFFICULTY:</strong> <span class="green-text">BEGINNER</span></p>
        A fast, 30-minute HIIT workout using weights and bodyweight to build strength, tone muscles, and boost endurance. Perfect for quick, powerful results!</p>
        <button class="view-btn">VIEW</button>
      </div>
    </div>

    <div class="class-item">
      <img src="assets/peloton.png" alt="Grit Strength" class="class-image">
      <div class="class-details">
        <h3>POUND - ROCKOUT
          - WORKOUT</h3>
        <p><strong>DIFFICULTY:</strong> <span class="green-text">BEGINNER</span></p>
        <p>
          A fast, 30-minute HIIT workout using weights and bodyweight to build strength, tone muscles, and boost endurance. Perfect for quick, powerful results!</p>
        <button class="view-btn">VIEW</button>
      </div>
    </div>

    <div class="class-item">
      <img src="assets/gritcardio.png" alt="Cycling" class="class-image">
      <div class="class-details">
        <h3>FLOATING YOGA</h3>
        <p><strong>DIFFICULTY:</strong> <span class="green-text">BEGINNER</span></p>
        <p>
          A fast, 30-minute HIIT workout using weights and bodyweight to build strength, tone muscles, and boost endurance. Perfect for quick, powerful results!</p>
        <button class="view-btn">VIEW</button>
      </div>
    </div>

    <div class="class-item">
      <img src="assets/grit.png" alt="Grit Strength" class="class-image">
      <div class="class-details">
        <h3>BODY COMBAT</h3>
        <p><strong>DIFFICULTY:</strong> <span class="green-text">BEGINNER</span></p>
        <p>
          A fast, 30-minute HIIT workout using weights and bodyweight to build strength, tone muscles, and boost endurance. Perfect for quick, powerful results!</p>
        <button class="view-btn">VIEW</button>
      </div>
    </div>

    <div class="class-item">
      <img src="assets/back.jpg" alt="Cycling" class="class-image">
      <div class="class-details">
        <h3>BODY STEP</h3>
        <p><strong>DIFFICULTY:</strong> <span class="green-text">BEGINNER</span></p>
        <p>
          A fast, 30-minute HIIT workout using weights and bodyweight to build strength, tone muscles, and boost endurance. Perfect for quick, powerful results!</p>
        <button class="view-btn">VIEW</button>
      </div>
    </div>
  </section>

  <?php require_once "./components/footer.php" ?>
  <?php require_once "./components/navbar_scripts.php" ?>
</body>

</html>