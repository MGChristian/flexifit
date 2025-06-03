<?php

// Check whether user has the authority to access this page.
require_once "./includes/auth.php";

if (isset($_SESSION['error_adding_exercise_details'])) {
    print_r($_SESSION['error_adding_exercise_details']);
    unset($_SESSION['error_adding_exercise_details']);
}

//Check if ID is set and its not empty, if it is, go back to exercise page.
isset($_GET['id']) && !empty($_GET['id']) ? $instructorId = $_GET['id'] : header("location: ./instructors.php");

?>

<?php
require_once("./includes/edit-instructor.php");
$instructor = new Instructor($conn, $instructorId);
if (!$instructor->is_id_valid()) {
    header("location: ./instructors.php");
    exit();
}
$instructorDetails = $instructor->get_instructor_user_details();
$instructorOtherDetails = $instructor->get_instructor_other_details();
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
                    <p><a href="index.php"> HOME </a> > <a href="instructors.php">INSTRUCTORS</a> > <?= strtoupper(htmlspecialchars($instructorDetails['username'])) ?></p>
                </div>
            </div>
            <div class="main-content">
                <div class="edit-content">
                    <div class="edit-content-title">
                        <h2>EDIT INSTRUCTOR</h2>
                    </div>
                    <form class="edit-content-form" action="./includes/add-instructor-details.php" method="POST" enctype="multipart/form-data">
                        <div class="input-full hidden">
                            <label>Intructor ID</label>
                            <input name="instructorID" type="text" value="<?= $instructorId ?>" />
                        </div>
                        <h4>Profile Picture</h4>
                        <div class="input-full">
                            <input type="file" accept="image/*" name="profilePicUrl" />
                        </div>
                        <hr>
                        <div class="half">
                            <div class="input-half">
                                <label>First Name</label>
                                <input name="firstName" type="text" value="<?= $instructorDetails['firstName'] ?>" />
                            </div>
                            <div class="input-half">
                                <label>Last Name</label>
                                <input name="lastName" type="text" value="<?= $instructorDetails['lastName'] ?>" />
                            </div>
                        </div>
                        <div class="half">
                            <div class="input-half">
                                <label>Email</label>
                                <input name="email" type="text" value="<?= $instructorDetails['email'] ?>" />
                            </div>
                            <div class="input-half">
                                <label>Contact Number</label>
                                <input name="contactNumber" type="text" value="<?= $instructorDetails['contactNo'] ?>" />
                            </div>
                        </div>
                        <div class="half">
                            <div class="input-half">
                                <label>Gender</label>
                                <select name="gender">
                                    <option value="Male" <?= $instructorDetails['gender'] == "Male" ? 'selected' : '' ?>>Male</option>
                                    <option value="Female" <?= $instructorDetails['gender'] == "Female" ? 'selected' : '' ?>>Female</option>
                                </select>
                            </div>
                            <div class="input-half">
                                <label>Birthdate</label>
                                <input name="birthdate" type="date" />
                            </div>
                        </div>
                        <div class="input-full">
                            <label>Status</label>
                            <select name="status">
                                <option value="inactive" <?= htmlspecialchars($instructorDetails['status']) == 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                                <option value="active" <?= htmlspecialchars($instructorDetails['status']) == 'active' ? 'selected' : ''; ?>>Active</option>
                            </select>
                        </div>
                        <hr>
                        <h4>Personal Information</h4>
                        <div class="input-full">
                            <label>Personal Goals</label>
                            <input name="personalGoals" type="text" value="<?= isset($instructorOtherDetails['goal']) ? htmlspecialchars($instructorOtherDetails['goal']) : '' ?>" />
                        </div>
                        <div class="input-full">
                            <label>Personal Description</label>
                            <input name="personalDescription" type="text" value="<?= isset($instructorOtherDetails['personalDescription']) ? htmlspecialchars($instructorOtherDetails['personalDescription']) : '' ?>" />
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