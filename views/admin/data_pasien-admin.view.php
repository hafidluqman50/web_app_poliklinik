<?php $this->load('layout\header') ?>
<?php $this->load('admin\navbar-admin') ?>
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
				<a href="?c=admin&m=tambah_data_pasien">
					<button class="btn btn-danger-outline">
						Tambah Data
					</button>
				</a>
				<input type="search" class="input input-float-right light-table-filter" data-table="table" placeholder="Cari Data Pasien">
			</div>
			<div class="data-table-body">
				<table class="table">
					<thead>
						<th>No</th>
						<th>Nama Pasien</th>
						<th>Alamat Pasien</th>
						<th>Gender Pasien</th>
						<th>Umur Pasien</th>
						<th>Telepon Pasien</th>
						<th>Action</th>
					</thead>
					<tbody>
						<?php if ($cek != 0): ?>
							<?php foreach ($data_pasien as $num => $pasien): ?>
							<tr>
								<td><?= $num+1; ?></td>
								<td><?= $pasien['nama_pasien'] ?></td>
								<td><?= $pasien['alamat_pasien'] ?></td>
								<td><?= $pasien['gender_pasien'] ?></td>
								<td><?= $pasien['umur_pasien'] ?></td>
								<td><?= $pasien['telpon_pasien'] ?></td>
								<td>
									<a href="?c=admin&m=edit_data_pasien&id=<?= $pasien['id_pasien'] ?>">
										<button class="btn btn-warning-outline btn-action">
											Edit
										</button>
									</a>
									<a href="?c=admin&m=delete_data_pasien&id=<?= $pasien['id_pasien'] ?>" onclick="return confirm('Yakin Hapus');">
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