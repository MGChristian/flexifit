<?php
require_once("./includes/auth.php");
require_once "./includes/class-instructor.php";
$instructors = new Instructor($conn);
$instructorList = $instructors->get_instructors();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Instructors</title>
  <?php require_once "./components/global_css.php" ?>
  <link rel="stylesheet" href="css/header.css" />
  <link rel="stylesheet" href="./css/instructors.css" />
</head>

<body>
  <!-- Navigation Header -->
  <?php require_once "./components/navbar.php" ?>

  <header class="header">
    <div class="header-details">
      <div class="header-content">
        <div class="header-list">
          <h3>Explore Instructors</h3>
        </div>
        <h1>
          SHOW ALL
        </h1>
        <div class="header-list">
          <p>Description: </p>
          <p>
            Discover experienced and passionate fitness instructors who are here to guide you on your health journey. Whether you're looking for strength training, mobility, weight loss, or specialized workouts, our instructors bring the knowledge, energy, and motivation you need. Browse through profiles, explore their programs, and connect with the right coach for your goals.
          </p>
        </div>
      </div>
      <div class="header-background">
        <img src="./assets/bg.jpg" alt="Instructors Visual">
      </div>
    </div>
  </header>


  <div class="main-container">
    <div class="trainer-section">
      <?php foreach ($instructorList as $rows): ?>
        <div class="trainer-card">
          <div class="trainer-image">
            <img src="./instructor/images/<?= rawurlencode($rows['firstName']) . "-" . rawurlencode($rows['lastName']) . "/" . rawurlencode($rows['profilePicUrl']) ?>" />
            <h2><?= htmlspecialchars($rows['lastName']) . ", " . htmlspecialchars($rows['firstName']) ?></h2>
            <p>Instructor</p>
          </div>
          <div class="trainer-text">
            <p>
              <?= htmlspecialchars($rows['goal']) ?>
            </p>
          </div>
          <a href="profile-instructor.php?id=<?= htmlspecialchars($rows['ID']) ?>"><button class="view-btn">VIEW</button></a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  <?php require_once "./components/footer.php" ?>
  <?php require_once "./components/navbar_scripts.php" ?>
</body>

</html>