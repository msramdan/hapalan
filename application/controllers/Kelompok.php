<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kelompok extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Tingkat_model');
        $this->load->model('Kelompok_model');
        $this->load->model('App_setting_model');
        $this->load->model('Tahun_ajaran_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/kelompok/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/kelompok/index/';
            $config['first_url'] = base_url() . 'index.php/kelompok/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Kelompok_model->total_rows($q);
        $kelompok = $this->Kelompok_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'kelompok_data' => $kelompok,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'app_setting' =>$this->App_setting_model->get_by_id(1),
        );
        $this->template->load('template','kelompok/kelompok_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Kelompok_model->get_by_id($id);
        if ($row) {
            $data = array(
		'kelompok_id' => $row->kelompok_id,
        'app_setting' =>$this->App_setting_model->get_by_id(1),
		'nama_kelompok' => $row->nama_kelompok,
		'tahun_ajaran' => $row->tahun_ajaran,
	    );
            $this->template->load('template','kelompok/kelompok_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kelompok'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'app_setting' =>$this->App_setting_model->get_by_id(1),
            'tahun_ajaran' =>$this->Tahun_ajaran_model->get_all_aktif(),
            'action' => site_url('kelompok/create_action'),
	    'kelompok_id' => set_value('kelompok_id'),
	    'nama_kelompok' => set_value('nama_kelompok'),
	    'tahun_ajaran_id' => set_value('tahun_ajaran_id'),
	);
        $this->template->load('template','kelompok/kelompok_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_kelompok' => $this->input->post('nama_kelompok',TRUE),
		'tahun_ajaran_id' => $this->input->post('tahun_ajaran_id',TRUE),
	    );

            $this->Kelompok_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('kelompok'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Kelompok_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'app_setting' =>$this->App_setting_model->get_by_id(1),
                'tahun_ajaran' =>$this->Tahun_ajaran_model->get_all_aktif(),
                'action' => site_url('kelompok/update_action'),
		'kelompok_id' => set_value('kelompok_id', $row->kelompok_id),
		'nama_kelompok' => set_value('nama_kelompok', $row->nama_kelompok),
		'tahun_ajaran_id' => set_value('tahun_ajaran_id', $row->tahun_ajaran_id),
	    );
            $this->template->load('template','kelompok/kelompok_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kelompok'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kelompok_id', TRUE));
        } else {
            $data = array(
		'nama_kelompok' => $this->input->post('nama_kelompok',TRUE),
		'tahun_ajaran_id' => $this->input->post('tahun_ajaran_id',TRUE),
	    );

            $this->Kelompok_model->update($this->input->post('kelompok_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('kelompok'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Kelompok_model->get_by_id($id);

        if ($row) {
            $this->Kelompok_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kelompok'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kelompok'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_kelompok', 'nama kelompok', 'trim|required');
	$this->form_validation->set_rules('tahun_ajaran_id', 'tahun ajaran id', 'trim|required');

	$this->form_validation->set_rules('kelompok_id', 'kelompok_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "kelompok.xls";
        $judul = "kelompok";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Kelompok");
	xlsWriteLabel($tablehead, $kolomhead++, "Tahun Ajaran Id");

	foreach ($this->Kelompok_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_kelompok);
	    xlsWriteNumber($tablebody, $kolombody++, $data->tahun_ajaran_id);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    function anggota_kelompok($kelompok_id)
    {

        $data = array(
            'tingkat' => $this->Tingkat_model->get_all(),
            'kelompok' => $this->db->get_where('kelompok', ['kelompok_id' =>$kelompok_id])->row_array(),
            'app_setting' =>$this->App_setting_model->get_by_id(1),
        );

        $this->template->load('template','kelompok/anggota_kelompok',$data);
    }

}

/* End of file Kelompok.php */
/* Location: ./application/controllers/Kelompok.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-12-01 10:04:02 */
/* http://harviacode.com */