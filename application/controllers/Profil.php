<?php defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Profil extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        is_login();
    }

    public function index()
    {
        $this->template->load('template', 'profil/profil');
    }
}
