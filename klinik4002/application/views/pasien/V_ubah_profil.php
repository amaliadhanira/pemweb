<div class="container mt-5">
	<div class="row justify-content-md-center">
	<div class="col col-md-8 p-3">
		<h1>Ubah Profil</h1>
		<?php if ($this->session->flashdata('info_msg') == 'error') { ?>
			<div class="alert alert-danger" role="alert">
				Password yang Anda masukkan salah
			</div>
		<?php } else if ($this->session->flashdata('info_msg') == 'success') { ?>
			<div class="alert alert-success" role="alert">
				Profil berhasil diubah
			</div>
		<?php } ?>
		<?= validation_errors('<div class="error alert alert-danger" role="alert">', '</div>') ?>
		<form action="<?= site_url('klinik/edit_profil/') ?>" method="post">
			<input type="hidden" name="id_pasien" value="<?= $pasien['id_pasien'] ?>">
			<div class="form-group">
				<label for="username">Username:</label>
				<input type="text" name="username" class="form-control" placeholder="Username" value="<?= $pasien['username'] ?>" readonly>
			</div>
			<div class="form-group">
				<label for="nama_pasien">Nama Lengkap:</label>
				<input type="text" name="nama_pasien" class="form-control" placeholder="Nama Lengkap" value="<?= $pasien['nama_pasien'] ?>">
			</div>
			<div class="form-group">
				<label for="tanggal_lahir">Tanggal Lahir:</label>
				<input type="date" name="tanggal_lahir" class="form-control" value="<?= $pasien['tanggal_lahir'] ?>" min="1930-01-01" max="<?= (new DateTime('today'))->format('Y-m-d') ?>">
			</div>
			<div class="form-group">
				<label for="alamat">Alamat:</label>
				<textarea name="alamat" class="form-control" placeholder="Alamat"><?= $pasien['alamat'] ?></textarea>
			</div>
			<div class="form-group">
				<label for="no_telp">Nomor Telepon:</label>
				<input type="text" name="no_telp" class="form-control" placeholder="Nomor Telepon" value="<?= $pasien['no_telp'] ?>">
			</div>
			<div class="form-group">
				<label for="email">Email:</label>
				<input type="email" name="email" class="form-control" placeholder="example@mail.com" value="<?= $pasien['email'] ?>" readonly>
			</div>
			<div class="form-group">
				<label for="password">Sandi:</label>
				<input type="password" name="password" class="form-control" placeholder="Sandi">
			</div>
			<div class="form-group">
				<label for="passconf">Konfirmasi Sandi:</label>
				<input type="password" name="passconf" class="form-control" placeholder="Konfirmasi Sandi">
			</div>
			<button type="submit" class="btn btn-primary">Simpan</button>
		</form>
	</div>
	</div>
</div>