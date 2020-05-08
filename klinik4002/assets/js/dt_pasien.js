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
          "targets": [0, -2],
          "orderable": false,
      },],
    });

  function reload_table(){
      table.ajax.reload(null, false);
  }

  //ON CLICK BUTTON HAPUS
  $('tbody').on('click', '#hapus_pasien', function(){
    id_pasien = $(this).data("id_pasien");

    if (confirm('Apakah Anda yakin ingin menghapus pasien?')){
      $.ajax({
        url: "http://localhost/klinik4002/adminpage/hapus_pasien/" + id_pasien,
        type: "POST",
        dataType: "JSON",
        success: function(data){
          $('#modal_pasien').modal('hide');
          reload_table();
        },
        error: function(jqXHR, textStatus, errorThrown){
          alert('Terjadi error dalam penghapusan pasien');
        }
      });
    }
  });
})