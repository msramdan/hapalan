<?php
Class Fungsi{
    protected $ci;

    public function __construct() {
        $this->ci =& get_instance();
    }

    function user_login(){
        $this->ci->load->model('User_model');
        $user_id = $this->ci->session->userdata('userid');
        $user_data = $this->ci->User_model->get($user_id)->row();
        return $user_data;
    }

    function guru_login(){
        $ci = &get_instance();
        $user_session = $ci->session->userdata('userid');
        $ci->db->where('user_id', $user_session);
        $result = $ci->db->get('guru')->row();
        return $result;
    }

    function count_guru(){
        $this->ci->load->model('Guru_model');
        return $this->ci->Guru_model->get_total()->num_rows();
    }

    function count_siswa(){
            $this->ci->load->model('Siswa_model');
            return $this->ci->Siswa_model->get_total()->num_rows();
        }
    function count_kelompok(){
            $this->ci->load->model('Kelompok_model');
            return $this->ci->Kelompok_model->get_total()->num_rows();
        }

    function count_user(){
            $this->ci->load->model('User_model');
            return $this->ci->User_model->get_total()->num_rows();
        }

}