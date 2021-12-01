<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('App_setting_model');
        // check_admin();
    }

	function index()
	{
		$data = array(
            'app_setting' =>$this->App_setting_model->get_by_id(1),
        );
		$this->template->load('template','home/index',$data);
	}
}
