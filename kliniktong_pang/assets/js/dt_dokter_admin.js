$(document).ready(function(){

  /* JQUERY/AJAX DATATABLES dokter */
  var aksi;
  var table;
  var id_dokter;

  //DATATABLES dokter
  table = $('#table_dokter').DataTable({
      "processing": true,
      "serverSide": true,
      "order": [],
      "language": {
        "emptyTable": "Tabel kosong"
      },

      "ajax": {
          "url": "http://localhost/klinik4002/admin/adminpage/data_dokter",
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

    //ON CLICK BUTTON BUAT dokter
   $('#daftar_dokter').on('click', function(){
    aksi = 'add';
    $('#form_dokter')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();

    $.ajax({
      url: "http://localhost/klinik4002/admin/adminpage/buat_dokter",
      type: "GET",
      dataType: "JSON",
      success: function(data){
        $('[name="id_dokter"]').val(data.id_dokter);
        $('[name="nama_dokter"]').val(data.nama_dokter);
        $('[name="email"]').val(data.email);
        $('[name="alamat"]').val(data.alamat);
        $('[name="no_telp"]').val(data.no_telp);
      },
      error: function (jqXHR, textStatus, errorThrown){
        alert('Terjadi error dalam pengambilan data');
      }
    }); 
  });

    //ON CLICK BUTTON EDIT dokter
  $('tbody').on('click', 'edit_dokter', function(){

    id_dokter = $(this).data("id_dokter");
    aksi = 'edit';
    $('#form_dokter')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();

    $.ajax({
      url: "http://localhost/klinik4002/admin/adminpage/edit_dokter/" + id_dokter,
      type: "GET",
      dataType: "JSON",
      success: function(data){
        $('[name="id_dokter"]').val(data.id_dokter);
        $('[name="nama_dokter"]').val(data.nama_dokter);
        $('[name="email"]').val(data.email);
        $('[name="alamat"]').val(data.alamat);
        $('[name="no_telp"]').val(data.no_telp);
      },
      error: function (jqXHR, textStatus, errorThrown){
        alert('Terjadi error dalam pengambilan data');
      }
    });
  });

    // ON CLICK DELETE dokter
  $('tbody').on('click', '#hapus_dokter', function(){
    id_dokter = $(this).data("id_dokter");

    if (confirm('Apakah Anda yakin ingin menghapus dokter?')){
      $.ajax({
        url: "http://localhost/klinik4002/admin/adminpage/hapus_dokter/" + no_antrean,
        type: "POST",
        data: $('#form_dokter').serialize(),
        dataType: "JSON",
        success: function(data){
          $('#modal_dokter').modal('hide');
          reload_table();
        },
        error: function(jqXHR, textStatus, errorThrown){
          alert('Terjadi error dalam penghapusan dokter');
        }
      });
    }
  });

 //ON CLICK BUTTON SIMPAN (MODAL)
  $('#btn_simpan').on('click', function(){

    $('#btn_simpan').text('Menyimpan...');
    $('#btn_simpan').prop('disabled', true);

    var url;

    if (aksi == 'add') {
      url = "http://localhost/klinik4002/admin/adminpage/buat_dokter";
    } else {
      url = "http://localhost/klinik4002/admin/adminpage/edit_dokter";
    }

    $.ajax({
      url: url,
      type: "POST",
      data: $('#form_dokter').serialize(),
      dataType: "JSON",
      success: function(data){
        console.log(data);

        if (data.success){
          $('#modal_dokter').modal('hide');
          $id_dokter = $("#dokter option:eq(0)").val();
          $('[name="id_dokter"]').val($id_dokter);
          reload_table();
        }

        $('#btn_simpan').text('Simpan');
        $('#btn_simpan').prop('disabled', false);
      },
      error: function(jqXHR, textStatus, errorThrown){

        alert('Terjadi error dalam pembuatan atau pengeditan dokter');

        $('#btn_simpan').text('Simpan');
        $('#btn_simpan').prop('disabled', false);
      }
    });
  });

})