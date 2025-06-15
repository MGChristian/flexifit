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
      <a href="#">ABOUT</a>
      <a href="signup-page-first.php">SIGN UP</a>
    </div>
    <div class="form-container">
      <div class="check">
        <div class="check-icon"></div>
      </div>
      <h2 class="login-check-title">PASSWORD CHANGED!</h2>
      <form>
        <div class="message">
          <p class="title">Your password has been changed successfully</p>
        </div>
        <button
          type="button"
          onclick="window.location.href='login-page.php'">
          GO BACK TO LOGIN
        </button>
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