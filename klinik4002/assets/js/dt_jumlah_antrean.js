$(document).ready(function(){

	/* JQUERY/AJAX DATATABLES JUMLAH ANTREAN */

	var table;

	//DATATABLES JUMLAH ANTREAN
	table = $('#table_jumlah_antrean').DataTable({
    	"processing": true,
    	"serverSide": true,
    	"order": [],
    	"language": {
      	"emptyTable": "Belum ada antrean hari ini"
    	},

    	"ajax": {
      		"url": "http://localhost/klinik4002/klinik/data_jumlah_antrean",
      		"type": "POST",
      		"dataType": "JSON"
    	},

    	"columnDefs": [{
      		"targets": [0],
      		"orderable": false,
    	},],
  	});

  	function reload_table(){
    	table.ajax.reload(null, false);
  	}

})