<div class="container mt-5">
	<div class="col col-md-12 p-3">
		<h1>Data Admin</h1>
		<?= validation_errors('<div class="error alert alert-danger" role="alert">', '</div>') ?>
		<div class="float-left p-1"><button class="btn btn-sm btn-primary" id="tambah_admin">Tambah Admin</button></div>
			<table class="table table-hover" id="table_admin" style="width: 100%">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Nama Admin</th>
						<th scope="col">Email</th>
						<th scope="col">Alamat</th>
						<th scope="col">Username</th>
						<th scope="col">Nomor Telepon</th>
						<th scope="col">Aksi</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>	
	</div>
</div>

<!-- MODAL TAMBAH / UBAH ADMIN -->
<div class="modal fade" id="modal_admin" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal_admin_label">Form Admin</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body form">
				<form action="" id="form_admin" class="form-horizontal">
					<input type="hidden" name="id_admin" value="">
					<div class="form-body">
						<div class="form-group">
							<label for="nama_admin" class="col-form-label">Nama Lengkap:</label>
							<input type="text" name="nama_admin" class="form-control" placeholder="Nama Lengkap">
							<span class="help-block"></span>
						</div>
						<div class="form-group">
							<label for="email" class="col-form-label">Email:</label>
							<input type="email" name="email" class="form-control" placeholder="Email">
							<span class="help-block"></span>
						</div>
						<div class="form-group">
							<label for="alamat" class="col-form-label">Alamat:</label>
							<textarea name="alamat" class="form-control" placeholder="Alamat"></textarea>
							<span class="help-block"></span>
						</div>
						<div class="form-group">
							<label for="username" class="col-form-label">Username:</label>
							<input type="text" name="username" class="form-control" placeholder="Username">
							<span class="help-block"></span>
						</div>
						<div class="form-group">
							<label for="no_telp" class="col-form-label">Nomor Telepon:</label>
							<input type="text" name="no_telp" class="form-control" placeholder="Nomor Telepon">
							<span class="help-block"></span>
						</div>
						<div class="form-group">
							<label for="password" class="col-form-label" id="label_sandi">Sandi:</label>
							<input type="password" name="password" class="form-control" placeholder="Sandi">
							<span class="help-block"></span>
						</div>
						<div class="form-group">
							<label for="passconf" class="col-form-label">Konfirmasi Sandi:</label>
							<input type="password" name="passconf" class="form-control" placeholder="Konfirmasi Sandi">
							<span class="help-block"></span>
						</div>
						
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="btn_simpan_admin" class="btn btn-primary">Simpan</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
			</div>
		</div>
	</div>
</div>