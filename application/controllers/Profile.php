<?php defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Profile extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('App_setting_model');
        $this->load->model('User_model');
    }

    public function index()
    {
        $data = array(
            'app_setting' =>$this->App_setting_model->get_by_id(1),
        );
        $this->template->load('template', 'profile/profile',$data);
    }

    public function edit_profil($id)
    {
        $data = array(
            'no_hp'         => $this->input->post('no_hp', true),
        );
        $this->User_model->ubah_data($data, $id);
         $this->session->set_flashdata('message', 'Update Record Success');
        echo "<script>window.location='" . site_url('profile') . "'</script>";
    }
    public function edit_password($id)
    {
        if (sha1($this->input->post('lama')) == $this->fungsi->user_login()->password) {
            $data = array(
                'password'          => sha1($this->input->post('password', true)),
            );
            $this->User_model->ubah_data($data, $id);
             $this->session->set_flashdata('message', 'Update Record Success');
            echo "<script>window.location='" . site_url('auth/logout') . "'</script>";
        } else {
            echo "<script> alert('Password Lama Salah')</script>";
            echo "<script>window.location='" . site_url('profile') . "'</script>";
        }
    }
}
