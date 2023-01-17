<?php $this->load('layout\header') ?>
<?php $this->load('admin\navbar-admin') ?>
<section class="content">
	<div class="form">
		<div class="form-header panel-primary">
			<p class="text-form">Tambah Data Dokter</p>
		</div>
		<form action="?c=admin&m=insert_data_dokter" method="POST">
			<div class="form-body">
				<div class="form-group">
					<label for="">Nama Dokter</label>
					<input type="text" name="nama_dkt" class="form-input" placeholder="Nama Dokter" required> 
				</div>
				<div class="form-group">
					<label for="">Alamat Doker</label>
					<textarea name="alamat_dkt" id="" cols="30" rows="10" class="form-input" required></textarea> 
				</div>
				<div class="form-group">
					<label for="">Spesialis</label>
					<input type="text" name="spesialis" class="form-input" placeholder="Spesialis" required> 
				</div>
				<div class="form-group">
					<label for="">Telepon Dokter</label>
					<input type="text" name="telepon_dkt" class="form-input" placeholder="Telepon Dokter" required> 
				</div>
				<div class="form-group">
					<label for="">Poli</label>
					<select name="id_poli" id="" class="form-input" required>
						<option value="" selected disabled>Poli</option>
						<?php foreach ($poli as $poli): ?>
						<option value="<?= $poli['id_poli'] ?>"><?= $poli['nama_poli'] ?></option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="form-group">
					<label for="">Tarif</label>
					<input type="number" name="tarif" class="form-input" placeholder="Umur Pasien" required> 
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