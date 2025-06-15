<?php

require_once("./includes/auth.php");

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
      <a href="signup-page-first.html">SIGN UP</a>
    </div>
    <div class="form-container">
      <h2>RESET PASSWORD</h2>
      <form action="./includes/login_reset_second.inc.php" method="POST">
        <?php check_login_errors(); ?>
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
        <input
          name="password"
          type="password"
          oninput="changeIcon(this.value)"
          id="resetPassword"
          placeholder="New Password"
          required />
        </input>
        <ion-icon name="lock-closed-outline" class="reset-pass-icon" id="reset-logPass-icon" onclick="myResetPassword()"></ion-icon>
        <input
          name="confirm-password"
          type="password"
          oninput="newIcon(this.value)"
          id="newPassword"
          placeholder="Confirm New Password"
          required />
        </input>
        <ion-icon name="lock-closed-outline" class="new-pass-icon" id="new-logPass-icon" onclick="myNewPassword()"></ion-icon>
        <button type="submit">
          RESET PASSWORD
        </button>
      </form>
    </div>
  </div>

  <script>
    const resetInputPass = document.getElementById('resetPassword');
    const resetInputIcon = document.getElementById('reset-logPass-icon');
    const newInputPass = document.getElementById('newPassword');
    const newInputIcon = document.getElementById('new-logPass-icon');

    function myResetPassword() {
      if (resetInputPass.type === "password") {
        resetInputPass.type = "text";

        resetInputIcon.name = "eye-off-outline";
        resetInputIcon.style.cursor = "pointer";
      } else {
        resetInputPass.type = "password";

        resetInputIcon.name = "eye-outline";
        resetInputIcon.style.cursor = "pointer";
      }
    }

    function changeIcon(value) {
      if (value.length > 0) {
        resetInputIcon.name = "eye-outline";
      } else {
        resetInputIcon.name = "lock-closed-outline"
      }
    }

    function myNewPassword() {
      if (newInputPass.type === "password") {
        newInputPass.type = "text";

        newInputIcon.name = "eye-off-outline";
        newInputIcon.style.cursor = "pointer";
      } else {
        newInputPass.type = "password";

        newInputIcon.name = "eye-outline";
        newInputIcon.style.cursor = "pointer";
      }
    }

    function newIcon(value) {
      if (value.length > 0) {
        newInputIcon.name = "eye-outline";
      } else {
        newInputIcon.name = "lock-closed-outline"
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
      header("Location: ./login-reset-first.php");
    }
  } else {
    $error = "No token provided.";
    $errors["no_token"] = $error;
    $_SESSION['error_login'] = $error;
    header("Location: ./login-reset-first.php");
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