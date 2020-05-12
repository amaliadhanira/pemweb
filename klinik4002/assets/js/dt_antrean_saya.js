$(document).ready(function(){

  /* JQUERY/AJAX DATATABLES ANTREAN SAYA */

  var aksi;
  var table;
  var no_antrean;

  //DATATABLES ANTREAN SAYA
  table = $('#table_antrean_saya').DataTable({
    "processing": true,
    "serverSide": true,
    "order": [],
    "language": {
      "emptyTable": "Anda belum memiliki antrean"
    },

    "ajax": {
      "url": "http://localhost/klinik4002/klinik/data_antrean_saya",
      "type": "POST",
      "dataType": "JSON"
    },

    "columnDefs": [{
      "targets": [0, -1],
      "orderable": false,
    },],
  });

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

  //ON CLICK BUTTON DAFTAR ANTREAN
  $('#daftar_antrean').on('click', function(){
    aksi = 'add';
    $('#form_antrean')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();

    $.ajax({
      url: "http://localhost/klinik4002/klinik/this_pasien",
      type: "GET",
      dataType: "JSON",
      success: function(data){
        $('[name="nama_pasien"]').val(data.nama_pasien);
        $('[name="id_pasien"]').val(data.id_pasien);
        $('[name="dokter"]').prop("disabled", false);
        $('[name="dokter"]').removeClass("disabled");
        $('#modal_antrean').modal('show');
        $('#modal_antrean_label').text('Daftar Antrean');
      },
      error: function (jqXHR, textStatus, errorThrown){
        alert('Terjadi error dalam pengambilan data');
      }
    }); 
  });

  //ON CLICK BUTTON UBAH TANGGAL
  $('tbody').on('click', '#ubah_antrean', function(){

    no_antrean = $(this).data("no_antrean");
    aksi = 'edit';
    $('#form_antrean')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();

    $.ajax({
      url: "http://localhost/klinik4002/klinik/edit_antrean_saya/" + no_antrean,
      type: "GET",
      dataType: "JSON",
      success: function(data){
        $('[name="no_antrean"]').val(data.no_antrean);
        $('[name="nama_pasien"]').val(data.nama_pasien);
        $('[name="id_pasien"]').val(data.id_pasien);
        $('[name="dokter"]').val(data.id_dokter);
        $('[name="id_dokter"]').val(data.id_dokter);
        $('[name="tgl_periksa"]').val(data.tgl_periksa);
        $('[name="dokter"]').prop("disabled", true);
        $('[name="dokter"]').addClass("disabled");
        $('#modal_antrean').modal('show');
        $('#modal_antrean_label').text('Ubah Tanggal Antrean');
      },
      error: function (jqXHR, textStatus, errorThrown){
        alert('Terjadi error dalam pengambilan data');
      }
    });
  });

  //SET ID DOKTER WHEN DOKTER OPTION SELECTED
  $('#dokter').on('change', function(){
    id_dokter = $("#dokter option:selected").val();
    $('[name="id_dokter"]').val(id_dokter);
  }).trigger("change");

  //ON CLICK BUTTON SIMPAN (MODAL)
  $('#btn_simpan').on('click', function(){

    $('#btn_simpan').text('Menyimpan...');
    $('#btn_simpan').prop('disabled', true);

    var url;

    if (aksi == 'add') {
      url = "http://localhost/klinik4002/klinik/daftar_antrean";
    } else {
      url = "http://localhost/klinik4002/klinik/ubah_antrean";
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
          id_dokter = $("#dokter option:eq(0)").val();
          $('[name="id_dokter"]').val(id_dokter);
          reload_table();
        }

        $('#btn_simpan').text('Simpan');
        $('#btn_simpan').prop('disabled', false);
      },
      error: function(jqXHR, textStatus, errorThrown){

        alert('Terjadi error dalam pendaftaran atau pengubahan tanggal antrean');

        $('#btn_simpan').text('Simpan');
        $('#btn_simpan').prop('disabled', false);
      }
    });
  });

  //ON CLICK BUTTON BATALKAN
  $('tbody').on('click', '#batalkan_antrean', function(){
    no_antrean = $(this).data("no_antrean");

    if (confirm('Apakah Anda yakin ingin membatalkan antrean?')){
      $.ajax({
        url: "http://localhost/klinik4002/klinik/batalkan_antrean/" + no_antrean,
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

  /* END OF JQUERY/AJAX DATATABLES ANTREAN SAYA */

})