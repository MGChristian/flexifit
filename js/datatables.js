$(document).ready(function () {
  new DataTable("#myTable", {
    columnDefs: [
      {
        orderable: false,
        width: "120px",
        targets: [-1],
      },
      {
        orderable: false,
        width: "*",
        targets: [1],
      },
    ],
    layout: {
      topStart: {
        buttons: [
          {
            extend: "pdfHtml5",
            exportOptions: {
              columns: function (idx, data, node) {
                return idx < $("#myTable thead th").length - 1;
              },
            },
          },
        ],
      },
    },
  });

  const PDF = document.querySelector(".buttons-pdf");
  const generatePDF = document.querySelector("#generate-pdf");

  generatePDF.addEventListener("click", () => {
    PDF.click();
  });
});
