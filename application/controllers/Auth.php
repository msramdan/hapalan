<?php defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Auth extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('User_model');
    $this->load->model('App_setting_model');
  }

  public function index()
  {
    check_already_login();

    $data = array(
            'app_setting' =>$this->App_setting_model->get_by_id(1),
        );
    $this->load->view('auth/login',$data);
  }

  public function process()
  {
    $post =$this->input->post(null, TRUE);
    if (isset($post['login'])){
      $this->load->model('User_model');
      $query =$this->User_model->login($post);
      if($query->num_rows() >0){
        $row =$query->row();
        $params = array(
          'userid'=>$row->user_id,
          'level' =>$row->level
        );
        $this->session->set_userdata($params);
        $this->User_model->addHistory($this->fungsi->user_login()->user_id, $this->fungsi->user_login()->username.' Telah melakukan login', date('d/m/Y H:i:s'), $_SERVER['HTTP_USER_AGENT']);
        if ($this->session->userdata('level') =='ADMIN' || $this->session->userdata('level') =='GURU') {
          echo "<script>window.location='".site_url('home')."'</script>";
        }else{
          echo "<script>window.location='".site_url('pannel_siswa')."'</script>";
        }
  
      } else{
        echo "<script>
        alert('Login Gagal');
        window.location='".site_url('auth')."'</script>";

      }
    }
  }


  public function logout()
  {
    $params = array('userid', 'level');
    $this->session->unset_userdata($params);
    redirect('auth');
  }

  public function blocked()
  {
    $this->load->view('v_error');
  }

}
