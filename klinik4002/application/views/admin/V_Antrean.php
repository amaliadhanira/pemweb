<div class="container mt-5">
	<div class="col col-md-12 p-3">
		<h1>Data Antrean</h1>
			<table class="table table-hover" id="table_antrean" style="width: 100%">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Nama Pasien</th>
						<th scope="col">Nama Dokter</th>
						<th scope="col">Spesialis</th>
						<th scope="col">Tanggal Periksa</th>
						<th scope="col">Waktu Daftar</th>
						<th scope="col">Aksi</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>	
	</div>
</div>

<!-- MODAL TAMBAH / UBAH ANTREAN -->
<div class="modal fade" id="modal_antrean" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal_antrean_label">Form antrean</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body form">
				<form action="" id="form_antrean" class="form-horizontal">
					<input type="hidden" name="no_antrean" value="">
					<div class="form-body">
						<div class="form-group">
							<label for="nama_pasien" class="col-form-label">Nama Pasien:</label>
							<input type="text" name="nama_pasien" class="form-control disabled" disabled>
							<input type="hidden" name="id_pasien">
							<span class="help-block"></span>
						</div>
						<div class="form-group">
							<label for="nama_dokter" class="col-form-label">Nama Dokter:</label>
							<input type="text" name="nama_dokter" class="form-control disabled" disabled>
							<input type="hidden" name="id_dokter">
							<span class="help-block"></span>
						</div>
						<div class="form-group">
							<label for="nama_spesialisasi" class="col-form-label">Spesialis:</label>
							<input type="text" name="nama_spesialisasi" class="form-control disabled" disabled>
							<span class="help-block"></span>
						</div>
						<div class="form-group">
							<label for="username" class="col-form-label">Tanggal Periksa:</label>
							<input type="text" name="tgl_periksa" class="form-control datepicker" placeholder="yyyy-mm-dd" value="<?= (new DateTime('tomorrow'))->format('Y-m-d') ?>" required readonly>
							<span class="help-block"></span>
						</div>
						<div class="form-group">
							<label for="waktu_daftar" class="col-form-label">Waktu Daftar:</label>
							<input type="text" name="waktu_daftar" class="form-control" disabled>
							<span class="help-block"></span>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="btn_simpan_antrean" class="btn btn-primary">Simpan</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>