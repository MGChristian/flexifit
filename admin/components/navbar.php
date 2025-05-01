<?php

if (!isset($isLoggedIn)) {
    $isLoggedIn = isset($_SESSION['id']);
}

if (!isset($userData) && $isLoggedIn) {
    $user_id = $_SESSION['id'];
    $stmt = $conn->prepare("SELECT * FROM `user` WHERE `ID` = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && $result->num_rows > 0) {
        $userData = $result->fetch_assoc();
    }
}

?>

<header class="header">
    <div class="logo" style="display:flex; gap:5px;">
        <div class="logo">
            <img src="assets/flexifitlogo.png" alt="FlexiFit Logo" />
        </div>
    </div>
    <div class="user-profile">
        <i class="fa fa-user-circle filterOpen fa-lg" aria-hidden="true" data-target="user-dropdown"></i>
        <div class="filters shadow hidden" id="user-dropdown">
            <p style="word-wrap: break-word; overflow-wrap: break-word; max-width: 100%; "><?= htmlspecialchars($userData['firstName']) . " " . htmlspecialchars($userData['lastName']) ?></p>
            <hr />
            <!-- Dashboard page -->
            <a href="../">
                <div class="dropdown-item">
                    <div class="option">
                        <box-icon name="dashboard" type="solid"></box-icon>
                        <p>Homepage </p>
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
</header>