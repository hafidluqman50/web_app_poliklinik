<?php $this->load('layout\header') ?>
<?php $this->load('admin\navbar-admin') ?>
	<section class="content">
		<div class="welcome">
			<p class="text-welcome">Selamat Datang Admin</p>
		</div>
		<div class="data-panel">
			<div class="panel">
				<div class="panel-info panel-primary">
					<img class="icon" src="public/assets/img/medicine-white.svg" alt="">
					<p class="white-color"><?= $rows_obat; ?> Data Obat</p>
				</div>
				<div class="panel-desc">
					<a href="?c=admin&m=data_obat">
						<button class="btn btn-primary-outline">
							Lihat Data
						</button>
					</a>
				</div>
			</div>
			<div class="panel">
				<div class="panel-info panel-primary">
					<img class="icon" src="public/assets/img/rehabilitation.svg" alt="">
					<p class="white-color"><?= $rows_pasien; ?> Data Pasien</p>
				</div>
				<div class="panel-desc">
					<a href="?c=admin&m=data_pasien">
						<button class="btn btn-primary-outline">
							Lihat Data
						</button>
					</a>
				</div>
			</div>
			<div class="panel">
				<div class="panel-info panel-primary">
					<img class="icon" src="public/assets/img/icon.svg" alt="">
					<p class="white-color"><?= $rows_resep ?> Data Resep</p>
				</div>
				<div class="panel-desc">
					<a href="?c=admin&m=data_resep">
						<button class="btn btn-primary-outline">
							Lihat Data
						</button>
					</a>
				</div>
			</div>
			<div class="panel">
				<div class="panel-info panel-primary">
					<img class="icon" src="public/assets/img/poly.svg" alt="">
					<p class="white-color"><?= $rows_poli ?> Data Poli</p>
				</div>
				<div class="panel-desc">
					<a href="?c=admin&m=data_poli">
						<button class="btn btn-primary-outline">
							Lihat Data
						</button>
					</a>
				</div>
			</div>
			<div class="panel">
				<div class="panel-info panel-primary">
					<img class="icon" src="public/assets/img/doctor.svg" alt="">
					<p class="white-color"><?= $rows_dokter ?> Data Dokter</p>
				</div>
				<div class="panel-desc">
					<a href="?c=admin&m=data_dokter">
						<button class="btn btn-primary-outline">
							Lihat Data
						</button>
					</a>
				</div>
			</div>
			<div class="panel">
				<div class="panel-info panel-primary">
					<img class="icon" src="public/assets/img/register.svg" alt="">
					<p class="white-color"><?= $rows_pendaftar ?> Data Pendaftaran</p>
				</div>
				<div class="panel-desc">
					<a href="?c=admin&m=data_pendaftar">
						<button class="btn btn-primary-outline">
							Lihat Data
						</button>
					</a>
				</div>
			</div>
			<div class="panel">
				<div class="panel-info panel-primary">
					<img class="icon" src="public/assets/img/user.svg" alt="">
					<p class="white-color">Pengaturan Akun</p>
				</div>
				<div class="panel-desc">
					<a href="?c=admin&m=pengaturan_akun&id=<?= $_SESSION['login']['id_login'] ?>">
						<button class="btn btn-primary-outline">
							Lihat Data
						</button>
					</a>
				</div>
			</div>
		</div>
	</section>
<?php $this->load('layout\footer') ?>