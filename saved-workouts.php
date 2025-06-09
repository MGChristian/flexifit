<?php
require_once("./includes/auth.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "./components/css.php" ?>
    <?php require_once "./components/global_css.php" ?>
    <title>Flexifit</title>
</head>
<body>
    <?php require_once "./components/user-dashboard-nav.php" ?>

    <div class="grid-container">
        <!-- side -->
        <?php include "./components/user-dashboard-sidebar.php" ?>
        <div class="main-container">
        <h3>My Saved Workouts</h3>
    </div>
    </div>
    
</body>
</html>