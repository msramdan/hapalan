<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
require 'vendor/autoload.php';

class Surat_siswa extends CI_Controller
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
        $this->template->load('template','surat_siswa/daftar_kelompok', $data);
    }

    public function show($kelompok_id)
    {
        $data = array(
            'start' => 0,
            'siswa_data' => $this->Penilaian_model->get_all_kelompok($kelompok_id),
            'app_setting' =>$this->App_setting_model->get_by_id(1),
        );
        $this->template->load('template','surat_siswa/daftar_siswa', $data);
    }

    public function data($siswa_id)
    {
      $data = array(
              'siswa_id' =>$siswa_id,
              'app_setting' =>$this->App_setting_model->get_by_id(1),
      );
      $this->template->load('template','surat_siswa/nilai', $data);
    }


    function daftar_surah($siswa_id,$tahun_ajaran_id,$semester)
    {

        $data = array(
            'siswa' => $this->db->get_where('siswa', ['siswa_id' =>$siswa_id])->row_array(),
            'app_setting' =>$this->App_setting_model->get_by_id(1),
        );
        $this->template->load('template','surat_siswa/daftar_surah',$data);
    }


    function daftar_surat(){
        $siswa_id = $this->input->post('siswa_id');
        $tahun_ajaran_id = $this->input->post('tahun_ajaran_id');
        $semester = $this->input->post('semester');
		$kelompok_id = $this->input->post('kelompok_id');
        $output = '';

            $queryData = "SELECT surat.nama_surat,surat.surat_id as from_surat_id ,surat_siswa.surat_id,surat_siswa.tahun_ajaran_id,surat_siswa.semester,surat_siswa.siswa_id FROM surat LEFT JOIN surat_siswa ON surat_siswa.surat_id = surat.surat_id and siswa_id='$siswa_id ' AND tahun_ajaran_id='$tahun_ajaran_id' AND semester='$semester' where siswa_id IS null;";

            $data = $this->db->query($queryData);
              if($data->num_rows() > 0)
              {
               foreach($data->result() as $row)
               {
                $output .="
                <form action='".base_url('surat_siswa/add_surat')."' method='post'>
                    <div class='input-group' style='margin-bottom: 5px'>
                        <input readonly='' class='form-control' type='text' value='".$row->nama_surat."'>
                        <input class='form-control' type='hidden' name='siswa_id' value='".$siswa_id."'>
                        <input class='form-control' type='hidden' name='surat_id' value='".$row->from_surat_id."'>
                        <input class='form-control' type='hidden' name='tahun_ajaran_id' value='".$tahun_ajaran_id."'>
                        <input class='form-control' type='hidden' name='semester' value='".$semester."'>
						<input class='form-control' type='hidden' name='kelompok_id' value='".$kelompok_id."'>
                            <span class='input-group-btn'>
                                <button type='submit' class='btn btn-primary'><i class='fa fa-plus'></i></button>
                            </span>
                    </div>
                </form>";
               }
              }
              else
              {
               $output .= 'Tidak ada daftar surah';
              }
              echo $output;
    }




    function sudah_tertempel(){
        $siswa_id = $this->input->post('siswa_id');
        $tahun_ajaran_id = $this->input->post('tahun_ajaran_id');
        $semester = $this->input->post('semester');
		$kelompok_id = $this->input->post('kelompok_id');

        $output = '';

            $queryData = "SELECT siswa.nama_siswa,siswa.siswa_id,surat_siswa.tahun_ajaran_id,surat_siswa.surat_siswa_id, surat_siswa.semester, surat.nama_surat from
            surat_siswa join siswa on siswa.siswa_id = surat_siswa.siswa_id
            join surat on surat.surat_id = surat_siswa.surat_id
            where surat_siswa.siswa_id='$siswa_id' and tahun_ajaran_id='$tahun_ajaran_id' and semester='$semester'";
            $data = $this->db->query($queryData);
              if($data->num_rows() > 0)
              {
               foreach($data->result() as $row)
               {
                $output .="<form action='".base_url('surat_siswa/hapus_surat/' .$row->surat_siswa_id)."' method='post'>
                    <div class='input-group' style='margin-bottom: 5px'>
                        <input readonly='' class='form-control' type='text' value='".$row->nama_surat."'>
                        <input class='form-control' type='hidden' name='siswa_id' value='".$siswa_id."'>
                        <input class='form-control' type='hidden' name='tahun_ajaran_id' value='".$tahun_ajaran_id."'>
                        <input class='form-control' type='hidden' name='semester' value='".$semester."'>
						<input class='form-control' type='hidden' name='kelompok_id' value='".$kelompok_id."'>
                            <span class='input-group-btn'>
                                <button type='submit' class='btn btn-danger'><i class='fa fa-trash' '></i></button>
                            </span>
                    </div>
                </form>";
               }
              }
              else
              {
               $output .= 'Belum ada surah untuk siswa ini';
              }
              echo $output;
    }


    function add_surat(){
        $siswa_id = $this->input->post('siswa_id');
        $surat_id = $this->input->post('surat_id');
        $tahun_ajaran_id = $this->input->post('tahun_ajaran_id');
        $semester = $this->input->post('semester');
		$kelompok_id = $this->input->post('kelompok_id');
        $sql = "INSERT INTO surat_siswa (surat_siswa_id,siswa_id,surat_id,tahun_ajaran_id,semester) VALUES ('','$siswa_id','$surat_id','$tahun_ajaran_id','$semester')";
        $this->db->query($sql);

        redirect(site_url('surat_siswa/daftar_surah/'.$siswa_id.'/'.$tahun_ajaran_id.'/'.$semester.'/'.$kelompok_id));


    }
    function hapus_surat($id){
        $siswa_id = $this->input->post('siswa_id');
        $surat_id = $this->input->post('surat_id');
        $tahun_ajaran_id = $this->input->post('tahun_ajaran_id');
        $semester = $this->input->post('semester');
		$kelompok_id = $this->input->post('kelompok_id');


        $sql = "DELETE FROM surat_siswa WHERE surat_siswa_id ='$id'";
        $this->db->query($sql);
        redirect(site_url('surat_siswa/daftar_surah/'.$siswa_id.'/'.$tahun_ajaran_id.'/'.$semester.'/' .$kelompok_id));

    }

 
}
