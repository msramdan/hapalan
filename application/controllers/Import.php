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
						$nama_guru     = $sheetData[$i]['0'];
				    	$nip     = $sheetData[$i]['1'];
				        $jenis_kelamin    = $sheetData[$i]['2'];
						$level    = 'GURU';
				        $password = sha1($sheetData[$i]['3']);

						$query = "select * from guru where nip='$nip'";
						$data = $this->db->query($query);

						if ($data->num_rows() > 0) {
				        }else{
						$query = "INSERT INTO user (user_id,username,password,level) values ('','$nip','$password','$level')";
						$this->db->query($query);

						$user_id =$this->db->insert_id();
						$query2 = "INSERT INTO guru (guru_id,nip,nama_guru,jenis_kelamin,user_id) values ('','$nip','$nama_guru','$jenis_kelamin','$user_id')";
						$this->db->query($query2);
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
						$kelas_id = $this->input->post('kelas_id');
				    	$tahun_ajaran_id = $this->input->post('tahun_ajaran_id');
						$nama_siswa    = $sheetData[$i]['0'];
				        $nis     = $sheetData[$i]['1'];
				        $nisn    = $sheetData[$i]['2'];
				        $jenis_kelamin     = $sheetData[$i]['3'];
				        $nama_ibu = $sheetData[$i]['4'];
				        $nama_ayah = $sheetData[$i]['5'];
				        $no_hp_wali_murid = $sheetData[$i]['6'];
				        $level= 'SISWA';
				        $password = sha1($sheetData[$i]['2']);

						$query = "select * from siswa where nis='$nis'";
						$data = $this->db->query($query);

				        if ($data->num_rows() > 0) {
				        }else{

							$query = "INSERT INTO user (user_id,username,password,level) values ('','$nis','$password','$level')";
							$this->db->query($query);
							$user_id =$this->db->insert_id();

							$query2 = "INSERT INTO siswa (siswa_id,nis,nisn,nama_siswa,jenis_kelamin,kelas_id, nama_ibu,nama_ayah,no_hp_wali_murid,user_id) values ('','$nis','$nisn','$nama_siswa','$jenis_kelamin','$kelas_id','$nama_ibu','$nama_ayah','$no_hp_wali_murid','$user_id')";
							$this->db->query($query2);
				        	$siswa_id = $this->db->insert_id();

							$query3 = "INSERT INTO history_kelas (history_kelas_id,tahun_ajaran_id,siswa_id,kelas_id) values ('','$tahun_ajaran_id','$siswa_id','$kelas_id')";
							$this->db->query($query3);
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

	public function surah(){
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

					$nama_surat     = addslashes($sheetData[$i]['0']);
					$jumlah_ayat     = $sheetData[$i]['1'];
					$query = "SELECT * FROM surat where nama_surat='$nama_surat'";
					$data = $this->db->query($query);

					if ($data->num_rows() > 0) {
					}else{
						$query = "INSERT INTO surat (surat_id,nama_surat,jumlah_ayat) values ('','$nama_surat','$jumlah_ayat')";
						$result = $this->db->query($query);
						$jml = $jml + 1;
					}
					
				}
				$data1 =$jml;
				$data2 ='Data di Import';
				$result = $data1 . ' ' . $data2;
				$this->session->set_flashdata('message',$result);
				   redirect(site_url('surat'));

			}
			 
			}
	}


	// Import nilai tahzin
	public function import_nilai_tahzin(){
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

				    	$tahun_ajaran_id     = $sheetData[$i]['0'];
				        $semester     = $sheetData[$i]['2'];
				        $nis    = $sheetData[$i]['4'];
				        $jilid = $sheetData[$i]['6'];
				        $halaman = $sheetData[$i]['7'];
				        $tartil = $sheetData[$i]['8'];
				        $pemahaman = $sheetData[$i]['9'];
				        $pashohah = $sheetData[$i]['10'];

						$query = "SELECT * from siswa where nis='$nis'";
						$data = $this->db->query($query);
						$data_siswa = $data->row();
						
				        if ($data->num_rows() > 0) {
				        	$siswa_id = $data_siswa->siswa_id;
				        		// cek udah ada nilai sikap blm untuk siswa tersebut pada tahun ajar dan semester tersebut
								$cek_nilai_tahzin="select * from tahzin where siswa_id='$siswa_id' and tahun_ajaran_id='$tahun_ajaran_id' and semester='$semester'";
								$data2 = $this->db->query($cek_nilai_tahzin);
					        	if ($data2->num_rows() > 0) {
					        	}else{
						        	$tambah_data = "insert into tahzin (tahzin_id,siswa_id,jilid_alquran,halaman_juz,tartil,pemahaman,pashohah,tahun_ajaran_id,semester) values ('','$siswa_id','$jilid','$halaman','$tartil','$pemahaman','$pashohah','$tahun_ajaran_id','$semester')";
									$this->db->query($tambah_data);
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

	// Import nilai tahfizh
	public function import_nilai_tahfizh(){
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
				    	$tahun_ajaran_id     = $sheetData[$i]['0']; //14
				        $semester     = $sheetData[$i]['2']; //1
				        $nis    = $sheetData[$i]['4']; //9090
				        $surat_id    = $sheetData[$i]['6'];
				        $tartil    = $sheetData[$i]['8'];
				        $pemahaman    = $sheetData[$i]['9'];
				        $pashohah    = $sheetData[$i]['10'];

				        if ($tahun_ajaran_id !=null) {
				        	$tahun_ajaran_id     = $sheetData[$i]['0'];
				        }else{
				        	$tahun_ajaran_id     = $a;
				        }

				        if ($semester !=null) {
				        	$semester     = $sheetData[$i]['2'];
				        }else{
				        	$semester     = $b;
				        }

				        if ($nis !=null) {
				        	$nis     = $sheetData[$i]['4'];
				        }else{
				        	$nis     = $c;
				        }
						$query = "SELECT * from siswa where nis='$nis'";
						$data = $this->db->query($query);
						$data_siswa = $data->row();


						if ($data->num_rows() > 0) {
							$siswa_id = $data_siswa->siswa_id;
							$oke="select * from tahfizh where siswa_id='$siswa_id' and surat_id='$surat_id' and tahun_ajaran_id='$tahun_ajaran_id' and semester='$semester'";
							$data2 = $this->db->query($oke);
							if ($data2->num_rows() > 0) {
					        }else{
								$tambah_data = "insert into tahfizh (tahfizh_id,siswa_id,surat_id,tartil,pemahaman,pashohah,tahun_ajaran_id,semester) values ('','$siswa_id','$surat_id','$tartil','$pemahaman','$pashohah','$tahun_ajaran_id','$semester')";
								$this->db->query($tambah_data);
								$jml = $jml + 1;
					        }	
				        }
				        $a = $tahun_ajaran_id ;
				        $b = $semester ;
				        $c =$nis ;
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

				    	$tahun_ajaran_id     = $sheetData[$i]['0'];
				        $semester     = $sheetData[$i]['2'];
				        $nis    = $sheetData[$i]['5'];
				        $tertib = $sheetData[$i]['7'];
				        $disiplin = $sheetData[$i]['8'];
				        $motivasi = $sheetData[$i]['9'];
				        $keterangan = $sheetData[$i]['10'];

						$query = "SELECT * from siswa where nis='$nis'";
						$data = $this->db->query($query);
						$data_siswa = $data->row();
				        if ($data->num_rows() > 0) {
				        	$siswa_id = $data_siswa->siswa_id;
				        		// cek udah ada nilai sikap blm untuk siswa tersebut pada tahun ajar dan semester tersebut
				        		$cek_nilai_sikap="select * from sikap where siswa_id='$siswa_id' and tahun_ajaran_id='$tahun_ajaran_id' and semester='$semester'";
								$data2 = $this->db->query($cek_nilai_sikap);

					        	if ($data2->num_rows() > 0) {
					        	}else{
						        	$tambah_data = "insert into sikap (sikap_id,siswa_id,tertib,disiplin,motivasi,keterangan,tahun_ajaran_id,semester) values ('','$siswa_id','$tertib','$disiplin','$motivasi','$keterangan','$tahun_ajaran_id','$semester')";
									$this->db->query($tambah_data);
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
