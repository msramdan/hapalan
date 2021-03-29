<?php defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Nilai extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('kelas_model');
        $this->load->model('nilai_model');
        $this->load->model('akses_kelas_guru_model');
        $this->load->model('akses_kelas_walikelas_model');
    }

    public function index()
    {
        if ($this->fungsi->user_login()->level == 1) {
            $data['row'] = $this->kelas_model->get_all();
        } else {
            if ($this->fungsi->user_login()->level == 2) {
                $data['row'] = $this->akses_kelas_walikelas_model->get_akses($this->fungsi->user_login()->user_id);
                // var_dump($data['row']);
                // die;
            } else if ($this->fungsi->user_login()->level == 3) {
                $data['row'] = $this->akses_kelas_guru_model->get_akses($this->fungsi->user_login()->user_id);
            }
        }
        $this->template->load('template', 'nilai/nilai_data', $data);
    }

    public function ujian()
    {
        if ($this->fungsi->user_login()->level == 1) {
            $data['row'] = $this->kelas_model->get_all();
        } else {
            if ($this->fungsi->user_login()->level == 2) {
                $data['row'] = $this->akses_kelas_walikelas_model->get_akses($this->fungsi->user_login()->user_id);
            } else if ($this->fungsi->user_login()->level == 3) {
                $data['row'] = $this->akses_kelas_guru_model->get_akses($this->fungsi->user_login()->user_id);
            }
        }
        $this->template->load('template', 'nilai/nilai_ujian', $data);
    }

    public function view_siswa($kelas_id)
    {
        $data['row'] = $this->nilai_model->view_siswa($kelas_id);
        $this->template->load('template', 'nilai/view_siswa', $data);
    }
}
