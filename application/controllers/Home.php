<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        is_login();
        // check_admin();
    }

	function index()
	{
		$data = array(
            'bahan_baku_data' => 'Judul',
        );
		$this->template->load('template','home/index',$data);
	}
}
