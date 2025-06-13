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
        <div class="step active"></div>
        <div class="line"></div>
        <div class="step"></div>
        <div class="line"></div>
        <div class="step"></div>
      </div>
      <h2>SIGN UP</h2>
      <div style="display:flex; flex-direction:column; width:100%;">
        <div class="error-wrapper">
          <?php check_signup_errors() ?>
        </div>
        <form action="./includes/signup_first.inc.php" method="POST">
          <input
            name="firstName"
            type="text"
            placeholder="First name"
            autocomplete="off"
            id="firstName" />
          <input
            name="lastName"
            type="text"
            placeholder="Last name"
            autocomplete="off"
            id="lastName" />
          <input
            name="birthdate"
            type="text"
            placeholder="DOB"
            onfocus="(this.type='date')"
            onblur="(this.type='text')"
            autocomplete="off"
            id="birthdate" />
          <input name="email" type="email" placeholder="Email" autocomplete="on" id="email" />
          <div class="phone">
            <span>+63</span>
            <input type="tel" name="contactNumber" placeholder="Phone" pattern="[0-9]{10}" maxlength="10" />
          </div>
          <select name="gender" id="gender">
            <option value="" disabled selected style="color: #ccc">
              Gender
            </option>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
          </select>
          <button type="submit">CONTINUE</button>
        </form>
      </div>
    </div>
  </div>
  <script src="./js/signup.js"></script>
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