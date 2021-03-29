<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Guru extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        check_admin();
        $this->load->model('Guru_model');
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
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template', 'guru/guru_list', $data);
    }

    public function read($id)
    {
        $row = $this->Guru_model->get_by_id($id);
        if ($row) {
            $data = array(
                'guru_id' => $row->guru_id,
                'nama_guru' => $row->nama_guru,
                'jenis_kelamin' => $row->jenis_kelamin,
                'no_hp' => $row->no_hp,
                'alamat' => $row->alamat,
            );
            $this->template->load('template', 'guru/guru_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('guru'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('guru/create_action'),
            'guru_id' => set_value('guru_id'),
            'username' => set_value('username'),
            'password' => set_value('password'),
            'passconf' => set_value('passconf'),
            'email' => set_value('email'),
            'level' => set_value('level'),
            'nama_guru' => set_value('nama_guru'),
            'jenis_kelamin' => set_value('jenis_kelamin'),
            'no_hp' => set_value('no_hp'),
            'alamat' => set_value('alamat'),
        );
        $this->template->load('template', 'guru/guru_form', $data);
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
                'level' => $this->input->post('level'),
                'email' => $this->input->post('email', TRUE)
            );

            $this->db->insert('user', $data);
            $user_id = $this->db->insert_id();

            $data = array(
                'nama_guru' => $this->input->post('nama_guru', TRUE),
                'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
                'no_hp' => $this->input->post('no_hp', TRUE),
                'alamat' => $this->input->post('alamat', TRUE),
                'user_id' => $user_id
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
                'action' => site_url('guru/update_action'),
                'username' => set_value('username',),
                'password' => set_value('password'),
                'passconf' => set_value('passconf'),
                'email' => set_value('email'),
                'level' => set_value('level', $row->level),
                'guru_id' => set_value('guru_id', $row->guru_id),
                'nama_guru' => set_value('nama_guru', $row->nama_guru),
                'jenis_kelamin' => set_value('jenis_kelamin', $row->jenis_kelamin),
                'no_hp' => set_value('no_hp', $row->no_hp),
                'alamat' => set_value('alamat', $row->alamat),
            );
            $this->template->load('template', 'guru/guru_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('guru'));
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
            $this->update($this->input->post('guru_id', TRUE));
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
            if (!empty($this->input->post('level', TRUE))) {
                $data['level'] = $this->input->post('level', TRUE);
            }

            // fetch userid from guru
            $this->db->where('guru_id', $this->input->post('guru_id'));
            $guru = $this->db->get('guru')->row();
            // update user
            $this->db->where('user_id', $guru->user_id);
            $this->db->update('user', $data);

            $data = array(
                'nama_guru' => $this->input->post('nama_guru', TRUE),
                'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
                'no_hp' => $this->input->post('no_hp', TRUE),
                'alamat' => $this->input->post('alamat', TRUE),
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
            // update user
            $this->db->where('user_id', $row->user_id);
            $this->db->delete('user');

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
        $this->form_validation->set_rules('nama_guru', 'nama guru', 'trim|required');
        $this->form_validation->set_rules('jenis_kelamin', 'jenis kelamin', 'trim|required');
        $this->form_validation->set_rules('no_hp', 'no hp', 'trim|required');
        $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');

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
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Guru");
        xlsWriteLabel($tablehead, $kolomhead++, "Jenis Kelamin");
        xlsWriteLabel($tablehead, $kolomhead++, "No Hp");
        xlsWriteLabel($tablehead, $kolomhead++, "Alamat");

        foreach ($this->Guru_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_guru);
            xlsWriteLabel($tablebody, $kolombody++, $data->jenis_kelamin);
            xlsWriteLabel($tablebody, $kolombody++, $data->no_hp);
            xlsWriteLabel($tablebody, $kolombody++, $data->alamat);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=guru.doc");

        $data = array(
            'guru_data' => $this->Guru_model->get_all(),
            'start' => 0
        );

        $this->load->view('guru/guru_doc', $data);
    }
}

/* End of file Guru.php */
/* Location: ./application/controllers/Guru.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-03-23 13:22:05 */
/* http://harviacode.com */