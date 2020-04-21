<div class="container">
	<div class="col">
		<h1>Daftar Dokter</h1>
		<div class="row">
			<table class="table">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Nama Dokter</th>
						<th scope="col">Spesialis</th>
						<th scope="col">Nomor Telepon</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					if (count($dokter) > 0){
						$i = 1;
						foreach($dokter as $dok){
					?>
					<tr>
						<th scope="row"><?= $i ?></th>
						<td><?= $dok['nama_dokter'] ?></td>
						<td><?= $dok['spesialis'] ?></td>
						<td><?= $dok['no_telp'] ?></td>
					</tr>
					<?php 
						$i++;
						}
					} else {
					?>
					<tr>
						<td colspan="4" class="text-center text-muted">Belum ada dokter yang terdaftar</td>
					</tr>
					<?php
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>