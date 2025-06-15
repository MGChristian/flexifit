<?php
require_once("./includes/auth.php");
require_once("./includes/class-profile.php");

$id = $_SESSION['id'];
$profile = new Profile($conn, $id);

if (!$profile->check_user()) {
  header("location: ./index.php");
  exit();
}

$userDetails = $profile->get_user_details();

//User Details
$firstName = htmlspecialchars($userDetails['firstName']);
$lastName = htmlspecialchars($userDetails['lastName']);
$email = htmlspecialchars($userDetails['email']);
$contactNumber = htmlspecialchars($userDetails['contactNo']);
$birthdate = htmlspecialchars($userDetails['DOB']);
$gender = htmlspecialchars($userDetails['gender']);
$username = htmlspecialchars($userDetails['username']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FlexiFit</title>
  <?php require_once "./components/global_css.php"; ?>
  <link rel="stylesheet" href="css/my-profile.css" />
</head>

<body>
  <?php require_once "./components/navbar.php"; ?>

  <header class="header">
    <div class="header-content">
      <div class="profile-header">
        <div class="image-container">
          <img src="./images/users/51T5RPDAS1L._AC_SL1500_.jpg" alt="User Profile Image" />
        </div>
        <div class="profile-details">
          <h4><?= "$lastName, $firstName" ?></h4>
          <p><?= $email ?></p>
        </div>
      </div>
    </div>
  </header>

  <main class="main-container">
    <br>
    <div class="user-profile-content">
      <div class="user-profile-left">
        <form action="./includes/change-user-details.php" method="POST" id="user-details-form">
          <h4>Personal Information</h4>
          <hr />
          <div class="user-details">
            <div class="half">
              <div class="input-half">
                <label>First Name</label>
                <input type="text" value="<?= $firstName ?>" name="firstName" />
              </div>
              <div class="input-half">
                <label>Last Name</label>
                <input type="text" value="<?= $lastName ?>" name="lastName" />
              </div>
            </div>
            <div class="half">
              <div class="input-half">
                <label>Email</label>
                <input type="text" value="<?= $email ?>" name="email" />
              </div>
              <div class="input-half">
                <label>Contact Number</label>
                <input type="text" value="<?= $contactNumber ?>" name="contactNumber" />
              </div>
            </div>
            <div class="half">
              <div class="input-half">
                <label>Birthdate</label>
                <input type="text" value="<?= $birthdate ?>" name="birthdate" />
              </div>
              <div class="input-half">
                <label>Gender</label>
                <select name="gender">
                  <option <?= strtolower($gender) == 'male' ? 'selected' : '' ?>>Male</option>
                  <option <?= strtolower($gender) == 'female' ? 'selected' : '' ?>>Female</option>
                  <option <?= (strtolower($gender) !== 'male' && strtolower($gender) !== 'female') ? 'selected' : '' ?>>
                    <?= $gender ?>
                  </option>
                </select>
              </div>
            </div>
          </div>

          <h4>Account Information</h4>
          <hr />
          <div class="user-details">
            <div class="half">
              <div class="input-half">
                <label>Username</label>
                <input type="text" value="<?= $username ?>" name="username" />
              </div>
              <div class="input-half">
                <label>Date Created</label>
                <input type="date" value="2025-01-10" disabled />
              </div>
            </div>
          </div>

          <button type="submit" disabled>Save Changes</button>
        </form>
      </div>

      <div class="user-profile-right">
        <form action="./includes/change-pass.php" method="POST" id="user-password-form">
          <h4>Change Password</h4>
          <hr />
          <div class="user-details">
            <div class="input-full">
              <label>Current Password</label>
              <input type="password" name="currentPassword" />
            </div>
            <div class="input-full">
              <label>New Password</label>
              <input type="password" name="newPassword" />
            </div>
            <div class="input-full">
              <label>Confirm New Password</label>
              <input type="password" name="confirmPassword" />
            </div>
            <button type="submit" disabled>Change Password</button>
          </div>
        </form>
      </div>
    </div>
  </main>

  <?php require_once "./components/footer.php"; ?>
  <?php require_once "./components/navbar_scripts.php"; ?>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const userDetailsForm = document.getElementById("user-details-form");
      const userPasswordForm = document.getElementById("user-password-form");

      const userDetailsButton = userDetailsForm.querySelector("button");
      const userPasswordButton = userPasswordForm.querySelector("button");

      userDetailsForm.addEventListener("input", () => {
        userDetailsButton.disabled = false;
      });

      userPasswordForm.addEventListener("input", () => {
        userPasswordButton.disabled = false;
      });
    });
  </script>
</body>

</html>