<?php defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Walikelas extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        is_login();
        check_admin();
        $this->load->model('kelas_model');
        $this->load->model('akses_kelas_walikelas_model');
    }

    public function index()
    {
        if ($this->fungsi->user_login()->level == 1) {
            $data['row'] = $this->kelas_model->get_all();
        } else {
            $data['row'] = $this->akses_kelas_walikelas_model->get_akses($this->fungsi->user_login()->user_id);
        }
        $this->template->load('template', 'walikelas/walikelas_data', $data);
    }

    public function view_walikelas()
    {
        // 

    }
}
