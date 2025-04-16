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
      <a href="login-page.html">LOG IN</a>
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
        <?php check_signup_errors(); ?>
        <input name="username" type="text" placeholder="Username" required />
        <input name="password" type="password" placeholder="Password" required />
        <input name="confirm" type="password" placeholder="Confirm Password" required />

        <div class="divider">EMERGENCY CONTACT</div>

        <input name="emergencyname" type="text" placeholder="Contact Name" required />
        <input name="emergencycontact" type="text" placeholder="Contact Number" required />
        <button type="submit"> CONTINUE </button>
      </form>
    </div>
  </div>
</body>

</html>


<?php
function check_signup_errors()
{
  if (isset($_SESSION['error_signup'])) {
    $errors = $_SESSION['error_signup'];
    foreach ($errors as $error) {
      echo "<p class='form-error'>" . $error . "</p>";
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
    header("Location: signup-page-info.php");
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
        header("location:  ../instructors/");
        exit();
        break;
      case "admin":
        header("location: ../admin/");
        exit();
        break;
    }
  }
}

?>