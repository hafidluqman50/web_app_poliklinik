<?php $this->load('layout\header') ?>
<?php $this->load('admin\navbar-admin') ?>
<section class="content">
	<div class="form">
		<div class="form-header panel-primary">
			<p class="text-form">Tambah Data Obat</p>
		</div>
		<form action="?c=admin&m=insert_data_obat" method="POST">
			<div class="form-body">
				<div class="form-group">
					<label for="">Nama Obat</label>
					<input type="text" name="nama_obat" class="form-input" placeholder="Nama Obat"> 
				</div>
				<div class="form-group">
					<label for="">Jenis Obat</label>
					<input type="text" name="jenis_obat" class="form-input" placeholder="Jenis Obat">
				</div>
				<div class="form-group">
					<label for="">Kategori Obat</label>
					<input type="text" name="kategori" class="form-input" placeholder="Kategori Obat">
				</div>
				<div class="form-group">
					<label for="">Harga Obat</label>
					<input type="number" name="harga_obat" class="form-input" placeholder="Harga Obat">
				</div>
				<div class="form-group">
					<label for="">Jumlah Obat</label>
					<input type="number" name="jumlah_obat" class="form-input" placeholder="Jumlah Obat">
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