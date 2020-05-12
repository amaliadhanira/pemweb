$(document).ready(function(){

  /* JQUERY/AJAX DATATABLES LAPORAN */

  var table;
  var aksi;
  var id_laporan;
  
  //DATATABLES LAPORAN
  table = $('#table_laporan').DataTable({
    "processing": true,
    "serverSide": true,
    "order": [],
    "scrollX": true,
    "language": {
      "emptyTable": "Anda belum memiliki antrean"
    },

    "ajax": {
      "url": "http://localhost/klinik4002/adminpage/data_laporan",
      "type": "POST",
      "dataType": "JSON"
    },

    "columnDefs": [{
      "targets": [0, -1, -2, -3],
      "orderable": false,
    },],
  });

  function reload_table(){
    table.ajax.reload(null, false);
  }

//ON CLICK BUTTON BUAT LAPORAN
  $('#buat_laporan').on('click', function(){
    aksi = 'add';
    
    $('#label_antrean').remove();
    $('#antrean').remove();
    $('#antrean_select').remove();
    var antrean_select = '<label for="antrean_select" class="col-form-label" id="label_antrean">No. Antrean:</label> <select name="antrean_select" id="antrean_select" class="form-control"> </select>';
    $(antrean_select).insertAfter('#no_antrean');

    $('#form_laporan')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();

    $.ajax({
      url: "http://localhost/klinik4002/adminpage/antrean_options",
      type: "GET",
      dataType: "JSON",
      success: function(data){
        console.log(data);
        $('#antrean_select').append($("<option></option>").attr("value", -1).text("---Silakan Pilih Nomor Antrean---"));
        $.each(data, function(index, value){
          $('#antrean_select').append($("<option></option>").attr("value", value.no_antrean).text(value.no_antrean));
        })
        $("#antrean_select option:eq(0)").prop('selected', true);
      },
      error: function (jqXHR, textStatus, errorThrown){
        alert('Terjadi error dalam pengambilan data');
      }
    });

    $('#modal_laporan').modal('show');
    $('#modal_laporan_label').text('Buat Laporan');
  });

 //SET VALUES WHEN NO ANTREAN OPTION SELECTED
  $('.form-group').on('change', '#antrean_select', function(){
    var no_antrean = $("#antrean_select option:selected").val();
    
    $.ajax({
      url: "http://localhost/klinik4002/adminpage/this_antrean/" + no_antrean,
      type: "GET",
      dataType: "JSON",
      success: function(data){
        console.log(data)
        if(no_antrean != -1){
          $('[name="no_antrean"]').val(data.no_antrean);
          $('[name="nama_pasien"]').val(data.nama_pasien);
          $('[name="nama_dokter"]').val(data.nama_dokter);
          $('[name="nama_spesialisasi"]').val(data.nama_spesialisasi);
          $('[name="tgl_periksa"]').val(data.tgl_periksa);
        } else {
          $('#form_laporan')[0].reset();
        }
      },
      error: function (jqXHR, textStatus, errorThrown){
        alert('Terjadi error dalam pengambilan data');
      }
    });
  }).trigger("change");

 //ON CLICK BUTTON UBAH LAPORAN
  $('tbody').on('click', '#ubah_laporan', function(){
    id_laporan = $(this).data("id_laporan");
    aksi = 'edit';

    $('#label_antrean').remove();
    $('#antrean').remove();
    $('#antrean_select').remove();
    var antrean = '<label for="antrean" class="col-form-label" id="label_antrean">No. Antrean:</label> <input type="text" name="antrean" id="antrean" class="form-control disabled" placeholder="No. Antrean" disabled>';
    $(antrean).insertAfter('#no_antrean');

    $('#form_laporan')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();

    $.ajax({
      url: "http://localhost/klinik4002/adminpage/edit_laporan/" + id_laporan,
      type: "GET",
      dataType: "JSON",
      success: function(data){
        $('[name="id_laporan"]').val(data.id_laporan);
        $('[name="antrean"]').val(data.no_antrean);
        $('[name="no_antrean"]').val(data.no_antrean);
        $('[name="nama_pasien"]').val(data.nama_pasien);
        $('[name="nama_dokter"]').val(data.nama_dokter);
        $('[name="nama_spesialisasi"]').val(data.nama_spesialisasi);
        $('[name="tgl_periksa"]').val(data.tgl_periksa);
        $('[name="diagnosa"]').val(data.diagnosa);
        $('[name="resep_obat"]').val(data.resep_obat);
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
      url = "http://localhost/klinik4002/adminpage/ubah_laporan";
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