<?php 
use Core\Controllers;

class AuthController extends Controllers {
	public function __construct() {
		parent::__construct();
		if (isset($_SESSION['login'])) {
			if ($_SESSION['login']['level'] == 0) {
				return $this->redirect('?c=operator');
			}
			elseif ($_SESSION['login']['level'] == 1) {
				return $this->redirect('?c=petugas');
			}
			elseif ($_SESSION['login']['level'] == 2) {
				return $this->redirect('?c=admin');
			}
		}
	}

	public function index() {
		$this->view('login');
	}

	public function authenticate() {
		if ($_SERVER['REQUEST_METHOD']=="POST") {
			$username = $_POST['username'];
			$password = $_POST['password'];
			if ($username != '' && $password !='') {
				$query = "SELECT * FROM users WHERE username=?";
				$execute = $this->mysqli->prepare($query);
				$execute->bind_param('s',$username);
				$execute->execute();
				$get = $execute->get_result();
				$object = $get->fetch_array();
				$hash = password_verify($password,$object['password']);
				if ($get->num_rows != 0 && $hash) {
					$_SESSION['login'] = [
						'id_login'   => $object['id_users'],
						'username'   => $object['username'],
						'stts_login' => $object['stts_login'],
						'stts_akun'  => $object['stts_akun'],
						'level'      => $object['level']
					];
					if ($_SESSION['login']['stts_login'] == '1' && $_SESSION['login']['stts_akun'] == '1') {
						unset($_SESSION['login']);
						$_SESSION['fail'] = 'Maaf Akun Sedang Digunakan';
						return $this->redirect('?c=auth');
						die;
					}
					elseif($_SESSION['login']['stts_login'] == '0' && $_SESSION['login']['stts_akun'] == '1') {
						$this->UpdateLogin($_SESSION['login']['id_login']);
						// var_dump($_SESSION['login']['id_login']);
						// die;
						if ($_SESSION['login']['level'] == '0') {
							return $this->redirect('?c=operator');
						}
						elseif ($_SESSION['login']['level'] == '1') {
							return $this->redirect('?c=petugas');
						}
						elseif ($_SESSION['login']['level'] == '2') {
							return $this->redirect('?c=admin');
						}
					}
					elseif($_SESSION['login']['stts_akun'] == '0') {
						unset($_SESSION['login']);
						$_SESSION['fail'] = 'Akun Non Aktif';
						return $this->redirect('?c=auth');
						die;
					}
				}
				else {
					$_SESSION['fail'] = 'Maaf User Tidak Ada';
					return $this->redirect('?c=auth');
					die;
				}
			}
			else {
				$_SESSION['fail'] = 'Isi Username Dan Password Terlebih Dahulu';
				return $this->redirect('?c=auth');
				die;
			}
		}	
		else {
			die('MethodExeptions!!');
		}
	}

	private function UpdateLogin($id) {
		$sql = "UPDATE users SET stts_login = 1 WHERE id_users = $id";
		$execute = $this->mysqli->query($sql)or die($this->mysqli->error);
		return $execute;
	}

	public function logout() {
		$query = "UPDATE users SET stts_login = 0 WHERE id_users = ".$_SESSION['login']['id_login'];
		$this->mysqli->query($query)or die($this->mysqli->error);
		session_destroy();
		return $this->redirect('?c=auth');
	}
}