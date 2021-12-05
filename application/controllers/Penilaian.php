<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

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
            'app_setting' =>$this->App_setting_model->get_by_id(1),
        );
        $this->template->load('template','penilaian/nilai', $data);
    }

    public function excel_sikap()
    {
        $this->load->helper('exportexcel');
        $namaFile = "Format_upload_nilai_sikap.xls";
        $judul = "Format Upload";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
            xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "TA ID");
        xlsWriteLabel($tablehead, $kolomhead++, "Tahun Ajaran");
        xlsWriteLabel($tablehead, $kolomhead++, "Semester");
        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "SISWA ID");
        xlsWriteLabel($tablehead, $kolomhead++, "NIS");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Siswa");
        xlsWriteLabel($tablehead, $kolomhead++, "Tertib");
        xlsWriteLabel($tablehead, $kolomhead++, "Disiplin");
        xlsWriteLabel($tablehead, $kolomhead++, "Motivasi");
        xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");

        foreach ($this->Guru_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
        xlsWriteLabel($tablebody, $kolombody++, $data->nip);
        xlsWriteLabel($tablebody, $kolombody++, $data->nama_guru);
        xlsWriteLabel($tablebody, $kolombody++, $data->jenis_kelamin);
        xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
        xlsWriteNumber($tablebody, $kolombody++, $data->user_id);

       $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }
 
}
