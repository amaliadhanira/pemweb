<div class="container">
	<div class="col">
		<h1>Antrean Saya</h1>
		<div class="row">
			<a class="btn btn-primary" href="#" role="button">Daftar Antrean</a>
		</div>
		<div class="row">
			<table class="table">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Nama Dokter</th>
						<th scope="col">Spesialis</th>
						<th scope="col">Tanggal Periksa</th>
						<th scope="col">Ubah</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					if (count($antrean) > 0){
						$i = 1;
						foreach($antrean as $ant){
					?>
					<tr>
						<th scope="row"><?= $i ?></th>
						<td><?= $ant['nama_dokter'] ?></td>
						<td><?= $ant['spesialis'] ?></td>
						<td><?= $ant['tgl_periksa'] ?></td>
						<td>
							<a class="btn btn-warning <?php if ($ant['tgl_periksa'] < date("Y-m-d")){ echo 'disabled'; } ?>" href="#" role="button">Ubah Tanggal</a>
							<a class="btn btn-danger <?php if ($ant['tgl_periksa'] < date("Y-m-d")){ echo 'disabled'; } ?>" href="#" role="button">Batalkan</a>
						</td>
					</tr>
					<?php 
						$i++;
						}
					} else {
					?>
					<tr>
						<td colspan="4" class="text-center text-muted">Anda belum memiliki antrean</td>
					</tr>
					<?php
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>