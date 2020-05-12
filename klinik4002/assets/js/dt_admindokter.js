$(document).ready(function(){

	/* JQUERY/AJAX DATATABLES ANTREAN SAYA */

	var table;
  var aksi;
  var id_dokter;
  var id_spesialisasi;

	//DATATABLES DOKTER
	table = $('#table_dokter').DataTable({
    	"processing": true,
    	"serverSide": true,
    	"order": [],
    	"language": {
      	"emptyTable": "Tabel Kosong"
    	},

    	"ajax": {
      		"url": "http://localhost/klinik4002/adminpage/data_dokter",
      		"type": "POST",
      		"dataType": "JSON"
    	},

    	"columnDefs": [{
      		"targets": [0, -1, -2, -3, -4],
      		"orderable": false,
    	},],
  	});

  	function reload_table(){
    	table.ajax.reload(null, false);
  	}

    //ON CLICK BUTTON TAMBAH DOKTER
  $('#tambah_dokter').on('click', function(){
    aksi = 'add';
        $('#form_dokter')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('[name="nama_dokter"]').prop("disabled", false);
        $('[name="nama_dokter"]').removeClass("disabled");
        $('[name="spesialisasi"]').prop("disabled", false);
        $('[name="spesialisasi"]').removeClass("disabled");
        $('#modal_dokter').modal('show');
        $('#modal_dokter_label').text('Tambah Dokter');
  });

  //ON CLICK BUTTON UBAH DOKTER
  $('tbody').on('click', '#ubah_dokter', function(){

    id_dokter = $(this).data("id_dokter");
    aksi = 'edit';
    $('#form_dokter')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();

    $.ajax({
      url: "http://localhost/klinik4002/adminpage/edit_dokter/" + id_dokter,
      type: "GET",
      dataType: "JSON",
      success: function(data){
        $('[name="id_dokter"]').val(data.id_dokter);
        $('[name="id_spesialisasi"]').val(data.id_spesialisasi);
        $('[name="nama_dokter"]').val(data.nama_dokter);
        $('[name="spesialisasi"]').val(data.id_spesialisasi);
        $('[name="jadwal"]').val(data.jadwal);
        $('[name="alamat"]').val(data.alamat);
        $('[name="no_telp"]').val(data.no_telp);
        $('[name="nama_dokter"]').prop("disabled", true);
        $('[name="nama_dokter"]').addClass("disabled");
        $('[name="spesialisasi"]').prop("disabled", true);
        $('[name="spesialisasi"]').addClass("disabled");
        $('#modal_dokter').modal('show');
        $('#modal_dokter_label').text('Ubah dokter');
      },
      error: function (jqXHR, textStatus, errorThrown){
        alert('Terjadi error dalam pengambilan data');
      }
    });
  });

 //SET ID SPESIALISASI WHEN SPESIALISASI OPTION SELECTED
  $('#spesialisasi').on('change', function(){
    $id_spesialisasi = $("#spesialisasi option:selected").val();
    $('[name="id_spesialisasi"]').val($id_spesialisasi);
  }).trigger("change");


  //ON CLICK BUTTON SIMPAN (MODAL)
  $('#btn_simpan_dokter').on('click', function(){

    $('#btn_simpan_dokter').text('Menyimpan...');
    $('#btn_simpan_dokter').prop('disabled', true);

    var url;

    if (aksi == 'add') {
      url = "http://localhost/klinik4002/adminpage/tambah_dokter";
    } else {
      url = "http://localhost/klinik4002/adminpage/ubah_dokter";
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
          reload_table();
        }

        $('#btn_simpan_dokter').text('Simpan');
        $('#btn_simpan_dokter').prop('disabled', false);
      },
      error: function(jqXHR, textStatus, errorThrown){

        alert('Terjadi error dalam penambahan atau pengubahan dokter');

        $('#btn_simpan_dokter').text('Simpan');
        $('#btn_simpan_dokter').prop('disabled', false);
      }
    });
  });

  //ON CLICK BUTTON HAPUS
  $('tbody').on('click', '#hapus_dokter', function(){
    id_dokter = $(this).data("id_dokter");

    if (confirm('Apakah Anda yakin ingin menghapus dokter?')){
      $.ajax({
        url: "http://localhost/klinik4002/adminpage/hapus_dokter/" + id_dokter,
        type: "POST",
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

})