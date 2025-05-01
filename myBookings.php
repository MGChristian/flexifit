<?php

require_once "./includes/config_session.inc.php";

$isLoggedIn = isset($_SESSION['id']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FlexiFit</title>
  <?php require_once "./components/global_css.php" ?>
  <!-- <link rel="stylesheet" href="css/reset.css" />
    <link rel="stylesheet" href="css/userdesign.css" />
    <link rel="stylesheet" href="css/footer.css" />
    <link rel="stylesheet" href="css/userpage.css" /> -->
  <link rel="stylesheet" href="css/tabledesign.css" />
  <link rel="stylesheet" href="css/modals.css" />

  <link
    href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.2.1/af-2.7.0/b-3.2.0/b-colvis-3.2.0/b-html5-3.2.0/b-print-3.2.0/cr-2.0.4/date-1.5.5/fc-5.0.4/fh-4.0.1/kt-2.12.1/r-3.0.3/rg-1.5.1/rr-1.5.0/sc-2.4.3/sb-1.8.1/sp-2.3.3/sl-3.0.0/sr-1.4.1/datatables.min.css"
    rel="stylesheet" />

  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.2.1/af-2.7.0/b-3.2.0/b-colvis-3.2.0/b-html5-3.2.0/b-print-3.2.0/cr-2.0.4/date-1.5.5/fc-5.0.4/fh-4.0.1/kt-2.12.1/r-3.0.3/rg-1.5.1/rr-1.5.0/sc-2.4.3/sb-1.8.1/sp-2.3.3/sl-3.0.0/sr-1.4.1/datatables.min.js"></script>
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    rel="stylesheet" />
  <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</head>

<body>
  <!-- MODALS -->
  <div class="modal-container hidden" id="request-refund">
    <div class="modal">
      <h1>Refund Request</h1>
      <p>
        You are about to cancel your booking of the class “Yoga Class”. Please
        note, your refund request will be processed first which means
        canceling this booking will not automatically issue you a refund.
      </p>
      <p>
        You can also provide a reason for your refund request, which can help
        us a lot when it comes to addressing the concerns that you and others
        might have. Thank you!
      </p>
      <label for="refund-reason">Refund Reason: </label>
      <select>
        <option>Emergency</option>
        <option>Changed my mind</option>
        <option>No Longer Interested</option>
        <option>Others</option>
      </select>
      <textarea>Hello</textarea>
      <div class="modal-actions">
        <button
          type="button"
          class="filterOpen"
          style="background-color: var(--green)"
          data-target="request-refund">
          SUBMIT
        </button>
        <button
          type="button"
          class="filterOpen"
          style="background-color: var(--dark-red)"
          data-target="request-refund">
          GO BACK
        </button>
      </div>
    </div>
  </div>
  <!-- END OF MODALS -->
  <!-- Navigation Header -->
  <?php require_once "./components/navbar.php" ?>


  <!-- MAIN CONTAINER -->
  <header class="header">
    <div class="header-content">
      <h1>MY BOOKINGS</h1>
    </div>
  </header>
  <main class="main-container">
    <table id="myTable" class="display" style="width: 100%">
      <thead>
        <tr class="table-header">
          <th class="no-sort">#</th>
          <th>Class Name</th>
          <th>Instructor</th>
          <th>Date</th>
          <th>Session</th>
          <th>Time</th>
          <th style="text-align: center">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>Yoga Class</td>
          <td>Instructor Name</td>
          <td>MM/DD/YYYY</td>
          <td>Morning</td>
          <td>7:30</td>
          <td>
            <button
              class="refund-button filterOpen"
              data-target="request-refund"
              type="button">
              REFUND
            </button>
          </td>
        </tr>
        <tr>
          <td>1</td>
          <td>Yoga Class</td>
          <td>Instructor Name</td>
          <td>MM/DD/YYYY</td>
          <td>Morning</td>
          <td>7:30</td>
          <td>
            <button
              class="refund-button filterOpen"
              data-target="request-refund"
              type="button">
              REFUND
            </button>
          </td>
        </tr>

        <tr>
          <td>1</td>
          <td>Yoga Class</td>
          <td>Instructor Name</td>
          <td>MM/DD/YYYY</td>
          <td>Morning</td>
          <td>7:30</td>
          <td>
            <button class="refund-button" id="pending" type="button">
              PENDING
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </main>
  <!-- END OF MAIN -->
  <?php require_once "./components/footer.php" ?>
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const filters = document.querySelectorAll(".filterOpen");

      filters.forEach((filter) => {
        filter.addEventListener("click", () => {
          const dataTarget = filter.getAttribute("data-target");
          const modalTarget = document.querySelector(`#${dataTarget}`);
          modalTarget.classList.toggle("hidden");
        });
      });

      new DataTable("#myTable", {
        columnDefs: [{
          orderable: false,
          width: "120px",
          targets: [-1],
        }, ],
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