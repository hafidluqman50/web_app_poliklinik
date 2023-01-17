<?php $this->load('layout\header') ?>
<?php $this->load('admin\navbar-admin') ?>
<section class="content">
	<div class="form">
		<div class="form-header panel-warning">
			<p class="text-form">Edit Data Pasien</p>
		</div>
		<form action="?c=admin&m=update_data_pasien&id=<?= $data['id_pasien'] ?>" method="POST">
			<div class="form-body">
				<div class="form-group">
					<label for="">Nama Pasien</label>
					<input type="text" name="nama_pasien" class="form-input" placeholder="Nama Pasien" value="<?= $data['nama_pasien'] ?>"> 
				</div>
				<div class="form-group">
					<label for="">Alamat Pasien</label>
					<textarea name="alamat_pasien" id="" cols="30" rows="10" class="form-input"><?= $data['alamat_pasien'] ?></textarea> 
				</div>
				<div class="form-group">
					<label for="">Gender Pasien</label>
					<select name="gender_pasien" id="" class="form-input">
						<option value="" selected disabled>Gender Pasien</option>
						<option value="Laki - Laki" <?php if ($data['gender_pasien'] == 'Laki - Laki'): ?> selected<?php endif ?>>Laki - Laki</option>
						<option value="Perempuan" <?php if ($data['gender_pasien'] == 'Perempuan'): ?> selected<?php endif ?>>Perempuan</option>
					</select>
				</div>
				<div class="form-group">
					<label for="">Umur Pasien</label>
					<input type="number" name="umur_pasien" class="form-input" placeholder="Umur Pasien" value="<?= $data['umur_pasien'] ?>"> 
				</div>
				<div class="form-group">
					<label for="">Telepon Pasien</label>
					<input type="text" name="telepon_pasien" class="form-input" placeholder="Telepon Pasien" value="<?= $data['telpon_pasien'] ?>">
				</div>
			</div>
			<div class="form-footer">
				<button type="submit" name="edit" class="btn btn-primary btn-submit">
					Simpan
				</button>
			</div>
		</form>
	</div>
</section>
<?php $this->load('layout\footer') ?>