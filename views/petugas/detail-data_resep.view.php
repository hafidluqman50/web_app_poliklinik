<?php $this->load('layout\header') ?>
<?php $this->load('petugas\navbar-petugas') ?>
	<section class="content">
		<div class="bayar">
			<div class="bayar-header">
				Detail Resep
			</div>
			<div class="bayar-body">
				<div class="info-pasien">
					<div class="info-group">
						<label for="">Tgl Resep</label>
						<div class="form-info">
							<input type="text" value="<?= $rows->tgl_resep ?>" class="form-input" readonly>
						</div>
					</div>
					<div class="info-group">
						<label for="">Nama Pasien</label>
						<div class="form-info">
							<input type="text" value="<?= $rows->nama_pasien ?>" class="form-input" readonly>
						</div>
					</div>
					<div class="info-group">
						<label for="">Nama Dokter</label>
						<div class="form-info">
							<input type="text" value="<?= $rows->nama_dkt ?>" class="form-input" readonly>
						</div>
					</div>
					<div class="info-group">
						<label for="">Poli</label>
						<div class="form-info">
							<input type="text" value="<?= $rows->nama_poli ?>" class="form-input" readonly>
						</div>
					</div>
					<div class="info-group">
						<label for="">Total Harga</label>
						<div class="form-info">
							<input type="text" value="<?= $rows->total_harga ?>" class="form-input" readonly>
						</div>
					</div>
					<div class="info-group">
						<label for="">Bayar</label>
						<div class="form-info">
							<input type="text" value="<?= $rows->bayar; ?>" class="form-input" readonly>
						</div>
					</div>
					<div class="info-group">
						<label for="">Kembali</label>
						<div class="form-info">
							<input type="text" value="<?= $rows->kembali ?>" class="form-input" readonly>
						</div>
					</div>
				</div>
				<div class="info-bayar">
					<?php foreach ($data_detail as $obat): ?>
					<div class="info-group">
						<label for="">Nama Obat</label>
						<div class="form-info">
							<input type="text" value="<?= $obat['nama_obat'] ?>" class="form-input" readonly>
						</div>
					</div>
					<div class="info-group">
						<label for="">Banyak Obat</label>
						<div class="form-info">
							<input type="text" value="<?= $obat['banyak_obat'] ?>" class="form-input" readonly>
						</div>
					</div>
					<div class="info-group">
						<label for="">Dosis</label>
						<div class="form-info">
							<input type="text" value="<?= $obat['dosis'] ?>" class="form-input" readonly>
						</div>
					</div>
					<div class="info-group">
						<label for="">Sub Total</label>
						<div class="form-info">
							<input type="text" value="<?= $obat['sub_total'] ?>" class="form-input" readonly>
						</div>
					</div>
				<?php endforeach ?>
				</div>
			</div>
		</div>
	</section>
<?php $this->load('layout\footer') ?>