<?php
require_once("./includes/auth.php");
require_once("./includes/profile.inc.php");
$id = $_SESSION['id'];
$profile = new Profile($conn, $id);
if (!$profile->check_user()) {
  header("location: ./index.php");
  exit();
}
$userDetails = $profile->get_user_details();

if (isset($_SESSION['error_login'])) {
  print_r($_SESSION['error_login']);
  unset($_SESSION['error_login']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FlexiFit</title>
  <?php require_once "./components/global_css.php" ?>
  <link rel="stylesheet" href="css/my-profile.css" />
</head>

<body>
  <!-- Navigation Header -->
  <?php require_once "./components/navbar.php" ?>
  <!-- MAIN CONTAINER -->
  <header class="header">
    <div class="header-content">
      <div class="profile-header">
        <div class="image-container"></div>
        <div class="profile-details">
          <h4><?= $userDetails['lastName'] . ", " . $userDetails['firstName'] ?></h4>
          <p><?= $userDetails['email'] ?></p>
        </div>
      </div>
    </div>
  </header>
  <main class="main-container">
    <br>
    <div class="user-profile-content">
      <div class="user-profile-left">
        <h4>Personal Information</h4>
        <hr />
        <div class="user-details">
          <div class="half">
            <div class="input-half">
              <label>Address</label>
              <input type="text" />
            </div>

            <div class="input-half">
              <label>Birthdate</label>
              <input type="text" value="<?= $userDetails['DOB'] ?>" />
            </div>
          </div>
          <div class="half">
            <div class="input-half">
              <label>Gender</label>
              <select>
                <option>Male</option>
                <option>Female</option>
                <option selected disabled>Gender</option>
              </select>
            </div>

            <div class="input-half">
              <label>Contact Number</label>
              <input type="number" value="<?= $userDetails['contactNo'] ?>" />
            </div>
          </div>
        </div>
        <h4>Account Information</h4>
        <hr />
        <div class="user-details">
          <div class="half">
            <div class="input-half">
              <label>Username</label>
              <input type="text" value="<?= $userDetails['username'] ?>" />
            </div>
            <div class="input-half">
              <label>Date Created</label>
              <input type="date" value="2025-01-10" disabled />
            </div>
          </div>
        </div>
      </div>
      <div class="user-profile-right">
        <h4>Change Password</h4>
        <hr />
        <div class="user-details">
          <form action="./includes/change-pass.php" method="POST">
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
            <button type="submit">Change Password</button>
          </form>
        </div>
      </div>

    </div>
  </main>
  <!-- END OF MAIN -->
  <?php require_once "./components/footer.php" ?>
  <?php require_once "./components/navbar_scripts.php" ?>
</body>

</html>