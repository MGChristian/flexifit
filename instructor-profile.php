<?php
require_once("./includes/auth.php");
// Check if id is set, if it is not go back to explore exercise page
isset($_GET['id']) && !empty($_GET['id']) ? $instructorId = $_GET['id'] : header("location: ./explore-instructors.php");
?>

<!-- Get all exercise details -->
<?php
require_once "./includes/class-instructor.php";
$instructor = new Instructor($conn);
$instructor->initialize_id($instructorId);
if ($instructor->check_id() === true) {
    $instructorDetails = $instructor->get_instructor_details();
    $workouts = $instructor->get_workouts();
} else {
    header("location: ./explore-instructors.php");
    exit();
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FlexiFit</title>
    <?php require_once "./components/global_css.php" ?>
    <link rel="stylesheet" href="./css/instructor-profile.css" />
</head>

<body>
    <!-- Navigation Header -->
    <?php require_once "./components/navbar.php" ?>
    <!-- MAIN CONTAINER -->
    <header class="header">
        <div class="header-content">
            <div class="profile-header">
                <div class="image-container">
                    <img src="./instructor/images/<?= rawurlencode($instructorDetails['firstName']) . "-" . rawurlencode($instructorDetails['lastName']) . "/" . rawurlencode($instructorDetails['profilePicUrl']) ?>" />
                </div>
                <div class="profile-details">
                    <p>INSTRUCTOR</p>
                    <h4><?= htmlspecialchars($instructorDetails['lastName']) . ", " . htmlspecialchars($instructorDetails['firstName']) ?></h4>
                    <p><b>Strength Training, Athletic Performance, Core Conditioning</b></p>
                    <p class="profile-description"><?= htmlspecialchars($instructorDetails['goal']) ?></p>
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
                    <p><?= htmlspecialchars($instructorDetails['personalDescription']) ?></p>
                </div>
                <div class="user-details-w-button">
                    <h4>My Workouts</h4>
                    <a href="explore-workouts.php?instructor-id=<?= htmlspecialchars($instructorDetails['ID']) ?>"><button class="view-btn">View More</button></a>
                </div>
                <hr />
                <div class="workout-container">
                    <?php foreach ($workouts as $workout): ?>
                        <a href="./view-workout.php?id=<?= htmlspecialchars($workout['ID']) ?>">
                            <div class="workout">
                                <div class="workout-image">
                                    <img src="./admin/images/workouts/<?= isset($workout['workoutPicUrl']) && !empty($workout['workoutPicUrl']) ? htmlspecialchars($workout['workoutPicUrl']) : 'play-button.png' ?>">
                                </div>
                                <div class="workout-details">
                                    <p><strong><?= htmlspecialchars($workout['workoutName']) ?></strong></p>
                                    <p><?= htmlspecialchars($workout['duration']) ?> - <strong><?= htmlspecialchars($workout['difficulty']) ?></strong></p>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
                <div class="user-details">
                </div>
            </div>
            <div class="user-profile-right">
                <h4>Connect with Me</h4>
                <hr />
            </div>

        </div>
    </main>
    <!-- END OF MAIN -->
    <?php require_once "./components/footer.php" ?>
    <?php require_once "./components/navbar_scripts.php" ?>
</body>

</html>