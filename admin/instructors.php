<?php require_once "./components/main.php";

if (isset($_SESSION['error_login'])) {
    print_r($_SESSION['error_login']);
    unset($_SESSION['error_login']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <?php include "./components/css.php" ?>
    <link href="./css/admin-modals.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.2.1/af-2.7.0/b-3.2.0/b-colvis-3.2.0/b-html5-3.2.0/b-print-3.2.0/cr-2.0.4/date-1.5.5/fc-5.0.4/fh-4.0.1/kt-2.12.1/r-3.0.3/rg-1.5.1/rr-1.5.0/sc-2.4.3/sb-1.8.1/sp-2.3.3/sl-3.0.0/sr-1.4.1/datatables.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.2.1/af-2.7.0/b-3.2.0/b-colvis-3.2.0/b-html5-3.2.0/b-print-3.2.0/cr-2.0.4/date-1.5.5/fc-5.0.4/fh-4.0.1/kt-2.12.1/r-3.0.3/rg-1.5.1/rr-1.5.0/sc-2.4.3/sb-1.8.1/sp-2.3.3/sl-3.0.0/sr-1.4.1/datatables.min.js"></script>
</head>

<body>
    <?php include "./modals/instructors-modals.php" ?>
    <!-- header -->
    <?php include "./components/navbar.php" ?>
    <!-- header -->
    <div class="grid-container">
        <!-- side -->
        <?php include "./components/sidebar.php" ?>
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
                <div class="main-title-button">
                    <h3>CURRENT INSTRUCTORS LIST</h3>
                    <div class="main-title-button-container">
                        <a href='./archived-instructors.php'><button type="button" class="add-button">ARCHIVED INSTRUCTORS</button></a>
                        <button type="button" class="filterOpen add-button" data-target="add-intructor">+ADD INSTRUCTOR</button>
                    </div>
                </div>
                <hr>
                <div class="table-container">
                    <table id="myTable" class="display" style="width:100%">
                        <thead>
                            <tr class="table-header">
                                <th>#</th>
                                <th>Instructor Name</th>
                                <th>Date Joined</th>
                                <th>Birthday</th>
                                <th>Gender</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            new DataTable("#myTable", {
                ajax: './includes/get-instructors.php',
                columns: [{
                        data: "id"
                    },
                    {
                        data: "instructorName"
                    },
                    {
                        data: "dateJoined"
                    },
                    {
                        data: "birthdate"
                    },
                    {
                        data: "gender"
                    },
                    {
                        data: "email"
                    },
                    {
                        data: "contact"
                    },
                    {
                        data: "buttons",
                        "orderable": false
                    }
                ],
                columnDefs: [{
                    width: "150px",
                    targets: (-1),
                }],
            });

            const PDF = document.querySelector(".buttons-pdf");
            const generatePDF = document.querySelector("#generate-pdf");

            generatePDF.addEventListener("click", () => {
                PDF.click();
            });
        });
    </script>
    <script src="js/scripts.js"> </script>
</body>

</html>