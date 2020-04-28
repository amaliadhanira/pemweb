<div class="container">
	<div class="col-md-12">
		<h1>Jumlah Antrean Hari Ini</h1>
		<table class="table">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Nama Dokter</th>
					<th scope="col">Spesialis</th>
					<th scope="col">Jumlah Antrean</th>
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
					<td><?= $ant['nama_spesialisasi'] ?></td>
					<td><?= $ant['jumlah_antrean'] ?></td>
				</tr>
				<?php 
					$i++;
					}
				} else {
				?>
				<tr>
					<td colspan="4" class="text-center text-muted">Belum ada antrean hari ini</td>
				</tr>
				<?php
				}
				?>
			</tbody>
		</table>
	</div>
</div>