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
  <title>Flexifit</title>
  <link rel="stylesheet" href="css/reset.css" />
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
      <a href="login-page.php">LOG IN</a>
    </div>
    <div class="form-container">
      <div class="progress-bar">
        <div class="step"></div>
        <div class="line"></div>
        <div class="step active"></div>
        <div class="line"></div>
        <div class="step"></div>
      </div>
      <h2>SIGN UP</h2>
      <form action="./includes/signup_second.inc.php" method="POST">
        <div class="error-wrapper">
          <?php check_signup_errors() ?>
        </div>
        <input
          name="username"
          type="text"
          placeholder="Username" />
        <ion-icon name="person-outline" class="user-icon"></ion-icon>
        <input
          name="password"
          type="password"
          oninput="changeIcon(this.value)"
          id="signPass"
          placeholder="Password" />
        <ion-icon name="lock-closed-outline" class="pass-icon" id="signPass-icon" onclick="mySignPassword()"></ion-icon>
        <input
          class="confirm-input"
          name="confirm"
          type="password"
          oninput="changeConfirmPassIcon(this.value)"
          id="signConfirmPass"
          placeholder="Confirm Password" />
        <ion-icon name="lock-closed-outline" class="confirm-pass-icon" id="signConfirmPass-icon" onclick="mySignConfirmPassword()"></ion-icon>
        <div id="matchMessage" class="message"></div>

        <div class="divider">EMERGENCY CONTACT</div>

        <input name="emergencyname" type="text" placeholder="Contact Name" />
        <input name="emergencycontact" type="text" placeholder="Contact Number" />
        <button type="submit"> CONTINUE </button>
      </form>
    </div>
  </div>

  <script src="./js/signup.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>


<?php
function check_signup_errors()
{
  if (isset($_SESSION['error_signup'])) {
    $errors = $_SESSION['error_signup'];
    foreach ($errors as $error) {
      echo "<p class='form-error'>" . htmlspecialchars($error) . "</p>";
    }
    unset($_SESSION['error_signup']);
  }
}

function check_sessions()
{
  if (
    !isset($_SESSION['firstName']) ||
    !isset($_SESSION['lastName']) ||
    !isset($_SESSION['birthdate']) ||
    !isset($_SESSION['email']) ||
    !isset($_SESSION['phone']) ||
    !isset($_SESSION['gender'])
  ) {
    $errors = [];
    $errors['empty_fields'] = "Please fill in all fields";
    $_SESSION['error_signup'] = $errors;
    header("Location: signup-page-first.php");
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