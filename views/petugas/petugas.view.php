<?php $this->load('layout\header') ?>
<?php $this->load('petugas\navbar-petugas') ?>
<section class="content">
		<div class="welcome">
			<p class="text-welcome">Selamat Datang Petugas</p>
		</div>
		<div class="data-panel">
			<div class="panel">
				<div class="panel-info panel-primary">
					<img class="icon" src="public/assets/img/medicine-white.svg" alt="">
					<p class="white-color"><?= $rows_obat; ?> Data Obat</p>
				</div>
				<div class="panel-desc">
					<a href="?c=petugas&m=data_obat">
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
					<a href="?c=petugas&m=data_resep">
						<button class="btn btn-primary-outline">
							Lihat Data
						</button>
					</a>
				</div>
			</div>
		</div>
	</section>
<?php $this->load('layout\footer') ?>