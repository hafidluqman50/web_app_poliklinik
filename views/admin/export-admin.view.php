<?php 
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=hasil.xls"); ?>
<table class="table">
	<thead>
		<th>No</th>
		<th>Tanggal Daftar</th>
		<th>Nama Pasien</th>
		<th>Nama Dokter</th>
		<th>Poli</th>
		<th>Ket</th>
		<th>Action</th>
	</thead>
	<tbody>
		<?php if ($cek != 0): ?>
			<?php foreach ($data_pendaftar as $num => $daftar): ?>
			<tr>
				<td><?= $num+1; ?></td>
				<td><?= $daftar['tgl_daftar'] ?></td>
				<td><?= $daftar['nama_pasien'] ?></td>
				<td><?= $daftar['nama_dkt'] ?></td>
				<td><?= $daftar['nama_poli'] ?></td>
				<td><?= $daftar['ket'] ?></td>
				<td><a href="?c=admin&m=detail_data_pendaftar&id=<?= $daftar['id_pendaftaran'] ?>">
						<button class="btn btn-primary-outline btn-action">
							Detail
						</button>
					</a>
					<a href="?c=admin&m=delete_data_pendaftar&id=<?= $daftar['id_pendaftaran'] ?>" onclick="return confirm('Yakin Hapus ?');">
						<button class="btn btn-danger-outline btn-action">
							Hapus
						</button>
					</a>
				</td>
			</tr>
			<?php endforeach ?>
		<?php else: ?>
		<tr>
			<td colspan="7">Data Kosong</td>
		</tr>
		<?php endif ?>
	</tbody>
</table>