<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Flexifit</title>
</head>
<?php $current_page = basename($_SERVER['PHP_SELF']); ?>

<div class="sidebar">
    <div class="sidebar-title">
        <div class="sidebar-role">USER PANEL</div>
    </div>
    <ul class="sidebar-list">
        <!-- NAVBAR TITLE -->
        <a href="./dashboard.php">
            <li class="sidebar-list-item <?= $current_page == 'dashboard.php' ? 'active' : '' ?>">
                <div class="sidebar-list-title"><i class="fa-solid fa-chart-line" aria-hidden="true"></i> Dashboard</div>
            </li>
        </a>

        <!-- INSTRUCTORS -->
        <a href="./saved-workouts.php">
            <li class="sidebar-list-item <?= $current_page == 'saved-workouts.php' ? 'active' : '' ?>">
                <div class="sidebar-list-title"><i class="fa-solid fa-heart-circle-plus" aria-hidden="true"></i> Saved Workouts</div>
            </li>
        </a>

        <!-- USERS -->
        <a href="./my-collection.php">
            <li class="sidebar-list-item <?= $current_page == 'my-collection.php' ? 'active' : '' ?>">
                <div class="sidebar-list-title"><i class="fa-solid fa-layer-group" aria-hidden="true"></i> My Collection</div>
            </li>
        </a>
    </ul>
</div>