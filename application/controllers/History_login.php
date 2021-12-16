<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class History_login extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        check_admin();
        $this->load->model('History_login_model');
        $this->load->model('App_setting_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/history_login/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/history_login/index/';
            $config['first_url'] = base_url() . 'index.php/history_login/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->History_login_model->total_rows($q);
        $history_login = $this->History_login_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'history_login_data' => $history_login,
            'app_setting' =>$this->App_setting_model->get_by_id(1),
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','history_login/history_login_list', $data);
    }

    public function read($id) 
    {
        $row = $this->History_login_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
        'app_setting' =>$this->App_setting_model->get_by_id(1),
		'username' => $row->username,
		'info' => $row->info,
		'tanggal' => $row->tanggal,
		'user_agent' => $row->user_agent,
	    );
            $this->template->load('template','history_login/history_login_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('history_login'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'app_setting' =>$this->App_setting_model->get_by_id(1),
            'action' => site_url('history_login/create_action'),
	    'id' => set_value('id'),
	    'user_id' => set_value('user_id'),
	    'info' => set_value('info'),
	    'tanggal' => set_value('tanggal'),
	    'user_agent' => set_value('user_agent'),
	);
        $this->template->load('template','history_login/history_login_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'user_id' => $this->input->post('user_id',TRUE),
		'info' => $this->input->post('info',TRUE),
		'tanggal' => $this->input->post('tanggal',TRUE),
		'user_agent' => $this->input->post('user_agent',TRUE),
	    );

            $this->History_login_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('history_login'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->History_login_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'app_setting' =>$this->App_setting_model->get_by_id(1),
                'action' => site_url('history_login/update_action'),
		'id' => set_value('id', $row->id),
		'user_id' => set_value('user_id', $row->user_id),
		'info' => set_value('info', $row->info),
		'tanggal' => set_value('tanggal', $row->tanggal),
		'user_agent' => set_value('user_agent', $row->user_agent),
	    );
            $this->template->load('template','history_login/history_login_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('history_login'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'user_id' => $this->input->post('user_id',TRUE),
		'info' => $this->input->post('info',TRUE),
		'tanggal' => $this->input->post('tanggal',TRUE),
		'user_agent' => $this->input->post('user_agent',TRUE),
	    );

            $this->History_login_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('history_login'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->History_login_model->get_by_id($id);

        if ($row) {
            $this->History_login_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('history_login'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('history_login'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('user_id', 'user id', 'trim|required');
	$this->form_validation->set_rules('info', 'info', 'trim|required');
	$this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
	$this->form_validation->set_rules('user_agent', 'user agent', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "history_login.xls";
        $judul = "history_login";
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
	xlsWriteLabel($tablehead, $kolomhead++, "User Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Info");
	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal");
	xlsWriteLabel($tablehead, $kolomhead++, "User Agent");

	foreach ($this->History_login_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->user_id);
	    xlsWriteLabel($tablebody, $kolombody++, $data->info);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal);
	    xlsWriteLabel($tablebody, $kolombody++, $data->user_agent);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file History_login.php */
/* Location: ./application/controllers/History_login.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-11-30 20:32:13 */
/* http://harviacode.com */