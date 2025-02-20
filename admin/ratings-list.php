<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/colors.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/table-design.css">
    <link href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.2.1/af-2.7.0/b-3.2.0/b-colvis-3.2.0/b-html5-3.2.0/b-print-3.2.0/cr-2.0.4/date-1.5.5/fc-5.0.4/fh-4.0.1/kt-2.12.1/r-3.0.3/rg-1.5.1/rr-1.5.0/sc-2.4.3/sb-1.8.1/sp-2.3.3/sl-3.0.0/sr-1.4.1/datatables.min.css" rel="stylesheet">
    <?php include "includes/css.php" ?>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.2.1/af-2.7.0/b-3.2.0/b-colvis-3.2.0/b-html5-3.2.0/b-print-3.2.0/cr-2.0.4/date-1.5.5/fc-5.0.4/fh-4.0.1/kt-2.12.1/r-3.0.3/rg-1.5.1/rr-1.5.0/sc-2.4.3/sb-1.8.1/sp-2.3.3/sl-3.0.0/sr-1.4.1/datatables.min.js"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/2.2.1/dataRender/ellipsis.js"></script>
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
                <h1>RATINGS AND REVIEWS</h1>
                <div class="quick-link">
                    <p><a href="index.php"> HOME </a> > RATINGS AND REVIEWS</p>
                </div>
            </div>
            <div class="main-content">
                <div class="table-desc">
                    <h3>CURRENT USERS LIST</h3>
                </div>
                <hr>
                <div class="refunds-table">
                    <table id="ratingTable" class="display" style="width:100%">
                        <thead>
                            <tr class="table-header">
                                <th>#</th>
                                <th>Client Name</th>
                                <th>Rating</th>
                                <th class="review">Review</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 1; $i <= 30; $i++) { ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td>Surname, Firstname M.I</td>
                                    <td><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i></td>
                                    <td class="review">Lorem ipsum dolor sit amet, consectetur adipiscing el</td>
                                    <td>January 18, 2025</td>
                                    <td><button type="button"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
                                </tr>
                            <?php } ?>
                    </table>
                </div>
            </div>
        </main>
    </div>
    <script src="js/scripts.js"> </script>
    <script src="js/datatables.js"></script>
    <script>
        $(document).ready(function() {
            new DataTable("#ratingTable", {
                columnDefs: [{
                    // For rating list table
                    targets: 3,
                    render: DataTable.render.ellipsis(35, true),
                }],
                layout: {
                    topStart: {
                        buttons: [{
                            extend: "pdfHtml5",
                            exportOptions: {
                                columns: function(idx, data, node) {
                                    return idx < $("#myTable thead th").length - 1;
                                },
                            },
                        }, ],
                    },
                },
            });

            const PDF = document.querySelector(".buttons-pdf");
            const generatePDF = document.querySelector("#generate-pdf");

            generatePDF.addEventListener("click", () => {
                PDF.click();
            });
        });
    </script>
</body>

</html>