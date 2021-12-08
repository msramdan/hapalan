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
			        $level= $sheetData[$i]['6'];

			        $result=mysqli_query($koneksi,"select * from guru where nip='$nip'");
			        $rowcount=mysqli_num_rows($result);

			        if ($rowcount > 0) {
			        	// $jml = $jml + 1;
			        }else{
			        	mysqli_query($koneksi,"insert into user (user_id,username,password,level) values ('','$nip','$password','$level')");
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
			        $nisn    = $sheetData[$i]['2'];
			        $nama_siswa    = $sheetData[$i]['3'];
			        $jenis_kelamin     = $sheetData[$i]['4'];
			        $nama_ibu = $sheetData[$i]['5'];
			        $nama_ayah = $sheetData[$i]['6'];
			        $no_hp_wali_murid = $sheetData[$i]['7'];
			        $level= $sheetData[$i]['8'];
			        $password = sha1($sheetData[$i]['9']);


			        $result=mysqli_query($koneksi,"select * from siswa where nis='$nis'");
			        $rowcount=mysqli_num_rows($result);

			        if ($rowcount > 0) {
			        	// $jml = $jml + 1;
			        }else{
			        	mysqli_query($koneksi,"insert into user (user_id,username,password,level) values ('','$nis','$password','$level')");
			        	$user_id =mysqli_insert_id($koneksi);
			        	mysqli_query($koneksi,"insert into siswa (siswa_id,nis,nisn,nama_siswa,jenis_kelamin,kelas_id, nama_ibu,nama_ayah,no_hp_wali_murid,user_id) values ('','$nis','$nisn','$nama_siswa','$jenis_kelamin','$kelas_id','$nama_ibu','$nama_ayah','$no_hp_wali_murid','$user_id')");
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

	// Import nilai tahzin
		public function import_nilai_tahzin(){
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

			    	$tahun_ajaran_id     = $sheetData[$i]['1'];
			        $semester     = $sheetData[$i]['3'];
			        $nis    = $sheetData[$i]['5'];

			        $jilid = $sheetData[$i]['7'];
			        $halaman = $sheetData[$i]['8'];
			        $tartil = $sheetData[$i]['9'];
			        $pemahaman = $sheetData[$i]['10'];
			        $pashohah = $sheetData[$i]['11'];


			        $data=mysqli_query($koneksi,"select * from siswa where nis='$nis'");
					$rowcount=mysqli_num_rows($data);
					$row = $data->fetch_row();
					
			        if ($rowcount > 0) {
			        	$siswa_id = $row[0];
			        		// cek udah ada nilai sikap blm untuk siswa tersebut pada tahun ajar dan semester tersebut
			        		$cek_nilai_sikap=mysqli_query($koneksi,"select * from tahzin where siswa_id='$siswa_id' and tahun_ajaran_id='$tahun_ajaran_id' and semester='$semester'");
							$rowcount_nilai_sikap=mysqli_num_rows($cek_nilai_sikap);

				        	if ($rowcount_nilai_sikap > 0) {
				        		// tidak ada proses import nilai sikap
				        	}else{
				        		mysqli_query($koneksi,"insert into tahzin (tahzin_id,siswa_id,jilid_alquran,halaman_juz,tartil,pemahaman,pashohah,tahun_ajaran_id,semester) values ('','$siswa_id','$jilid','$halaman','$tartil','$pemahaman','$pashohah','$tahun_ajaran_id','$semester')");
					        	$jml = $jml + 1;
				        	}
			        }

			    }
			    $data1 =$jml;
			    $data2 ='Data di Import';
			    $result = $data1 . ' ' . $data2;
			    $this->session->set_flashdata('message',$result);
			    echo "
			    <script>
				 window.location=history.go(-1);
				 </script>";
			}
			 
			}
	}
	
	// import nilai sikap
	public function import_nilai_sikap(){
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

			    	$tahun_ajaran_id     = $sheetData[$i]['1'];
			        $semester     = $sheetData[$i]['3'];
			        $nis    = $sheetData[$i]['6'];
			        $tertib = $sheetData[$i]['8'];
			        $disiplin = $sheetData[$i]['9'];
			        $motivasi = $sheetData[$i]['10'];
			        $keterangan = $sheetData[$i]['11'];


			        $data=mysqli_query($koneksi,"select * from siswa where nis='$nis'");
					$rowcount=mysqli_num_rows($data);
					$row = $data->fetch_row();
					
			        if ($rowcount > 0) {
			        	$siswa_id = $row[0];
			        		// cek udah ada nilai sikap blm untuk siswa tersebut pada tahun ajar dan semester tersebut
			        		$cek_nilai_sikap=mysqli_query($koneksi,"select * from sikap where siswa_id='$siswa_id' and tahun_ajaran_id='$tahun_ajaran_id' and semester='$semester'");
							$rowcount_nilai_sikap=mysqli_num_rows($cek_nilai_sikap);

				        	if ($rowcount_nilai_sikap > 0) {
				        		// tidak ada proses import nilai sikap
				        	}else{
				        		mysqli_query($koneksi,"insert into sikap (sikap_id,siswa_id,tertib,disiplin,motivasi,keterangan,tahun_ajaran_id,semester) values ('','$siswa_id','$tertib','$disiplin','$motivasi','$keterangan','$tahun_ajaran_id','$semester')");
					        	$jml = $jml + 1;
				        	}
			        }

			    }
			    $data1 =$jml;
			    $data2 ='Data di Import';
			    $result = $data1 . ' ' . $data2;
			    $this->session->set_flashdata('message',$result);
			    echo "
			    <script>
				 window.location=history.go(-1);
				 </script>";
			}
			 
			}
	}
}