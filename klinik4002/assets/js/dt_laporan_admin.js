$(document).ready(function(){

  /* JQUERY/AJAX DATATABLES ADMIN */

  var table;
  var aksi;
  var id_laporan;
  
  //DATATABLES ADMIN
  table = $('#table_laporan').DataTable({
      "processing": true,
      "serverSide": true,
      "order": [],
      "language": {
        "emptyTable": "Tabel kosong"
      },

      "ajax": {
          "url": "http://localhost/klinik4002/adminpage/data_laporan",
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

//DATEPICKER ANTREAN SAYA
  $('.datepicker').datepicker({
    autoclose: true,
    format: "yyyy-mm-dd",
    orientation: "top auto",
    startDate: "+1d",
    endDate: "+1w",
    defaultDate: "+1d",
  });

  //ON CLICK BUTTON RINCIAN LAPORAN
  $('tbody').on('click', '#rincian_laporan', function(){

    id_laporan = $(this).data("id_laporan");
    aksi = 'rincian';

    $.ajax({
      url: "http://localhost/klinik4002/adminpage/this_resep_obat/" + id_laporan,
      type: "GET",
      dataType: "JSON",
      success: function(data){
        $('#obat').empty();
        $('#nama_dokter').text(data[0].nama_dokter);
        $('#spesialis').text(data[0].nama_spesialisasi);
        $('#tgl_periksa').text(data[0].tgl_periksa);
        $('#diagnosa').text(data[0].diagnosa);
        $.each(data, function(i, item){
          $('#obat').append('<li>' + data[i].nama_obat + '</li>');
        });
        $('#modal_rincian_laporan').modal('show');
      },
      error: function (jqXHR, textStatus, errorThrown){
        alert('Terjadi error dalam pengambilan data');
      }
    });
  });

//ON CLICK BUTTON BUAT LAPORAN
 $('#buat_laporan').on('click', function(){
      aksi = 'add';
        $('#form_laporan')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('[name="no_antrean"]').prop("disabled", false);
        $('[name="no_antrean"]').removeClass("disabled");
        $('[name="nama_pasien"]').prop("disabled", false);
        $('[name="nama_pasien"]').removeClass("disabled");
        $('[name="nama_dokter"]').prop("disabled", false);
        $('[name="nama_dokter"]').removeClass("disabled");
        $('[name="nama_spesialisasi"]').prop("disabled", false);
        $('[name="nama_spesialisasi"]').removeClass("disabled");
        $('[name="tgl_periksa"]').prop("disabled", false);
        $('[name="tgl_periksa"]').removeClass("disabled");
        $('[name="diagnosa"]').prop("disabled", false);
        $('[name="diagnosa"]').removeClass("disabled");
        $('[name="resep_obat"]').prop("disabled", false);
        $('[name="resep_obat"]').removeClass("disabled");
        $('#modal_admin').modal('show');
        $('#modal_admin_label').text('Tambah Admin');
    });

 //ON CLICK BUTTON UBAH ADMIN
  $('tbody').on('click', '#ubah_laporan', function(){
    id_laporan = $(this).data("id_laporan");
    aksi = 'edit';
    $('#form_laporan')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();

    $.ajax({
      url: "http://localhost/klinik4002/adminpage/edit_laporan/" + id_laporan,
      type: "GET",
      dataType: "JSON",
      success: function(data){
        $('[name="id_laporan"]').val(data.id_laporan);
        $('[name="no_antrean"]').val(data.no_antrean);
        $('[name="nama_pasien"]').val(data.nama_pasien);
        $('[name="nama_dokter"]').val(data.nama_dokter);
        $('[name="nama_spesialisasi"]').val(data.nama_spesialisasi);
        $('[name="tgl_periksa"]').val(data.tgl_periksa);
        $('[name="diagnosa"]').val(data.diagnosa);
        $('[name="resep_obat"]').val(data.resep_obat);
        $('[name="no_antrean"]').prop("disabled", true);
        $('[name="no_antrean"]').addClass("disabled");
        $('[name="nama_pasien"]').prop("disabled", true);
        $('[name="nama_pasien"]').addClass("disabled");
        $('[name="nama_dokter"]').prop("disabled", true);
        $('[name="nama_dokter"]').addClass("disabled");
        $('[name="nama_spesialisasi"]').prop("disabled", true);
        $('[name="nama_spesialisasi"]').addClass("disabled");
        $('#modal_laporan').modal('show');
        $('#modal_laporan_label').text('Edit Laporan');
      },
      error: function (jqXHR, textStatus, errorThrown){
        alert('Terjadi error dalam pengambilan data');
      }
    });
  });

//ON CLICK BUTTON SIMPAN (MODAL)
  $('#btn_simpan_laporan').on('click', function(){

    $('#btn_simpan_laporan').text('Menyimpan...');
    $('#btn_simpan_laporan').prop('disabled', true);

    var url;

    if (aksi == 'add') {
      url = "http://localhost/klinik4002/adminpage/buat_laporan";
    } else {
      url = "http://localhost/klinik4002/adminpage/edit_laporan";
    }

    $.ajax({
      url: url,
      type: "POST",
      data: $('#form_laporan').serialize(),
      dataType: "JSON",
      success: function(data){
        console.log(data);

        if (data.success){
          $('#modal_laporan').modal('hide');
          reload_table();
        }

        $('#btn_simpan_laporan').text('Simpan');
        $('#btn_simpan_laporan').prop('disabled', false);
      },
      error: function(jqXHR, textStatus, errorThrown){

        alert('Terjadi error dalam penambahan atau pengubahan laporan');

        $('#btn_simpan_laporan').text('Simpan');
        $('#btn_simpan_laporan').prop('disabled', false);
      }
    });
  });

   //ON CLICK BUTTON HAPUS
  $('tbody').on('click', '#hapus_laporan', function(){
    id_laporan = $(this).data("id_laporan");

    if (confirm('Apakah Anda yakin ingin menghapus laporan?')){
      $.ajax({
        url: "http://localhost/klinik4002/adminpage/hapus_laporan/" + id_laporan,
        type: "POST",
        dataType: "JSON",
        success: function(data){
          $('#modal_laporan').modal('hide');
          reload_table();
        },
        error: function(jqXHR, textStatus, errorThrown){
          alert('Terjadi error dalam penghapusan laporan');
        }
      });
    }
  });
});