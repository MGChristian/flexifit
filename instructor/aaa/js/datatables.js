$(document).ready(function() {
    new DataTable('#myTable', {
        columnDefs: [{
            orderable: false,
            targets: [-1],
        }],
    })
});