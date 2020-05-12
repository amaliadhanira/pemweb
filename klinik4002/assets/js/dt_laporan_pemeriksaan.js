$(document).ready(function(){

  /* JQUERY/AJAX DATATABLES LAPORAN PEMERIKSAAN */

  var aksi;
  var table;
  var no_antrean;

  //DATATABLES LAPORAN PEMERIKSAAN
  table = $('#table_laporan_pemeriksaan').DataTable({
    "processing": true,
    "serverSide": true,
    "order": [],
    "language": {
      "emptyTable": "Anda belum memiliki antrean"
    },

    "ajax": {
      "url": "http://localhost/klinik4002/klinik/data_laporan_pemeriksaan",
      "type": "POST",
      "dataType": "JSON"
    },

    "columnDefs": [{
      "targets": [0, -1, -2],
      "orderable": false,
    },],
  });

  function reload_table(){
    table.ajax.reload(null, false);
  }

})