<?php 
use Core\Controllers;
use App\Models\Pasien;
use App\Models\Obat;
use App\Models\Resep;
use App\Models\Poliklinik;
use App\Models\Dokter;
use App\Models\Pendaftaran;
use App\Models\Pembayaran;

class AdminController extends Controllers
{
	public $pasien;
	public $obat;
	public $resep;
	public $poli;
	public $dokter;
	public $pendaftar;
	public function __construct() {
		parent::__construct();
		if (!isset($_SESSION['login'])) {
			$_SESSION['fail'] = 'Maaf Login Terlebih Dahulu';
			return $this->redirect('?c=auth');
			die;
		}
		elseif(isset($_SESSION['login']) && $_SESSION['login']['level'] != 2) {
			return $this->redirect('?=auth');
		}

		$this->pasien    = new Pasien;
		$this->obat      = new Obat;
		$this->resep     = new Resep;
		$this->poli      = new Poliklinik;
		$this->dokter    = new Dokter;
		$this->pendaftar = new Pendaftaran;
	}

	public function index() {
		$title          = 'Admin | Poliklinik 2017';
		$rows_pasien    = $this->pasien->rowsAll();
		$rows_obat		= $this->obat->rowsAll();
		$rows_resep     = $this->resep->rowsAll();
		$rows_poli      = $this->poli->rowsAll();
		$rows_dokter    = $this->dokter->rowsAll();
		$rows_pendaftar = $this->pendaftar->rowsAll();
		$this->view('admin\admin',compact('title','rows_pasien','rows_obat','rows_resep','rows_poli','rows_dokter','rows_pendaftar'));
	}

	public function data_pasien() {
		$title = 'Data Pasien | Poliklinik 2017';
		$data_pasien = $this->pasien->all();
		$cek = $this->pasien->rowsAll();
		$this->view('admin\data_pasien-admin',compact('title','data_pasien','cek'));
	}

