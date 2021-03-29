<?php
Class Fungsi{
    protected $ci;

    public function __construct() {
        $this->ci =& get_instance();
    }

    public function user_login(){
        $this->ci->load->model('user_m');
        $user_id = $this->ci->session->userdata('userid');
        $user_data = $this->ci->user_m->get($user_id)->row();
        return $user_data;
    }

    public function count_karyawan(){
        $this->ci->load->model('karyawan_model');
        return $this->ci->karyawan_model->total_rows();
    }
    public function count_jabatan(){
        $this->ci->load->model('jabatan_model');
        return $this->ci->jabatan_model->total_rows();
    }
    public function count_bank(){
        $this->ci->load->model('bank_model');
        return $this->ci->bank_model->total_rows();
    }
    public function count_status(){
        $this->ci->load->model('status_karyawan_model');
        return $this->ci->status_karyawan_model->total_rows();
    }
}