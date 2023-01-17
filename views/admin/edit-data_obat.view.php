<?php $this->load('layout\header') ?>
<?php $this->load('admin\navbar-admin') ?>
<section class="content">
	<div class="form">
		<div class="form-header panel-warning">
			<p class="text-form">Edit Data Obat</p>
		</div>
		<form action="?c=admin&m=edit_data_obat&id=<?= $data['id_obat'] ?>" method="POST">
			<div class="form-body">
				<div class="form-group">
					<label for="">Nama Obat</label>
					<input type="text" name="nama_obat" class="form-input" placeholder="Nama Pasien" value="<?= $data['nama_obat'] ?>"> 
				</div>
				<div class="form-group">
					<label for="">Jenis Obat</label>
					<input type="text" name="jenis_obat" class="form-input" placeholder="Jenis Obat" value="<?= $data['jenis_obat'] ?>">
				</div>
				<div class="form-group">
					<label for="">Kategori Obat</label>
					<input type="text" name="kategori_obat" class="form-input" placeholder="Jenis Obat" value="<?= $data['kategori_obat'] ?>">
				</div>
				<div class="form-group">
					<label for="">Harga Obat</label>
					<input type="number" name="harga_obat" class="form-input" placeholder="Jenis Obat" value="<?= $data['harga_obat'] ?>">
				</div>
				<div class="form-group">
					<label for="">Jumlah Obat</label>
					<input type="number" name="jumlah_obat" class="form-input" placeholder="Jenis Obat" value="<?= $data['jumlah_obat'] ?>">
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