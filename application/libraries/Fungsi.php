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

}