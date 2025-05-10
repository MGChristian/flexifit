<?php
require_once("./includes/auth.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>How It Works</title>
  <?php require_once "./components/global_css.php" ?>
  <link rel="stylesheet" href="./css/howitworks.css" />
</head>

<body>
  <!-- Navigation Header -->
  <?php require_once "./components/navbar.php" ?>

  <header class="header">
    <div class="header-content">
      <h1>FREQUENTLY ASKED QUESTIONS</h1>
    </div>
  </header>

  <div class="accordion">
    <?php
    $faqs = [
      "What is flexifit?" => "Welcome to FlexiFit! We are here to help you with your workout needs, here in FlexiFit we provide a variety of exercises and workouts that you can follow or share. We aim to help people manage their workouts easily and quickly get in shape.",
      "Want to know how to perform a certain exercise?" => "1. Go to exercise page <br />
                                                            2. View all featured exercises or look for a certain muscle group <br />
                                                            3. Click the exercise that you want <br />
                                                            4. Follow the steps or videos",
      "Want to follow a certain workout routine?" => "1. Go to workouts page <br />
                                                      2. View all featured workouts or look for a certain category <br />
                                                      3. Click on the workout that you want <br />
                                                      4. Follow the steps or workout along with the video",
      "Want to follow a workout routine of an instructor?" => "1. Go to the instructors page <br />
                                                              2. View all the instructors <br />
                                                              3. Look for instructors with the specialties you like <br />
                                                              4. View their profile <br />
                                                              5. Look at the workout routines they have made",
      "Want to view your progress?" => "1. If you haven't already, log in to your account or create one <br />
                                        2. Go to your dashboard <br />
                                        3. Here you can view your workouts completed, workout collection",
      "Want to share your workout collections?" => "1. Create a collection <br />
                                                    2. Add the workouts you created <br />
                                                    3. Share the workout to others"
    ];

    foreach ($faqs as $question => $answer): ?>
      <div class="accordion-item">
        <button class="accordion-header">
          <span class="icon">+</span> <?= $question ?>
        </button>
        <div class="accordion-body"><?= $answer ?></div>
      </div>
    <?php endforeach; ?>
  </div>

  <?php require_once "./components/footer.php" ?>
  <?php require_once "./components/navbar_scripts.php" ?>

  <script>
    document.querySelectorAll('.accordion-header').forEach(header => {
      header.addEventListener('click', () => {
        const body = header.nextElementSibling;
        const icon = header.querySelector('.icon');
        const isOpen = body.style.maxHeight;

        if (isOpen) {
          body.style.maxHeight = null;
          body.classList.remove('open');
          icon.textContent = '+';
        } else {
          body.style.maxHeight = body.scrollHeight + "px";
          body.classList.add('open');
          icon.textContent = '−';
        }
      });
    });
  </script>
</body>

</html>