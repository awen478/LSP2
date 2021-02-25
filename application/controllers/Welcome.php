<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		if(isset($_GET['o'])){
			switch($_GET['o']){
				case 't':
					$this->load->view('tambah');
					break;
				case 'h':
					$this->hapus($_GET['id']);
					header('Location: http://' . $_SERVER['HTTP_HOST'] . '/lsp/');
					break;
				case 'u':
					$d['data'] = $this->pilih($_GET['id']);
					$this->load->view('ubah', $d);
					break;
			}
		}elseif(isset($_POST['d'])){
			switch($_POST['d']){
				case 'u':
					$this->ubah($_POST['kd'], $_POST['nm']);
					break;
				case 't':
					$this->tambah($_POST['kd'], $_POST['nm']);
					break;
			}
			$d['data'] = $this->ambil();
			$this->load->view('utama', $d);
		}else{
			$d['data'] = $this->ambil();
			$this->load->view('utama', $d);
		}
	}
	public function ambil(){
		$this->load->database();
		$query = $this->db->query("select * from mahasiswa");
		return $query;
	}
	public function pilih($id){
		$this->load->database();
		$query = $this->db->query("select * from mahasiswa where npm = '".$id."'");
		return $query;
	}
	public function ubah($id,$nama){
		$this->load->database();
		$this->db->query("update mahasiswa SET nama_mhs='".$nama."' WHERE npm='".$id."'");
	}
	public function tambah($id,$nama){
		$this->load->database();
		$this->db->query("insert into mahasiswa values('".$id."','".$nama."')");
	}
	public function hapus($id){
		$this->load->database();
		$this->db->query("delete from mahasiswa where npm = '".$id."'");
	}
}
