<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Surat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Surat_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/surat/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/surat/index/';
            $config['first_url'] = base_url() . 'index.php/surat/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Surat_model->total_rows($q);
        $surat = $this->Surat_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'surat_data' => $surat,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','surat/surat_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Surat_model->get_by_id($id);
        if ($row) {
            $data = array(
		'surat_id' => $row->surat_id,
		'nama_surat' => $row->nama_surat,
		'jumlah_ayat' => $row->jumlah_ayat,
	    );
            $this->template->load('template','surat/surat_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('surat'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('surat/create_action'),
	    'surat_id' => set_value('surat_id'),
	    'nama_surat' => set_value('nama_surat'),
	    'jumlah_ayat' => set_value('jumlah_ayat'),
	);
        $this->template->load('template','surat/surat_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_surat' => $this->input->post('nama_surat',TRUE),
		'jumlah_ayat' => $this->input->post('jumlah_ayat',TRUE),
	    );

            $this->Surat_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('surat'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Surat_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('surat/update_action'),
		'surat_id' => set_value('surat_id', $row->surat_id),
		'nama_surat' => set_value('nama_surat', $row->nama_surat),
		'jumlah_ayat' => set_value('jumlah_ayat', $row->jumlah_ayat),
	    );
            $this->template->load('template','surat/surat_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('surat'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('surat_id', TRUE));
        } else {
            $data = array(
		'nama_surat' => $this->input->post('nama_surat',TRUE),
		'jumlah_ayat' => $this->input->post('jumlah_ayat',TRUE),
	    );

            $this->Surat_model->update($this->input->post('surat_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('surat'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Surat_model->get_by_id($id);

        if ($row) {
            $this->Surat_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('surat'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('surat'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_surat', 'nama surat', 'trim|required');
	$this->form_validation->set_rules('jumlah_ayat', 'jumlah ayat', 'trim|required');

	$this->form_validation->set_rules('surat_id', 'surat_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "surat.xls";
        $judul = "surat";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Surat");
	xlsWriteLabel($tablehead, $kolomhead++, "Jumlah Ayat");

	foreach ($this->Surat_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_surat);
	    xlsWriteNumber($tablebody, $kolombody++, $data->jumlah_ayat);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Surat.php */
/* Location: ./application/controllers/Surat.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-12-01 09:55:19 */
/* http://harviacode.com */