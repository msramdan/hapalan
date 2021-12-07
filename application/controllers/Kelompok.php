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
            'tingkat' => $this->Tingkat_model->get_all(),
            'app_setting' =>$this->App_setting_model->get_by_id(1),
            'tahun_ajaran' =>$this->Tahun_ajaran_model->get_all_aktif(),
            'action' => site_url('kelompok/create_action'),
	    'kelompok_id' => set_value('kelompok_id'),
	    'nama_kelompok' => set_value('nama_kelompok'),
	    'tahun_ajaran_id' => set_value('tahun_ajaran_id'),
        'tingkat_id' => set_value('tingkat_id'),
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
        'tingkat_id' => $this->input->post('tingkat_id',TRUE),
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
                'tingkat' => $this->Tingkat_model->get_all(),
                'app_setting' =>$this->App_setting_model->get_by_id(1),
                'tahun_ajaran' =>$this->Tahun_ajaran_model->get_all_aktif(),
                'action' => site_url('kelompok/update_action'),
		'kelompok_id' => set_value('kelompok_id', $row->kelompok_id),
		'nama_kelompok' => set_value('nama_kelompok', $row->nama_kelompok),
		'tahun_ajaran_id' => set_value('tahun_ajaran_id', $row->tahun_ajaran_id),
        'tingkat_id' => set_value('tingkat_id', $row->tingkat_id),
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
        'tingkat_id' => $this->input->post('tingkat_id',TRUE),
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
	$this->form_validation->set_rules('tahun_ajaran_id', 'tahun ajaran', 'trim|required');
    $this->form_validation->set_rules('tingkat_id', 'Tingkat', 'trim|required');

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
            'kelompok' => $this->db->get_where('kelompok', ['kelompok_id' =>$kelompok_id])->row_array(),
            'app_setting' =>$this->App_setting_model->get_by_id(1),
        );

        $this->template->load('template','kelompok/anggota_kelompok',$data);
    }

    function daftar_kelas(){
        $tingkat_id = $this->input->post('tingkat_id');
        $kelompok_id = $this->input->post('kelompok_id');
        $tahun_ajaran_id = $this->input->post('tahun_ajaran_id');
        $output = '';
        if($tingkat_id=='pilih')
          {
           echo "Silahkan Pilih Tingkat terlebih dahulu";
          }else{
            $queryData = "SELECT * from kelas where tingkat_id='$tingkat_id'";
            $data = $this->db->query($queryData);
              if($data->num_rows() > 0)
              {
               foreach($data->result() as $row)
               {
                $output .="
                    <div class='panel panel-default' style='margin-bottom: 2px'>
                        <div class='panel-heading'>
                            <h4 class='panel-title'>
                                <a data-toggle='collapse' href='#collapse".$row->kelas_id."'>".$row->nama_kelas."</a>
                            </h4>
                        </div>
                        <div id='collapse".$row->kelas_id."' class='panel-collapse collapse in'>";
                $querySiswa = "SELECT siswa.*,kelompok_member.kelompok_member_id
                                FROM siswa
                                LEFT OUTER JOIN kelompok_member
                                ON siswa.siswa_id = kelompok_member.siswa_id
                                WHERE kelompok_member.kelompok_member_id IS NULL
                                and kelas_id='$row->kelas_id'";

                $siswa = $this->db->query($querySiswa);
                    foreach($siswa->result() as $data)
                        {
                            $output .="<div class='input-group' style='margin-bottom: 5px;margin-left: 25px; margin-right: 25px'>
                                        <input readonly='' class='form-control' type='text' value='".$data->nama_siswa."'>
                                        <span class='input-group-btn'>
                                            <a href='".base_url('kelompok/add_kelompok/').$data->siswa_id.'/'.$kelompok_id."' class='btn btn-primary'><i class='fa fa-plus' aria-hidden='true'></i></a></span>
                                    </div>";
                        }            
                $output .="
                        </div>
                    </div>";
               }
              }
              else
              {
               $output .= 'Kelas tidak ditemukan';
              }
              echo $output;
          }        
    }


     function daftar_kelompok(){
        $kelompok_id = $this->input->post('kelompok_id');
        $output = '';
        if($kelompok_id=='pilih')
          {
           echo "Silahkan Pilih Tingkat terlebih dahulu";
          }else{
            $queryData = "SELECT siswa.nama_siswa,siswa.siswa_id,kelompok_member.kelompok_id from
            kelompok_member join kelompok on kelompok.kelompok_id=kelompok_member.kelompok_id
            join siswa on siswa.siswa_id = kelompok_member.siswa_id where kelompok_member.kelompok_id='$kelompok_id'";



            $data = $this->db->query($queryData);
              if($data->num_rows() > 0)
              {
               foreach($data->result() as $row)
               {
                $output .="<div class='input-group' style='margin-bottom: 5px'>
                            <input readonly='' class='form-control' type='text' value='".$row->nama_siswa."'>
                                <span class='input-group-btn'>
                                    <a href='".base_url('kelompok/hapus_kelompok/').$row->siswa_id.'/'.$kelompok_id."' class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></a>
                                </span>
                        </div>";
               }
              }
              else
              {
               $output .= 'Belum ada anggota kelompok';
              }
              echo $output;
          }        
    }

    function add_kelompok($siswa_id){
        $kelompok= $this->uri->segment(4);
        $sql = "INSERT INTO kelompok_member (kelompok_member_id,kelompok_id,siswa_id) VALUES ('','$kelompok','$siswa_id')";
        $this->db->query($sql);
        redirect(site_url('kelompok/anggota_kelompok/'.$kelompok));

    }
    function hapus_kelompok($siswa_id){
        $kelompok= $this->uri->segment(4);
        $sql = "DELETE FROM kelompok_member WHERE siswa_id='$siswa_id'";
        $this->db->query($sql);
        redirect(site_url('kelompok/anggota_kelompok/'.$kelompok));
    }




    
}
