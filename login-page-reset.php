<?php

require_once "./includes/config.php";
require_once "./includes/config_session.inc.php";

$token = isset($_GET['token']) ? $_GET['token'] : '';

check_if_logged_in();
check_token($conn, $token);

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FlexiFit</title>
  <link rel="stylesheet" href="css/login-page.css" />
  <link rel="icon" href="assets/logo.png" />
</head>

<body>
  <div class="left-section">
    <div class="branding">
      <a href=""><img src="assets/logo.png" alt="" /></a>
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
      <a href="signup-page-info.html">SIGN UP</a>
    </div>
    <div class="form-container">
      <h2>RESET PASSWORD</h2>
      <form action="./includes/login_reset_second.inc.php" method="POST">
        <?php check_login_errors(); ?>
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
        <input
          name="password"
          type="password"
          placeholder="New Password"
          required />
        <input
          name="confirm-password"
          type="password"
          placeholder="Confirm Password"
          required />
        <button type="submit">
          RESET PASSWORD
        </button>
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

function check_token($conn, $token)
{
  if (!empty($token)) {
    $errors = [];
    // Check if token exists and is not expired
    $stmt = $conn->prepare("SELECT ID FROM user WHERE reset_token = ? AND reset_expiry > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
      $error = "Invalid or expired token. Please request a new reset link.";
      $errors["invalid_token"] = $error;
      $_SESSION['error_login'] = $errors;
      header("Location: ./login-page-forgot.php");
    }
  } else {
    $error = "No token provided.";
    $errors["no_token"] = $error;
    $_SESSION['error_login'] = $error;
    header("Location: ./login-page-forgot.php");
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
        header("location:  ./instructors/");
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