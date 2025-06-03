<?php
require_once("./includes/auth.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About Us</title>
  <?php require_once "./components/global_css.php" ?>
  <link rel="stylesheet" href="./css/about-us.css" />
</head>

<body>
  <!-- Navigation Header -->
  <?php require_once "./components/navbar.php" ?>

  <header class="header">
    <img src="./assets/explore.jpg" />
    <div class="header-content">
      <h1>ABOUT US</h1>
      <p>Your Fitness Journey Starts Here</p>
    </div>
  </header>

  <section class="hero-section mission">
    <div class="hero-image">
      <img src="assets/img1.jpg" alt="Mission" />
    </div>
    <div class="hero-text">
      <h2>Our Mission</h2>
      <p>
        To empower you with the tools and flexibility to achieve your fitness
        goals without the hassle. We’re committed to providing a user-friendly
        experience, making fitness accessible anytime, anywhere. Flexifit is
        more than just a booking system – it’s a community of fitness
        enthusiasts dedicated to improving their health, one session at a
        time.
      </p>
    </div>
  </section>

  <section class="hero-section vision">
    <div class="hero-text">
      <h2>Our Vision</h2>
      <p>
        We’re passionate about promoting healthier, happier lives through
        fitness. By offering a seamless booking experience, Flexifit aims to
        inspire individuals of all fitness levels to stay committed to their
        goals. We partner with a wide network of gyms, studios, and trainers
        to give you more options and greater control over your fitness
        schedule. At Flexifit, we’re not just a booking system—we’re your
        partner in progress.
      </p>
    </div>
    <div class="hero-image">
      <img src="assets/img2.jpg" alt="Vision" />
    </div>
  </section>

  <?php require_once "./components/footer.php" ?>
  <?php require_once "./components/navbar_scripts.php" ?>
</body>

</html>