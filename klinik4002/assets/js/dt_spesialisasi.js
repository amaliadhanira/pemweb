$(document).ready(function(){

  /* JQUERY/AJAX DATATABLES SPESIALISASI */

  var table;
  var aksi;
  var id_spesialisasi;
  
  //DATATABLES SPESIALISASI
  table = $('#table_spesialisasi').DataTable({
      "processing": true,
      "serverSide": true,
      "order": [],
      "language": {
        "emptyTable": "Tabel kosong"
      },

      "ajax": {
          "url": "http://localhost/klinik4002/adminpage/data_spesialisasi",
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

 //ON CLICK BUTTON TAMBAH SPESIALISASI
  $('#tambah_spesialisasi').on('click', function(){
    aksi = 'add';
    $('#form_spesialisasi')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();
    $('#modal_spesialisasi').modal('show');
    $('#modal_spesialisasi_spesialisasiel').text('Tambah Apoteker');
  });

  //ON CLICK BUTTON UBAH SPESIALISASI
  $('tbody').on('click', '#ubah_spesialisasi', function(){
    id_spesialisasi = $(this).data("id_spesialisasi");
    aksi = 'edit';
    $('#form_spesialisasi')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();

    $.ajax({
      url: "http://localhost/klinik4002/adminpage/edit_spesialisasi/" + id_spesialisasi,
      type: "GET",
      dataType: "JSON",
      success: function(data){
        $('[name="id_spesialisasi"]').val(data.id_spesialisasi);
        $('[name="nama_spesialisasi"]').val(data.nama_spesialisasi);
        $('#modal_spesialisasi').modal('show');
        $('#modal_spesialisasi_spesialisasiel').text('Edit spesialisasioratorium');
      },
      error: function (jqXHR, textStatus, errorThrown){
        alert('Terjadi error dalam pengambilan data');
      }
    });
  });

  //ON CLICK BUTTON SIMPAN (MODAL)
  $('#btn_simpan_spesialisasi').on('click', function(){

    $('#btn_simpan_spesialisasi').text('Menyimpan...');
    $('#btn_simpan_spesialisasi').prop('disabled', true);

    var url;

    if (aksi == 'add') {
      url = "http://localhost/klinik4002/adminpage/tambah_spesialisasi";
    } else {
      url = "http://localhost/klinik4002/adminpage/ubah_spesialisasi";
    }

    $.ajax({
      url: url,
      type: "POST",
      data: $('#form_spesialisasi').serialize(),
      dataType: "JSON",
      success: function(data){
        console.log(data);

        if (data.success){
          $('#modal_spesialisasi').modal('hide');
          reload_table();
        }

        $('#btn_simpan_spesialisasi').text('Simpan');
        $('#btn_simpan_spesialisasi').prop('disabled', false);
      },
      error: function(jqXHR, textStatus, errorThrown){

        alert('Terjadi error dalam penambahan atau pengubahan spesialisasi');

        $('#btn_simpan_spesialisasi').text('Simpan');
        $('#btn_simpan_spesialisasi').prop('disabled', false);
      }
    });
  });

  //ON CLICK BUTTON HAPUS
  $('tbody').on('click', '#hapus_spesialisasi', function(){
    id_spesialisasi = $(this).data("id_spesialisasi");

    if (confirm('Apakah Anda yakin ingin menghapus analis?')){
      $.ajax({
        url: "http://localhost/klinik4002/adminpage/hapus_spesialisasi/" + id_spesialisasi,
        type: "POST",
        dataType: "JSON",
        success: function(data){
          $('#modal_spesialisasi').modal('hide');
          reload_table();
        },
        error: function(jqXHR, textStatus, errorThrown){
          alert('Terjadi error dalam penghapusan analis');
        }
      });
    }
  });
})
   