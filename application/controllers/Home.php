<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        is_login();    
    }

	public function index()
	{
		$user_session = $this->session->userdata('userid');
		if (!$user_session) {
			redirect('auth/login');
		}else if ($user_session==1 || $user_session==2 ) {
			$this->template->load('template','dashboard');
		}else{
			$this->template->load('template','home');
		}
		
	}
}
