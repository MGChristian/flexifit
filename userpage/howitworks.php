<?php

require_once "./includes/config_session.inc.php";

$isLoggedIn = isset($_SESSION['id']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>How It Works</title>
  <?php require_once "./components/global_css.php" ?>
  <link rel="stylesheet" href="css/howitworks.css" />
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    rel="stylesheet" />
</head>

<body>
  <!-- Navigation Header -->
  <?php require_once "./components/navbar.php" ?>

  <header class="header">
    <div class="header-content">
      <h1>HOW IT WORKS</h1>
    </div>
  </header>
  <div class="steps-container">
    <div class="step">
      <div class="step-content">
        <div class="step-number">STEP 1</div>
        <h2>Create an Account</h2>
        <p>
          In order for you to book a class or session you need to have an
          account first. To create an account you just need to click the the
          yellow button at the top-right of the website that says “JOIN NOW”
        </p>
      </div>
      <img src="assets/step1.jpg" alt="Step 1 Screenshot" />
    </div>

    <div class="step">
      <div class="step-content">
        <div class="step-number">STEP 2</div>
        <h2>Fill in the Signup Form</h2>
        <p>
          After clicking the “JOIN NOW” button our website will direct you to
          our SIGN UP page, fill up all the information needed before you
          proceeds to the next step. Click all the empty boxes and put your
          information by typing. Just finish all the steps in creating an
          account and make sure to verify your account logging it to our
          website
        </p>
      </div>
      <img src="assets/step2.jpg" alt="Step 2 Screenshot" />
    </div>

    <div class="step">
      <div class="step-content">
        <div class="step-number">STEP 3</div>
        <h2>Log In to Your Account</h2>
        <p>After creating an account log in your account.</p>
      </div>
      <img src="assets/step3.jpg" alt="Step 3 Screenshot" />
    </div>

    <div class="step">
      <div class="step-content">
        <div class="step-number">STEP 4</div>
        <h2>View and Select a Schedule</h2>
        <p>
          You can now view the schedule available, to do that all you need to
          do is to stroll down until you see the provided picture shown in
          this step. once you see it choose the last one and click the “Learn
          more”.
        </p>
      </div>
      <img src="assets/step4.jpg" alt="Step 4 Screenshot" />
    </div>

    <div class="step">
      <div class="step-content">
        <div class="step-number">STEP 5</div>
        <h2>View and Select a Schedule</h2>
        <p>
          You can see the full details about the class such as the instructor,
          time and date, place , Duration , intensity and the class
          description if you click the “View details”. if you are now sure
          about the schedule you can book that schedule by clicking the “BOOK
          NOW ”..
        </p>
      </div>
      <img src="assets/step5.jpg" alt="Step 5 Screenshot" />
    </div>

    <div class="step">
      <div class="step-content">
        <div class="step-number">STEP 6</div>
        <h2>CONFIRM BOOKING</h2>
        <p>
          To finish your booking, choose the method of payment and fill up all
          the needed information, after fill up all the information and the
          method of payment you can now click the “Pay now” button
        </p>
      </div>
      <img src="assets/step6.jpg" alt="Step 6 Screenshot" />
    </div>
  </div>

  <?php require_once "./components/footer.php" ?>
  <?php require_once "./components/navbar_scripts.php" ?>
</body>

</html>