	public function tambah_data_pasien() {
		$title = 'Tambah Data Pasien | Poliklinik 2017';
		$this->view('admin\tambah-data_pasien',compact('title'));
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
				return $this->redirect('?c=admin&m=data_pasien');
			}
			else {
				die('Maaf Gagal');
			}
		}
	}

	public function edit_data_pasien($id) {
		$query = "SELECT * FROM pasien WHERE id_pasien = $id";
		$sql = $this->mysqli->query($query) or die($this->mysqli->error);
		$data = $sql->fetch_array();
		$this->view('admin\edit-data_pasien',compact('data'));
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
				return $this->redirect('?c=admin&m=data_pasien');
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
		return $this->redirect('?c=admin&m=data_pasien');
	}

	public function data_resep() {
		$title = 'Data Resep | Poliklinik 2017';
		// $data_resep = $this->resep->all();
		$query = "SELECT resep.*,pasien.*,dokter.*,poliklinik.* FROM resep INNER JOIN dokter ON resep.id_dkt=dokter.id_dkt INNER JOIN pasien ON resep.id_pasien=pasien.id_pasien INNER JOIN poliklinik ON resep.id_poli=poliklinik.id_poli";
		$data_resep = $this->mysqli->query($query)or die($this->mysqli->error);
		$cek = $this->resep->rowsAll();
		$this->view('admin\data_resep-admin',compact('title','data_resep','cek'));
	}

	public function tambah_data_resep() {
		$title = 'Tambah Data Resep | Poliklinik 2017';
		$data_pasien = $this->pasien->all();
		$data_poli = $this->poli->all();
		$data_obat = $this->obat->all();
		$this->view('admin\tambah-data_resep',compact('title','data_pasien','data_poli','data_obat'));
	}

	public function insert_data_resep() {
		if (isset($_POST['simpan'])) {
			$tgl = date('Y-m-d');
			$nama = $_POST['pasien'];
			$dokter = $_POST['dokter'];
			$poli = $_POST['poli'];
			$obat = $_POST['obat'];
			$jmlh = $_POST['bnyk_obt'];
			$dosis = $_POST['dosis_obt'];
			$total = $_POST['total_harga'];
			$bayar = $_POST['bayar'];
			$kembali = $_POST['kembali'];
			$query1 = "INSERT INTO resep(tgl_resep,id_dkt,id_pasien,id_poli,total_harga,bayar,kembali) VALUES ('$tgl','$dokter','$nama','$poli','$total','$bayar','$kembali')";
			$this->mysqli->query($query1)or die($this->mysqli->error);
			$id_resep = $this->mysqli->insert_id;
			foreach ($obat as $key => $value) {
				$query2 = "SELECT harga_obat FROM obat WHERE id_obat = $obat[$key]";
				$execute = $this->mysqli->query($query2)or die($this->mysqli->error);
				$array = $execute->fetch_array();
				$sub_total = $jmlh[$key] * $array['harga_obat'];
				$data_dosis = $dosis[$key];
				$query3 = "INSERT INTO detail(id_resep,id_obat,banyak_obat,dosis,sub_total) VALUES($id_resep,$obat[$key],$jmlh[$key],'$data_dosis',$sub_total)";
				$this->mysqli->query($query3)or die($this->mysqli->error);
			}
			$_SESSION['simpan'] = 'Berhasil Menambah Resep';
			return $this->redirect('?c=admin&m=data_resep');
		}
	}

	public function detail_data_resep($id) {
		$title = 'Detail Data Resep | Poliklinik 2017';
		$query = "SELECT resep.*,pasien.*,dokter.*,poliklinik.* FROM resep INNER JOIN dokter ON resep.id_dkt=dokter.id_dkt INNER JOIN pasien ON resep.id_pasien=pasien.id_pasien INNER JOIN poliklinik ON resep.id_poli=poliklinik.id_poli WHERE id_resep=$id";
		$query2 = "SELECT detail.*,obat.* FROM detail INNER JOIN obat ON detail.id_obat=obat.id_obat WHERE id_resep=$id";
		$data_resep = $this->mysqli->query($query)or die($this->mysqli->error);
		$rows = $data_resep->fetch_object();
		$data_detail = $this->mysqli->query($query2)or die($this->mysqli->error);
		$this->view('admin\detail-data_resep',compact('title','rows','data_detail'));
	}

	public function delete_data_resep($id) {
		$query = "DELETE FROM resep WHERE id_resep=$id";
		$this->mysqli->query($query)or die($this->mysqli->error);
		$_SESSION['hapus'] = 'Berhasil Menghapus Resep';
		return $this->redirect('?c=admin&m=data_resep');
	}

	public function data_obat() {
		$title = 'Data Obat | Poliklinik 2017';
		$data_obat = $this->obat->all();
		$cek = $this->obat->rowsAll();
		$this->view('admin\data_obat-admin',compact('title','data_obat','cek'));
	}

	public function tambah_data_obat() {
		$title = 'Tambah Data Pasien | Poliklinik 2017';
		$this->view('admin\tambah-data_obat',compact('title'));
	}

	public function insert_data_obat() {
		if (isset($_POST['simpan'])) {
			$nama     = $_POST['nama_obat'];
			$jenis    = $_POST['jenis_obat'];
			$kategori = $_POST['kategori'];
			$harga    = $_POST['harga_obat'];
			$jumlah   = $_POST['jumlah_obat'];
			$sql = "INSERT INTO obat (nama_obat,jenis_obat,kategori,harga_obat,jumlah_obat) VALUES('$nama','$jenis','$kategori','$harga','$jumlah')";
			$execute = $this->mysqli->query($sql)or die($this->mysqli->error);
			if ($execute) {
				$_SESSION['simpan'] = 'Berhasil Menambahkan Obat';
				return $this->redirect('?c=admin&m=data_obat');
			}
			else {
				die('Maaf Gagal');
			}
		}
	}

	public function edit_data_obat($id) {
		$query = "SELECT * FROM obat WHERE id_obat=$id";
		$sql = $this->mysqli->query($query)or die($this->mysqli->error);
		$data = $sql->fetch_array();
		$this->view('admin\edit-data_obat',compact('data'));
	}

	public function update_data_obat($id) {
		if (isset($_POST['edit'])) {
			$nama    = $_POST['nama_obat'];
			$jenis  = $_POST['jenis_obat'];
			$kategori  = $_POST['kategori'];
			$harga    = $_POST['harga_obat'];
			$jumlah = $_POST['jumlah_obat'];
			$sql = "UPDATE obat SET nama_obat='$nama',jenis_obat='$jenis',kategori='$kategori',harga_obat=$harga,jumlah_obat=$jumlah WHERE id_obat = $id";
			$execute = $this->mysqli->query($sql)or die($this->mysqli->error);
			if ($execute) {
				$_SESSION['edit'] = 'Berhasil Edit Obat';
				return $this->redirect('?c=admin&m=data_obat');
			}
			else {
				die('Maaf Gagal');
			}
		}
	}

	public function delete_data_obat($id) {
		$sql = "DELETE FROM obat WHERE id_obat = $id";
		$this->mysqli->query($sql) or die($this->mysqli->error);
		$_SESSION['hapus'] = 'Berhasil Menghapus Data';
		return $this->redirect('?c=admin&m=data_obat');
	}

	public function data_poli() {
		$title = 'Data Poli | Poliklinik 2017';
		$get_poli = $this->poli->all();
		$cek = $this->poli->rowsAll();
		$this->view('admin\data_poli-admin',compact('title','get_poli','cek'));
	}

	public function tambah_data_poli() {
		$title = 'Tambah Data Pasien | Poliklinik 2017';
		$this->view('admin\tambah-data_poli',compact('title'));
	}

	public function insert_data_poli() {
		if (isset($_POST['simpan'])) {
			$poli   = $_POST['nama_poli'];
			$sql = "INSERT INTO poliklinik (nama_poli) VALUES('$poli')";
			$execute = $this->mysqli->query($sql)or die($this->mysqli->error);
			if ($execute) {
				$_SESSION['simpan'] = 'Berhasil Menambahkan Poli';
				return $this->redirect('?c=admin&m=data_poli');
			}
			else {
				die('Maaf Gagal');
			}
		}
	}

	public function edit_data_poli($id) {
		$title = 'Edit Data Pasien | Poliklinik 2017';
		$query = "SELECT * FROM poliklinik WHERE id_poli=$id";
		$execute = $this->mysqli->query($query)or die($this->mysqli->error);
		$data = $execute->fetch_array();
		$this->view('admin\edit-data_poli',compact('title','data'));
	}

	public function update_data_poli($id) {
		if (isset($_POST['edit'])) {
			$poli   = $_POST['nama_poli'];
			$sql = "UPDATE poliklinik SET nama_poli='$poli' WHERE id_poli=$id";
			$execute = $this->mysqli->query($sql)or die($this->mysqli->error);
			if ($execute) {
				$_SESSION['edit'] = 'Berhasil edit Poli';
				return $this->redirect('?c=admin&m=data_poli');
			}
			else {
				die('Maaf Gagal');
			}
		}
	}

	public function delete_data_poli($id) {
		$sql = "DELETE FROM poliklinik WHERE id_poli = $id";
		$this->mysqli->query($sql) or die($this->mysqli->error);
		$_SESSION['hapus'] = 'Berhasil Menghapus Data';
		return $this->redirect('?c=admin&m=data_poli');
	}

	public function data_dokter() {
		$title = 'Data Dokter | Poliklinik 2017';
		$query = "SELECT dokter.*,poliklinik.nama_poli FROM dokter INNER JOIN poliklinik ON dokter.id_poli=poliklinik.id_poli";
		$get_dokter = $this->mysqli->query($query)or die($this->mysqli->error);
		$cek = $get_dokter->num_rows;
		$this->view('admin\data_dokter-admin',compact('title','get_dokter','cek'));
	}

	public function tambah_data_dokter() {
		$title = 'Tambah Data Pasien | Poliklinik 2017';
		$poli = $this->poli->all();
		$this->view('admin\tambah-data_dokter',compact('title','poli'));
	}

	public function insert_data_dokter() {
		if (isset($_POST['simpan'])) {
			$nama    = $_POST['nama_dkt'];
			$alamat  = $_POST['spesialis'];
			$gender  = $_POST['alamat_dkt'];
			$umur    = $_POST['telepon_dkt'];
			$telepon = $_POST['id_poli'];
			$tarif   = $_POST['tarif'];
			$sql = "INSERT INTO dokter (nama_dkt,spesialis,alamat_dkt,telepon_dkt,id_poli,tarif) VALUES('$nama','$alamat','$gender','$umur','$telepon','$tarif')";
			$execute = $this->mysqli->query($sql)or die($this->mysqli->error);
			if ($execute) {
				$_SESSION['simpan'] = 'Berhasil Menambahkan Dokter';
				return $this->redirect('?c=admin&m=data_dokter');
			}
			else {
				die('Maaf Gagal');
			}
		}
	}

	public function edit_data_dokter($id) {
		$query = "SELECT * FROM dokter WHERE id_dkt = $id";
		$sql = $this->mysqli->query($query) or die($this->mysqli->error);
		$data = $sql->fetch_array();
		$this->view('admin\edit-data_dokter',compact('data'));	
	}

	public function delete_data_dokter($id) {
		$sql = "DELETE FROM dokter WHERE id_dkt = $id";
		$this->mysqli->query($sql) or die($this->mysqli->error);
		$_SESSION['hapus'] = 'Berhasil Menghapus Data';
		return $this->redirect('?c=admin&m=data_dokter');
	}

	public function data_pendaftar() {
		$title = 'Data Pendaftaran | Poliklinik 2017';
		$query = "SELECT pendaftaran.*,dokter.*,pasien.*,poliklinik.* FROM pendaftaran INNER JOIN dokter ON pendaftaran.id_dkt=dokter.id_dkt INNER JOIN pasien ON pendaftaran.id_pasien=pasien.id_pasien INNER JOIN poliklinik ON pendaftaran.id_poli=poliklinik.id_poli";
		$data_pendaftar = $this->mysqli->query($query)or die($this->mysqli->error);
		$cek = $data_pendaftar->num_rows;
		$this->view('admin\data_pendaftar-admin',compact('title','data_pendaftar','cek'));
	}

	public function tambah_data_pendaftar() {
		$title = 'Tambah Data Pendaftar | Poliklinik 2017';
		$query = "SELECT * FROM poliklinik";
		$query2 = "SELECT * FROM pasien";
		$data_poli = $this->mysqli->query($query)or die($this->mysqli->error);
		$data_pasien = $this->mysqli->query($query2)or die($this->mysqli->error);
		$this->view('admin\tambah-data_pendaftar',compact('title','data_poli','data_pasien'));
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
			return $this->redirect('?c=admin&m=bayar_pendaftar&id='.$id_daftar);
		}
	}

	public function bayar($id) {
		if (isset($_POST['simpan'])) {
			$bayar   = $_POST['bayar'];
			$kembali = $_POST['kembali'];
			$query = "UPDATE pembayaran SET bayar=$bayar,kembali=$kembali WHERE id_pendaftaran=$id";
			$execute = $this->mysqli->query($query)or die($this->mysqli->error);
			$_SESSION['simpan'] = 'Berhasil Mendaftarkan Pasien';
			return $this->redirect('?c=admin&m=data_pendaftar');
		}
	}

	public function bayar_pendaftar($id) {
		$title = 'Bayar Pendaftar | Poliklinik 2017';
		$query = "SELECT pembayaran.*,pendaftaran.*,pasien.*,dokter.*,poliklinik.* FROM pembayaran INNER JOIN pendaftaran ON pembayaran.id_pendaftaran=pendaftaran.id_pendaftaran INNER JOIN pasien ON pendaftaran.id_pasien=pasien.id_pasien INNER JOIN dokter ON pendaftaran.id_dkt=dokter.id_dkt INNER JOIN poliklinik ON pendaftaran.id_poli=poliklinik.id_poli WHERE pembayaran.id_pendaftaran=$id";
		$execute = $this->mysqli->query($query)or die($this->mysqli->error);
		$data = $execute->fetch_object();
		$this->view('admin\bayar-pendaftar',compact('title','data'));
	}

	public function detail_data_pendaftar($id) {
		$title = 'Detail Data Pendaftar | Poliklinik 2017';
		$query = "SELECT pembayaran.*,pendaftaran.*,pasien.*,dokter.*,poliklinik.* FROM pembayaran INNER JOIN pendaftaran ON pembayaran.id_pendaftaran=pendaftaran.id_pendaftaran INNER JOIN pasien ON pendaftaran.id_pasien=pasien.id_pasien INNER JOIN dokter ON pendaftaran.id_dkt=dokter.id_dkt INNER JOIN poliklinik ON pendaftaran.id_poli=poliklinik.id_poli WHERE pembayaran.id_pendaftaran=$id";
		$execute = $this->mysqli->query($query)or die($this->mysqli->error);
		$data = $execute->fetch_object();
		$this->view('admin\detail-data_pendaftar',compact('title','data'));
	}

	public function delete_data_pendaftar($id) {
		$query = "DELETE FROM pendaftaran WHERE id_pendaftaran=$id";
		$this->mysqli->query($query)or die($this->mysqli->error);
		$_SESSION['hapus'] = 'Berhasil Menghapus Data';
		return $this->redirect('?c=admin&m=data_pendaftar');
	}

	public function data_user() {
		$title = 'Data User | Poliklinik 2017';
		$query = "SELECT * FROM users WHERE level IN (0,1)";
		$data_user = $this->mysqli->query($query)or die($this->mysqli->error);
		$cek = $data_user->num_rows;
		$this->view('admin\data_user-admin',compact('title','data_user','cek'));
	}

	public function aktif_user($id) {
		$query = "UPDATE users SET stts_akun=1 WHERE id_users=$id";
		$this->mysqli->query($query)or die($this->mysqli->error);
		$_SESSION['simpan'] = 'Berhasil Aktifkan Akun';
		return $this->redirect('?c=admin&m=data_user');
	}

	public function nonaktif_user($id) {
		$query = "UPDATE users SET stts_akun=0 WHERE id_users=$id";
		$this->mysqli->query($query)or die($this->mysqli->error);
		$_SESSION['hapus'] = 'Berhasil Nonaktifkan Akun';
		return $this->redirect('?c=admin&m=data_user');
	}

	public function pengaturan_akun($id) {
		
	}

	public function get_dokter($poli) {
		$query = "SELECT id_dkt,nama_dkt FROM dokter WHERE id_poli=$poli";
		$data = $this->mysqli->query($query)or die($this->mysqli->error);
		foreach ($data as $dokter) {
			echo '<option value="'.$dokter['id_dkt'].'">'.$dokter['nama_dkt'].'</option>';
		}
	}

	public function export_daftar() {
		$title = 'Data Pendaftaran | Poliklinik 2017';
		$query = "SELECT pendaftaran.*,dokter.*,pasien.*,poliklinik.* FROM pendaftaran INNER JOIN dokter ON pendaftaran.id_dkt=dokter.id_dkt INNER JOIN pasien ON pendaftaran.id_pasien=pasien.id_pasien INNER JOIN poliklinik ON pendaftaran.id_poli=poliklinik.id_poli";
		$data_pendaftar = $this->mysqli->query($query)or die($this->mysqli->error);
		$cek = $data_pendaftar->num_rows;
		$this->view('admin\export-admin',compact('title','data_pendaftar','cek'));
	}

	public function get_harga($obat) {
		$query = "SELECT harga_obat FROM obat WHERE id_obat=$obat";
		$execute = $this->mysqli->query($query)or die($this->mysqli->error);
		$rows = $execute->fetch_object();
		echo $rows->harga_obat;
	}
}