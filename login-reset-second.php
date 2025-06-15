<?php
require_once("./includes/auth.php");
check_if_logged_in();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FlexFit</title>
  <link rel="stylesheet" href="css/login-page.css" />
  <link rel="icon" href="assets/logo.png" />
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
      <a href="signup-page-first.php">SIGN UP</a>
    </div>
    <div class="form-container">
      <h2 class="login-email-title">RESET PASSWORD</h2>
      <form>
        <div class="email-notification">
          <div class="email-icon"></div>
        </div>
        <div class="otp-message">
          <p class="title">Please check your email</p>
          <p>An email has been sent to email@gmail.com.</p>
          <p>Please check the inbox of the account.</p>
        </div>
      </form>
    </div>
  </div>
</body>

</html>

<?php

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