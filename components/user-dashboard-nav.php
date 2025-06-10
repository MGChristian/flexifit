<header class="header">

    <div class="logo">
        <i class="fa fa-bars navbar-hamburger" aria-hidden="true"></i>
        <div class="logo">
            <img src="assets/flexifitlogo.png" alt="FlexiFit Logo" />
        </div>
    </div>
    <div class="user-profile">
        <i class="fa-solid fa-user-circle filterOpen fa-lg" aria-hidden="true" data-target="user-dropdown"></i>
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
