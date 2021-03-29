<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Nilai_siswa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Nilai_siswa_model');
        $this->load->model('Siswa_model');
        $this->load->model('Surat_model');
        $this->load->model('Tahunajaran_model');
        $this->load->library('form_validation');
    }

    public function index($kelas_id)
    {
        // cek hak akses
        if ($this->session->userdata('level') == '2') {
            check_access_walikelas($kelas_id);
        } else if ($this->session->userdata('level') == '3') {
            check_access_guru($kelas_id);
        }

        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(4));

        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/nilai_siswa/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/nilai_siswa/index/';
            $config['first_url'] = base_url() . 'index.php/nilai_siswa/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Nilai_siswa_model->total_rows($q, $kelas_id);
        $nilai_siswa = $this->Nilai_siswa_model->get_limit_data($config['per_page'], $start, $q, $kelas_id);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'nilai_siswa_data' => $nilai_siswa,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'kelas_id' => $kelas_id
        );
        $this->template->load('template', 'nilai_siswa/nilai_list', $data);
    }

    public function read($id, $kelas_id)
    {
        // cek hak akses
        if ($this->session->userdata('level') == '2') {
            check_access_walikelas($kelas_id);
        } else if ($this->session->userdata('level') == '3') {
            check_access_guru($kelas_id);
        }

        $row = $this->Nilai_siswa_model->get_by_id($id);
        if ($row) {
            $data = array(
                'nama_siswa' => $row->nama_siswa,
                'nama_surat1' => $row->nama_surat1,
                'nama_surat2' => $row->nama_surat2,
                'ayat_mulai' => $row->ayat_mulai,
                'ayat_selesai' => $row->ayat_selesai,
                'nilai' => $row->nilai,
                'tanggal' => $row->tanggal,
                'tahun_ajaran' => $row->tahun_ajaran,
                'kelas_id' => $kelas_id
            );
            $this->template->load('template', 'nilai_siswa/nilai_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('nilai_siswa/index/' . $kelas_id));
        }
    }

    public function create($kelas_id)
    {
        // cek hak akses
        if ($this->session->userdata('level') == '2') {
            check_access_walikelas($kelas_id);
        } else if ($this->session->userdata('level') == '3') {
            check_access_guru($kelas_id);
        }

        $siswa = $this->Siswa_model->get_all($kelas_id);
        $tahunajaran = $this->Tahunajaran_model->get_all();
        $surat = $this->Surat_model->get_all();
        $data = array(
            'button' => 'Create',
            'action' => site_url('nilai_siswa/create_action'),
            'nilai_id' => set_value('nilai_id'),
            'siswa_list' => $siswa,
            'siswa_id' => set_value('siswa_id'),
            'surat_list' => $surat,
            'surat_id_mulai' => set_value('surat_id_mulai'),
            'surat_id_selesai' => set_value('surat_id_selesai'),
            'ayat_mulai' => set_value('ayat_mulai'),
            'ayat_selesai' => set_value('ayat_selesai'),
            'juz' => set_value('juz'),
            'akumulasi' => set_value('akumulasi'),
            'tahunajaran_list' => $tahunajaran,
            'tahun_ajaran_id' => set_value('tahun_ajaran_id'),
            'nilai' => set_value('nilai'),
            'tanggal' => set_value('tanggal'),
            'kelas_id' => $kelas_id
        );
        $this->template->load('template', 'nilai_siswa/nilai_form', $data);
    }

    public function create_action()
    {
        $kelas_id = $this->input->post('kelas_id');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create($kelas_id);
        } else {
            $data = array(
                'siswa_id' => $this->input->post('siswa_id', TRUE),
                'surat_id_mulai' => $this->input->post('surat_id_mulai'),
                'surat_id_selesai' => $this->input->post('surat_id_selesai'),
                'ayat_mulai' => $this->input->post('ayat_mulai'),
                'ayat_selesai' => $this->input->post('ayat_selesai'),
                'juz' => $this->input->post('juz'),
                'akumulasi' => $this->input->post('akumulasi'),
                'tahun_ajaran_id' => $this->input->post('tahun_ajaran_id'),
                'nilai' => $this->input->post('nilai'),
                'tanggal' => $this->input->post('tanggal'),
                'tipe' => '1'
            );

            $this->Nilai_siswa_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('nilai_siswa/index/' . $kelas_id));
        }
    }

    public function update($id, $kelas_id)
    {
        // cek hak akses
        if ($this->session->userdata('level') == '2') {
            check_access_walikelas($kelas_id);
        } else if ($this->session->userdata('level') == '3') {
            check_access_guru($kelas_id);
        }

        $row = $this->Nilai_siswa_model->get_by_id($id);
        $siswa = $this->Siswa_model->get_all($kelas_id);
        $tahunajaran = $this->Tahunajaran_model->get_all();
        $surat = $this->Surat_model->get_all();
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('nilai_siswa/update_action'),
                'nilai_id' => set_value('nilai_id', $row->nilai_id),
                'siswa_list' => $siswa,
                'siswa_id' => set_value('siswa_id', $row->siswa_id),
                'surat_list' => $surat,
                'surat_id_mulai' => set_value('surat_id_mulai', $row->surat_id_mulai),
                'surat_id_selesai' => set_value('surat_id_selesai', $row->surat_id_selesai),
                'ayat_mulai' => set_value('ayat_mulai', $row->ayat_mulai),
                'ayat_selesai' => set_value('ayat_selesai', $row->ayat_selesai),
                'juz' => set_value('juz', $row->juz),
                'akumulasi' => set_value('akumulasi', $row->akumulasi),
                'tahunajaran_list' => $tahunajaran,
                'tahun_ajaran_id' => set_value('tahun_ajaran_id', $row->tahun_ajaran_id),
                'nilai' => set_value('nilai', $row->nilai),
                'tanggal' => set_value('tanggal', $row->tanggal),
                'tipe' => '1',
                'kelas_id' => $kelas_id
            );
            $this->template->load('template', 'nilai_siswa/nilai_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('nilai_siswa/index/' . $kelas_id));
        }
    }

    public function update_action()
    {
        $kelas_id = $this->input->post('kelas_id');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('nilai_id', TRUE), $kelas_id);
        } else {
            $data = array(
                'siswa_id' => $this->input->post('siswa_id', TRUE),
                'surat_id_mulai' => $this->input->post('surat_id_mulai'),
                'surat_id_selesai' => $this->input->post('surat_id_selesai'),
                'ayat_mulai' => $this->input->post('ayat_mulai'),
                'ayat_selesai' => $this->input->post('ayat_selesai'),
                'juz' => $this->input->post('juz'),
                'akumulasi' => $this->input->post('akumulasi'),
                'tahun_ajaran_id' => $this->input->post('tahun_ajaran_id'),
                'nilai' => $this->input->post('nilai'),
                'tanggal' => $this->input->post('tanggal'),
            );

            $this->Nilai_siswa_model->update($this->input->post('nilai_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('nilai_siswa/index/' . $kelas_id));
        }
    }

    public function delete($id, $kelas_id)
    {
        // cek hak akses
        if ($this->session->userdata('level') == '2') {
            check_access_walikelas($kelas_id);
        } else if ($this->session->userdata('level') == '3') {
            check_access_guru($kelas_id);
        }

        $row = $this->Nilai_siswa_model->get_by_id($id);

        if ($row) {
            $this->Nilai_siswa_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('nilai_siswa/index/' . $kelas_id));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('nilai_siswa/index/' . $kelas_id));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('siswa_id', 'Siswa', 'trim|required');
        $this->form_validation->set_rules('surat_id_mulai', 'Surat Mulai', 'trim|required');
        $this->form_validation->set_rules('surat_id_selesai', 'Surat Selesai', 'trim|required');
        $this->form_validation->set_rules('ayat_mulai', 'Ayat Mulai', 'trim|required');
        $this->form_validation->set_rules('ayat_selesai', 'Ayat Selesai', 'trim|required');
        $this->form_validation->set_rules('nilai', 'nilai', 'trim|required');
        $this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');

        $this->form_validation->set_rules('nilai_id', 'nilai_id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel($kelas_id)
    {
        // cek hak akses
        if ($this->session->userdata('level') == '2') {
            check_access_walikelas($kelas_id);
        } else if ($this->session->userdata('level') == '3') {
            check_access_guru($kelas_id);
        }

        $this->load->helper('exportexcel');
        $namaFile = "nilai.xls";
        $judul = "nilai";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Siswa");
        xlsWriteLabel($tablehead, $kolomhead++, "Surat Mulai");
        xlsWriteLabel($tablehead, $kolomhead++, "Surat Selesai");
        xlsWriteLabel($tablehead, $kolomhead++, "Ayat Mulai");
        xlsWriteLabel($tablehead, $kolomhead++, "Ayat Selesai");
        xlsWriteLabel($tablehead, $kolomhead++, "Nilai");
        xlsWriteLabel($tablehead, $kolomhead++, "Tahun Ajaran");
        xlsWriteLabel($tablehead, $kolomhead++, "Tanggal");

        foreach ($this->Nilai_siswa_model->get_all($kelas_id) as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_siswa);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_surat1);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_surat2);
            xlsWriteLabel($tablebody, $kolombody++, $data->ayat_mulai);
            xlsWriteLabel($tablebody, $kolombody++, $data->ayat_selesai);
            xlsWriteLabel($tablebody, $kolombody++, $data->nilai);
            xlsWriteLabel($tablebody, $kolombody++, $data->tahun_ajaran . ' | Semester ' . $data->semester);
            xlsWriteLabel($tablebody, $kolombody++, $data->tanggal);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word($kelas_id)
    {
        // cek hak akses
        if ($this->session->userdata('level') == '2') {
            check_access_walikelas($kelas_id);
        } else if ($this->session->userdata('level') == '3') {
            check_access_guru($kelas_id);
        }

        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=nilai.doc");

        $data = array(
            'nilai_data' => $this->Nilai_siswa_model->get_all($kelas_id),
            'start' => 0
        );

        $this->load->view('nilai_siswa/nilai_doc', $data);
    }
}

/* End of file Nilai_siswa.php */
/* Location: ./application/controllers/Nilai_siswa.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-03-24 01:31:04 */
/* http://harviacode.com */