var aksi;
var table;
var no_antrean;

$(document).ready(function(){

  //datatables
  table = $('#table_antrean_saya').dataTable({
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

  //datepicker
  $('.datepicker').datepicker({
    autoclose: true,
    format: "yyyy-mm-dd",
    orientation: "top auto",
    startDate: "+1d",
    endDate: "+1w"
  });

  function reload_table(){
    table.ajax.reload(null, false);
  }

  $('#daftar_antrean').click(function(){
    aksi = 'add';
    $('#form_antrean')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();
    $('#modal_antrean').modal('show');
    $('#modal_antrean_label').text('Daftar Antrean');
  });

  $('#ubah_antrean').click(function(){
    no_antrean = $(this).data("no_antrean");
    aksi = 'edit';
    $('#form_antrean')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();

    $.ajax({
      url: "http://localhost/klinik4002/klinik/change_antrean_saya/" + no_antrean,
      type: "GET",
      dataType: "JSON",
      success: function(data){
        $('[name="no_antrean"]').val(data.no_antrean);
        $('[name="nama_pasien"').val(data.nama_pasien);
        $('[name="dokter"').val(data.id_dokter);
        $('[name="tgl_periksa"').val(data.tgl_periksa);
        $('#modal_antrean').modal('show');
        $('#modal_antrean_label').text('Ubah Antrean');
      },
      error: function (jqXHR, textStatus, errorThrown){
        alert('Terjadi error dalam pengambilan data');
      }
    });
  });

  function simpan_antrean(){
    $('#btn_simpan').text('Menyimpan...');
    $('#btn_simpan').attr('disabled', true);

    var url;

    if (aksi = 'add') {
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
        if (data.status){
          $('#modal_antrean').modal('hide');
          reload_table();
        }

        $('#btn_simpan').text('Simpan');
        $('#btn_simpan').attr('disabled', false);
      },
      error: function(jqXHR, textStatus, errorThrown){
        alert('Terjadi error dalam pendaftaran atau pengubahan tanggal antrean');

        $('#btn_simpan').text('Simpan');
        $('#btn_simpan').attr('disabled', false);
      }
    });
  }

  function batalkan_antrean(no_antrean){
    if (confirm('Apakah Anda yakin ingin membatalkan antrean?')){
      $.ajax({
        url: url,
        type: "POST",
        data: $('#form_antrean').serialize(),
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
  }

})