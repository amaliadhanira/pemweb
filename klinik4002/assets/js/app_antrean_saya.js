$(document).ready(function(){
  /*
  show_antrean_saya();

  $('#data_antrean_saya').dataTable({
    "processing": true,
    "serverSide": false,
    "order": [],
    "language": {
      "emptyTable": "Anda belum memiliki antrean"
    }
  });

  function show_antrean_saya(){
    $.ajax({
      type: "POST",
      url: "klinik/data_antrean_saya",
      dataType: "json",
      success: function(data){
        var html = '';
        var i;

        for (i=0; i < data.length; i++){
          html += '<tr>';
          html += '<th scope="row">' + (i+1) + '</th>';
          html += '<td>' + data[i].nama_dokter + '</td>';
          html += '<td>' + data[i].spesialis + '</td>';
          html += '<td>' + data[i].tgl_periksa + '</td>';
          html += '<td style="text-align:right;">' + 
          '<a href="javascript:void(0);" class="btn btn-warning btn-sm';
          if (compare_dates(data[i].tgl_periksa)) {
            html += ' disabled';
          }
          html += '" data-no_antrean="'+data[i].no_antrean+'" data-id_dokter="'+data[i].id_dokter+'" data-id_pasien="'+data[i].id_pasien+'" data-tgl_periksa="'+data[i].tgl_periksa+'">Ubah Tanggal</a>'+' ';
          html += '<a href="javascript:void(0);" class="btn btn-danger btn-sm'
          if (compare_dates(data[i].tgl_periksa)) {
            html += ' disabled';
          }
          html += '" data-no_antrean="'+data[i].no_antrean+'">Batalkan</a>'+'</td>';
          html += '</tr>';

          console.log(data[i].tgl_periksa, compare_dates(data[i].tgl_periksa));
        }
        $('#show_antrean_saya').html(html);
      },
      error: function(){
        alert('An error occured!');
      }
    });
  }

  function compare_dates(tgl_periksa){
    var d1 = Date.parse(new Date());
    var d2 = Date.parse(tgl_periksa);

    console.log(d1, d2);

    if (d2 < d1) {
      return true;
    } else {
      return false;
    }
  }

  $('#btn_tambah').on('click', function(){
    //var no_antrean = $('#no_antrean').val();
    var id_pasien = $('#id_pasien').val();
    var id_dokter = $('#dokter').val();
    var tgl_periksa = $('#tgl_periksa').val();

    $.ajax({
      type: "POST",
      url: "<?= site_url('klinik/daftar_antrean') ?>",
      dataType: "JSON",
      data: {id_dokter:id_dokter, id_pasien:id_pasien, tgl_periksa:tgl_periksa},
      success: function(data){
        $('[name="id_dokter"').val("");
        $('[name="id_pasien"').val("");
        $('[name="tgl_periksa"').val("");
        $('#modal_daftar').modal('hide');
        show_antrean_saya();
      }
    });
    return false;
  })*/

})