<?php $this->load('layout\header') ?>
<?php $this->load('admin\navbar-admin') ?>
	<section class="content">
		<div class="bayar">
			<div class="bayar-header">
				Bayar Pendaftaran
			</div>
			<div class="bayar-body">
				<div class="info-pasien">
					<div class="info-group">
						<label for="">Nama Pasien</label>
						<div class="form-info">
							<input type="text" value="<?= $data->nama_pasien ?>" class="form-input" readonly>
						</div>
					</div>
					<div class="info-group">
						<label for="">Alamat Pasien</label>
						<div class="form-info">
							<input type="text" value="<?= $data->alamat_pasien ?>" class="form-input" readonly>
						</div>
					</div>
					<div class="info-group">
						<label for="">Gender Pasien</label>
						<div class="form-info">
							<input type="text" value="<?= $data->gender_pasien ?>" class="form-input" readonly>
						</div>
					</div>
					<div class="info-group">
						<label for="">Umur Pasien</label>
						<div class="form-info">
							<input type="text" value="<?= $data->umur_pasien ?>" class="form-input" readonly>
						</div>
					</div>
					<div class="info-group">
						<label for="">Telepon Pasien</label>
						<div class="form-info">
							<input type="text" value="<?= $data->telpon_pasien ?>" class="form-input" readonly>
						</div>
					</div>
					<div class="info-group">
						<label for="">Tanggal Daftar</label>
						<div class="form-info">
							<input type="text" value="<?= $data->tgl_daftar ?>" class="form-input" readonly>
						</div>
					</div>
					<div class="info-group">
						<label for="">Ket</label>
						<div class="form-info">
							<textarea class="form-input" cols="30" rows="10" readonly><?= $data->ket ?></textarea>
						</div>
					</div>
				</div>
				<div class="info-bayar">
					<div class="info-group">
						<label for="">Nama Dokter</label>
						<div class="form-info">
							<input type="text" value="<?= $data->nama_dkt ?>" class="form-input" readonly>
						</div>
					</div>
					<div class="info-group">
						<label for="">Nama Poli</label>
						<div class="form-info">
							<input type="text" value="<?= $data->nama_poli ?>" class="form-input" readonly>
						</div>
					</div>
					<div class="info-group">
						<label for="">Biaya Daftar</label>
						<div class="form-info">
							<input type="text" value="<?= $data->biaya ?>" class="form-input" readonly>
						</div>
					</div>
					<div class="info-group">
						<label for="">Tarif Dokter</label>
						<div class="form-info">
							<input type="text" value="<?= $data->tarif ?>" class="form-input" readonly>
						</div>
					</div>
					<div class="info-group">
						<label for="">Total Biaya</label>
						<div class="form-info">
							<input type="text" value="<?= $data->jumlah_byr ?>" class="form-input total" readonly>
						</div>
					</div>
					<div class="info-group">
						<label for="">Bayar</label>
						<div class="form-info">
							<input type="text" value="<?= $data->bayar ?>" class="form-input" readonly>
						</div>
					</div>
					<div class="info-group">
						<label for="">Kembali</label>
						<div class="form-info">
							<input type="text" value="<?= $data->kembali ?>" class="form-input" readonly>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php $this->load('layout\footer') ?>