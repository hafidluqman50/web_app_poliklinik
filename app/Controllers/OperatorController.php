<?php 
use Core\Controllers;
use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\Pendaftaran;

class OperatorController extends Controllers {
	public $pasien;
	public $dokter;
	public $pendaftar;

	public function __construct() {
		parent::__construct();
		if (!isset($_SESSION['login'])) {
			$_SESSION['fail'] = 'Maaf Login Terlebih Dahulu';
			return $this->redirect('?c=auth');
			die;
		}
		elseif(isset($_SESSION['login']) && $_SESSION['login']['level'] != 0) {
			return $this->location('?=auth');
		}
		$this->pasien    = new Pasien;
		$this->dokter    = new Dokter;
		$this->pendaftar = new Pendaftaran;
	}

	public function index() {
		$title = 'Operator | Poliklinik_2017';
		$rows_pasien    = $this->pasien->rowsAll();
		$rows_dokter    = $this->dokter->rowsAll();
		$rows_pendaftar = $this->pendaftar->rowsAll();
		$this->view('operator\operator',compact('title','rows_pasien','rows_dokter','rows_pendaftar'));
	}

	public function data_pasien() {
		$title = 'Data Pasien | Poliklinik 2017';
		$data_pasien = $this->pasien->all();
		$cek = $this->pasien->rowsAll();
		$this->view('operator\data_pasien-operator',compact('title','data_pasien','cek'));
	}

	public function tambah_data_pasien() {
		$title = 'Tambah Data Pasien | Poliklinik 2017';
		$this->view('operator\tambah-data_pasien',compact('title'));
	}

	public function insert_data_pasien() {
		if (isset($_POST['simpan'])) {
			$nama    = $_POST['nama_pasien'];
			$alamat  = $_POST['alamat_pasien'];
			$gender  = $_POST['gender_pasien'];
			$umur    = $_POST['umur_pasien'];
			$telepon = $_POST['telepon_pasien'];
			$sql = "INSERT INTO pasien (nama_pasien,alamat_pasien,gender_pasien,umur_pasien,telpon_pasien) VALUES('$nama','$alamat','$gender','$umur','$telepon')";
			$execute = $this->mysqli->query($sql)or die($this->mysqli->error);
			if ($execute) {
				$_SESSION['simpan'] = 'Berhasil Menambahkan Pasien';
				return $this->redirect('?c=operator&m=data_pasien');
			}
			else {
				die('Maaf Gagal');
			}
		}
	}
	
	public function edit_data_pasien($id) {
		$title = 'Edit Data Pasien | Poliklinik 2017';
		$query = "SELECT * FROM pasien WHERE id_pasien = $id";
		$sql = $this->mysqli->query($query) or die($this->mysqli->error);
		$data = $sql->fetch_array();
		$this->view('operator\edit-data_pasien',compact('title','data'));
	}

	public function update_data_pasien($id) {
		if (isset($_POST['edit'])) {
			$nama    = $_POST['nama_pasien'];
			$alamat  = $_POST['alamat_pasien'];
			$gender  = $_POST['gender_pasien'];
			$umur    = $_POST['umur_pasien'];
			$telepon = $_POST['telepon_pasien'];
			$sql = "UPDATE pasien SET nama_pasien='$nama', alamat_pasien='$alamat', gender_pasien='$gender',umur_pasien=$umur,telpon_pasien=$telepon WHERE id_pasien=$id";
			$execute = $this->mysqli->query($sql)or die($this->mysqli->error);
			if ($execute) {
				$_SESSION['edit'] = 'Berhasil Edit Pasien';
				return $this->redirect('?c=operator&m=data_pasien');
			}
			else {
				die('Maaf Gagal');
			}
		}
	}

	public function delete_data_pasien($id) {
		$sql = "DELETE FROM pasien WHERE id_pasien = $id";
		$this->mysqli->query($sql) or die($this->mysqli->error);
		$_SESSION['hapus'] = 'Berhasil Menghapus Data';
		return $this->redirect('?c=operator&m=data_pasien');
	}

	public function export_daftar() {
		$title = 'Data Pendaftaran | Poliklinik 2017';
		$query = "SELECT pendaftaran.*,dokter.*,pasien.*,poliklinik.* FROM pendaftaran INNER JOIN dokter ON pendaftaran.id_dkt=dokter.id_dkt INNER JOIN pasien ON pendaftaran.id_pasien=pasien.id_pasien INNER JOIN poliklinik ON pendaftaran.id_poli=poliklinik.id_poli";
		$data_pendaftar = $this->mysqli->query($query)or die($this->mysqli->error);
		$cek = $data_pendaftar->num_rows;
		$this->view('operator\export-operator',compact('title','data_pendaftar','cek'));
	}

	public function data_pendaftar() {
		$title = 'Data Pendaftaran | Poliklinik 2017';
		$query = "SELECT pendaftaran.*,dokter.*,pasien.*,poliklinik.* FROM pendaftaran INNER JOIN dokter ON pendaftaran.id_dkt=dokter.id_dkt INNER JOIN pasien ON pendaftaran.id_pasien=pasien.id_pasien INNER JOIN poliklinik ON pendaftaran.id_poli=poliklinik.id_poli";
		$data_pendaftar = $this->mysqli->query($query)or die($this->mysqli->error);
		$cek = $data_pendaftar->num_rows;
		$this->view('operator\data_pendaftar-operator',compact('title','data_pendaftar','cek'));
	}

