<?php
require_once("./includes/auth.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Instructors</title>
  <?php require_once "./components/global_css.php" ?>
  <link rel="stylesheet" href="./css/instructors.css" />
</head>

<body>
  <!-- Navigation Header -->
  <?php require_once "./components/navbar.php" ?>

  <header class="header">
    <div class="header-content">
      <h1>INSTRUCTORS</h1>
    </div>
  </header>

  <div class="main-container">
    <div class="trainer-section">
      <!-- Card 1 -->
      <div class="trainer-card">
        <div class="trainer-image">
          <img src="assets/back.jpg" alt="Patricia Gatus" />
          <h2>JELLI JANTE</h2>
          <p>Instructor</p>
        </div>
        <div class="trainer-text">
          <p>
            I want to motivate, encourage, and educate everyone to help them achieve their optimum level of quality of life.
          </p>
        </div>
        <a href="instructor-profile.php"><button class="view-btn">VIEW</button></a>
      </div>

      <!-- Card 1 -->
      <div class="trainer-card">
        <div class="trainer-image">
          <img src="assets/back.jpg" alt="Patricia Gatus" />
          <h2>JELLI JANTE</h2>
          <p>Instructor</p>
        </div>
        <div class="trainer-text">
          <p>
            I want to motivate, encourage, and educate everyone to help them achieve their optimum level of quality of life.
          </p>
        </div>
        <button class="view-btn">VIEW</button>
      </div>

      <!-- Card 2 -->
      <div class="trainer-card">
        <div class="trainer-image">
          <img src="assets/back.jpg" alt="Sam Corrales" />
          <h2>JAI LAWAN</h2>
          <p>Yoga Instructor</p>
        </div>
        <div class="trainer-text">
          <p>
            I want to motivate, encourage, and educate everyone to help them achieve their optimum level of quality of life.
          </p>
        </div>
        <button class="view-btn">VIEW</button>
      </div>

      <!-- Card 3 -->
      <div class="trainer-card">
        <div class="trainer-image">
          <img src="assets/back.jpg" alt="Sam Corrales" />
          <h2>AG MOLINA</h2>
          <p>Yoga Instructor</p>
        </div>
        <div class="trainer-text">
          <p>
            I want to motivate, encourage, and educate everyone to help them achieve their optimum level of quality of life.
          </p>
        </div>
        <button class="view-btn">VIEW</button>
      </div>

      <!-- Card 4 -->
      <div class="trainer-card">
        <div class="trainer-image">
          <img src="assets/back.jpg" alt="Sam Corrales" />
          <h2>PAOLO SALVADOR</h2>
          <p>Yoga Instructor</p>
        </div>
        <div class="trainer-text">
          <p>
            I want to motivate, encourage, and educate everyone to help them achieve their optimum level of quality of life.
          </p>
        </div>
        <button class="view-btn">VIEW</button>
      </div>

      <!-- Card 5 -->
      <div class="trainer-card">
        <div class="trainer-image">
          <img src="assets/back.jpg" alt="Sam Corrales" />
          <h2>PATRICIA GATUS</h2>
          <p>Yoga Instructor</p>
        </div>
        <div class="trainer-text">
          <p>
            I want to motivate, encourage, and educate everyone to help them achieve their optimum level of quality of life.
          </p>
        </div>
        <button class="view-btn">VIEW</button>
      </div>

      <!-- Card 6 -->
      <div class="trainer-card">
        <div class="trainer-image">
          <img src="assets/back.jpg" alt="Sam Corrales" />
          <h2>SAM CORRALES</h2>
          <p>Yoga Instructor</p>
        </div>
        <div class="trainer-text">
          <p>
            I want to motivate, encourage, and educate everyone to help them achieve their optimum level of quality of life.
          </p>
        </div>
        <button class="view-btn">VIEW</button>
      </div>
    </div>
  </div>
  <?php require_once "./components/footer.php" ?>
  <?php require_once "./components/navbar_scripts.php" ?>
</body>

</html>