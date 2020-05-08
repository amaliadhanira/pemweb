<div class="container mt-5">
	<div class="col col-md-12 p-3">
		<h1>Laporan Pemeriksaan</h1>
			<table class="table table-hover" id="table_laporan_pemeriksaan" style="width: 100%">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Nama Dokter</th>
						<th scope="col">Spesialis</th>
						<th scope="col">Tanggal Pemeriksaan</th>
						<th scope="col">Diagnosa</th>
						<th scope="col">Rincian</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
	</div>
</div>

<!-- MODAL RINCIAN -->
<div class="modal fade" id="modal_rincian_laporan" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal_laporan_label">Rincian Laporan Pemeriksaan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table">
					<tr>
						<th scope="row" style="width: 50%">Nama Dokter:</th>
						<td id="nama_dokter"></td>
					</tr>
					<tr>
						<th scope="row">Spesialis:</th>
						<td id="spesialis"></td>
					</tr>
					<tr>
						<th scope="row">Tanggal Pemeriksaan:</th>
						<td id="tgl_periksa"></td>
					</tr>
					<tr>
						<th scope="row">Diagnosa:</th>
						<td id="diagnosa"></td>
					</tr>
					<tr>
						<th scope="row">Resep Obat:</th>
						<td>
							<ul id="obat"></ul>
						</td>
					</tr>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>