	public function tambah_data_pendaftar() {
		$title = 'Tambah Data Pendaftar | Poliklinik 2017';
		$query = "SELECT * FROM poliklinik";
		$query2 = "SELECT * FROM pasien";
		$data_poli = $this->mysqli->query($query)or die($this->mysqli->error);
		$data_pasien = $this->mysqli->query($query2)or die($this->mysqli->error);
		$this->view('operator\tambah-data_pendaftar',compact('title','data_poli','data_pasien'));
	}

	public function insert_data_pendaftar() {
		if (isset($_POST['simpan'])) {
			$tanggal = date('Y-m-d');
			$pasien  = $_POST['nama_pasien'];
			$poli    = $_POST['poli'];
			$dokter  = $_POST['dokter'];
			$biaya   = 50000;
			$ket     = $_POST['ket'];

			$query = "INSERT INTO pendaftaran (tgl_daftar,id_dkt,id_pasien,id_poli,biaya,ket) VALUES ('$tanggal','$dokter','$pasien','$poli',$biaya,'$ket')";
			$query2 = "SELECT tarif FROM dokter WHERE id_dkt=$dokter";
			$execute = $this->mysqli->query($query)or die($this->mysqli->error);
			$id_daftar = $this->mysqli->insert_id;
			$execute2 = $this->mysqli->query($query2)or die($this->mysqli->error);
			$get_biaya = $execute2->fetch_array();
			
			$bayar = $get_biaya['tarif'] + $biaya;
			$query3 = "INSERT INTO pembayaran(id_pendaftaran,tgl_byr,jumlah_byr) VALUES($id_daftar,'$tanggal','$bayar')";
			$execute3 = $this->mysqli->query($query3)or die($this->mysqli->error);
			return $this->redirect('?c=operator&m=bayar_pendaftar&id='.$id_daftar);
		}
	}

	public function get_dokter($poli) {
		$query = "SELECT id_dkt,nama_dkt FROM dokter WHERE id_poli=$poli";
		$data = $this->mysqli->query($query)or die($this->mysqli->error);
		foreach ($data as $dokter) {
			echo '<option value="'.$dokter['id_dkt'].'">'.$dokter['nama_dkt'].'</option>';
		}
	}

	public function bayar($id) {
		if (isset($_POST['simpan'])) {
			$bayar   = $_POST['bayar'];
			$kembali = $_POST['kembali'];
			$query = "UPDATE pembayaran SET bayar=$bayar,kembali=$kembali WHERE id_pendaftaran=$id";
			$execute = $this->mysqli->query($query)or die($this->mysqli->error);
			$_SESSION['simpan'] = 'Berhasil Mendaftarkan Pasien';
			return $this->redirect('?c=operator&m=data_pendaftar');
		}
	}

	public function bayar_pendaftar($id) {
		$title = 'Bayar Pendaftar | Poliklinik 2017';
		$query = "SELECT pembayaran.*,pendaftaran.*,pasien.*,dokter.*,poliklinik.* FROM pembayaran INNER JOIN pendaftaran ON pembayaran.id_pendaftaran=pendaftaran.id_pendaftaran INNER JOIN pasien ON pendaftaran.id_pasien=pasien.id_pasien INNER JOIN dokter ON pendaftaran.id_dkt=dokter.id_dkt INNER JOIN poliklinik ON pendaftaran.id_poli=poliklinik.id_poli WHERE pembayaran.id_pendaftaran=$id";
		$execute = $this->mysqli->query($query)or die($this->mysqli->error);
		$data = $execute->fetch_object();
		$this->view('operator\bayar-pendaftar',compact('title','data'));
	}

	public function detail_data_pendaftar($id) {
		$title = 'Detail Data Pendaftar | Poliklinik 2017';
		$query = "SELECT pembayaran.*,pendaftaran.*,pasien.*,dokter.*,poliklinik.* FROM pembayaran INNER JOIN pendaftaran ON pembayaran.id_pendaftaran=pendaftaran.id_pendaftaran INNER JOIN pasien ON pendaftaran.id_pasien=pasien.id_pasien INNER JOIN dokter ON pendaftaran.id_dkt=dokter.id_dkt INNER JOIN poliklinik ON pendaftaran.id_poli=poliklinik.id_poli WHERE pembayaran.id_pendaftaran=$id";
		$execute = $this->mysqli->query($query)or die($this->mysqli->error);
		$data = $execute->fetch_object();
		$this->view('operator\detail-data_pendaftar',compact('title','data'));
	}

	public function delete_data_pendaftar($id) {
		$query = "DELETE FROM pendaftaran WHERE id_pendaftaran=$id";
		$this->mysqli->query($query)or die($this->mysqli->error);
		$_SESSION['hapus'] = 'Berhasil Menghapus Data';
		return $this->redirect('?c=operator&m=data_pendaftar');
	}
}