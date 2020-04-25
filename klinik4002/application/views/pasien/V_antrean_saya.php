<div class="container">
	<div class="col-md-12">
		<h1>Antrean Saya</h1>
		<div class="float-left p-2"><button class="btn btn-sm btn-primary" id="daftar_antrean">Daftar Antrean</button></div>
		<div class="p-2">
			<table class="table table-hover" id="table_antrean_saya" style="width: 100%">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Nama Dokter</th>
						<th scope="col">Spesialis</th>
						<th scope="col">Tanggal Periksa</th>
						<th scope="col">Aksi</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- MODAL DAFTAR / UBAH TANGGAL -->
<div class="modal fade" id="modal_antrean" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal_antrean_label">Form Antrean</h5>
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
							<label for="dokter" class="col-form-label">Dokter:</label>
							<select name="dokter" id="dokter" class="form-control">
								<?php foreach ($dokter as $dok) { ?>
									<option value="<?= $dok['id_dokter'] ?>"><?= $dok['nama_dokter']. ' - ' .$dok['nama_spesialisasi'] ?></option>
								<?php 
								$val_id_dok = $dok['id_dokter'];
							} ?>
							</select>
							<input type="hidden" name="id_dokter" value="">
							<span class="help-block"></span>
						</div>
						<div class="form-group">
							<label for="tgl_periksa" class="col-form-label">Tanggal Periksa:</label>
							<input type="text" name="tgl_periksa" class="form-control datepicker datepicker-as" placeholder="yyyy-mm-dd" value="<?= (new DateTime('tomorrow'))->format('Y-m-d') ?>" required readonly>
							<span class="help-block"></span>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="btn_simpan" class="btn btn-primary">Simpan</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>