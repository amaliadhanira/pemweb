$(document).ready(function(){

  /* JQUERY/AJAX DATATABLES LAPORAN PEMERIKSAAN */

  var aksi;
  var table;
  var no_antrean;

  //DATATABLES LAPORAN PEMERIKSAAN
  table = $('#table_laporan_pemeriksaan').DataTable({
    "processing": true,
    "serverSide": true,
    "order": [],
    "language": {
      "emptyTable": "Anda belum memiliki antrean"
    },

    "ajax": {
      "url": "http://localhost/klinik4002/klinik/data_laporan_pemeriksaan",
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

  //ON CLICK BUTTON RINCIAN LAPORAN
  $('tbody').on('click', '#rincian_laporan', function(){

    id_laporan = $(this).data("id_laporan");
    aksi = 'rincian';

    $.ajax({
      url: "http://localhost/klinik4002/klinik/this_resep_obat/" + id_laporan,
      type: "GET",
      dataType: "JSON",
      success: function(data){
        $('#obat').empty();
        $('#nama_dokter').text(data[0].nama_dokter);
        $('#spesialis').text(data[0].nama_spesialisasi);
        $('#tgl_periksa').text(data[0].tgl_periksa);
        $('#diagnosa').text(data[0].diagnosa);
        $('#obat').text(data[0].resep_obat);
        $('#modal_rincian_laporan').modal('show');
      },
      error: function (jqXHR, textStatus, errorThrown){
        alert('Terjadi error dalam pengambilan data');
      }
    });
  });

  /*
  //SET ID DOKTER WHEN DOKTER OPTION SELECTED
  $('#dokter').on('change', function(){
    $id_dokter = $("#dokter option:selected").val();
    $('[name="id_dokter"]').val($id_dokter);
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
          $id_dokter = $("#dokter option:eq(0)").val();
          $('[name="id_dokter"]').val($id_dokter);
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
  });
  */

  /* END OF JQUERY/AJAX DATATABLES LAPORAN PEMERIKSAAN */

})