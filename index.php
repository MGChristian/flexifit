<?php
require_once("./includes/auth.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FlexiFit</title>
  <?php require_once "./components/global_css.php" ?>
  <link rel="stylesheet" href="css/index.css" />
</head>

<body>
  <!-- Navigation Header -->
  <?php require_once "./components/navbar.php" ?>

  <header class="header">
    <img src="./assets/bg.jpg" alt="Hero Section" />
    <div class="header-content">
      <h1>DARE TO BE GREAT</h1>
      <p>Our goal is to help you achieve the body of your dreams.</p>
    </div>
  </header>

  <section class="yellow-bg">
    <h2>FIND THE BEST FITNESS CLASS FOR YOU</h2>
    <p>
      We offer a variety of classes to suit your needs, you can choose from
      our highly talented and passionate instructors. If you’re looking to
      start your fitness journey, you’ve come to the right place!
    </p>
  </section>

  <div class="photo-container">
    <div class="photo-item">
      <img src="assets/yoga.jpg" alt="How it Works" />
      <div class="photo-content">
        <h3>HOW IT WORKS</h3>
        <p>
          Follow personalized workout routines, track your progress, and train with expert instructors—anytime, anywhere.
        </p>
        <a href="./how-it-works.php">Learn More</a>
      </div>
    </div>
    <div class="photo-item">
      <img src="assets/instructors.jpg" alt="Instructors" />
      <div class="photo-content">
        <h3>INSTRUCTORS</h3>
        <p>
          Meet expert trainers ready to guide your fitness journey.
        </p>
        <a href="./explore-instructors.php">Learn More</a>
      </div>
    </div>
    <div class="photo-item">
      <img src="assets/schedules.png" alt="Schedules" />
      <div class="photo-content">
        <h3>EXPLORE WORKOUTS</h3>
        <p>
          Browse workouts by type, intensity, or trainer. There’s something for every level and lifestyle.
        </p>
        <a href="./explore-workouts.php">Learn More</a>
      </div>
    </div>
  </div>

  <section class="hero">
    <div class="hero-max-width">
      <div class="hero-content">
        <h1>WHY WORK WITH US?</h1>
        <p>
          Why don’t you join us? It’s easy because you can choose everything you
          want that will be good for your body here with us. So, what are you
          waiting for? Join us.
        </p>
        <a href="#" class="btn">DISCOVER</a>
      </div>
      <div class="hero-image">
        <img src="assets/workwithus.jpg" alt="Why Work With Us" />
      </div>
    </div>
  </section>

  <!-- Classes Section -->
  <section class="classes">
    <h2>VARIETY OF EXERCISES TO CHOOSE FROM</h2>
    <div class="classes-grid">
      <!-- First Row: Two large images -->
      <div class="class-card">
        <img src="assets/yoga1.jpg" alt="Yoga" />
        <h3>YOGA</h3>
      </div>
      <div class="class-card">
        <img src="assets/strength.jpg" alt="Strength" />
        <h3>STRENGTH</h3>
      </div>
      <!-- Second Row: Three smaller images -->
      <div class="class-card">
        <img src="assets/cardio.png" alt="Cardio" />
        <h3>CARDIO</h3>
      </div>
      <div class="class-card">
        <img src="assets/boxing.jpg" alt="Boxing" />
        <h3>BOXING</h3>
      </div>
      <div class="class-card">
        <img src="assets/back.jpg" alt="Back" />
        <!-- Button inside the image -->
        <a href="./explore-exercises.php" class="btn">DISCOVER ALL CLASSES</a>
      </div>
    </div>
  </section>
  <?php require_once "./components/footer.php" ?>
  <?php require_once "./components/navbar_scripts.php" ?>
</body>

</html>