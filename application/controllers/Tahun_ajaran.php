<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tahun_ajaran extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // is_login();
        $this->load->model('Tahun_ajaran_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/tahun_ajaran/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/tahun_ajaran/index/';
            $config['first_url'] = base_url() . 'index.php/tahun_ajaran/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Tahun_ajaran_model->total_rows($q);
        $tahun_ajaran = $this->Tahun_ajaran_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tahun_ajaran_data' => $tahun_ajaran,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','tahun_ajaran/tahun_ajaran_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Tahun_ajaran_model->get_by_id($id);
        if ($row) {
            $data = array(
		'tahun_ajaran_id' => $row->tahun_ajaran_id,
		'tahun_ajaran' => $row->tahun_ajaran,
		'status' => $row->status,
	    );
            $this->template->load('template','tahun_ajaran/tahun_ajaran_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tahun_ajaran'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tahun_ajaran/create_action'),
	    'tahun_ajaran_id' => set_value('tahun_ajaran_id'),
	    'tahun_ajaran' => set_value('tahun_ajaran'),
	    'status' => set_value('status'),
	);
        $this->template->load('template','tahun_ajaran/tahun_ajaran_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'tahun_ajaran' => $this->input->post('tahun_ajaran',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );

            $this->Tahun_ajaran_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('tahun_ajaran'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tahun_ajaran_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tahun_ajaran/update_action'),
		'tahun_ajaran_id' => set_value('tahun_ajaran_id', $row->tahun_ajaran_id),
		'tahun_ajaran' => set_value('tahun_ajaran', $row->tahun_ajaran),
		'status' => set_value('status', $row->status),
	    );
            $this->template->load('template','tahun_ajaran/tahun_ajaran_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tahun_ajaran'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('tahun_ajaran_id', TRUE));
        } else {
            $data = array(
		'tahun_ajaran' => $this->input->post('tahun_ajaran',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );

            $this->Tahun_ajaran_model->update($this->input->post('tahun_ajaran_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tahun_ajaran'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tahun_ajaran_model->get_by_id($id);

        if ($row) {
            $this->Tahun_ajaran_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tahun_ajaran'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tahun_ajaran'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('tahun_ajaran', 'tahun ajaran', 'trim|required');
	$this->form_validation->set_rules('status', 'status', 'trim|required');

	$this->form_validation->set_rules('tahun_ajaran_id', 'tahun_ajaran_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tahun_ajaran.xls";
        $judul = "tahun_ajaran";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Tahun Ajaran");
	xlsWriteLabel($tablehead, $kolomhead++, "Status");

	foreach ($this->Tahun_ajaran_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tahun_ajaran);
	    xlsWriteLabel($tablebody, $kolombody++, $data->status);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Tahun_ajaran.php */
/* Location: ./application/controllers/Tahun_ajaran.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-11-30 19:56:41 */
/* http://harviacode.com */