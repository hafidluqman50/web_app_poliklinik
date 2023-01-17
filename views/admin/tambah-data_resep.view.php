<?php $this->load('layout\header') ?>
<?php $this->load('admin\navbar-admin') ?>
<section class="content">
	<div class="resep">
		<div class="header-resep">
			<p>Tambah Data Resep</p>
		</div>
		<form action="?c=adminm=insert_data_resep" method="POST">
			<div class="body-resep">
				<div class="info-resep1">
					<div class="form-resep">
						<label for="" class="label">Nama Pasien</label>
						<select name="pasien" id="" class="form-input">
							<option value="" selected disabled>Pilih Data Pasien</option>
							<?php foreach ($data_pasien as $pasien): ?>
							<option value="<?= $pasien['id_pasien'] ?>"><?= $pasien['nama_pasien'] ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="form-resep">
						<label for="" class="label">Poli</label>
						<select name="poli" id="jagaw_admin" class="form-input">
							<option value="" selected disabled>Pilih Data Poli</option>
							<?php foreach ($data_poli as $poli): ?>
							<option value="<?= $poli['id_poli'] ?>"><?= $poli['nama_poli'] ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="form-resep">
						<label for="" class="label">Dokter</label>
						<select name="dokter" id="dokter-resep" class="form-input">
						</select>
					</div>
					<div class="form-resep">
						<label for="" class="label">Jumlah Bayar</label>
						<input type="text" name="total_harga" class="form-input jmlh-admin" readonly>
					</div>
					<div class="form-resep">
						<label for="" class="label">Bayar</label>
						<input type="text" name="bayar" class="form-input bayar-admin">
					</div>
					<div class="form-resep">
						<label for="" class="label">Kembali</label>
						<input type="text" name="kembali" class="form-input kembali-admin">
					</div>
					<div class="action-resep">
						<button type="button" class="btn btn-primary-outline" id="tambah">
							Tambah
						</button>
						<button type="button" class="btn btn-danger-outline" id="hapus">
							Hapus
						</button>
					</div>
				</div>
				<div class="resep-dokter resep-admin">
					<div class="form-resep" id="nm_obt">
						<label for="" class="label">Obat</label>
						<select name="obat[]" class="form-input obat-admin">
							<option value="" selected disabled>Pilih Obat</option>
							<?php foreach ($data_obat as $obat): ?>
							<option value="<?= $obat['id_obat'] ?>"><?= $obat['nama_obat'] ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="form-resep" id="jml_obt">
						<label for="" class="label">Jumlah Obat</label>
						<input type="text" name="bnyk_obt[]" class="form-input bnyk-admin" placeholder="Jumlah Obat">
					</div>
					<div class="form-resep" id="dss_obt">
						<label for="" class="label">Dosis Obat</label>
						<input type="text" name="dosis_obt[]" class="form-input" placeholder="Dosis Obat">
					</div>
				</div>
			</div>
			<div class="footer-resep">
				<button type="submit" name="simpan" class="btn btn-primary btn-resep">
					Tambah Resep
				</button>
			</div>
		</form>
	</div>
</section>
<?php $this->load('layout\footer') ?>