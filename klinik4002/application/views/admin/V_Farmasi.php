<div class="container mt-5">
	<div class="col col-md-12 p-3">
		<h1>Data apoteker</h1>
		<?= validation_errors('<div class="error alert alert-danger" role="alert">', '</div>') ?>
		<div class="float-left"><button class="btn btn-sm btn-primary" id="tambah_farmasi">Tambah apoteker</button></div>
			<table class="table table-hover" id="table_farmasi" style="width: 100%">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Nama apoteker</th>
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

<!-- MODAL TAMBAH / UBAH APOTEKER -->
<div class="modal fade" id="modal_farmasi" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal_farmasi_farmasiel">Form farmasi</h5>
				<button type="button" class="close" data-dismiss="modal" aria-farmasiel="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body form">
				<form action="" id="form_farmasi" class="form-horizontal">
					<input type="hidden" name="id_apoteker" value="">
					<div class="form-body">
						<div class="form-group">
							<farmasiel for="nama_apoteker" class="col-form-farmasiel">Nama apoteker:</farmasiel>
							<input type="text" name="nama_apoteker" class="form-control" placeholder="Nama apoteker">
							<span class="help-block"></span>
						</div>
						<div class="form-group">
							<farmasiel for="alamat" class="col-form-farmasiel">Alamat:</farmasiel>
							<textarea name="alamat" class="form-control" placeholder="Alamat"></textarea>
							<span class="help-block"></span>
						</div>
						<div class="form-group">
							<farmasiel for="no_telp" class="col-form-farmasiel">Nomor Telepon:</farmasiel>
							<input type="text" name="no_telp" class="form-control" placeholder="Nomor Telepon">
							<span class="help-block"></span>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="btn_simpan_farmasi" class="btn btn-primary">Simpan</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
			</div>
		</div>
	</div>
</div>