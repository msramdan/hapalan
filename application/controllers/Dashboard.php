<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct()
    {
        parent::__construct();

       
    }

	public function index()
	{

		$user_session = $this->session->userdata('userid');
		if (!$user_session) {
			redirect('auth/login');
		}else{
			$this->template->load('template','dashboard');
		}
		
	}
}
