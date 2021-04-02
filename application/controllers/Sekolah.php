<?php defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Sekolah extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        check_admin();
        $this->load->model('sekolah_model');
    }

    public function index()
    {
        $row = $this->sekolah_model->get();

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('sekolah/update_action'),
                'sekolah_id' => set_value('sekolah_id', $row->sekolah_id),
                'nama' => set_value('nama', $row->nama),
                'alamat' => set_value('alamat', $row->alamat),
                'no_hp' => set_value('no_hp', $row->no_hp),
                'kepala_sekolah' => set_value('kepala_sekolah', $row->kepala_sekolah),
            );
            $this->template->load('template', 'sekolah/index', $data);
        } else {
            $data = array(
                'button' => 'Update',
                'action' => site_url('sekolah/update_action'),
                'sekolah_id' => set_value('sekolah_id'),
                'nama' => set_value('nama'),
                'alamat' => set_value('alamat'),
                'no_hp' => set_value('no_hp'),
                'kepala_sekolah' => set_value('kepala_sekolah'),
            );
            $this->template->load('template', 'sekolah/index', $data);
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = array(
                'nama' => $this->input->post('nama', TRUE),
                'alamat' => $this->input->post('alamat', TRUE),
                'no_hp' => $this->input->post('no_hp', TRUE),
                'kepala_sekolah' => $this->input->post('kepala_sekolah', TRUE)
            );
            $sekolah_id = $this->input->post('sekolah_id', TRUE);
            if ($sekolah_id == '') {
                $this->sekolah_model->insert($data);
            } else {
                $this->sekolah_model->update($sekolah_id, $data);
            }
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('sekolah'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama', 'nama sekolah', 'trim|required');
        $this->form_validation->set_rules('alamat', 'alamat sekolah', 'trim|required');
        $this->form_validation->set_rules('no_hp', 'no telepon sekolah', 'trim|required');
        $this->form_validation->set_rules('kepala_sekolah', 'kepala sekolah', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}
