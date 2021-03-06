<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tingkat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('App_setting_model');
        $this->load->model('Tingkat_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data = array(
            'tingkat_data' => $this->Tingkat_model->get_all(),
            'app_setting' =>$this->App_setting_model->get_by_id(1),
        );
        $this->template->load('template','tingkat/tingkat_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Tingkat_model->get_by_id($id);
        if ($row) {
            $data = array(
		'tingkat_id' => $row->tingkat_id,
        'app_setting' =>$this->App_setting_model->get_by_id(1),
		'nama_tingkat' => $row->nama_tingkat,
	    );
            $this->template->load('template','tingkat/tingkat_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tingkat'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'app_setting' =>$this->App_setting_model->get_by_id(1),
            'action' => site_url('tingkat/create_action'),
	    'tingkat_id' => set_value('tingkat_id'),
	    'nama_tingkat' => set_value('nama_tingkat'),
	);
        $this->template->load('template','tingkat/tingkat_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_tingkat' => $this->input->post('nama_tingkat',TRUE),
	    );

            $this->Tingkat_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('tingkat'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tingkat_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'app_setting' =>$this->App_setting_model->get_by_id(1),
                'action' => site_url('tingkat/update_action'),
		'tingkat_id' => set_value('tingkat_id', $row->tingkat_id),
		'nama_tingkat' => set_value('nama_tingkat', $row->nama_tingkat),
	    );
            $this->template->load('template','tingkat/tingkat_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tingkat'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('tingkat_id', TRUE));
        } else {
            $data = array(
		'nama_tingkat' => $this->input->post('nama_tingkat',TRUE),
	    );

            $this->Tingkat_model->update($this->input->post('tingkat_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tingkat'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tingkat_model->get_by_id($id);

        if ($row) {
            $this->Tingkat_model->delete($id);
            $error = $this->db->error();
            if ($error['code'] != 0) {
                 $this->session->set_flashdata('error', 'Tidak dapat dihapus data sudah berrelasi');
            }else{
                $this->session->set_flashdata('message', 'Delete Record Success');
            }
            redirect(site_url('tingkat'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tingkat'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_tingkat', 'nama tingkat', 'trim|required');

	$this->form_validation->set_rules('tingkat_id', 'tingkat_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tingkat.xls";
        $judul = "tingkat";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Tingkat");

	foreach ($this->Tingkat_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_tingkat);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Tingkat.php */
/* Location: ./application/controllers/Tingkat.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-12-01 10:05:45 */
/* http://harviacode.com */