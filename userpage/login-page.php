<?php

require_once "./includes/config_session.inc.php";
check_if_logged_in();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FlexiFit</title>
  <link rel="stylesheet" href="css/login-page.css" />
  <link rel="icon" href="logo.png" />
</head>

<body>
  <div class="left-section">
    <div class="branding">
      <a href=""><img src="logo.png" alt="" /></a>
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
      <span>|</span>
      <a href="signup-page-info.php">SIGN UP</a>
    </div>
    <div class="form-container">
      <h2>LOG IN</h2>
      <form action="./includes/login.inc.php" method="POST">
        <?php check_login_errors() ?>
        <input
          name="username"
          type="text"
          placeholder="Username"
          required />
        <input
          name="password"
          type="password"
          placeholder="Password"
          required />
        <button
          type="submit"
          onclick="window.location.href='loggedin/Home.html'">
          LOG IN
        </button>
        <a href="login-page-forgot.html">Forgot Password?</a>
      </form>
    </div>
  </div>
</body>

</html>

<?php

function check_login_errors()
{
  if (isset($_SESSION['error_login'])) {
    $errors = $_SESSION['error_login'];
    foreach ($errors as $error) {
      echo "<p class='form-error'>" . $error . "</p>";
    }
    unset($_SESSION['error_login']);
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
        header("location: ./instructor_dashboard.php");
        exit();
        break;
      case "admin":
        header("location: ./admin_dashboard.php");
        exit();
        break;
    }
  }
}

?>