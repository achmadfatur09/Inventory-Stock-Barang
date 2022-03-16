// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable({
    "language" : {
      "url" : "http://cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json",
      "sEmptyTable": "Tidak ada data di database"
    },
    "dom" : '<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"f>><"row"rt><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"p>><"clear">'
  });
});
