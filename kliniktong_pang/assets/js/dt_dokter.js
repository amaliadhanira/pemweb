$(document).ready(function(){

	/* JQUERY/AJAX DATATABLES ANTREAN SAYA */

	var table;

	//DATATABLES DOKTER
	table = $('#table_dokter').DataTable({
    	"processing": true,
    	"serverSide": true,
    	"order": [],
    	"language": {
      	"emptyTable": "Anda belum memiliki antrean"
    	},

    	"ajax": {
      		"url": "http://localhost/klinik4002/klinik/data_dokter",
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

})