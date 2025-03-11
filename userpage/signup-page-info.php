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
        <div class="step active"></div>
        <div class="line"></div>
        <div class="step"></div>
        <div class="line"></div>
        <div class="step"></div>
      </div>
      <h2>SIGN UP</h2>
      <?php
      check_signup_errors();
      ?>
      <form action="./includes/signup_first.inc.php" method="POST">
        <input
          name="firstName"
          type="text"
          placeholder="First name"
          autocomplete="off"
          id="firstName"
          required />
        <input
          name="lastName"
          type="text"
          placeholder="Last name"
          autocomplete="off"
          id="lastName"
          required />
        <input
          name="birthdate"
          type="date"
          autocomplete="off"
          id="birthdate"
          required />
        <input name="email" type="email" placeholder="Email" autocomplete="on" id="email" required />
        <div class="phone">
          <span>+63</span>
          <input name="contactNumber" type="number" placeholder="Contact Number" id="contactNumber" required />
        </div>
        <select name="gender" id="gender" required>
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
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      // FOR OTHER GENDER
      const gender = document.querySelector("#gender");
      const form = document.querySelector("form");
      const submitBtn = document.querySelector("button[type='submit']");
      gender.addEventListener("input", () => {
        if (gender.value == "other") {
          gender.remove();
          const genderEl = document.createElement("input");
          genderEl.name = "gender";
          genderEl.placeholder = "Other";
          genderEl.id = "gender";
          genderEl.required = true;
          genderEl.type = "text";
          genderEl.autocomplete = "off";
          form.insertBefore(genderEl, submitBtn);
        }
      });
    })
  </script>
  <script src="js/signup.js"></script>
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