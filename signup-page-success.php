<?php
require_once "./includes/config_session.inc.php";
check_if_logged_in();
check_sessions();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FlexiFit</title>
  <link rel="stylesheet" href="css/signup-page.css" />
  <link rel="icon" href="./assets/logo.png" />
</head>

<body>
  <div class="left-section">
    <div class="branding">
      <a href=""><img src="./assets/logo.png" alt="" /></a>
      <h1>FLEXIFIT</h1>
    </div>
    <div class="motto">
      <h2>
        YOU CAN HAVE <br />
        RESULT OR EXCUSES <br />
        NOT BOTH
      </h2>
      <p>Our goal is to help you achieve the body of your dreams.</p>
    </div>
  </div>
  <div class="right-section">
    <div class="nav">
      <a href="./">HOME</a>
      <span>|</span>
      <a href="login-page.php">LOG IN</a>
    </div>
    <div class="content">
      <div class="progress-bar">
        <div class="step active"></div>
        <div class="line"></div>
        <div class="step active"></div>
        <div class="line"></div>
        <div class="step active"></div>
      </div>
      <h1>YOU'RE ALL SET UP</h1>
      <img src="./assets/finish.png" alt="" />
      <p>Thank you for joining us! You can now log in to your Account.</p>
      <button type="button" onclick="window.location.href='login-page.php'">
        FINISH
      </button>
    </div>
  </div>
</body>

</html>

<?php

function check_sessions()
{
  if (
    !isset($_SESSION['success']) ||
    $_SESSION['success'] !== true
  ) {
    header("Location: signup-page-first.php");
  } else {
    unset($_SESSION['success']);
  }
}

function check_if_logged_in()
{
  if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
    $user_role = $_SESSION['role'];
    switch ($user_role) {
      case "user":
        header("location: ./");
        exit();
        break;
      case "instructor":
        header("location:  ./instructor/");
        exit();
        break;
      case "admin":
        header("location: ./admin/");
        exit();
        break;
    }
  }
}

?>