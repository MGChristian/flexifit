<?php
require_once("./includes/auth.php");
require_once("./includes/class-collection.php");
$userID = $_SESSION['id'];
$collections = new Collection($conn, $userID);
$collectionsList = $collections->get_all_collection();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "./components/css.php" ?>
    <?php require_once "./components/global_css.php" ?>
    <link rel="stylesheet" href="./admin/css/admin-modals.css">
    <link rel="stylesheet" href="./css/user-all-collection.css">
    <title>Flexifit</title>
</head>

<body>
    <!-- MODALS -->
    <?php include "./modals/collection-modal.php" ?>
    <!-- HEADER -->
    <?php require_once "./components/user-dashboard-nav.php" ?>

    <div class="grid-container">
        <!-- side -->
        <?php include "./components/user-dashboard-sidebar.php" ?>
        <div class="main-container">
            <div class="page-title">
                <h1>MY COLLECTIONS</h1>
                <div class="quick-link">
                    <p><a href="user-my-collection.php"> HOME </a> > MY COLLECTIONS</p>
                </div>
            </div>
            <div class="main-content">
                <div class="main-title-button">
                    <h3>CURRENT COLLECTTION LIST</h3>
                    <div class="main-title-button-container">
                        <button type="button" class="filterOpen add-button" data-target="add-collection">+ CREATE COLLECTION</button>
                    </div>
                </div>
                <hr>
                <div class="table-container">
                    <div class="collection-list">
                        <?php foreach ($collectionsList as $collection): ?>
                            <a href="./user-my-collection-edit.php?id=<?= htmlspecialchars($collection['ID']) ?>">
                                <div class="collection">
                                    <h3><?= htmlspecialchars($collection['collectionName']) ?></h3>
                                    <p>Duration:</p>
                                    <p>Created On: <?= htmlspecialchars($collection['date_created']) ?></p>
                                    <p>Description: <?= htmlspecialchars($collection['description']) ?></p>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./js/scripts.js"></script>
</body>

</html>