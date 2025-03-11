<?php
require_once "./includes/config_session.inc.php";
check_if_logged_in();
check_sessions();
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FlexFit</title>
  <link rel="stylesheet" href="css/signup-page.css" />
  <link rel="icon" href="loginimages/logo.png" />
</head>

<body>
  <div class="left-section">
    <div class="branding">
      <a href=""><img src="loginimages/logo.png" alt="" /></a>
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
      <a href="login-page.html">LOG IN</a>
    </div>
    <div class="form-container">
      <div class="progress-bar">
        <div class="step"></div>
        <div class="line"></div>
        <div class="step"></div>
        <div class="line"></div>
        <div class="step active"></div>
      </div>
      <h2>SIGN UP</h2>
      <form action="includes/signup_third.inc.php" method="POST">
        <?php check_signup_errors(); ?>
        <div class="email-notification">
          <div class="email-icon"></div>
        </div>
        <div class="otp-message">
          <p class="title">Please check your email</p>
          <p>You're almost done setting up your account.</p>
          <p>An OTP code has been sent to <?= htmlspecialchars($email) ?></p>
        </div>
        <div class="otp-inputs">
          <input type="text" id="otp1" name="otp1" maxlength="1" />
          <input type="text" id="otp2" name="otp2" maxlength="1" />
          <input type="text" id="otp3" name="otp3" maxlength="1" />
          <input type="text" id="otp4" name="otp4" maxlength="1" />
        </div>
        <p class="resend-text">
          Didn't get the code? <a href="#">Click to resend</a>
        </p>
        <button type="submit"> CONTINUE </button>
      </form>
    </div>
  </div>
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const otpEls = document.querySelectorAll("input[type='text']");
      otpEls.forEach((otpEl, index) => {
        otpEl.addEventListener("focus", () => {
          otpEl.value = ''; //Clear input on click
        })
        otpEl.addEventListener("input", (e) => {
          const nextEl = otpEls[index + 1]; // Get the next input
          if (nextEl && otpEl.value !== '') {
            nextEl.focus(); // Move focus only if input is not empty
          }
        });
      })
    });
  </script>
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
    !isset($_SESSION['gender']) ||
    !isset($_SESSION['username']) ||
    !isset($_SESSION['password']) ||
    !isset($_SESSION['emergencyname']) ||
    !isset($_SESSION['emergencycontact']) ||
    !isset($_SESSION['OTP'])
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