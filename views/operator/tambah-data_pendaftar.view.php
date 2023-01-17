<?php $this->load('layout\header') ?>
<?php $this->load('operator\navbar-operator') ?>
<section class="content">
	<div class="form">
		<div class="form-header panel-primary">
			<p class="text-form">Tambah Data Dokter</p>
		</div>
		<form action="?c=operator&m=insert_data_pendaftar" method="POST">
			<div class="form-body">
				<div class="form-group">
					<label for="">Nama Pasien</label>
					<select name="nama_pasien" id="" class="form-input">
						<option value="" selected disabled>Pilih Data pasien</option>
					<?php foreach ($data_pasien as $pasien): ?>
						<option value="<?= $pasien['id_pasien'] ?>"><?= $pasien['nama_pasien'] ?></option>
					<?php endforeach ?>
					</select>
				</div>
				<div class="form-group">
					<label for="">Poli</label>
					<select name="poli" id="poli" class="form-input">
						<option value="" selected disabled>Pilih Data Poli</option>
					<?php foreach ($data_poli as $poli): ?>
						<option value="<?= $poli['id_poli'] ?>"><?= $poli['nama_poli'] ?></option>
					<?php endforeach ?>
					</select>
				</div>
				<div class="form-group">
					<label for="">Dokter</label>
					<select name="dokter" id="dokter" class="form-input">
					</select>
				</div>
				<div class="form-group">
					<label for="">Ket</label>
					<textarea name="ket" class="form-input" cols="30" rows="10"></textarea>
				</div>
			</div>
			<div class="form-footer">
				<button type="submit" name="simpan" class="btn btn-primary btn-submit">
					Simpan
				</button>
			</div>
		</form>
	</div>
</section>
<?php $this->load('layout\footer') ?>