<?php

// Check whether user has the authority to access this page.
require_once "./includes/auth.php";


//Check if ID is set and its not empty, if it is, go back to exercise page.
isset($_GET['id']) && !empty($_GET['id']) ? $userID = $_GET['id'] : header("location: ./users.php");

?>

<?php
require_once("./includes/edit-user.php");
$user = new User($conn, $userID);
if (!$user->is_id_valid()) {
    header("location: ./users.php");
    exit();
}
$userDetails = $user->get_user_details();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <?php include "./components/css.php" ?>
    <link href="./css/edit-instructor.css" rel="stylesheet">
</head>

<body>
    <!-- header -->
    <?php include "./components/navbar.php" ?>
    <!-- header -->
    <div class="grid-container">

        <!-- side -->
        <?php include "./components/sidebar.php" ?>
        <!-- side -->

        <!-- main -->
        <main class="main-container">
            <div class="page-title">
                <div class="quick-link">
                    <p><a href="index.php"> HOME </a> > <a href="users.php">USERS</a> > <?= strtoupper(htmlspecialchars($userDetails['username'])) ?></p>
                </div>
            </div>
            <div class="main-content">
                <div class="edit-content">
                    <div class="edit-content-title">
                        <h2>EDIT USERS</h2>
                    </div>
                    <form class="edit-content-form" action="./includes/add-user-details.php" method="POST" enctype="multipart/form-data">
                        <div class="input-full hidden">
                            <label>User ID</label>
                            <input name="userID" type="text" value="<?= $userID ?>" />
                        </div>
                        <h4>Profile Picture</h4>
                        <div class="input-full">
                            <input type="file" accept="image/*" name="profilePicUrl" />
                        </div>
                        <hr>
                        <div class="half">
                            <div class="input-half">
                                <label>First Name</label>
                                <input name="firstName" type="text" value="<?= $userDetails['firstName'] ?>" />
                            </div>
                            <div class="input-half">
                                <label>Last Name</label>
                                <input name="lastName" type="text" value="<?= $userDetails['lastName'] ?>" />
                            </div>
                        </div>
                        <div class="half">
                            <div class="input-half">
                                <label>Email</label>
                                <input name="email" type="text" value="<?= $userDetails['email'] ?>" />
                            </div>
                            <div class="input-half">
                                <label>Contact Number</label>
                                <input name="contactNumber" type="number" value="<?= $userDetails['contactNo'] ?>" />
                            </div>
                        </div>
                        <div class="half">
                            <div class="input-half">
                                <label>Gender</label>
                                <select name="gender">
                                    <option value="Male" <?= $userDetails['gender'] == "Male" ? 'selected' : '' ?>>Male</option>
                                    <option value="Female" <?= $userDetails['gender'] == "Female" ? 'selected' : '' ?>>Female</option>
                                </select>
                            </div>
                            <div class="input-half">
                                <label>Birthdate</label>
                                <input name="birthdate" type="date" value="<?= $userDetails['DOB'] ?>" />
                            </div>
                        </div>
                        <div class="input-full">
                            <label>Status</label>
                            <select name="status">
                                <option value="inactive" <?= strtolower(htmlspecialchars($userDetails['status'])) == 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                                <option value="active" <?= strtolower(htmlspecialchars($userDetails['status'])) == 'active' ? 'selected' : ''; ?>>Active</option>
                            </select>
                        </div>
                        <div class="edit-form-buttons">
                            <button type="submit" class="save">SAVE</button>
                            <a href="./instructors.php"><button type="button" class="back">GO BACK</button></a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
    <script src="js/scripts.js"> </script>
</body>

</html>