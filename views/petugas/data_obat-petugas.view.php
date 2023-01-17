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
				<a href="?c=petugas&m=tambah_data_obat">
					<button class="btn btn-danger-outline">
						Tambah Data
					</button>
				</a>
				<input type="search" class="input input-float-right light-table-filter" data-table="table" placeholder="Cari Data Obat">
			</div>
			<div class="data-table-body">
				<table class="table">
					<thead>
						<th>No</th>
						<th>Nama Obat</th>
						<th>Jenis Obat</th>
						<th>Harga Obat</th>
						<th>Jumlah Obat</th>
						<th>Action</th>
					</thead>
					<tbody>
						<?php if ($cek != 0): ?>
							<?php foreach ($data_obat as $num => $obat): ?>
							<tr>
								<td><?= $num+1; ?></td>
								<td><?= $obat['nama_obat'] ?></td>
								<td><?= $obat['jenis_obat'] ?></td>
								<td><?= $obat['harga_obat'] ?></td>
								<td><?= $obat['jumlah_obat'] ?></td>
								<td><a href="?c=petugas&m=edit_data_obat&id=<?= $obat['id_obat'] ?>">
										<button class="btn btn-warning-outline btn-action">
											Edit
										</button>
									</a>
									<a href="?c=petugas&m=delete_data_obat&id=<?= $obat['id_obat'] ?>" onclick="return confirm('Yakin Hapus?');">
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