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
    <style>
        .dashboard-title {
            display: flex;
            justify-content: space-between;
        }

        .dashboard-title button {
            padding: 0.5rem 1rem;
            background-color: var(--yellow);
            border: none;
        }

        .collection {
            display: flex;
            flex-direction: column;
            padding: 1rem;
            background-color: var(--black);
            border-radius: 5px;
            color: white;
        }
    </style>
    <title>Flexifit</title>
</head>

<body>
    <?php require_once "./components/user-dashboard-nav.php" ?>

    <div class="grid-container">
        <!-- side -->
        <?php include "./components/user-dashboard-sidebar.php" ?>
        <div class="main-container">
            <div class="dashboard-title">
                <h2>My Collections</h2>
                <button>+CREATE COLLECTION</button>

            </div>
            <br>
            <hr>
            <br>
            <div class="collection-list">
                <div class="collection">
                    <h3>Collection Title</h3>
                    <p>Duration:</p>
                    <p>Created On: </p>
                </div>
            </div>
        </div>
    </div>

</body>

</html>