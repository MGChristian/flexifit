<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/colors.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/table-design.css">
    <link rel="stylesheet" href="css/create-instructor.css">
    <link rel="stylesheet" href="css/user-page.css">
    <?php include "includes/css.php" ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
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
                <h1>USER PROFILE</h1>
                <div class="quick-link">
                    <p><a href="index.php"> HOME </a> > USER PROFILE</p>
                </div>
            </div>
            <div class="main-content">
                <div class="user-actions">
                    <a href="userpage.php">
                        <h3>VIEW USER PROFILE</h3>
                    </a>
                    <a href="user-history.php">
                        <h3>BOOKING HISTORY</h3>
                    </a>
                </div>
                <hr>
                <div class="refunds-table">
                    <div class="user-profile">
                        <div class="profile-header">
                            <div class="image-container"></div>
                            <div class="profile-details">
                                <h3>Surname, Firstname, M.I</h3>
                                <p>email@gmail.com</p>
                            </div>
                        </div>
                        <h3>Personal Information</h3>
                        <hr>
                        <div class="user-details">
                            <div class="half">
                                <div class="input-half">
                                    <label>Address</label>
                                    <input type="text">
                                </div>

                                <div class="input-half">
                                    <label>Birthdate</label>
                                    <input type="text" value="2002-12-11">
                                </div>

                            </div>
                            <div class="half">
                                <div class="input-half">
                                    <label>Gender</label>
                                    <select>
                                        <option>Male</option>
                                        <option>Female</option>
                                        <option selected disabled>Gender</option>
                                    </select>
                                </div>

                                <div class="input-half">
                                    <label>Contact Number</label>
                                    <input type="number">
                                </div>
                            </div>
                        </div>
                        <h3>Account Information</h3>
                        <hr>
                        <div class="user-details">
                            <div class="half">
                                <div class="input-half">
                                    <label>Username</label>
                                    <input type="text">
                                </div>
                                <div class="input-half">
                                    <label>Date Created</label>
                                    <input type="date" value="2025-01-10">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="js/scripts.js"> </script>
    <script src="js/datatables.js"></script>
</body>

</html>