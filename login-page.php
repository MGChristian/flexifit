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
  <link rel="stylesheet" href="./css/login-page.css" />
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
      <a href="signup-page-info.php">SIGN UP</a>
    </div>
    <div class="form-container">
      <h2>LOG IN</h2>
    
      <?php
        if (isset($_SESSION['success'])) {
            echo "<div class='success-message'>Registration successful! You can now log in.</div>";
            unset($_SESSION['success']);
        }
      ?>
      <form action="./includes/login.inc.php" method="POST">
        <div class="error-wrapper">
          <?php check_login_errors() ?>
        </div>
        <input
          name="username"
          type="text"
          placeholder="Username"
          required />
        <ion-icon name="person-outline" class="user-icon"></ion-icon>
        <input
          name="password"
          type="password"
          oninput="changeIcon(this.value)"
          id="logPassword"
          placeholder="Password"
          required />
        <ion-icon name="lock-closed-outline" class="pass-icon" id="logPass-icon" onclick="myLogPassword()"></ion-icon>
        <button
          type="submit">
          LOG IN
        </button>
        <a href="login-page-forgot.php">Forgot Password?</a>
      </form>
    </div>
  </div>
  <script>
    const logInputPass = document.getElementById('logPassword');
    const logInputIcon = document.getElementById('logPass-icon');

    function myLogPassword() {
      if(logInputPass.type === "password") {
        logInputPass.type = "text";

        logInputIcon.name = "eye-off-outline";
        logInputIcon.style.cursor = "pointer";
      } else {
        logInputPass.type = "password";

        logInputIcon.name = "eye-outline";
        logInputIcon.style.cursor = "pointer";
      }
    }

    function changeIcon(value) {
        if(value.length > 0) {
          logInputIcon.name = "eye-outline";
        } else {
          logInputIcon.name = "lock-closed-outline"
        }
      }
  </script>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
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