<?php
require_once("./includes/auth.php");
require_once("./includes/class-all-workouts.php");
$workoutLetters = range("A", "Z");
$workouts = new AllWorkout($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>All Workouts</title>
  <?php require_once "./components/global_css.php" ?>
  <link rel="stylesheet" href="./css/all-exercises.css">
</head>

<body>
  <?php require_once "./components/navbar.php"; ?>

  <header id="header" class="header">
    <div class="header-content">
      <h1>ALL WORKOUTS</h1>
      <p>Browse workouts alphabetically</p>
    </div>
  </header>

  <div class="scroll-to-top">
    <a href="#header">
      <span>^</span>
    </a>
  </div>

  <div class="main-container">
    <div class="exercise-letter-container">
      <?php foreach ($workoutLetters as $letter): ?>
        <a href="#<?= $letter ?>">
          <p class="exercise-letters"><?= $letter ?></p>
        </a>
      <?php endforeach; ?>
    </div>

    <?php foreach ($workoutLetters as $letter):
      $workoutList = $workouts->get_workouts($letter);
      if (!empty($workoutList)):
    ?>
        <h1 id="<?= $letter ?>"><?= $letter ?></h1>
        <section class="classes-grid">
          <?php foreach ($workoutList as $workout): ?>
            <a href="./view-workout.php?id=<?= $workout['ID'] ?>">
              <div class="class-item">
                <img src="./admin/images/workouts/<?= htmlspecialchars($workout['workoutPicUrl']) ?>">
                <div>
                  <p><b><?= htmlspecialchars($workout['workoutName']) ?></b></p>
                  <p>Duration: <?= htmlspecialchars($workout['duration']) ?></p>
                  <p>Difficulty: <?= htmlspecialchars($workout['difficulty']) ?></p>
                </div>
              </div>
            </a>
          <?php endforeach; ?>
        </section>
    <?php endif;
    endforeach; ?>
  </div>

  <?php require_once "./components/footer.php" ?>
  <?php require_once "./components/navbar_scripts.php" ?>
</body>

</html>