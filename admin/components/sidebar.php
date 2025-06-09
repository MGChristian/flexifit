<?php $current_page = basename($_SERVER['PHP_SELF']); ?>

<div class="sidebar">
    <div class="sidebar-title">
        <div class="sidebar-role">ADMIN PANEL</div>
    </div>
    <ul class="sidebar-list">
        <!-- NAVBAR TITLE -->
        <a href="./">
            <li class="sidebar-list-item <?= $current_page == 'index.php' ? 'active' : '' ?>">
                <div class="sidebar-list-title"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</div>
            </li>
        </a>

        <!-- CONTENT -->
        <li class="content-a sidebar-list-item">
            <div class="sidebar-list-title"><i class="fa fa-columns" aria-hidden="true"></i></i> Content</div>
            <div><i class="fa fa-angle-down" aria-hidden="true"></i></div>
        </li>

        <!-- CONTENT DROPDOWN -->
        <ul class="content-m mini-sidebar-list hidden">
            <a href="./categories.php">
                <li class="mini-sidebar-list-item">Categories</li>
            </a>
            <a href="./exercises.php">
                <li class="mini-sidebar-list-item">Exercises</li>
            </a>
            <a href="./equipments.php">
                <li class="mini-sidebar-list-item">Equipments</li>
            </a>
            <a href="./muscles.php">
                <li class="mini-sidebar-list-item">Muscles</li>
            </a>
            <a href="./workouts.php">
                <li class="mini-sidebar-list-item">Workouts</li>
            </a>
        </ul>

        <!-- INSTRUCTORS -->
        <a href="./instructors.php">
            <li class="sidebar-list-item <?= $current_page == 'instructors.php' ? 'active' : '' ?>">
                <div class="sidebar-list-title"><i class="fa fa-users" aria-hidden="true"></i> Instructors</div>
            </li>
        </a>

        <!-- USERS -->
        <a href="./users.php">
            <li class="sidebar-list-item <?= $current_page == 'users.php' ? 'active' : '' ?>">
                <div class="sidebar-list-title"><i class="fa fa-user" aria-hidden="true"></i> Users</div>
            </li>
        </a>

        <!-- RATINGS -->
        <a href="./ratings.php">
            <li class="sidebar-list-item <?= $current_page == 'ratings.php' ? 'active' : '' ?>">
                <div class="sidebar-list-title"><i class="fa fa-star" aria-hidden="true"></i> Ratings & Reviews</div>
            </li>
        </a>

        <!-- REPORTS -->
        <a href="./reports.php">
            <li class="sidebar-list-item <?= $current_page == 'reports.php' ? 'active' : '' ?>">
                <div class="sidebar-list-title"><i class="fa fa-area-chart" aria-hidden="true"></i> Reports</div>
            </li>
        </a>
    </ul>
</div>