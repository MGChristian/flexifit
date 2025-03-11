<?php

require_once "./includes/config_session.inc.php";

$isLoggedIn = isset($_SESSION['id']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FlexiFit</title>
  <?php require_once "./components/global_css.php" ?>
  <link rel="stylesheet" href="css/my-profile.css" />
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    rel="stylesheet" />
</head>

<body>
  <!-- Navigation Header -->
  <?php require_once "./components/navbar.php" ?>
  <!-- MAIN CONTAINER -->
  <header class="header">
    <div class="header-content">
      <h1>MY PROFILE</h1>
    </div>
  </header>
  <main class="main-container">
    <div class="profile-header">
      <div class="image-container"></div>
      <div class="profile-details">
        <h4>Surname, Firstname, M.I</h4>
        <p>email@gmail.com</p>
      </div>
    </div>
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
              <input type="text" value="2002-12-11" />
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
              <input type="number" />
            </div>
          </div>
        </div>
        <h4>Account Information</h4>
        <hr />
        <div class="user-details">
          <div class="half">
            <div class="input-half">
              <label>Username</label>
              <input type="text" />
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
              <input type="password" />
            </div>
            <div class="input-full">
              <label>New Password</label>
              <input type="password" />
            </div>
            <div class="input-full">
              <label>Confirm New Password</label>
              <input type="password" />
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