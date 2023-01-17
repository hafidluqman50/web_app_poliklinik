<?php 
use Core\Controllers;
use App\Models\Obat;
use App\Models\Resep;
use App\Models\Pembayaran;
use App\Models\Pasien;
use App\Models\Poliklinik;

class PetugasController extends Controllers 
{
	public $obat;
	public $resep;
	public $bayar;
	public $pasien;
	public $poli;

	public function __construct() {
		parent::__construct();
		if (!isset($_SESSION['login'])) {
			$_SESSION['fail'] = 'Maaf Login Terlebih Dahulu';
			return $this->redirect('?c=auth');
			die;
		}
		elseif(isset($_SESSION['login']) && $_SESSION['login']['level'] != 1) {
			return $this->location('?=auth');
		}
		$this->obat      = new Obat;
		$this->resep     = new Resep;
		$this->bayar 	 = new Pembayaran;
		$this->pasien 	 = new Pasien;
		$this->poli      = new Poliklinik;
	}

	public function index() {
		$title = 'Petugas | Poliklinik 2017';
		$rows_obat		= $this->obat->rowsAll();
		$rows_resep     = $this->resep->rowsAll();
		$rows_pembayaran = $this->bayar->rowsAll();
		$this->view('petugas/petugas',compact('title','rows_obat','rows_resep','rows_pembayaran'));
	}

	public function data_obat() {
		$title = 'Data Obat | Poliklinik 2017';
		$data_obat = $this->obat->all();
		$cek = $this->obat->rowsAll();
		$this->view('petugas\data_obat-petugas',compact('title','data_obat','cek'));
	}

	public function tambah_data_obat() {
		$title = 'Tambah Data Pasien | Poliklinik 2017';
		$this->view('petugas\tambah-data_obat',compact('title'));
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
				return $this->redirect('?c=petugas&m=data_obat');
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
		$this->view('petugas\edit-data_obat',compact('data'));
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
				return $this->redirect('?c=petugas&m=data_obat');
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
		return $this->redirect('?c=petugas&m=data_obat');
	}

	public function data_resep() {
		$title = 'Data Resep | Poliklinik 2017';
		// $data_resep = $this->resep->all();
		$query = "SELECT resep.*,pasien.*,dokter.*,poliklinik.* FROM resep INNER JOIN dokter ON resep.id_dkt=dokter.id_dkt INNER JOIN pasien ON resep.id_pasien=pasien.id_pasien INNER JOIN poliklinik ON resep.id_poli=poliklinik.id_poli";
		$data_resep = $this->mysqli->query($query)or die($this->mysqli->error);
		$cek = $this->resep->rowsAll();
		$this->view('petugas\data_resep-petugas',compact('title','data_resep','cek'));
	}

	public function tambah_data_resep() {
		$title = 'Tambah Data Resep | Poliklinik 2017';
		$data_pasien = $this->pasien->all();
		$data_poli = $this->poli->all();
		$data_obat = $this->obat->all();
		$this->view('petugas\tambah-data_resep',compact('title','data_pasien','data_poli','data_obat'));
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
			return $this->redirect('?c=petugas&m=data_resep');
		}
	}

	public function detail_data_resep($id) {
		$title = 'Detail Data Resep | Poliklinik 2017';
		$query = "SELECT resep.*,pasien.*,dokter.*,poliklinik.* FROM resep INNER JOIN dokter ON resep.id_dkt=dokter.id_dkt INNER JOIN pasien ON resep.id_pasien=pasien.id_pasien INNER JOIN poliklinik ON resep.id_poli=poliklinik.id_poli WHERE id_resep=$id";
		$query2 = "SELECT detail.*,obat.* FROM detail INNER JOIN obat ON detail.id_obat=obat.id_obat WHERE id_resep=$id";
		$data_resep = $this->mysqli->query($query)or die($this->mysqli->error);
		$rows = $data_resep->fetch_object();
		$data_detail = $this->mysqli->query($query2)or die($this->mysqli->error);
		$this->view('petugas\detail-data_resep',compact('title','rows','data_detail'));
	}

	public function delete_data_resep($id) {
		$query = "DELETE FROM resep WHERE id_resep=$id";
		$this->mysqli->query($query)or die($this->mysqli->error);
		$_SESSION['hapus'] = 'Berhasil Menghapus Resep';
		return $this->redirect('?c=petugas&m=data_resep');
	}

	public function get_harga($obat) {
		$query = "SELECT harga_obat FROM obat WHERE id_obat=$obat";
		$execute = $this->mysqli->query($query)or die($this->mysqli->error);
		$rows = $execute->fetch_object();
		echo $rows->harga_obat;
	}

	public function get_dokter($poli) {
		$query = "SELECT id_dkt,nama_dkt FROM dokter WHERE id_poli=$poli";
		$data = $this->mysqli->query($query)or die($this->mysqli->error);
		foreach ($data as $dokter) {
			echo '<option value="'.$dokter['id_dkt'].'">'.$dokter['nama_dkt'].'</option>';
		}
	}
}