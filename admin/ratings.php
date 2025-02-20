<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/colors.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/table-design.css">
    <link rel="stylesheet" href="css/ratings.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <?php include "includes/css.php" ?>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

</head>

<body>
    <div class="grid-container">
        <!-- header -->
        <?php include "includes/header.php" ?>
        <!-- header -->

        <!-- side -->
        <?php include "includes/sidebar.php" ?>
        <!-- side -->

        <!-- main -->
        <main class="main-container">
            <div class="page-title">
                <h1>RATINGS & REVIEWS</h1>
                <div class="quick-link">
                    <p><a href="index.php"> HOME </a> > RATINGS & REVIEWS</p>
                </div>
            </div>
            <div class="main-content">
                <div class="table-desc">
                    <h3>INSTRUCTORS LIST</h3>
                </div>
                <hr>
                <div class="ratings-table">
                    <?php for ($i = 1; $i <= 10; $i++) { ?>
                        <div class="client-card">
                            <img src="images/1.jpg">
                            <p>Surname, Name M.I</p>
                            <p><box-icon type='solid' name='star'></box-icon><box-icon type='solid' name='star'></box-icon><box-icon type='solid' name='star'></box-icon><box-icon type='solid' name='star'></box-icon><box-icon type='solid' name='star'></box-icon></p>
                            <a href="ratings-list.php" class="rating-view">VIEW RATINGS</a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </main>
    </div>
    <script src="js/scripts.js"> </script>

</body>

</html>