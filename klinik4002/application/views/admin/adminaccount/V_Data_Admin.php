<div class="container">
	<div class="col-md-12">
		<h1>Data Admin</h1>
			<table class="table table-hover" id="table_admin" style="width: 100%">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Nama Admin</th>
						<th scope="col">Email</th>
						<th scope="col">Alamat</th>
						<th scope="col">Username</th>
						<th scope="col">Nomor Telepon</th>
						<th scope="col">Username</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>	
	</div>
</div>
<div class="modal fade" id="modal_admin" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal_admin_label">Form Buat Admin</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body form">
				<form action="" id="form_admin" class="form-horizontal">
					<div class="form-body">
						<div class="form-group">
							<label for="nama_admin" class="col-form-label">Nama Admin:</label>
							<input type="text" name="nama_admin">
						</div>
						<div class="form-group">
							<label for="email" class="col-form-label">Email:</label>
							<input type="text" name="email">
						</div>
						</div>
						<div class="form-group">
							<label for="email" class="col-form-label">Alamat:</label>
							<input type="text" name="alamat">
						</div>
						<div class="form-group">
							<label for="no_telp" class="col-form-label">Nomor Telepon:</label>
							<input type="text" name="no_telp">
						</div>
						<div class="form-group">
							<label for="username" class="col-form-label">Username:</label>
							<input type="text" name="username">
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="btn_simpan" class="btn btn-primary">Simpan</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
			</div>
		</div>
	</div>
</div>