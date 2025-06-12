<?php $current_page = basename($_SERVER['PHP_SELF']); ?>

<div class="sidebar">
    <div class="sidebar-title">
        <div class="sidebar-role">USER PANEL</div>
    </div>
    <ul class="sidebar-list">
        <!-- NAVBAR TITLE -->
        <a href="./user-dashboard.php">
            <li class="sidebar-list-item <?= $current_page == 'user-dashboard.php' ? 'active' : '' ?>">
                <div class="sidebar-list-title"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</div>
            </li>
        </a>

        <!-- INSTRUCTORS -->
        <a href="./user-workout-history.php">
            <li class="sidebar-list-item <?= $current_page == 'user-workout-history.php' ? 'active' : '' ?>">
                <div class="sidebar-list-title"><i class="fa fa-history" aria-hidden="true"></i> Workout History</div>
            </li>
        </a>


        <!-- INSTRUCTORS -->
        <a href="./user-saved-workouts.php">
            <li class="sidebar-list-item <?= $current_page == 'user-saved-workouts.php' ? 'active' : '' ?>">
                <div class="sidebar-list-title"><i class="fa fa-heart" aria-hidden="true"></i> Saved Workouts</div>
            </li>
        </a>

        <!-- USERS -->
        <a href="./user-my-collection.php">
            <li class="sidebar-list-item <?= $current_page == 'user-my-collection.php' ? 'active' : '' ?>">
                <div class="sidebar-list-title"><i class="fa fa-book" aria-hidden="true"></i> My Collection</div>
            </li>
        </a>
    </ul>
</div>