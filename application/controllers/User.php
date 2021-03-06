<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('App_setting_model');
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        check_admin();
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/user/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/user/index/';
            $config['first_url'] = base_url() . 'index.php/user/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->User_model->total_rows($q);
        $user = $this->User_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'user_data' => $user,
            'app_setting' =>$this->App_setting_model->get_by_id(1),
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','user/user_list', $data);
    }

    public function read($id) 
    {
        check_admin();
        $row = $this->User_model->get_by_id($id);
        if ($row) {
            $data = array(
		'user_id' => $row->user_id,
        'app_setting' =>$this->App_setting_model->get_by_id(1),
		'username' => $row->username,
		'password' => $row->password,
		'level' => $row->level,
	    );
            $this->template->load('template','user/user_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user'));
        }
    }

    public function create() 
    {
        check_admin();
        $data = array(
            'button' => 'Create',
            'app_setting' =>$this->App_setting_model->get_by_id(1),
            'action' => site_url('user/create_action'),
	    'user_id' => set_value('user_id'),
	    'username' => set_value('username'),
	    'password' => set_value('password'),
	    'level' => set_value('level'),
	);
        $this->template->load('template','user/user_form', $data);
    }
    
    public function create_action() 
    {
        check_admin();
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {

            $data = array(
        		'username' => $this->input->post('username',TRUE),
                'password' => sha1($this->input->post('password',TRUE)),
        		'level' => $this->input->post('level',TRUE),
        	);

            $this->User_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('user'));
        }
    }
    
    public function update($id) 
    {
        check_admin();
        $row = $this->User_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'app_setting' =>$this->App_setting_model->get_by_id(1),
                'action' => site_url('user/update_action'),
		'user_id' => set_value('user_id', $row->user_id),
		'username' => set_value('username', $row->username),
		'password' => set_value('password', $row->password),
		'level' => set_value('level', $row->level),
	    );
            $this->template->load('template','user/user_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user'));
        }
    }
    
    public function update_action() 
    {
        check_admin();
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('user_id', TRUE));
        } else {

            if ($this->input->post('password')==''||$this->input->post('password')==null) {            
                 $data = array(
                    'username' => $this->input->post('username',TRUE),
                    'level' => $this->input->post('level',TRUE),
                );
            }else{
                $data = array(
                'username' => $this->input->post('username',TRUE),
                'password' => sha1($this->input->post('password',TRUE)),
                'level' => $this->input->post('level',TRUE),
                );
            }

            $this->User_model->update($this->input->post('user_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('user'));
        }
    }
    
    public function delete($id) 
    {
        check_admin();
        $row = $this->User_model->get_by_id($id);

        if ($row) {
            $this->User_model->delete($id);
            $error = $this->db->error();
            if ($error['code'] != 0) {
                 $this->session->set_flashdata('error', 'Tidak dapat dihapus data sudah berrelasi');
            }else{
                $this->session->set_flashdata('message', 'Delete Record Success');
            }

            redirect(site_url('user'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('username', 'username', 'trim|required');
	// $this->form_validation->set_rules('password', 'password', 'trim|required');
	$this->form_validation->set_rules('level', 'level', 'trim|required');

	$this->form_validation->set_rules('user_id', 'user_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "user.xls";
        $judul = "user";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Username");
	xlsWriteLabel($tablehead, $kolomhead++, "Level");

	foreach ($this->User_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->username);
	    xlsWriteLabel($tablebody, $kolombody++, $data->level);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function download($gambar){
        check_admin();
        force_download('admin/assets/img/user/'.$gambar,NULL);
    }

}

/* End of file User.php */
/* Location: ./application/controllers/User.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-12-01 10:13:59 */
/* http://harviacode.com */