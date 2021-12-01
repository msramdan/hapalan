<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Guru extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Guru_model');
        $this->load->model('App_setting_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/guru/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/guru/index/';
            $config['first_url'] = base_url() . 'index.php/guru/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Guru_model->total_rows($q);
        $guru = $this->Guru_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'guru_data' => $guru,
            'app_setting' =>$this->App_setting_model->get_by_id(1),
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','guru/guru_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Guru_model->get_by_id($id);
        if ($row) {
            $data = array(
		'guru_id' => $row->guru_id,
        'app_setting' =>$this->App_setting_model->get_by_id(1),
		'nip' => $row->nip,
		'nama_guru' => $row->nama_guru,
		'jenis_kelamin' => $row->jenis_kelamin,
		'alamat' => $row->alamat,
		'user_id' => $row->user_id,
	    );
            $this->template->load('template','guru/guru_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('guru'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'app_setting' =>$this->App_setting_model->get_by_id(1),
            'action' => site_url('guru/create_action'),
	    'guru_id' => set_value('guru_id'),
	    'nip' => set_value('nip'),
	    'nama_guru' => set_value('nama_guru'),
	    'jenis_kelamin' => set_value('jenis_kelamin'),
	    'alamat' => set_value('alamat'),
	    'user_id' => set_value('user_id'),
	);
        $this->template->load('template','guru/guru_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nip' => $this->input->post('nip',TRUE),
		'nama_guru' => $this->input->post('nama_guru',TRUE),
		'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'user_id' => $this->input->post('user_id',TRUE),
	    );

            $this->Guru_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('guru'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Guru_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'app_setting' =>$this->App_setting_model->get_by_id(1),
                'action' => site_url('guru/update_action'),
		'guru_id' => set_value('guru_id', $row->guru_id),
		'nip' => set_value('nip', $row->nip),
		'nama_guru' => set_value('nama_guru', $row->nama_guru),
		'jenis_kelamin' => set_value('jenis_kelamin', $row->jenis_kelamin),
		'alamat' => set_value('alamat', $row->alamat),
		'user_id' => set_value('user_id', $row->user_id),
	    );
            $this->template->load('template','guru/guru_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('guru'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('guru_id', TRUE));
        } else {
            $data = array(
		'nip' => $this->input->post('nip',TRUE),
		'nama_guru' => $this->input->post('nama_guru',TRUE),
		'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'user_id' => $this->input->post('user_id',TRUE),
	    );

            $this->Guru_model->update($this->input->post('guru_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('guru'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Guru_model->get_by_id($id);

        if ($row) {
            $this->Guru_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('guru'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('guru'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nip', 'nip', 'trim|required');
	$this->form_validation->set_rules('nama_guru', 'nama guru', 'trim|required');
	$this->form_validation->set_rules('jenis_kelamin', 'jenis kelamin', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('user_id', 'user id', 'trim|required');

	$this->form_validation->set_rules('guru_id', 'guru_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "guru.xls";
        $judul = "guru";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nip");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Guru");
	xlsWriteLabel($tablehead, $kolomhead++, "Jenis Kelamin");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
	xlsWriteLabel($tablehead, $kolomhead++, "User Id");

	foreach ($this->Guru_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nip);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_guru);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jenis_kelamin);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
	    xlsWriteNumber($tablebody, $kolombody++, $data->user_id);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Guru.php */
/* Location: ./application/controllers/Guru.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-12-01 10:08:17 */
/* http://harviacode.com */