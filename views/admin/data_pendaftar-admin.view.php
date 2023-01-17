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
				<a href="?c=admin&m=tambah_data_pendaftar">
					<button class="btn btn-danger-outline">
						Tambah Data
					</button>
				</a>
				<a href="?c=admin&m=export_daftar">
					<button class="btn btn-success-outline btn-action">
						export
					</button>
				</a>
				<input type="search" class="input input-float-right light-table-filter" data-table="table" placeholder="Cari Data Pendaftar">
			</div>
			<div class="data-table-body">
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
			</div>	
		</div>
	</section>
<?php $this->load('layout\footer') ?>