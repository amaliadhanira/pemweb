$(document).ready(function(){

  /* JQUERY/AJAX DATATABLES ADMIN */

  var table;
  var aksi;
  var id_admin;
  var label_sandi;
  
  //DATATABLES ADMIN
  table = $('#table_admin').DataTable({
      "processing": true,
      "serverSide": true,
      "order": [],
      "language": {
        "emptyTable": "Tabel kosong"
      },

      "ajax": {
          "url": "http://localhost/klinik4002/adminpage/data_admin",
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

  //ON CLICK BUTTON TAMBAH ADMIN
  $('#tambah_admin').on('click', function(){
    aksi = 'add';
    label_sandi = 'Sandi:';
    $('#label_sandi').text(label_sandi);
    $('#info-sandi').remove();

    $('#form_admin')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();

    $('[name="nama_admin"]').prop("disabled", false);
    $('[name="nama_admin"]').removeClass("disabled");
    $('[name="email"]').prop("disabled", false);
    $('[name="email"]').removeClass("disabled");
    $('[name="username"]').prop("disabled", false);
    $('[name="username"]').removeClass("disabled");
    $('#modal_admin').modal('show');
    $('#modal_admin_label').text('Tambah Admin');
  });

  //ON CLICK BUTTON UBAH ADMIN
  $('tbody').on('click', '#ubah_admin', function(){
    id_admin = $(this).data("id_admin");
    aksi = 'edit';
    var info = '<small class="text-muted" id="info-sandi">*Masukkan sandi akun admin yang bersangkutan untuk mengubah data admin. Data tidak dapat diubah oleh orang lain tanpa mengetahui sandi akun.</small>';
    label_sandi = '*Sandi:';
    $('#form_admin')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();
    $('.form-body').append(info);
    $('#label_sandi').text(label_sandi);

    $.ajax({
      url: "http://localhost/klinik4002/adminpage/edit_admin/" + id_admin,
      type: "GET",
      dataType: "JSON",
      success: function(data){
        $('[name="id_admin"]').val(data.id_admin);
        $('[name="nama_admin"]').val(data.nama_admin);
        $('[name="email"]').val(data.email);
        $('[name="alamat"]').val(data.alamat);
        $('[name="username"]').val(data.username);
        $('[name="no_telp"]').val(data.no_telp);
        $('[name="nama_admin"]').prop("disabled", true);
        $('[name="nama_admin"]').addClass("disabled");
        $('[name="email"]').prop("disabled", true);
        $('[name="email"]').addClass("disabled");
        $('[name="username"]').prop("disabled", true);
        $('[name="username"]').addClass("disabled");
        $('#modal_admin').modal('show');
        $('#modal_admin_label').text('Edit Admin');
      },
      error: function (jqXHR, textStatus, errorThrown){
        alert('Terjadi error dalam pengambilan data');
      }
    });
  });

  //ON CLICK BUTTON SIMPAN (MODAL)
  $('#btn_simpan_admin').on('click', function(){

    $('#btn_simpan_admin').text('Menyimpan...');
    $('#btn_simpan_admin').prop('disabled', true);

    var url;

    if (aksi == 'add') {
      url = "http://localhost/klinik4002/adminpage/tambah_admin";
    } else {
      url = "http://localhost/klinik4002/adminpage/ubah_admin";
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
          reload_table();
        }

        $('#btn_simpan_admin').text('Simpan');
        $('#btn_simpan_admin').prop('disabled', false);
      },
      error: function(jqXHR, textStatus, errorThrown){

        alert('Terjadi error dalam penambahan atau pengubahan admin');

        $('#btn_simpan_admin').text('Simpan');
        $('#btn_simpan_admin').prop('disabled', false);
      }
    });
  });

  //ON CLICK BUTTON HAPUS
  $('tbody').on('click', '#hapus_admin', function(){
    id_admin = $(this).data("id_admin");

    if (confirm('Apakah Anda yakin ingin menghapus admin?')){
      $.ajax({
        url: "http://localhost/klinik4002/adminpage/hapus_admin/" + id_admin,
        type: "POST",
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


})
   