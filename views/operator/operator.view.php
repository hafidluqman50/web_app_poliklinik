<?php $this->load('layout\header') ?>
<?php $this->load('operator\navbar-operator') ?>
	<section class="content">
		<div class="welcome">
			<p class="text-welcome">Selamat Datang Operator</p>
		</div>
		<div class="data-panel">
			<div class="panel">
				<div class="panel-info panel-primary">
					<img class="icon" src="public/assets/img/rehabilitation.svg" alt="">
					<p class="white-color"><?= $rows_pasien; ?> Data Pasien</p>
				</div>
				<div class="panel-desc">
					<a href="?c=operator&m=data_pasien">
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
					<a href="?c=operator&m=data_pendaftar">
						<button class="btn btn-primary-outline">
							Lihat Data
						</button>
					</a>
				</div>
			</div>
		</div>
	</section>
<?php $this->load('layout\footer') ?>