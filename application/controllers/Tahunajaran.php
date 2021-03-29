<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tahunajaran extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        check_admin();
        $this->load->model('Tahunajaran_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));

        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/tahunajaran/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/tahunajaran/index/';
            $config['first_url'] = base_url() . 'index.php/tahunajaran/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Tahunajaran_model->total_rows($q);
        $tahunajaran = $this->Tahunajaran_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tahunajaran_data' => $tahunajaran,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template', 'tahunajaran/tahunajaran_list', $data);
    }

    public function read($id)
    {
        $row = $this->Tahunajaran_model->get_by_id($id);
        if ($row) {
            $data = array(
                'tahun_ajaran' => $row->tahun_ajaran,
                'semester' => $row->semester,
                'status' => $row->status
            );
            $this->template->load('template', 'tahunajaran/tahunajaran_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tahunajaran'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tahunajaran/create_action'),
            'tahun_ajaran_id' => set_value('tahun_ajaran_id'),
            'tahun_ajaran' => set_value('tahun_ajaran'),
            'semester' => set_value('semester'),
            'status' => set_value('status')
        );
        $this->template->load('template', 'tahunajaran/tahunajaran_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'tahun_ajaran' => $this->input->post('tahun_ajaran', TRUE),
                'semester' => $this->input->post('semester', TRUE),
                'status' => $this->input->post('status', TRUE)
            );

            $this->Tahunajaran_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('tahunajaran'));
        }
    }

    public function update($id)
    {
        $row = $this->Tahunajaran_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tahunajaran/update_action'),
                'tahun_ajaran_id' => set_value('tahun_ajaran_id', $row->tahun_ajaran_id),
                'tahun_ajaran' => set_value('tahun_ajaran', $row->tahun_ajaran),
                'semester' => set_value('semester', $row->semester),
                'status' => set_value('status', $row->status)
            );
            $this->template->load('template', 'tahunajaran/tahunajaran_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tahunajaran'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('tahun_ajaran_id', TRUE));
        } else {
            $data = array(
                'tahun_ajaran' => $this->input->post('tahun_ajaran', TRUE),
                'semester' => $this->input->post('semester', TRUE),
                'status' => $this->input->post('status', TRUE)
            );

            $this->Tahunajaran_model->update($this->input->post('tahun_ajaran_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tahunajaran'));
        }
    }

    public function delete($id)
    {
        $row = $this->Tahunajaran_model->get_by_id($id);

        if ($row) {
            $this->Tahunajaran_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tahunajaran'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tahunajaran'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('tahun_ajaran', 'tahun ajaran', 'trim|required');
        $this->form_validation->set_rules('semester', 'semester', 'trim|required');

        $this->form_validation->set_rules('status', 'status', 'required|trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tahunajaran.xls";
        $judul = "tahunajaran";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Semester");

        foreach ($this->Tahunajaran_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->tahun_ajaran);
            xlsWriteNumber($tablebody, $kolombody++, $data->semester);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tahunajaran.doc");

        $data = array(
            'tahunajaran_data' => $this->Tahunajaran_model->get_all(),
            'start' => 0
        );

        $this->load->view('tahunajaran/tahunajaran_doc', $data);
    }
}

/* End of file Kelas.php */
/* Location: ./application/controllers/Kelas.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-03-23 13:29:12 */
/* http://harviacode.com */