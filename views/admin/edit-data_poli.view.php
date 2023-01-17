<?php $this->load('layout\header') ?>
<?php $this->load('admin\navbar-admin') ?>
<section class="content">
	<div class="form">
		<div class="form-header panel-warning">
			<p class="text-form">Edit Data Poli</p>
		</div>
		<form action="?c=admin&m=update_data_poli&id=<?= $data['id_poli'] ?>" method="POST">
			<div class="form-body">
				<div class="form-group">
					<label for="">Nama Poli</label>
					<input type="text" name="nama_poli" value="<?= $data['nama_poli'] ?>" class="form-input" placeholder="Nama Pasien"> 
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