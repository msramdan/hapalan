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
            'tahun_ajaran' =>$this->Tahun_ajaran_model->get_all_aktif(),
            'app_setting' =>$this->App_setting_model->get_by_id(1),
        );
        $this->template->load('template','penilaian/penilaian_list', $data);
    }

    public function show($kelompok_id)
    {
        $data = array(
            'start' => 0,
            'siswa_data' => $this->Penilaian_model->get_all_kelompok($kelompok_id),
            'app_setting' =>$this->App_setting_model->get_by_id(1),
        );
        $this->template->load('template','penilaian/daftar_siswa', $data);
    }

    public function data($siswa_id)
    {
      $data = array(
              'siswa_id' =>$siswa_id,
              'app_setting' =>$this->App_setting_model->get_by_id(1),
      );
      $this->template->load('template','penilaian/nilai', $data);
    }

    public function del_sikap($sikap_id,$siswa_id)
    {
      $this->Penilaian_model->delete_sikap($sikap_id);
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('penilaian/data/' .$siswa_id));

    }

    public function excel_tahzin($tahun_ajaran_detail_id)
     {
          $a = $this->db->get_where('tahun_ajaran_detail', array('tahun_ajaran_detail_id' => $tahun_ajaran_detail_id))->row();
          $tahun_ajaran_id = $a->tahun_ajaran_id;
          $semester = $a->semester;


          $spreadsheet = new Spreadsheet;

          $spreadsheet->setActiveSheetIndex(0)
                      ->setCellValue('A1', 'No')
                      ->setCellValue('B1', 'TA ID')
                      ->setCellValue('C1', 'Tahun Ajaran')
                      ->setCellValue('D1', 'Semester')
                      ->setCellValue('E1', 'Kelas')
                      ->setCellValue('F1', 'NIS')
                      ->setCellValue('G1', 'Nama Siswa')
                      ->setCellValue('H1', 'Jilid/Alquran')
                      ->setCellValue('I1', 'Halaman / Juz')
                      ->setCellValue('J1', 'Tartil')
                      ->setCellValue('K1', 'Pemahaman')
                      ->setCellValue('L1', 'Pashohah');



          

          $kolom = 2;
          $nomor = 1;

            if ($this->fungsi->user_login()->level =="GURU") {
            // jika login guru
            $guru_id =$this->fungsi->guru_login()->guru_id;
            $query_kelompok = "SELECT access_guru_to_kelompok.*, kelompok.tahun_ajaran_id FROM access_guru_to_kelompok JOIN kelompok on kelompok.kelompok_id = access_guru_to_kelompok.kelompok_id where guru_id='$guru_id' and tahun_ajaran_id='$tahun_ajaran_id'";
            $data_kel= $this->db->query($query_kelompok)->result();
          }else if ($this->fungsi->user_login()->level =="ADMIN") {
            $query_kelompok = "SELECT * from kelompok where tahun_ajaran_id='$tahun_ajaran_id'";
            $data_kel= $this->db->query($query_kelompok)->result();
          }

          $data = 100 ;
          $spreadsheet->getActiveSheet()->getStyle('A1:A'.$data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
          $spreadsheet->getActiveSheet()->getStyle('B1:B'.$data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
          $spreadsheet->getActiveSheet()->getStyle('C1:C'.$data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
          $spreadsheet->getActiveSheet()->getStyle('D1:D'.$data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
          $spreadsheet->getActiveSheet()->getStyle('E1:E'.$data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
          $spreadsheet->getActiveSheet()->getStyle('F1:F'.$data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
          $spreadsheet->getActiveSheet()->getStyle('G1:G'.$data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
          $spreadsheet->getActiveSheet()->getStyle('H1:H'.$data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
          $spreadsheet->getActiveSheet()->getStyle('I1:I'.$data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
          $spreadsheet->getActiveSheet()->getStyle('J1:J'.$data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
          $spreadsheet->getActiveSheet()->getStyle('K1:K'.$data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
          $spreadsheet->getActiveSheet()->getStyle('L1:L'.$data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

          $spreadsheet->getActiveSheet()->getStyle('H1:H'.$data)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');
          $spreadsheet->getActiveSheet()->getStyle('I1:I'.$data)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');
          $spreadsheet->getActiveSheet()->getStyle('J1:J'.$data)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');
          $spreadsheet->getActiveSheet()->getStyle('K1:K'.$data)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');
          $spreadsheet->getActiveSheet()->getStyle('L1:L'.$data)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');

            foreach ($data_kel as $value) {
              foreach($this->Penilaian_model->get_all_kelompok($value->kelompok_id) as $row) {
               $spreadsheet->setActiveSheetIndex(0)
                           ->setCellValue('A' . $kolom, $nomor)
                           ->setCellValue('B' . $kolom, $row->tahun_ajaran_id)
                           ->setCellValue('C' . $kolom, $row->tahun_ajaran)
                           ->setCellValue('D' . $kolom, $semester)
                           ->setCellValue('E' . $kolom, $row->nama_kelas)
                           ->setCellValue('F' . $kolom, $row->nis)
                           ->setCellValue('G' . $kolom, $row->nama_siswa)
                           ->setCellValue('H' . $kolom, '')
                           ->setCellValue('I' . $kolom, '')
                           ->setCellValue('J' . $kolom, '')
                           ->setCellValue('K' . $kolom, '')
                           ->setCellValue('L' . $kolom, '');
               $kolom++;
               $nomor++;
          }
        }   

          $writer = new Xlsx($spreadsheet);

          header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="Format upload nilai tahzin.xlsx"');
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
                      ->setCellValue('A1', 'No')
                      ->setCellValue('B1', 'TA ID')
                      ->setCellValue('C1', 'Tahun Ajaran')
                      ->setCellValue('D1', 'Semester')
                      ->setCellValue('E1', 'Kelompok')
                      ->setCellValue('F1', 'Kelas')
                      ->setCellValue('G1', 'NIS')
                      ->setCellValue('H1', 'Nama Siswa')
                      ->setCellValue('I1', 'Tertib')
                      ->setCellValue('J1', 'Disiplin')
                      ->setCellValue('K1', 'Motivasi')
                      ->setCellValue('L1', 'Keterangan');

          $kolom = 2;
          $nomor = 1;

          if ($this->fungsi->user_login()->level =="GURU") {
            // jika login guru
            $guru_id =$this->fungsi->guru_login()->guru_id;
            $query_kelompok = "SELECT access_guru_to_kelompok.*, kelompok.tahun_ajaran_id FROM access_guru_to_kelompok JOIN kelompok on kelompok.kelompok_id = access_guru_to_kelompok.kelompok_id where guru_id='$guru_id' and tahun_ajaran_id='$tahun_ajaran_id'";
            $data_kel= $this->db->query($query_kelompok)->result();
          }else if ($this->fungsi->user_login()->level =="ADMIN") {
            $query_kelompok = "SELECT * from kelompok where tahun_ajaran_id='$tahun_ajaran_id'";
            $data_kel= $this->db->query($query_kelompok)->result();
          }

          $data = 100 ;
          $spreadsheet->getActiveSheet()->getStyle('A1:A'.$data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
          $spreadsheet->getActiveSheet()->getStyle('B1:B'.$data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
          $spreadsheet->getActiveSheet()->getStyle('C1:C'.$data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
          $spreadsheet->getActiveSheet()->getStyle('D1:D'.$data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
          $spreadsheet->getActiveSheet()->getStyle('E1:E'.$data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
          $spreadsheet->getActiveSheet()->getStyle('F1:F'.$data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
          $spreadsheet->getActiveSheet()->getStyle('G1:G'.$data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
          $spreadsheet->getActiveSheet()->getStyle('H1:H'.$data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
          $spreadsheet->getActiveSheet()->getStyle('I1:I'.$data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
          $spreadsheet->getActiveSheet()->getStyle('J1:J'.$data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
          $spreadsheet->getActiveSheet()->getStyle('K1:K'.$data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
          $spreadsheet->getActiveSheet()->getStyle('L1:L'.$data)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

          
          $spreadsheet->getActiveSheet()->getStyle('I1:I'.$data)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');
          $spreadsheet->getActiveSheet()->getStyle('J1:J'.$data)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');
          $spreadsheet->getActiveSheet()->getStyle('K1:K'.$data)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');
          $spreadsheet->getActiveSheet()->getStyle('L1:L'.$data)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');

            foreach ($data_kel as $value) {
              foreach($this->Penilaian_model->get_all_kelompok($value->kelompok_id) as $row) {
               $spreadsheet->setActiveSheetIndex(0)
                           ->setCellValue('A' . $kolom, $nomor)
                           ->setCellValue('B' . $kolom, $row->tahun_ajaran_id)
                           ->setCellValue('C' . $kolom, $row->tahun_ajaran)
                           ->setCellValue('D' . $kolom, $semester)
                           ->setCellValue('E' . $kolom, $row->nama_kelompok)
                           ->setCellValue('F' . $kolom, $row->nama_kelas)
                           ->setCellValue('G' . $kolom, $row->nis)
                           ->setCellValue('H' . $kolom, $row->nama_siswa)
                           ->setCellValue('I' . $kolom, '')
                           ->setCellValue('J' . $kolom, '')
                           ->setCellValue('K' . $kolom, '')
                           ->setCellValue('L' . $kolom, '');

               $kolom++;
               $nomor++;
          }
        }   

          $writer = new Xlsx($spreadsheet);

          header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="Format upload nilai sikap.xlsx"');
      header('Cache-Control: max-age=0');
      $writer->save('php://output');
     }

     function hapus_nilai_sikap($tahun_ajaran_detail_id){
        $a = $this->db->get_where('tahun_ajaran_detail', array('tahun_ajaran_detail_id' => $tahun_ajaran_detail_id))->row();
        $tahun_ajaran_id = $a->tahun_ajaran_id;
        $semester = $a->semester;

        if ($this->fungsi->user_login()->level =="GURU") {
          $guru_id =$this->fungsi->guru_login()->guru_id;
            $query_kelompok = "SELECT access_guru_to_kelompok.*, kelompok.tahun_ajaran_id FROM access_guru_to_kelompok JOIN kelompok on kelompok.kelompok_id = access_guru_to_kelompok.kelompok_id where guru_id='$guru_id' and tahun_ajaran_id='$tahun_ajaran_id'";
            $data_kel= $this->db->query($query_kelompok)->result();
            foreach ($data_kel as $value) {
              foreach($this->Penilaian_model->get_all_kelompok($value->kelompok_id) as $row) {
                $del = "DELETE from sikap where tahun_ajaran_id='$tahun_ajaran_id' and semester='$semester' and siswa_id='$row->siswa_id'";
                $this->db->query($del);
              }
            }

          }else if ($this->fungsi->user_login()->level =="ADMIN") {
            $del = "DELETE from sikap where tahun_ajaran_id='$tahun_ajaran_id' and semester='$semester'";
            $this->db->query($del);
          }
           echo "
          <script>
         window.location=history.go(-1);
         </script>";

     }


     function hapus_nilai_tahzin($tahun_ajaran_detail_id){
        $a = $this->db->get_where('tahun_ajaran_detail', array('tahun_ajaran_detail_id' => $tahun_ajaran_detail_id))->row();
        $tahun_ajaran_id = $a->tahun_ajaran_id;
        $semester = $a->semester;

        if ($this->fungsi->user_login()->level =="GURU") {
          $guru_id =$this->fungsi->guru_login()->guru_id;
            $query_kelompok = "SELECT access_guru_to_kelompok.*, kelompok.tahun_ajaran_id FROM access_guru_to_kelompok JOIN kelompok on kelompok.kelompok_id = access_guru_to_kelompok.kelompok_id where guru_id='$guru_id' and tahun_ajaran_id='$tahun_ajaran_id'";
            $data_kel= $this->db->query($query_kelompok)->result();
            foreach ($data_kel as $value) {
              foreach($this->Penilaian_model->get_all_kelompok($value->kelompok_id) as $row) {
                $del = "DELETE from tahzin where tahun_ajaran_id='$tahun_ajaran_id' and semester='$semester' and siswa_id='$row->siswa_id'";
                $this->db->query($del);
              }
            }

          }else if ($this->fungsi->user_login()->level =="ADMIN") {
            $del = "DELETE from tahzin where tahun_ajaran_id='$tahun_ajaran_id' and semester='$semester'";
            $this->db->query($del);
          }
           echo "
          <script>
         window.location=history.go(-1);
         </script>";

     }
 
}
