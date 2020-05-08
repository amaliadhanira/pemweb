$(document).ready(function(){

  /* JQUERY/AJAX DATATABLES ANTREAN */
  var aksi;
  var table;
  var id_antrean;

  //DATATABLES ANTREAN
  table = $('#table_antrean').DataTable({
      "processing": true,
      "serverSide": true,
      "order": [],
      "language": {
        "emptyTable": "Tabel kosong"
      },

      "ajax": {
          "url": "http://localhost/klinik4002/adminpage/data_antrean",
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

     //DATEPICKER ANTREAN SAYA
  $('.datepicker').datepicker({
    autoclose: true,
    format: "yyyy-mm-dd",
    orientation: "top auto",
    startDate: "+1d",
    endDate: "+1w",
    defaultDate: "+1d",
  });

  function reload_table(){
    table.ajax.reload(null, false);
  }

  //ON CLICK BUTTON UBAH TANGGAL
  $('tbody').on('click', '#ubah_antrean', function(){

    no_antrean = $(this).data("no_antrean");
    aksi = 'edit';
    $('#form_antrean')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();

    $.ajax({
      url: "http://localhost/klinik4002/adminpage/edit_antrean/" + no_antrean,
      type: "GET",
      dataType: "JSON",
      success: function(data){
        $('[name="no_antrean"]').val(data.no_antrean);
        $('[name="nama_pasien"]').val(data.nama_pasien);
        $('[name="id_pasien"]').val(data.id_pasien);
        $('[name="nama_dokter"]').val(data.nama_dokter);
        $('[name="id_dokter"]').val(data.id_dokter);
        $('[name="nama_spesialisasi"]').val(data.nama_spesialisasi);
        $('[name="tgl_periksa"]').val(data.tgl_periksa);
        $('[name="waktu_daftar"]').val(data.waktu_daftar);
        $('#modal_antrean').modal('show');
        $('#modal_antrean_label').text('Ubah Tanggal Antrean');
      },
      error: function (jqXHR, textStatus, errorThrown){
        alert('Terjadi error dalam pengambilan data');
      }
    });
  });

   //ON CLICK BUTTON SIMPAN (MODAL)
  $('#btn_simpan_antrean').on('click', function(){

    $('#btn_simpan_antrean').text('Menyimpan...');
    $('#btn_simpan_antrean').prop('disabled', true);

    var url;

    if (aksi == 'edit') {
      url = "http://localhost/klinik4002/adminpage/ubah_antrean";
    } 

    $.ajax({
      url: url,
      type: "POST",
      data: $('#form_antrean').serialize(),
      dataType: "JSON",
      success: function(data){
        console.log(data);

        if (data.success){
          $('#modal_antrean').modal('hide');
          reload_table();
        }

        $('#btn_simpan_antrean').text('Simpan');
        $('#btn_simpan_antrean').prop('disabled', false);
      },
      error: function(jqXHR, textStatus, errorThrown){

        alert('Terjadi error dalam pendaftaran atau pengubahan tanggal antrean');

        $('#btn_simpan_antrean').text('Simpan');
        $('#btn_simpan_antrean').prop('disabled', false);
      }
    });
  });

  //ON CLICK BUTTON HAPUS
  $('tbody').on('click', '#hapus_antrean', function(){
    no_antrean = $(this).data("no_antrean");

    if (confirm('Apakah Anda yakin ingin menghapus antrean?')){
      $.ajax({
        url: "http://localhost/klinik4002/adminpage/hapus_antrean/" + no_antrean,
        type: "POST",
        dataType: "JSON",
        success: function(data){
          $('#modal_antrean').modal('hide');
          reload_table();
        },
        error: function(jqXHR, textStatus, errorThrown){
          alert('Terjadi error dalam pembatalan antrean');
        }
      });
    }
  });

  /* END OF JQUERY/AJAX DATATABLES ANTREAN */

})