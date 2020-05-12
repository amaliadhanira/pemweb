<div class="container mt-5">
	<div class="col col-md-12 p-3">
		<h1>Data Analis</h1>
		<?= validation_errors('<div class="error alert alert-danger" role="alert">', '</div>') ?>
		<div class="float-left p-1"><button class="btn btn-sm btn-primary" id="tambah_lab">Tambah Analis</button></div>
			<table class="table table-hover" id="table_lab" style="width: 100%">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Nama Analis</th>
						<th scope="col">Alamat</th>
						<th scope="col">Nomor Telepon</th>
						<th scope="col">Aksi</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>	
	</div>
</div>

<!-- MODAL TAMBAH / UBAH ANALIS -->
<div class="modal fade" id="modal_lab" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal_lab_label">Form Lab</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body form">
				<form action="" id="form_lab" class="form-horizontal">
					<input type="hidden" name="id_examiner" value="">
					<div class="form-body">
						<div class="form-group">
							<label for="nama_examiner" class="col-form-label">Nama Analis:</label>
							<input type="text" name="nama_examiner" class="form-control" placeholder="Nama Analis">
							<span class="help-block"></span>
						</div>
						<div class="form-group">
							<label for="alamat" class="col-form-label">Alamat:</label>
							<textarea name="alamat" class="form-control" placeholder="Alamat"></textarea>
							<span class="help-block"></span>
						</div>
						<div class="form-group">
							<label for="no_telp" class="col-form-label">Nomor Telepon:</label>
							<input type="text" name="no_telp" class="form-control" placeholder="Nomor Telepon">
							<span class="help-block"></span>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="btn_simpan_lab" class="btn btn-primary">Simpan</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
			</div>
		</div>
	</div>
</div>