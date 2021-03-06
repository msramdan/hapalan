<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require 'vendor/autoload.php';

class Penilaian extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('Tahun_ajaran_model');
		$this->load->model('Penilaian_model');
		$this->load->model('App_setting_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data = array(
			'tahun_ajaran' => $this->Tahun_ajaran_model->get_all_aktif(),
			'app_setting' => $this->App_setting_model->get_by_id(1),
		);
		$this->template->load('template', 'penilaian/penilaian_list', $data);
	}

	public function show($kelompok_id)
	{
		$data = array(
			'start' => 0,
			'siswa_data' => $this->Penilaian_model->get_all_kelompok($kelompok_id),
			'app_setting' => $this->App_setting_model->get_by_id(1),
		);
		$this->template->load('template', 'penilaian/daftar_siswa', $data);
	}

	public function data($siswa_id, $tahun_ajaran_id, $semester)
	{
		$ttd = "SELECT access_guru_to_kelompok.guru_id, guru.nama_guru, guru.tanda_tangan,kelompok.tahun_ajaran_id, kelompok_member.siswa_id from access_guru_to_kelompok
              join guru on guru.guru_id=access_guru_to_kelompok.guru_id
              join kelompok on kelompok.kelompok_id = access_guru_to_kelompok.kelompok_id
              join kelompok_member on kelompok_member.kelompok_id = kelompok.kelompok_id where $tahun_ajaran_id='$tahun_ajaran_id' and siswa_id='$siswa_id'
      ";
		$hasil = $this->db->query($ttd)->row();


		$this->load->library('dompdf_gen');
		$data = array(
			'app_setting' => $this->App_setting_model->get_by_id(1),
			'siswa' => $this->db->get_where('siswa', array('siswa_id' => $siswa_id))->row(),
			'tahun_ajaran' => $this->db->get_where('tahun_ajaran', array('tahun_ajaran_id' => $tahun_ajaran_id))->row(),
			'semester' => $semester,
			'kelas' => $this->db->get_where('history_kelas', array(
				'siswa_id' => $siswa_id,
				'tahun_ajaran_id' => $tahun_ajaran_id,
			))->row(),
			'hasil' => $hasil,
			'sikap' => $this->db->get_where('sikap', array(
				'siswa_id' => $siswa_id,
				'tahun_ajaran_id' => $tahun_ajaran_id,
				'semester' => $semester,
			))->row(),

			'tahfizh' => $this->db->get_where('tahfizh', array(
				'siswa_id' => $siswa_id,
				'tahun_ajaran_id' => $tahun_ajaran_id,
				'semester' => $semester,
			))->result(),

			'tahzin' => $this->db->get_where('tahzin', array(
				'siswa_id' => $siswa_id,
				'tahun_ajaran_id' => $tahun_ajaran_id,
				'semester' => $semester,
			))->row(),


		);
		$this->load->view('penilaian/nilai', $data);
		$paper_size = 'A4';
		$orientation = 'portrait';
		$html = $this->output->get_output();
		$this->dompdf->set_paper($paper_size, $orientation);

		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("raport_siswa.pdf", array('Attachment' => 0));
	}

	public function excel_tahzin($tahun_ajaran_detail_id)
	{
		$a = $this->db->get_where('tahun_ajaran_detail', array('tahun_ajaran_detail_id' => $tahun_ajaran_detail_id))->row();
		$tahun_ajaran_id = $a->tahun_ajaran_id;
		$semester = $a->semester;
		$spreadsheet = new Spreadsheet;
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'TA ID')
			->setCellValue('B1', 'Tahun Ajaran')
			->setCellValue('C1', 'Semester')
			->setCellValue('D1', 'Kelas')
			->setCellValue('E1', 'NIS')
			->setCellValue('F1', 'Nama Siswa')
			->setCellValue('G1', 'Jilid/Alquran')
			->setCellValue('H1', 'Halaman / Juz')
			->setCellValue('I1', 'Tartil')
			->setCellValue('J1', 'Pemahaman')
			->setCellValue('K1', 'Pashohah');
		
		$kolom = 2;
		$nomor = 1;

		if ($this->fungsi->user_login()->level == "GURU") {
			$guru_id = $this->fungsi->guru_login()->guru_id;
			$query_kelompok = "SELECT access_guru_to_kelompok.*, kelompok.tahun_ajaran_id FROM access_guru_to_kelompok JOIN kelompok on kelompok.kelompok_id = access_guru_to_kelompok.kelompok_id where guru_id='$guru_id' and tahun_ajaran_id='$tahun_ajaran_id'";
			$data_kel = $this->db->query($query_kelompok)->result();
		} else if ($this->fungsi->user_login()->level == "ADMIN") {
			$query_kelompok = "SELECT * from kelompok where tahun_ajaran_id='$tahun_ajaran_id'";
			$data_kel = $this->db->query($query_kelompok)->result();
		}



		foreach ($data_kel as $value) {
			foreach ($this->Penilaian_model->get_all_kelompok($value->kelompok_id) as $row) {
				$spreadsheet->setActiveSheetIndex(0)
					->setCellValue('A' . $kolom, $row->tahun_ajaran_id)
					->setCellValue('B' . $kolom, $row->tahun_ajaran)
					->setCellValue('C' . $kolom, $semester)
					->setCellValue('D' . $kolom, $row->nama_kelas)
					->setCellValue('E' . $kolom, $row->nis)
					->setCellValue('F' . $kolom, $row->nama_siswa)
					->setCellValue('G' . $kolom, '')
					->setCellValue('H' . $kolom, '')
					->setCellValue('I' . $kolom, '')
					->setCellValue('J' . $kolom, '')
					->setCellValue('K' . $kolom, '');
				$kolom++;
				$nomor++;
			}
		}

		$data =  $kolom - 1;	


		$spreadsheet->getActiveSheet()->getStyle('A1:A' . $data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$spreadsheet->getActiveSheet()->getStyle('B1:B' . $data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$spreadsheet->getActiveSheet()->getStyle('C1:C' . $data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$spreadsheet->getActiveSheet()->getStyle('D1:D' . $data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$spreadsheet->getActiveSheet()->getStyle('E1:E' . $data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$spreadsheet->getActiveSheet()->getStyle('F1:F' . $data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$spreadsheet->getActiveSheet()->getStyle('G1:G' . $data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$spreadsheet->getActiveSheet()->getStyle('H1:H' . $data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$spreadsheet->getActiveSheet()->getStyle('I1:I' . $data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$spreadsheet->getActiveSheet()->getStyle('J1:J' . $data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$spreadsheet->getActiveSheet()->getStyle('K1:K' . $data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

		$spreadsheet->getActiveSheet()->getStyle('G1:G' . $data)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');
		$spreadsheet->getActiveSheet()->getStyle('H1:H' . $data)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');
		$spreadsheet->getActiveSheet()->getStyle('I1:I' . $data)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');
		$spreadsheet->getActiveSheet()->getStyle('J1:J' . $data)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');
		$spreadsheet->getActiveSheet()->getStyle('K1:K' . $data)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');
		

		$validation = $spreadsheet->getActiveSheet()
			->getDataValidation('I1:I' .$data);
		$validation->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_WHOLE);
		$validation->setErrorStyle(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_STOP);
		$validation->setAllowBlank(true);
		$validation->setShowInputMessage(true);
		$validation->setShowErrorMessage(true);
		$validation->setErrorTitle('Input error');
		$validation->setError('Number is not allowed!');
		$validation->setPromptTitle('Allowed input');
		$validation->setPrompt('Only numbers between 0 and 100 are allowed.');
		$validation->setFormula1(0);
		$validation->setFormula2(100);

		$validation = $spreadsheet->getActiveSheet()
			->getDataValidation('J1:J' .$data);
		$validation->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_WHOLE);
		$validation->setErrorStyle(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_STOP);
		$validation->setAllowBlank(true);
		$validation->setShowInputMessage(true);
		$validation->setShowErrorMessage(true);
		$validation->setErrorTitle('Input error');
		$validation->setError('Number is not allowed!');
		$validation->setPromptTitle('Allowed input');
		$validation->setPrompt('Only numbers between 0 and 100 are allowed.');
		$validation->setFormula1(0);
		$validation->setFormula2(100);

		$validation = $spreadsheet->getActiveSheet()
			->getDataValidation('K1:K' .$data);
		$validation->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_WHOLE);
		$validation->setErrorStyle(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_STOP);
		$validation->setAllowBlank(true);
		$validation->setShowInputMessage(true);
		$validation->setShowErrorMessage(true);
		$validation->setErrorTitle('Input error');
		$validation->setError('Number is not allowed!');
		$validation->setPromptTitle('Allowed input');
		$validation->setPrompt('Only numbers between 0 and 100 are allowed.');
		$validation->setFormula1(0);
		$validation->setFormula2(100);

		$writer = new Xlsx($spreadsheet);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Format upload nilai tahzin.xlsx"');
		header('Cache-Control: max-age=0');
		$writer->save('php://output');
	}

	public function excel_tahfizh($tahun_ajaran_detail_id)
	{
		$a = $this->db->get_where('tahun_ajaran_detail', array('tahun_ajaran_detail_id' => $tahun_ajaran_detail_id))->row();
		$tahun_ajaran_id = $a->tahun_ajaran_id;
		$semester = $a->semester;
		$spreadsheet = new Spreadsheet;
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'TA ID')
			->setCellValue('B1', 'Tahun Ajaran')
			->setCellValue('C1', 'Semester')
			->setCellValue('D1', 'Kelas')
			->setCellValue('E1', 'NIS')
			->setCellValue('F1', 'Nama Siswa')
			->setCellValue('G1', 'Surah ID')
			->setCellValue('H1', 'Surah')
			->setCellValue('I1', 'Tartil')
			->setCellValue('J1', 'Pemahaman')
			->setCellValue('K1', 'Pashohah');
		$kolom = 2;
		$mulai = 2;
		$nomor = 1;

		if ($this->fungsi->user_login()->level == "GURU") {
			$guru_id = $this->fungsi->guru_login()->guru_id;
			$query_kelompok = "SELECT access_guru_to_kelompok.*, kelompok.tahun_ajaran_id FROM access_guru_to_kelompok JOIN kelompok on kelompok.kelompok_id = access_guru_to_kelompok.kelompok_id where guru_id='$guru_id' and tahun_ajaran_id='$tahun_ajaran_id'";
			$data_kel = $this->db->query($query_kelompok)->result();
		} else if ($this->fungsi->user_login()->level == "ADMIN") {
			$query_kelompok = "SELECT * from kelompok where tahun_ajaran_id='$tahun_ajaran_id'";
			$data_kel = $this->db->query($query_kelompok)->result();
		}
		foreach ($data_kel as $value) {
			$query_siswa = "SELECT surat_siswa.siswa_id,surat_siswa.semester,siswa.nis,siswa.nama_siswa,kelas.nama_kelas,tahun_ajaran.tahun_ajaran,kelompok_member_with_kelompok.kelompok_id,kelompok_member_with_kelompok.tahun_ajaran_id from surat_siswa join siswa on siswa.siswa_id = surat_siswa.siswa_id join kelas on kelas.kelas_id = siswa.kelas_id join kelompok_member_with_kelompok on kelompok_member_with_kelompok.siswa_id= siswa.siswa_id JOIN tahun_ajaran on tahun_ajaran.tahun_ajaran_id = kelompok_member_with_kelompok.tahun_ajaran_id WHERE surat_siswa.tahun_ajaran_id='$tahun_ajaran_id' AND semester='$semester' and kelompok_id='$value->kelompok_id' GROUP BY surat_siswa.siswa_id";

			foreach ($this->db->query($query_siswa)->result() as $siswa) {

				$jml = $this->db->query("SELECT * from surat_siswa where siswa_id='$siswa->siswa_id'");
				$jml_data = $jml->num_rows();
				$data = $kolom + $jml_data - 1;
				$spreadsheet->setActiveSheetIndex(0)
					->setCellValue('A' . $kolom, $siswa->tahun_ajaran_id)
					->setCellValue('B' . $kolom, $siswa->tahun_ajaran)
					->setCellValue('C' . $kolom, $semester)
					->setCellValue('D' . $kolom, $siswa->nama_kelas)
					->setCellValue('E' . $kolom, $siswa->nis)
					->setCellValue('F' . $kolom, $siswa->nama_siswa);

				$daftarSurah = "SELECT surat.nama_surat,surat.surat_id from surat_siswa join surat on surat.surat_id = surat_siswa.surat_id where siswa_id='$siswa->siswa_id'";
				$daftarSurah2 = $this->db->query($daftarSurah)->result();

				foreach ($daftarSurah2 as $daftar_surah) {
					$spreadsheet->setActiveSheetIndex(0)
						->setCellValue('G' . $mulai, $daftar_surah->surat_id)
						->setCellValue('H' . $mulai, $daftar_surah->nama_surat)
						->setCellValue('I' . $mulai, '')
						->setCellValue('J' . $mulai, '')
						->setCellValue('K' . $mulai, '');
					$mulai++;
				}
				$spreadsheet->getActiveSheet()->mergeCells('A' . $kolom . ':A' . $data);
				$spreadsheet->getActiveSheet()->mergeCells('B' . $kolom . ':B' . $data);
				$spreadsheet->getActiveSheet()->mergeCells('C' . $kolom . ':C' . $data);
				$spreadsheet->getActiveSheet()->mergeCells('D' . $kolom . ':D' . $data);
				$spreadsheet->getActiveSheet()->mergeCells('E' . $kolom . ':E' . $data);
				$spreadsheet->getActiveSheet()->mergeCells('F' . $kolom . ':F' . $data);

				$kolom = $data + 1;
				$nomor++;
			}
		}

		$data =  $kolom - 1;
		$spreadsheet->getActiveSheet()->getStyle('A1:A' . $data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$spreadsheet->getActiveSheet()->getStyle('B1:B' . $data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$spreadsheet->getActiveSheet()->getStyle('C1:C' . $data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$spreadsheet->getActiveSheet()->getStyle('D1:D' . $data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$spreadsheet->getActiveSheet()->getStyle('E1:E' . $data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$spreadsheet->getActiveSheet()->getStyle('F1:F' . $data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$spreadsheet->getActiveSheet()->getStyle('G1:G' . $data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$spreadsheet->getActiveSheet()->getStyle('H1:H' . $data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$spreadsheet->getActiveSheet()->getStyle('I1:I' . $data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$spreadsheet->getActiveSheet()->getStyle('J1:J' . $data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$spreadsheet->getActiveSheet()->getStyle('K1:K' . $data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

		$spreadsheet->getActiveSheet()->getStyle('I1:I' . $data)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');
		$spreadsheet->getActiveSheet()->getStyle('J1:J' . $data)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');
		$spreadsheet->getActiveSheet()->getStyle('K1:K' . $data)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');

		$validation = $spreadsheet->getActiveSheet()
			->getDataValidation('I1:I' .$data);
		$validation->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_WHOLE);
		$validation->setErrorStyle(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_STOP);
		$validation->setAllowBlank(true);
		$validation->setShowInputMessage(true);
		$validation->setShowErrorMessage(true);
		$validation->setErrorTitle('Input error');
		$validation->setError('Number is not allowed!');
		$validation->setPromptTitle('Allowed input');
		$validation->setPrompt('Only numbers between 0 and 100 are allowed.');
		$validation->setFormula1(0);
		$validation->setFormula2(100);

		$validation = $spreadsheet->getActiveSheet()
			->getDataValidation('J1:J' .$data);
		$validation->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_WHOLE);
		$validation->setErrorStyle(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_STOP);
		$validation->setAllowBlank(true);
		$validation->setShowInputMessage(true);
		$validation->setShowErrorMessage(true);
		$validation->setErrorTitle('Input error');
		$validation->setError('Number is not allowed!');
		$validation->setPromptTitle('Allowed input');
		$validation->setPrompt('Only numbers between 0 and 100 are allowed.');
		$validation->setFormula1(0);
		$validation->setFormula2(100);

		$validation = $spreadsheet->getActiveSheet()
			->getDataValidation('K1:K' .$data);
		$validation->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_WHOLE);
		$validation->setErrorStyle(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_STOP);
		$validation->setAllowBlank(true);
		$validation->setShowInputMessage(true);
		$validation->setShowErrorMessage(true);
		$validation->setErrorTitle('Input error');
		$validation->setError('Number is not allowed!');
		$validation->setPromptTitle('Allowed input');
		$validation->setPrompt('Only numbers between 0 and 100 are allowed.');
		$validation->setFormula1(0);
		$validation->setFormula2(100);

		$writer = new Xlsx($spreadsheet);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Format upload nilai tahfizh.xlsx"');
		header('Cache-Control: max-age=0');
		$writer->save('php://output');
	}

	public function excel_sikap($tahun_ajaran_detail_id)
	{

		$a = $this->db->get_where('tahun_ajaran_detail', array('tahun_ajaran_detail_id' => $tahun_ajaran_detail_id))->row();
		$tahun_ajaran_id = $a->tahun_ajaran_id;
		$semester = $a->semester;

		$spreadsheet = new Spreadsheet;

		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'TA ID')
			->setCellValue('B1', 'Tahun Ajaran')
			->setCellValue('C1', 'Semester')
			->setCellValue('D1', 'Kelompok')
			->setCellValue('E1', 'Kelas')
			->setCellValue('F1', 'NIS')
			->setCellValue('G1', 'Nama Siswa')
			->setCellValue('H1', 'Tertib')
			->setCellValue('I1', 'Disiplin')
			->setCellValue('J1', 'Motivasi')
			->setCellValue('K1', 'Keterangan');

		$kolom = 2;
		$nomor = 1;

		if ($this->fungsi->user_login()->level == "GURU") {
			// jika login guru
			$guru_id = $this->fungsi->guru_login()->guru_id;
			$query_kelompok = "SELECT access_guru_to_kelompok.*, kelompok.tahun_ajaran_id FROM access_guru_to_kelompok JOIN kelompok on kelompok.kelompok_id = access_guru_to_kelompok.kelompok_id where guru_id='$guru_id' and tahun_ajaran_id='$tahun_ajaran_id'";
			$data_kel = $this->db->query($query_kelompok)->result();
		} else if ($this->fungsi->user_login()->level == "ADMIN") {
			$query_kelompok = "SELECT * from kelompok where tahun_ajaran_id='$tahun_ajaran_id'";
			$data_kel = $this->db->query($query_kelompok)->result();
		}

		foreach ($data_kel as $value) {
			foreach ($this->Penilaian_model->get_all_kelompok($value->kelompok_id) as $row) {
				$spreadsheet->setActiveSheetIndex(0)
					//  ->setCellValue('A' . $kolom, $nomor)
					->setCellValue('A' . $kolom, $row->tahun_ajaran_id)
					->setCellValue('B' . $kolom, $row->tahun_ajaran)
					->setCellValue('C' . $kolom, $semester)
					->setCellValue('D' . $kolom, $row->nama_kelompok)
					->setCellValue('E' . $kolom, $row->nama_kelas)
					->setCellValue('F' . $kolom, $row->nis)
					->setCellValue('G' . $kolom, $row->nama_siswa)
					->setCellValue('H' . $kolom, '')
					->setCellValue('I' . $kolom, '')
					->setCellValue('J' . $kolom, '')
					->setCellValue('K' . $kolom, '');

				$kolom++;
				$nomor++;
			}
		}

		$data =  $kolom - 1;
		$spreadsheet->getActiveSheet()->getStyle('A1:A' . $data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$spreadsheet->getActiveSheet()->getStyle('B1:B' . $data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$spreadsheet->getActiveSheet()->getStyle('C1:C' . $data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$spreadsheet->getActiveSheet()->getStyle('D1:D' . $data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$spreadsheet->getActiveSheet()->getStyle('E1:E' . $data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$spreadsheet->getActiveSheet()->getStyle('F1:F' . $data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$spreadsheet->getActiveSheet()->getStyle('G1:G' . $data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$spreadsheet->getActiveSheet()->getStyle('H1:H' . $data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$spreadsheet->getActiveSheet()->getStyle('I1:I' . $data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$spreadsheet->getActiveSheet()->getStyle('J1:J' . $data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$spreadsheet->getActiveSheet()->getStyle('K1:K' . $data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

		$spreadsheet->getActiveSheet()->getStyle('H1:H' . $data)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');
		$spreadsheet->getActiveSheet()->getStyle('I1:I' . $data)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');
		$spreadsheet->getActiveSheet()->getStyle('J1:J' . $data)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');
		$spreadsheet->getActiveSheet()->getStyle('K1:K' . $data)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');


		$writer = new Xlsx($spreadsheet);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Format upload nilai sikap.xlsx"');
		header('Cache-Control: max-age=0');
		$writer->save('php://output');
	}

	function hapus_nilai_sikap($tahun_ajaran_detail_id)
	{
		$a = $this->db->get_where('tahun_ajaran_detail', array('tahun_ajaran_detail_id' => $tahun_ajaran_detail_id))->row();
		$tahun_ajaran_id = $a->tahun_ajaran_id;
		$semester = $a->semester;

		if ($this->fungsi->user_login()->level == "GURU") {
			$guru_id = $this->fungsi->guru_login()->guru_id;
			$query_kelompok = "SELECT access_guru_to_kelompok.*, kelompok.tahun_ajaran_id FROM access_guru_to_kelompok JOIN kelompok on kelompok.kelompok_id = access_guru_to_kelompok.kelompok_id where guru_id='$guru_id' and tahun_ajaran_id='$tahun_ajaran_id'";
			$data_kel = $this->db->query($query_kelompok)->result();
			foreach ($data_kel as $value) {
				foreach ($this->Penilaian_model->get_all_kelompok($value->kelompok_id) as $row) {
					$del = "DELETE from sikap where tahun_ajaran_id='$tahun_ajaran_id' and semester='$semester' and siswa_id='$row->siswa_id'";
					$this->db->query($del);
				}
			}
		} else if ($this->fungsi->user_login()->level == "ADMIN") {
			$del = "DELETE from sikap where tahun_ajaran_id='$tahun_ajaran_id' and semester='$semester'";
			$this->db->query($del);
		}
		echo "
          <script>
         window.location=history.go(-1);
         </script>";
	}


	function hapus_nilai_tahfizh($tahun_ajaran_detail_id)
	{
		$a = $this->db->get_where('tahun_ajaran_detail', array('tahun_ajaran_detail_id' => $tahun_ajaran_detail_id))->row();
		$tahun_ajaran_id = $a->tahun_ajaran_id;
		$semester = $a->semester;

		if ($this->fungsi->user_login()->level == "GURU") {
			$guru_id = $this->fungsi->guru_login()->guru_id;
			$query_kelompok = "SELECT access_guru_to_kelompok.*, kelompok.tahun_ajaran_id FROM access_guru_to_kelompok JOIN kelompok on kelompok.kelompok_id = access_guru_to_kelompok.kelompok_id where guru_id='$guru_id' and tahun_ajaran_id='$tahun_ajaran_id'";
			$data_kel = $this->db->query($query_kelompok)->result();
			foreach ($data_kel as $value) {
				foreach ($this->Penilaian_model->get_all_kelompok($value->kelompok_id) as $row) {
					$del = "DELETE from tahfizh where tahun_ajaran_id='$tahun_ajaran_id' and semester='$semester' and siswa_id='$row->siswa_id'";
					$this->db->query($del);
				}
			}
		} else if ($this->fungsi->user_login()->level == "ADMIN") {
			$del = "DELETE from tahfizh where tahun_ajaran_id='$tahun_ajaran_id' and semester='$semester'";
			$this->db->query($del);
		}
		echo "
          <script>
         window.location=history.go(-1);
         </script>";
	}


	function hapus_nilai_tahzin($tahun_ajaran_detail_id)
	{
		$a = $this->db->get_where('tahun_ajaran_detail', array('tahun_ajaran_detail_id' => $tahun_ajaran_detail_id))->row();
		$tahun_ajaran_id = $a->tahun_ajaran_id;
		$semester = $a->semester;

		if ($this->fungsi->user_login()->level == "GURU") {
			$guru_id = $this->fungsi->guru_login()->guru_id;
			$query_kelompok = "SELECT access_guru_to_kelompok.*, kelompok.tahun_ajaran_id FROM access_guru_to_kelompok JOIN kelompok on kelompok.kelompok_id = access_guru_to_kelompok.kelompok_id where guru_id='$guru_id' and tahun_ajaran_id='$tahun_ajaran_id'";
			$data_kel = $this->db->query($query_kelompok)->result();
			foreach ($data_kel as $value) {
				foreach ($this->Penilaian_model->get_all_kelompok($value->kelompok_id) as $row) {
					$del = "DELETE from tahzin where tahun_ajaran_id='$tahun_ajaran_id' and semester='$semester' and siswa_id='$row->siswa_id'";
					$this->db->query($del);
				}
			}
		} else if ($this->fungsi->user_login()->level == "ADMIN") {
			$del = "DELETE from tahzin where tahun_ajaran_id='$tahun_ajaran_id' and semester='$semester'";
			$this->db->query($del);
		}
		echo "
          <script>
         window.location=history.go(-1);
         </script>";
	}
}
