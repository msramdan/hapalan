<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Siswa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Siswa_model');
        $this->load->model('App_setting_model');
        $this->load->model('Tingkat_model');
        $this->load->model('Kelas_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $kelas_id = $_GET['kelas_id'];

        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/siswa/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/siswa/index/';
            $config['first_url'] = base_url() . 'index.php/siswa/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Siswa_model->total_rows($q);
        $siswa = $this->Siswa_model->get_limit_data($kelas_id,$config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'siswa_data' => $siswa,
            'app_setting' =>$this->App_setting_model->get_by_id(1),
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','siswa/siswa_list', $data);
    }

    public function grup()
    {
        $data = array(
            'siswa_data' => $this->Siswa_model->get_all(),
            'tingkat_data' => $this->Tingkat_model->get_all(),
            'app_setting' =>$this->App_setting_model->get_by_id(1),
        );
        $this->template->load('template','siswa/siswa_group', $data);
    }


    public function read($id) 
    {
        $row = $this->Siswa_model->get_by_id($id);
        if ($row) {
            $data = array(
		'siswa_id' => $row->siswa_id,
		'nis' => $row->nis,
        'app_setting' =>$this->App_setting_model->get_by_id(1),
		'nama_siswa' => $row->nama_siswa,
		'jenis_kelamin' => $row->jenis_kelamin,
		'kelas_id' => $row->kelas_id,
		'nama_ibu' => $row->nama_ibu,
		'nama_ayah' => $row->nama_ayah,
		'no_hp_wali_murid' => $row->no_hp_wali_murid,
		'user_id' => $row->user_id,
	    );
            $this->template->load('template','siswa/siswa_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('siswa/grup'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'kelas' => $this->Kelas_model->get_all(),
            'action' => site_url('siswa/create_action'),
	    'siswa_id' => set_value('siswa_id'),
	    'nis' => set_value('nis'),
        'app_setting' =>$this->App_setting_model->get_by_id(1),
	    'nama_siswa' => set_value('nama_siswa'),
	    'jenis_kelamin' => set_value('jenis_kelamin'),
	    'kelas_id' => set_value('kelas_id'),
	    'nama_ibu' => set_value('nama_ibu'),
	    'nama_ayah' => set_value('nama_ayah'),
	    'no_hp_wali_murid' => set_value('no_hp_wali_murid'),
	    'user_id' => set_value('user_id'),
	);
        $this->template->load('template','siswa/siswa_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nis' => $this->input->post('nis',TRUE),
		'nama_siswa' => $this->input->post('nama_siswa',TRUE),
		'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
		'kelas_id' => $this->input->post('kelas_id',TRUE),
		'nama_ibu' => $this->input->post('nama_ibu',TRUE),
		'nama_ayah' => $this->input->post('nama_ayah',TRUE),
		'no_hp_wali_murid' => $this->input->post('no_hp_wali_murid',TRUE),
		'user_id' => $this->input->post('user_id',TRUE),
	    );

            $this->Siswa_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('siswa/grup'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Siswa_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'app_setting' =>$this->App_setting_model->get_by_id(1),
                'kelas' => $this->Kelas_model->get_all(),
                'action' => site_url('siswa/update_action'),
		'siswa_id' => set_value('siswa_id', $row->siswa_id),
		'nis' => set_value('nis', $row->nis),
		'nama_siswa' => set_value('nama_siswa', $row->nama_siswa),
		'jenis_kelamin' => set_value('jenis_kelamin', $row->jenis_kelamin),
		'kelas_id' => set_value('kelas_id', $row->kelas_id),
		'nama_ibu' => set_value('nama_ibu', $row->nama_ibu),
		'nama_ayah' => set_value('nama_ayah', $row->nama_ayah),
		'no_hp_wali_murid' => set_value('no_hp_wali_murid', $row->no_hp_wali_murid),
		'user_id' => set_value('user_id', $row->user_id),
	    );
            $this->template->load('template','siswa/siswa_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('siswa/grup'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('siswa_id', TRUE));
        } else {
            $data = array(
		'nis' => $this->input->post('nis',TRUE),
		'nama_siswa' => $this->input->post('nama_siswa',TRUE),
		'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
		'kelas_id' => $this->input->post('kelas_id',TRUE),
		'nama_ibu' => $this->input->post('nama_ibu',TRUE),
		'nama_ayah' => $this->input->post('nama_ayah',TRUE),
		'no_hp_wali_murid' => $this->input->post('no_hp_wali_murid',TRUE),
		'user_id' => $this->input->post('user_id',TRUE),
	    );

            $this->Siswa_model->update($this->input->post('siswa_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('siswa/grup'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Siswa_model->get_by_id($id);

        if ($row) {
            $this->Siswa_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('siswa/grup'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('siswa/grup'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nis', 'nis', 'trim|required');
	$this->form_validation->set_rules('nama_siswa', 'nama siswa', 'trim|required');
	$this->form_validation->set_rules('jenis_kelamin', 'jenis kelamin', 'trim|required');
	$this->form_validation->set_rules('kelas_id', 'kelas id', 'trim|required');
	$this->form_validation->set_rules('nama_ibu', 'nama ibu', 'trim|required');
	$this->form_validation->set_rules('nama_ayah', 'nama ayah', 'trim|required');
	$this->form_validation->set_rules('no_hp_wali_murid', 'no hp wali murid', 'trim|required');
	$this->form_validation->set_rules('user_id', 'user id', 'trim|required');

	$this->form_validation->set_rules('siswa_id', 'siswa_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "siswa.xls";
        $judul = "siswa";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nis");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Siswa");
	xlsWriteLabel($tablehead, $kolomhead++, "Jenis Kelamin");
	xlsWriteLabel($tablehead, $kolomhead++, "Kelas Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Ibu");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Ayah");
	xlsWriteLabel($tablehead, $kolomhead++, "No Hp Wali Murid");
	xlsWriteLabel($tablehead, $kolomhead++, "User Id");

	foreach ($this->Siswa_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nis);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_siswa);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jenis_kelamin);
	    xlsWriteNumber($tablebody, $kolombody++, $data->kelas_id);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_ibu);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_ayah);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_hp_wali_murid);
	    xlsWriteNumber($tablebody, $kolombody++, $data->user_id);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Siswa.php */
/* Location: ./application/controllers/Siswa.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-12-01 10:07:57 */
/* http://harviacode.com */