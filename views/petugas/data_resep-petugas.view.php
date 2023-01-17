<?php $this->load('layout\header') ?>
<?php $this->load('petugas\navbar-petugas') ?>
	<section class="content">
		<?php if (isset($_SESSION['simpan'])): ?>
		<div class="alert alert-success">
			<?= $_SESSION['simpan'] ?>
		</div>	
		<?php unset($_SESSION['simpan']) ?>
		<?php elseif(isset($_SESSION['edit'])): ?>
		<div class="alert alert-warning">
			<?= $_SESSION['edit'] ?>
		</div>
		<?php unset($_SESSION['edit']) ?>
		<?php elseif(isset($_SESSION['hapus'])): ?>
		<div class="alert alert-danger">
			<?= $_SESSION['hapus'] ?>
		</div>
		<?php unset($_SESSION['hapus']) ?>
		<?php endif ?>
		<div class="data-table">
			<div class="data-table-header">
				<a href="?c=petugas&m=tambah_data_resep">
					<button class="btn btn-danger-outline">
						Tambah Data
					</button>
				</a>
				<input type="search" class="input input-float-right light-table-filter" data-table="table" placeholder="Cari Data Resep">
			</div>
			<div class="data-table-body">
				<table class="table">
					<thead>
						<th>No</th>
						<th>Tanggal Resep</th>
						<th>Nama Dokter</th>
						<th>Nama Pasien</th>
						<th>Nama Poli</th>
						<th>Action</th>
					</thead>
					<tbody>
						<?php if ($cek != 0): ?>
							<?php foreach ($data_resep as $num => $resep): ?>
							<tr>
								<td><?= $num+1; ?></td>
								<td><?= $resep['tgl_resep'] ?></td>
								<td><?= $resep['nama_dkt'] ?></td>
								<td><?= $resep['nama_pasien'] ?></td>
								<td><?= $resep['nama_poli'] ?></td>
								<td>
									<a href="?c=petugas&m=detail_data_resep&id=<?= $resep['id_resep'] ?>">
										<button class="btn btn-primary-outline btn-action">
											Detail
										</button>
									</a>
									<a href="?c=petugas&m=delete_data_resep&id=<?= $resep['id_resep'] ?>" onclick="return confirm('Yakin Hapus Data?');">
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
			</div>	
		</div>
	</section>
<?php $this->load('layout\footer') ?>