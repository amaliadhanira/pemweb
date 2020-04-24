$(document).ready(function(){

  /* JQUERY/AJAX DATATABLES ADMIN */
  var aksi;
  var table;
  var id_admin;

  //DATATABLES ADMIN
  table = $('#table_admin').DataTable({
      "processing": true,
      "serverSide": true,
      "order": [],
      "language": {
        "emptyTable": "Tabel kosong"
      },

      "ajax": {
          "url": "http://localhost/klinik4002/admin/adminpage/data_admin",
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

    //ON CLICK BUTTON BUAT ADMIN
   $('#buat_admin').on('click', function(){
    aksi = 'add';
    $('#form_antrean')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();

    $.ajax({
      url: "http://localhost/klinik4002/admin/adminpage/buat_admin",
      type: "GET",
      dataType: "JSON",
      success: function(data){
        $('[name="id_admin"]').val(data.id_admin);
        $('[name="nama_admin"]').val(data.nama_admin);
        $('[name="email"]').val(data.email);
        $('[name="alamat"]').val(data.alamat);
        $('[name="no_telp"]').val(data.no_telp);
        $('[name="username"]').val(data.username);
        $('[name="password"]').val($data.password);
      },
      error: function (jqXHR, textStatus, errorThrown){
        alert('Terjadi error dalam pengambilan data');
      }
    }); 
  });

    //ON CLICK BUTTON EDIT ADMIN
  $('tbody').on('click', 'edit_admin', function(){

    id_admin = $(this).data("id_admin");
    aksi = 'edit';
    $('#form_admin')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();

    $.ajax({
      url: "http://localhost/klinik4002/admin/adminpage/edit_admin/" + id_admin,
      type: "GET",
      dataType: "JSON",
      success: function(data){
        $('[name="id_admin"]').val(data.id_admin);
        $('[name="nama_admin"]').val(data.nama_admin);
        $('[name="email"]').val(data.email);
        $('[name="alamat"]').val(data.alamat);
        $('[name="no_telp"]').val(data.no_telp);
        $('[name="username"]').val(data.username);
        $('[name="password"]').val($data.password);
      },
      error: function (jqXHR, textStatus, errorThrown){
        alert('Terjadi error dalam pengambilan data');
      }
    });
  });

    // ON CLICK DELETE ADMIN
  $('tbody').on('click', '#hapus_admin', function(){
    id_admin = $(this).data("id_admin");

    if (confirm('Apakah Anda yakin ingin menghapus admin?')){
      $.ajax({
        url: "http://localhost/klinik4002/admin/adminpage/hapus_admin/" + id_admin,
        type: "POST",
        data: $('#form_admin').serialize(),
        dataType: "JSON",
        success: function(data){
          $('#modal_admin').modal('hide');
          reload_table();
        },
        error: function(jqXHR, textStatus, errorThrown){
          alert('Terjadi error dalam penghapusan admin');
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
      url = "http://localhost/klinik4002/admin/adminpage/new_admin";
    } else {
      url = "http://localhost/klinik4002/admin/adminpage/edit_admin";
    }

    $.ajax({
      url: url,
      type: "POST",
      data: $('#form_admin').serialize(),
      dataType: "JSON",
      success: function(data){
        console.log(data);

        if (data.success){
          $('#modal_admin').modal('hide');
          $id_admin = $("#admin option:eq(0)").val();
          $('[name="id_admin"]').val($id_admin);
          reload_table();
        }

        $('#btn_simpan').text('Simpan');
        $('#btn_simpan').prop('disabled', false);
      },
      error: function(jqXHR, textStatus, errorThrown){

        alert('Terjadi error dalam pembuatan atau pengeditan admin');

        $('#btn_simpan').text('Simpan');
        $('#btn_simpan').prop('disabled', false);
      }
    });
  });

})