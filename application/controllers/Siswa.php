<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Siswa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        // siswa dilarang masuk
        if ($this->session->userdata()['level'] == '4') {
            redirect('dashboard');
        }
        $this->load->model('Siswa_model');
        $this->load->model('Kelas_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
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
        $siswa = $this->Siswa_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'siswa_data' => $siswa,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template', 'siswa/siswa_list', $data);
    }

    public function read($id)
    {
        $row = $this->Siswa_model->get_by_id($id);
        if ($row) {
            $data = array(
                'siswa_id' => $row->siswa_id,
                'nis' => $row->nis,
                'nama_siswa' => $row->nama_siswa,
                'jenis_kelamin' => $row->jenis_kelamin,
                'nama_kelas' => $row->nama_kelas,
                'nama_ibu' => $row->nama_ibu,
                'nama_ayah' => $row->nama_ayah,
                'no_hp_wali_murid' => $row->no_hp_wali_murid,
            );
            $this->template->load('template', 'siswa/siswa_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('siswa'));
        }
    }

    public function create()
    {
        $kelas = $this->Kelas_model->get_all();
        $data = array(
            'button' => 'Create',
            'kelas' => $kelas,
            'action' => site_url('siswa/create_action'),
            'username' => set_value('username'),
            'password' => set_value('password'),
            'passconf' => set_value('passconf'),
            'email' => set_value('email'),
            'siswa_id' => set_value('siswa_id'),
            'nis' => set_value('nis'),
            'nama_siswa' => set_value('nama_siswa'),
            'jenis_kelamin' => set_value('jenis_kelamin'),
            'kelas_id' => set_value('kelas_id'),
            'nama_ibu' => set_value('nama_ibu'),
            'nama_ayah' => set_value('nama_ayah'),
            'no_hp_wali_murid' => set_value('no_hp_wali_murid'),
        );
        $this->template->load('template', 'siswa/siswa_form', $data);
    }

    public function create_action()
    {
        $this->_rules();
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
        $this->form_validation->set_rules(
            'passconf',
            'Password Confirmation',
            'required|matches[password]',
            array('matches' => '%s Tidak Sesuai dengan Password')
        );
        $this->form_validation->set_rules('username', 'username', 'trim|required|min_length[5]|is_unique[user.username]');
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[user.email]');

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {

            // level 4 untuk murid
            $data = array(
                'username' => $this->input->post('username', TRUE),
                'password' => sha1($this->input->post('password', TRUE)),
                'level' => 4,
                'email' => $this->input->post('email', TRUE)
            );

            $this->db->insert('user', $data);
            $user_id = $this->db->insert_id();

            $data = array(
                'nis' => $this->input->post('nis', TRUE),
                'nama_siswa' => $this->input->post('nama_siswa', TRUE),
                'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
                'kelas_id' => $this->input->post('kelas_id', TRUE),
                'nama_ibu' => $this->input->post('nama_ibu', TRUE),
                'nama_ayah' => $this->input->post('nama_ayah', TRUE),
                'no_hp_wali_murid' => $this->input->post('no_hp_wali_murid', TRUE),
                'user_id' => $user_id
            );

            $this->Siswa_model->insert($data);

            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('siswa'));
        }
    }

    public function update($id)
    {
        $row = $this->Siswa_model->get_by_id($id);
        $kelas = $this->Kelas_model->get_all();

        if ($row) {
            $data = array(
                'button' => 'Update',
                'kelas' => $kelas,
                'action' => site_url('siswa/update_action'),
                'siswa_id' => set_value('siswa_id', $row->siswa_id),
                'username' => set_value('username',),
                'password' => set_value('password'),
                'passconf' => set_value('passconf'),
                'email' => set_value('email'),
                'nis' => set_value('nis', $row->nis),
                'nama_siswa' => set_value('nama_siswa', $row->nama_siswa),
                'jenis_kelamin' => set_value('jenis_kelamin', $row->jenis_kelamin),
                'kelas_id' => set_value('kelas_id', $row->kelas_id),
                'nama_ibu' => set_value('nama_ibu', $row->nama_ibu),
                'nama_ayah' => set_value('nama_ayah', $row->nama_ayah),
                'no_hp_wali_murid' => set_value('no_hp_wali_murid', $row->no_hp_wali_murid),
            );
            $this->template->load('template', 'siswa/siswa_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('siswa'));
        }
    }

    public function update_action()
    {
        $this->_rules();
        if ($this->input->post('username')) {
            $this->form_validation->set_rules('username', 'username', 'trim|required|min_length[5]|is_unique[user.username]');
        }

        if ($this->input->post('email')) {
            $this->form_validation->set_rules('email', 'Email', 'required|is_unique[user.email]');
        }

        if ($this->input->post('password')) {
            $this->form_validation->set_rules('password', 'Password', 'min_length[5]');
            $this->form_validation->set_rules(
                'passconf',
                'Password Confirmation',
                'matches[password]',
                array('matches' => '%s Tidak Sesuai dengan Password')
            );
        }

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('siswa_id', TRUE));
        } else {
            // level 4 untuk murid
            $data = [];

            if (!empty($this->input->post('username', TRUE))) {
                $data['username'] = $this->input->post('username', TRUE);
            }
            if (!empty($this->input->post('email', TRUE))) {
                $data['email'] = $this->input->post('email', TRUE);
            }
            if (!empty($this->input->post('password', TRUE))) {
                $data['password'] = sha1($this->input->post('password', TRUE));
            }

            // fetch userid from siswa
            $this->db->where('siswa_id', $this->input->post('siswa_id'));
            $siswa = $this->db->get('siswa')->row();
            // update user
            $this->db->where('user_id', $siswa->user_id);
            $this->db->update('user', $data);

            $data = array(
                'nis' => $this->input->post('nis', TRUE),
                'nama_siswa' => $this->input->post('nama_siswa', TRUE),
                'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
                'kelas_id' => $this->input->post('kelas_id', TRUE),
                'nama_ibu' => $this->input->post('nama_ibu', TRUE),
                'nama_ayah' => $this->input->post('nama_ayah', TRUE),
                'no_hp_wali_murid' => $this->input->post('no_hp_wali_murid', TRUE),
            );

            $this->Siswa_model->update($this->input->post('siswa_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('siswa'));
        }
    }

    public function delete($id)
    {
        $row = $this->Siswa_model->get_by_id($id);

        if ($row) {
            // update user
            $this->db->where('user_id', $row->user_id);
            $this->db->delete('user');

            $this->Siswa_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('siswa'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('siswa'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nis', 'nis siswa', 'trim|required');
        $this->form_validation->set_rules('nama_siswa', 'nama siswa', 'trim|required');
        $this->form_validation->set_rules('jenis_kelamin', 'jenis kelamin', 'trim|required');
        $this->form_validation->set_rules('kelas_id', 'kelas id', 'trim|required');
        $this->form_validation->set_rules('nama_ibu', 'nama ibu', 'trim|required');
        $this->form_validation->set_rules('nama_ayah', 'nama ayah', 'trim|required');
        $this->form_validation->set_rules('no_hp_wali_murid', 'no hp wali murid', 'trim|required');

        $this->form_validation->set_rules('siswa_id', 'siswa_id', 'trim');

        $this->form_validation->set_message('required', '%s Masih kosong, Silahkan diisi');
        $this->form_validation->set_message('min_length', '%s Minimal 5 Karakter');
        $this->form_validation->set_message('is_unique', '%s Ini sudah terpakai, Silahkan ganti');
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
        xlsWriteLabel($tablehead, $kolomhead++, "NIS");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Siswa");
        xlsWriteLabel($tablehead, $kolomhead++, "Jenis Kelamin");
        xlsWriteLabel($tablehead, $kolomhead++, "Kelas");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Ibu");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Ayah");
        xlsWriteLabel($tablehead, $kolomhead++, "No Hp Wali Murid");

        foreach ($this->Siswa_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->nis);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_siswa);
            xlsWriteLabel($tablebody, $kolombody++, $data->jenis_kelamin);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_kelas);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_ibu);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_ayah);
            xlsWriteLabel($tablebody, $kolombody++, $data->no_hp_wali_murid);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=siswa.doc");

        $data = array(
            'siswa_data' => $this->Siswa_model->get_all(),
            'start' => 0
        );

        $this->load->view('siswa/siswa_doc', $data);
    }
}

/* End of file Siswa.php */
/* Location: ./application/controllers/Siswa.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-03-23 13:31:08 */
/* http://harviacode.com */