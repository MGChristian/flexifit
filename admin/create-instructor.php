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
                <h1>INSTRUCTORS</h1>
                <div class="quick-link">
                    <p><a href="index.php"> HOME </a> > INSTRUCTORS</p>
                </div>
            </div>
            <div class="main-content">
                <div class="table-desc">
                    <h3>CREATE INSTRUCTOR</h3>
                </div>
                <hr>
                <div class="refunds-table">
                    <form class="create-table">
                        <div class="create-table-header">
                            <p>CREATE INSTRUCTOR</p>
                        </div>
                        <div class="create-table-content">
                            <div class="input">
                                <label>Instructor Photo</label>
                                <input type="file">
                            </div>
                            <div class="input">
                                <label>Instructor Name</label>
                                <input type="text">
                            </div>
                            <div class="input">
                                <label>Instructor's Forte</label>
                                <select>
                                    <option>Forte 1</option>
                                    <option>Forte 2</option>
                                    <option>Forte 3</option>
                                </select>
                            </div>
                            <div class="input">
                                <label>Instructor Description</label>
                                <textarea default="Description"></textarea>
                            </div>
                            <div class="buttons">
                                <div class="create-add">
                                    <a href="instructors.php"><button type="button">ADD INSTRUCTOR</button></a>
                                </div>
                                <div class="create-cancel">
                                    <a href="instructors.php"><button type="button">CANCEL</button></a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
    <script src="js/scripts.js"> </script>
    <script src="js/datatables.js"></script>
</body>

</html>