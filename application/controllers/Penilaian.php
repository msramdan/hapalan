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
    
     public function excel_sikap($kelompok_id)
     {

          $spreadsheet = new Spreadsheet;

          $spreadsheet->setActiveSheetIndex(0)
                      ->setCellValue('A1', 'No')
                      ->setCellValue('B1', 'TA ID')
                      ->setCellValue('C1', 'Tahun Ajaran')
                      ->setCellValue('D1', 'Semester')
                      ->setCellValue('E1', 'Kelas')
                      ->setCellValue('F1', 'NIS')
                      ->setCellValue('G1', 'Nama Siswa')
                      ->setCellValue('H1', 'Tertib')
                      ->setCellValue('I1', 'Disiplin')
                      ->setCellValue('J1', 'Motivasi')
                      ->setCellValue('K1', 'Keterangan');

          $kolom = 2;
          $nomor = 1;
          foreach($this->Penilaian_model->get_all_kelompok($kelompok_id) as $data) {
               $spreadsheet->setActiveSheetIndex(0)
                           ->setCellValue('A' . $kolom, $nomor)
                           ->setCellValue('B' . $kolom, $data->tahun_ajaran_id)
                           ->setCellValue('C' . $kolom, $data->tahun_ajaran)
                           ->setCellValue('D' . $kolom, '')
                           ->setCellValue('E' . $kolom, $data->nama_kelas)
                           ->setCellValue('F' . $kolom, $data->nis)
                           ->setCellValue('G' . $kolom, $data->nama_siswa)
                           ->setCellValue('H' . $kolom, '')
                           ->setCellValue('I' . $kolom, '')
                           ->setCellValue('J' . $kolom, '')
                           ->setCellValue('J' . $kolom, '');

               $kolom++;
               $nomor++;

          }

          $writer = new Xlsx($spreadsheet);

          header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="Format upload nilai sikap.xlsx"');
      header('Cache-Control: max-age=0');
      $writer->save('php://output');
     }
 
}
