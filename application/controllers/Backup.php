<?php
date_default_timezone_set('Asia/Jakarta');

class Backup extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		is_login();
		// check_admin();
	}

	public function index()
	{
		$this->template->load('template', 'backup/view');
	}

	public function file()
	{
		date_default_timezone_set("Asia/Jakarta");
		$this->load->dbutil();
		$prefs = array(
			'tables'        => array('user'),   // Array of tables to backup.
			'ignore'        => array(),                     // List of tables to omit from the backup
			'format'        => 'txt',                       // gzip, zip, txt
			'filename'      => date('Ymd-h.i') . '.sql',              // File name - NEEDED ONLY WITH ZIP FILES
			'add_drop'      => TRUE,                        // Whether to add DROP TABLE statements to backup file
			'add_insert'    => TRUE,                        // Whether to add INSERT data to backup file
			'newline'       => "\n"                         // Newline character used in backup file
		);
		$backup = $this->dbutil->backup($prefs);
		// Load the file helper and write the file to your server
		$this->load->helper('file');
		write_file(base_url('db/') . date('Ymd-h.i') . '.sql', $backup);
		// Load the download helper and send the file to your desktop
		$this->load->helper('download');
		force_download(date('Ymd-h.i') . '.sql', $backup);
		 
	}
}
