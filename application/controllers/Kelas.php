<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kelas extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Kelas_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/kelas/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/kelas/index/';
            $config['first_url'] = base_url() . 'index.php/kelas/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Kelas_model->total_rows($q);
        $kelas = $this->Kelas_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'kelas_data' => $kelas,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','kelas/kelas_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Kelas_model->get_by_id($id);
        if ($row) {
            $data = array(
		'kelas_id' => $row->kelas_id,
		'tingkat_id' => $row->tingkat_id,
		'nama_kelas' => $row->nama_kelas,
	    );
            $this->template->load('template','kelas/kelas_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kelas'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('kelas/create_action'),
	    'kelas_id' => set_value('kelas_id'),
	    'tingkat_id' => set_value('tingkat_id'),
	    'nama_kelas' => set_value('nama_kelas'),
	);
        $this->template->load('template','kelas/kelas_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'tingkat_id' => $this->input->post('tingkat_id',TRUE),
		'nama_kelas' => $this->input->post('nama_kelas',TRUE),
	    );

            $this->Kelas_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('kelas'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Kelas_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kelas/update_action'),
		'kelas_id' => set_value('kelas_id', $row->kelas_id),
		'tingkat_id' => set_value('tingkat_id', $row->tingkat_id),
		'nama_kelas' => set_value('nama_kelas', $row->nama_kelas),
	    );
            $this->template->load('template','kelas/kelas_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kelas'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kelas_id', TRUE));
        } else {
            $data = array(
		'tingkat_id' => $this->input->post('tingkat_id',TRUE),
		'nama_kelas' => $this->input->post('nama_kelas',TRUE),
	    );

            $this->Kelas_model->update($this->input->post('kelas_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('kelas'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Kelas_model->get_by_id($id);

        if ($row) {
            $this->Kelas_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kelas'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kelas'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('tingkat_id', 'tingkat id', 'trim|required');
	$this->form_validation->set_rules('nama_kelas', 'nama kelas', 'trim|required');

	$this->form_validation->set_rules('kelas_id', 'kelas_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "kelas.xls";
        $judul = "kelas";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Tingkat Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Kelas");

	foreach ($this->Kelas_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->tingkat_id);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_kelas);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Kelas.php */
/* Location: ./application/controllers/Kelas.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-12-01 11:09:58 */
/* http://harviacode.com */