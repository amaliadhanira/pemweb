$(document).ready(function(){

  /* JQUERY/AJAX DATATABLES ADMIN */

  var table;
  var aksi;
  var id_lab;
  
  //DATATABLES ADMIN
  table = $('#table_lab').DataTable({
      "processing": true,
      "serverSide": true,
      "order": [],
      "language": {
        "emptyTable": "Tabel kosong"
      },

      "ajax": {
          "url": "http://localhost/klinik4002/adminpage/data_lab",
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

 //ON CLICK BUTTON TAMBAH LAB
  $('#tambah_lab').on('click', function(){
    aksi = 'add';
    $('#form_lab')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();
    $('#modal_lab').modal('show');
    $('#modal_lab_label').text('Tambah Apoteker');
  });

  //ON CLICK BUTTON UBAH ADMIN
  $('tbody').on('click', '#ubah_lab', function(){
    id_examiner = $(this).data("id_examiner");
    aksi = 'edit';
    $('#form_lab')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();

    $.ajax({
      url: "http://localhost/klinik4002/adminpage/edit_lab/" + id_examiner,
      type: "GET",
      dataType: "JSON",
      success: function(data){
        $('[name="id_examiner"]').val(data.id_examiner);
        $('[name="nama_examiner"]').val(data.nama_examiner);
        $('[name="alamat"]').val(data.alamat);
        $('[name="no_telp"]').val(data.no_telp);
        $('#modal_lab').modal('show');
        $('#modal_lab_label').text('Edit Laboratorium');
      },
      error: function (jqXHR, textStatus, errorThrown){
        alert('Terjadi error dalam pengambilan data');
      }
    });
  });

  //ON CLICK BUTTON SIMPAN (MODAL)
  $('#btn_simpan_lab').on('click', function(){

    $('#btn_simpan_lab').text('Menyimpan...');
    $('#btn_simpan_lab').prop('disabled', true);

    var url;

    if (aksi == 'add') {
      url = "http://localhost/klinik4002/adminpage/buat_lab";
    } else {
      url = "http://localhost/klinik4002/adminpage/ubah_lab";
    }

    $.ajax({
      url: url,
      type: "POST",
      data: $('#form_lab').serialize(),
      dataType: "JSON",
      success: function(data){
        console.log(data);

        if (data.success){
          $('#modal_lab').modal('hide');
          reload_table();
        }

        $('#btn_simpan_lab').text('Simpan');
        $('#btn_simpan_lab').prop('disabled', false);
      },
      error: function(jqXHR, textStatus, errorThrown){

        alert('Terjadi error dalam penambahan atau pengubahan lab');

        $('#btn_simpan_lab').text('Simpan');
        $('#btn_simpan_lab').prop('disabled', false);
      }
    });
  });

  //ON CLICK BUTTON HAPUS
  $('tbody').on('click', '#hapus_lab', function(){
    id_examiner = $(this).data("id_examiner");

    if (confirm('Apakah Anda yakin ingin menghapus analis?')){
      $.ajax({
        url: "http://localhost/klinik4002/adminpage/hapus_lab/" + id_examiner,
        type: "POST",
        dataType: "JSON",
        success: function(data){
          $('#modal_lab').modal('hide');
          reload_table();
        },
        error: function(jqXHR, textStatus, errorThrown){
          alert('Terjadi error dalam penghapusan analis');
        }
      });
    }
  });
})
   