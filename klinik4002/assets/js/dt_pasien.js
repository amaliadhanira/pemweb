$(document).ready(function(){

  /* JQUERY/AJAX DATATABLES pasien */
  var aksi;
  var table;
  var id_pasien;

  //DATATABLES pasien
  table = $('#table_pasien').DataTable({
      "processing": true,
      "serverSide": true,
      "order": [],
      "language": {
        "emptyTable": "Tabel kosong"
      },

      "ajax": {
          "url": "http://localhost/klinik4002/adminpage/data_pasien",
          "type": "POST",
          "dataType": "JSON"
      },

      "columnDefs": [{
          "targets": [0, -1],
          "orderable": false,
      },],
    });

    function reload_table(){
      table.ajax.reload(null, false);
    }
})