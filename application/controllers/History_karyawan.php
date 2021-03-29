<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class History_karyawan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('History_karyawan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));

        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/history_karyawan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/history_karyawan/index/';
            $config['first_url'] = base_url() . 'index.php/history_karyawan/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->History_karyawan_model->total_rows($q);
        $history_karyawan = $this->History_karyawan_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'history_karyawan_data' => $history_karyawan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template', 'history_karyawan/history_karyawan_list', $data);
    }

    public function read($id)
    {
        $row = $this->History_karyawan_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'username' => $row->username,
                'info' => $row->info,
                'tanggal' => $row->tanggal,
                'user_agent' => $row->user_agent,
            );
            $this->template->load('template', 'history_karyawan/history_karyawan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('history_karyawan'));
        }
    }

    public function delete($id)
    {
        $row = $this->History_karyawan_model->get_by_id($id);

        if ($row) {
            $this->History_karyawan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('history_karyawan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('history_karyawan'));
        }
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "history_karyawan.xls";
        $judul = "history_karyawan";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Username");
        xlsWriteLabel($tablehead, $kolomhead++, "Info");
        xlsWriteLabel($tablehead, $kolomhead++, "Tanggal");
        xlsWriteLabel($tablehead, $kolomhead++, "User Agent");

        foreach ($this->History_karyawan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->username);
            xlsWriteLabel($tablebody, $kolombody++, $data->info);
            xlsWriteLabel($tablebody, $kolombody++, $data->tanggal);
            xlsWriteLabel($tablebody, $kolombody++, $data->user_agent);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=history_karyawan.doc");

        $data = array(
            'history_karyawan_data' => $this->History_karyawan_model->get_all(),
            'start' => 0
        );

        $this->load->view('history_karyawan/history_karyawan_doc', $data);
    }
}

/* End of file History_karyawan.php */
/* Location: ./application/controllers/History_karyawan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-03-16 06:59:25 */
/* http://harviacode.com */