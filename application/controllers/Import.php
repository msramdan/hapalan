<?php
defined('BASEPATH') OR exit('No direct script access allowed');


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
require 'vendor/autoload.php';

class Import extends CI_Controller {
public function __construct(){
	parent::__construct();
}

public function index(){
	$this->load->view('guru/import_guru');
	}

public function import(){
		$host       = "localhost";
		$user       = "root";
		$password   = "";
		$database   = "db_juz";
		$koneksi    = mysqli_connect($host, $user, $password, $database);

		if(isset($_POST['import'])){
			$file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

			if(isset($_FILES['berkas_excel']['name']) && in_array($_FILES['berkas_excel']['type'], $file_mimes)) {
			 
			    $arr_file = explode('.', $_FILES['berkas_excel']['name']);
			    $extension = end($arr_file);
			 
			    if('csv' == $extension) {
			        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
			    } else {
			        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			    }
			 
			    $spreadsheet = $reader->load($_FILES['berkas_excel']['tmp_name']);
			     
			    $sheetData = $spreadsheet->getActiveSheet()->toArray();
			    $jml = 0;
			    for($i = 1;$i < count($sheetData);$i++)
			    {

			    	$nip     = $sheetData[$i]['1'];
			        $nama_guru     = $sheetData[$i]['2'];
			        $jenis_kelamin    = $sheetData[$i]['3'];
			        $alamat = $sheetData[$i]['4'];
			        $password = sha1($sheetData[$i]['5']);
			        $email = $sheetData[$i]['6'];
			        $level= $sheetData[$i]['7'];

			        $result=mysqli_query($koneksi,"select * from guru where nip='$nip'");
			        $rowcount=mysqli_num_rows($result);

			        if ($rowcount > 0) {
			        	// $jml = $jml + 1;
			        }else{
			        	mysqli_query($koneksi,"insert into user (user_id,username,password,level,email) values ('','$nip','$password','$level','$email')");
			        $user_id =mysqli_insert_id($koneksi);
			        mysqli_query($koneksi,"insert into guru (guru_id,nip,nama_guru,jenis_kelamin,alamat, user_id) values ('','$nip','$nama_guru','$jenis_kelamin','$alamat','$user_id')");
			        $jml = $jml + 1;
			        }
			        
			    }
			    $data1 =$jml;
			    $data2 ='Data di Import';
			    $result = $data1 . ' ' . $data2;
			    $this->session->set_flashdata('message',$result);
           		redirect(site_url('guru'));

			}
			 
			}
	}


	public function import_siswa(){
		$kelas_id = $this->uri->segment(3);
		$host       = "localhost";
		$user       = "root";
		$password   = "";
		$database   = "db_juz";
		$koneksi    = mysqli_connect($host, $user, $password, $database);

		if(isset($_POST['import'])){
			$file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

			if(isset($_FILES['berkas_excel']['name']) && in_array($_FILES['berkas_excel']['type'], $file_mimes)) {
			 
			    $arr_file = explode('.', $_FILES['berkas_excel']['name']);
			    $extension = end($arr_file);
			    $kelas_id = $this->input->post('kelas_id');

			    if('csv' == $extension) {
			        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
			    } else {
			        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			    }
			 
			    $spreadsheet = $reader->load($_FILES['berkas_excel']['tmp_name']);
			     
			    $sheetData = $spreadsheet->getActiveSheet()->toArray();
			    $jml = 0;
			    for($i = 1;$i < count($sheetData);$i++)
			    {
			        $nis     = $sheetData[$i]['1'];
			        $nama_siswa    = $sheetData[$i]['2'];
			        $jenis_kelamin     = $sheetData[$i]['3'];
			        // $kelas_id = $sheetData[$i]['4'];
			        $nama_ibu = $sheetData[$i]['4'];
			        $nama_ayah = $sheetData[$i]['5'];
			        $no_hp_wali_murid = $sheetData[$i]['6'];
			        $level= $sheetData[$i]['7'];
			        $password = sha1($sheetData[$i]['8']);
			        $email = $sheetData[$i]['9'];


			        $result=mysqli_query($koneksi,"select * from siswa where nis='$nis'");
			        $rowcount=mysqli_num_rows($result);

			        if ($rowcount > 0) {
			        	// $jml = $jml + 1;
			        }else{
			        	mysqli_query($koneksi,"insert into user (user_id,username,password,level,email) values ('','$nis','$password','$level','$email')");
			        	$user_id =mysqli_insert_id($koneksi);
			        	mysqli_query($koneksi,"insert into siswa (siswa_id,nis,nama_siswa,jenis_kelamin,kelas_id, nama_ibu,nama_ayah,no_hp_wali_murid,user_id) values ('','$nis','$nama_siswa','$jenis_kelamin','$kelas_id','$nama_ibu','$nama_ayah','$no_hp_wali_murid','$user_id')");
			        	$jml = $jml + 1;
			        }
			        
			        
			    }

			    $data1 =$jml;
			    $data2 ='Data di Import';
			    $result = $data1 . ' ' . $data2;
			    $this->session->set_flashdata('message',$result);
           		redirect(site_url('siswa/grup'));
				}
			 
			}
	}
}