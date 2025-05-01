<?php

require_once("./includes/config.php");

if (!isset($isLoggedIn)) {
    $isLoggedIn = isset($_SESSION['id']);
}

if (!isset($userData) && $isLoggedIn) {
    require_once "./includes/config_session.inc.php";
    $user_id = $_SESSION['id'];
    $stmt = $conn->prepare("SELECT * FROM `user` WHERE `ID` = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && $result->num_rows > 0) {
        $userData = $result->fetch_assoc();
    }
}

$url = basename($_SERVER['PHP_SELF']);

?>

<nav class="navbar desktop">
    <div class="navigation-left">
        <div class="logo">
            <img src="./assets/flexifitlogo.jpg" alt="FlexiFit Logo" />
        </div>
        <ul class="nav-links">
            <li <?php echo ($url && $url === 'index.php') ? 'class="active"' : ''; ?>><a href="./">HOME</a></li>
            <li <?php echo ($url && $url === 'explore-classes.php') ? 'class="active"' : ''; ?>><a href="explore-classes.php">EXPLORE WORKOUTS</a></li>
            <li <?php echo ($url && $url === 'explore-exercises.php' || $url === 'all-exercises.php' || $url === 'exercise.php') ? 'class="active"' : ''; ?>><a href="explore-exercises.php">EXERCISES</a></li>
            <li <?php echo ($url && $url === 'instructors.php') ? 'class="active"' : ''; ?>><a href="Instructors.php">INSTRUCTORS</a></li>
            <li <?php echo ($url && $url === 'how-it-works.php') ? 'class="active"' : ''; ?>><a href="how-it-works.php">HOW IT WORKS</a></li>
            <li <?php echo ($url && $url === 'about-us.php') ? 'class="active"' : ''; ?>><a href="about-us.php">ABOUT US</a></li>
        </ul>
    </div>
    <?php if ($isLoggedIn): ?>
        <div class="user-profile">
            <i class="fa fa-user-circle filterOpen fa-lg" aria-hidden="true" data-target="user-dropdown"></i>
            <div class="filters shadow hidden" id="user-dropdown">
                <p style="  word-wrap: break-word; overflow-wrap: break-word; max-width: 100%; "><?= htmlspecialchars($userData['firstName']) . " " . htmlspecialchars($userData['lastName']) ?></p>
                <hr />
                <!-- Dashboard page -->
                <a href=<?= check_dashboard(); ?>>
                    <div class="dropdown-item">
                        <div class="option">
                            <box-icon name="dashboard" type="solid"></box-icon>
                            <p>Dashboard</p>
                        </div>
                        <box-icon name="chevron-right"></box-icon>
                    </div>
                </a>
                <!-- Profile page -->
                <a href="myProfile.php">
                    <div class="dropdown-item">
                        <div class="option">
                            <box-icon name="user-circle" type="solid"></box-icon>
                            <p>My Profile</p>
                        </div>
                        <box-icon name="chevron-right"></box-icon>
                    </div>
                </a>
                <!-- Records page -->
                <div class="dropdown-item">
                    <div class="option">
                        <box-icon name="folder-open" type="solid"></box-icon>
                        <a href="myRecords.html">
                            <p>My Records</p>
                        </a>
                    </div>
                    <box-icon name="chevron-right"></box-icon>
                </div>
                <!-- User logout -->
                <div class="dropdown-item">
                    <div class="option">
                        <box-icon name="log-out" type="solid"></box-icon>
                        <a href="./logout.php">
                            <p>Log Out</p>
                        </a>
                    </div>
                    <box-icon name="chevron-right"></box-icon>
                </div>
            </div>
        </div>
    <?php else: ?>
        <button class="join-now">
            <a href="login-page.php">Join Now</a>
        </button>
    <?php endif; ?>
</nav>

<nav class="navbar mobile">
    <div class="navigation-left">
        <i class="fa fa-bars navbar-hamburger" aria-hidden="true"></i>
        <div class="logo">
            <img src="assets/flexifitlogo.jpg" alt="FlexiFit Logo" />
        </div>
    </div>
    <?php if ($isLoggedIn): ?>
        <div class="user-profile">
            <i class="fa fa-user-circle filterOpen fa-lg" aria-hidden="true" data-target="user-dropdown-mobile"></i>
            <div class="filters shadow hidden" id="user-dropdown-mobile">
                <p style="  word-wrap: break-word; overflow-wrap: break-word; max-width: 100%; "><?= htmlspecialchars($userData['firstName']) . " " . htmlspecialchars($userData['lastName']) ?></p>
                <hr />
                <!-- Dashboard page -->
                <a href=<?= check_dashboard(); ?>>
                    <div class="dropdown-item">
                        <div class="option">
                            <box-icon name="dashboard" type="solid"></box-icon>
                            <p>Dashboard</p>
                        </div>
                        <box-icon name="chevron-right"></box-icon>
                    </div>
                </a>
                <!-- Profile page -->
                <a href="myProfile.php">
                    <div class="dropdown-item">
                        <div class="option">
                            <box-icon name="user-circle" type="solid"></box-icon>
                            <p>My Profile</p>
                        </div>
                        <box-icon name="chevron-right"></box-icon>
                    </div>
                </a>
                <!-- Records page -->
                <div class="dropdown-item">
                    <div class="option">
                        <box-icon name="folder-open" type="solid"></box-icon>
                        <a href="myRecords.html">
                            <p>My Records</p>
                        </a>
                    </div>
                    <box-icon name="chevron-right"></box-icon>
                </div>
                <!-- User logout -->
                <div class="dropdown-item">
                    <div class="option">
                        <box-icon name="log-out" type="solid"></box-icon>
                        <a href="./logout.php">
                            <p>Log Out</p>
                        </a>
                    </div>
                    <box-icon name="chevron-right"></box-icon>
                </div>
            </div>
        </div>
    <?php endif; ?>
</nav>
<ul class="nav-links-mobile">
    <a href="./">
        <li <?php echo ($url && $url === 'index.php') ? 'class="active"' : ''; ?>>HOME</li>
    </a>
    <a href="explore-classes.php">
        <li <?php echo ($url && $url === 'explore-classes.php') ? 'class="active"' : ''; ?>>EXPLORE WORKOUTS</li>
    </a>
    <a href="explore-exercises.php">
        <li <?php echo ($url && $url === 'explore-exercises.php' || $url === 'all-exercises.php' || $url === 'exercise.php') ? 'class="active"' : ''; ?>>EXERCISES</li>
    </a>
    <a href="Instructors.php">
        <li <?php echo ($url && $url === 'instructors.php') ? 'class="active"' : ''; ?>>INSTRUCTORS</li>
    </a>
    <a href="how-it-works.php">
        <li <?php echo ($url && $url === 'how-it-works.php') ? 'class="active"' : ''; ?>>HOW IT WORKS</li>
    </a>
    <a href="about-us.php">
        <li <?php echo ($url && $url === 'about-us.php') ? 'class="active"' : ''; ?>>ABOUT US</li>
    </a>
    <?php if (!$isLoggedIn): ?>
        <a href="./login-page.php">
            <li class="join-us">JOIN US</li>
        </a>
    <?php endif; ?>
</ul>


<?php
function check_dashboard()
{
    if ($_SESSION['role'] && $_SESSION['role'] == 'admin') {
        return './admin/';
    } elseif ($_SESSION['role'] && $_SESSION['role'] == 'instructor') {
        return './instructor/';
    } else {
        return './dashboard.php';
    }
}
?>