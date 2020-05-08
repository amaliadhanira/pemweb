$(document).ready(function(){

  /* JQUERY/AJAX DATATABLES ADMIN */

  var table;
  var aksi;
  var id_apoteker;
  
  //DATATABLES ADMIN
  table = $('#table_farmasi').DataTable({
      "processing": true,
      "serverSide": true,
      "order": [],
      "language": {
        "emptyTable": "Tabel kosong"
      },

      "ajax": {
          "url": "http://localhost/klinik4002/adminpage/data_farmasi",
          "type": "POST",
          "dataType": "JSON"
      },

      "columnDefs": [{
          "targets": [0, -1, -2, -4],
          "orderable": false,
      },],
    });

  function reload_table(){
    table.ajax.reload(null, false);
  }

   //ON CLICK BUTTON TAMBAH LAB
   $('#tambah_farmasi').on('click', function(){
      aksi = 'add';
        $('#form_admin')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('[name="nama_apoteker"]').prop("disabled", false);
        $('[name="nama_apoteker"]').removeClass("disabled");
        $('[name="alamat"]').prop("disabled", false);
        $('[name="alamat"]').removeClass("disabled");
        $('[name="no_telp"]').prop("disabled", false);
        $('[name="no_telp"]').removeClass("disabled");
        $('#modal_farmasi').modal('show');
        $('#modal_farmasi_label').text('Tambah Apoteker');
    });

  //ON CLICK BUTTON UBAH ADMIN
  $('tbody').on('click', '#ubah_farmasi', function(){
    id_apoteker = $(this).data("id_apoteker");
    aksi = 'edit';
    $('#form_lab')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();

    $.ajax({
      url: "http://localhost/klinik4002/adminpage/edit_farmasi/" + id_apoteker,
      type: "GET",
      dataType: "JSON",
      success: function(data){
        $('[name="id_apoteker"]').val(data.id_apoteker);
        $('[name="nama_apoteker"]').val(data.nama_apoteker);
        $('[name="alamat"]').val(data.alamat);
        $('[name="no_telp"]').val(data.no_telp);
        $('[name="alamat"]').prop("disabled", true);
        $('[name="alamat"]').addClass("disabled");
        $('[name="no_telp"]').prop("disabled", true);
        $('[name="no_telp"]').addClass("disabled");
        $('#modal_farmasi').modal('show');
        $('#modal_farmasi_label').text('Edit Farmasi');
      },
      error: function (jqXHR, textStatus, errorThrown){
        alert('Terjadi error dalam pengambilan data');
      }
    });
  });

  //ON CLICK BUTTON SIMPAN (MODAL)
  $('#btn_simpan_farmasi').on('click', function(){

    $('#btn_simpan_farmasi').text('Menyimpan...');
    $('#btn_simpan_farmasi').prop('disabled', true);

    var url;

    if (aksi == 'add') {
      url = "http://localhost/klinik4002/adminpage/buat_farmasi";
    } else {
      url = "http://localhost/klinik4002/adminpage/ubah_farmasi";
    }

    $.ajax({
      url: url,
      type: "POST",
      data: $('#form_farmasi').serialize(),
      dataType: "JSON",
      success: function(data){
        console.log(data);

        if (data.success){
          $('#modal_farmasi').modal('hide');
          reload_table();
        }

        $('#btn_simpan_farmasi').text('Simpan');
        $('#btn_simpan_farmasi').prop('disabled', false);
      },
      error: function(jqXHR, textStatus, errorThrown){

        alert('Terjadi error dalam penambahan atau pengubahan apoteker');

        $('#btn_simpan_farmasi').text('Simpan');
        $('#btn_simpan_farmasi').prop('disabled', false);
      }
    });
  });

  //ON CLICK BUTTON HAPUS
  $('tbody').on('click', '#hapus_farmasi', function(){
    id_admin = $(this).data("id_admin");

    if (confirm('Apakah Anda yakin ingin menghapus apoteker?')){
      $.ajax({
        url: "http://localhost/klinik4002/adminpage/hapus_apoteker/" + id_examiner,
        type: "POST",
        dataType: "JSON",
        success: function(data){
          $('#modal_apoteker').modal('hide');
          reload_table();
        },
        error: function(jqXHR, textStatus, errorThrown){
          alert('Terjadi error dalam penghapusan apoteker');
        }
      });
    }
  });
})