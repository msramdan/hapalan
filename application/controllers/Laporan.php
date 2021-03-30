<?php defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Laporan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('laporan_model');
        $this->load->model('kelas_model');
        $this->load->model('nilai_model');
        $this->load->model('siswa_model');
        $this->load->model('tahunajaran_model');
        $this->load->model('akses_kelas_guru_model');
        $this->load->model('akses_kelas_walikelas_model');
    }

    public function index()
    {
        if ($this->fungsi->user_login()->level == 1) {
            $data['row'] = $this->kelas_model->get_all();
        } else {
            if ($this->fungsi->user_login()->level == 2) {
                $data['row'] = $this->akses_kelas_walikelas_model->get_akses($this->fungsi->user_login()->user_id);
                // var_dump($data['row']);
                // die;
            } else if ($this->fungsi->user_login()->level == 3) {
                $data['row'] = $this->akses_kelas_guru_model->get_akses($this->fungsi->user_login()->user_id);
            } else if ($this->fungsi->user_login()->level == 4) {
                $siswa = $this->siswa_model->get_by_userid($this->fungsi->user_login()->user_id);
                $data['row'] = $this->nilai_model->akses_siswa($siswa->siswa_id);
            }
        }
        $this->template->load('template', 'laporan/nilai_data', $data);
    }

    public function nilai($kelas_id)
    {
        // cek hak akses
        if ($this->session->userdata('level') == '2') {
            check_access_walikelas($kelas_id);
        } else if ($this->session->userdata('level') == '3') {
            check_access_guru($kelas_id);
        }

        $siswa = $this->siswa_model->get_all($kelas_id);
        $tahunajaran = $this->tahunajaran_model->get_all();
        $surat = $this->siswa_model->get_all();
        $data = array(
            'button' => 'Create',
            'action' => site_url('laporan/nilai_read'),
            'siswa_list' => $siswa,
            'siswa_id' => set_value('siswa_id'),
            'surat_list' => $surat,
            'tahunajaran_list' => $tahunajaran,
            'tahun_ajaran_id' => set_value('tahun_ajaran_id'),
            'adab_quran' => set_value('adab_quran'),
            'adab_guru' => set_value('adab_guru'),
            'kelas_id' => $kelas_id
        );
        $this->template->load('template', 'laporan/nilai', $data);
    }

    public function nilai_read()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=laporan-nilai-" . date('Y-m-d') . ".doc");

        $data = array(
            'siswa' => $this->siswa_model->get_by_id($this->input->post('siswa_id')),
            'nilai_harian' => $this->laporan_model->nilai_harian($this->input->post('siswa_id')),
            'nilai_ujian' => $this->laporan_model->nilai_ujian($this->input->post('siswa_id')),
            'tahun_ajaran' => $this->tahunajaran_model->get_by_id($this->input->post('tahun_ajaran_id')),
            'adab_quran' => $this->input->post('adab_quran'),
            'adab_guru' => $this->input->post('adab_guru'),
            'start' => 0
        );

        $this->load->view('laporan/nilai_read', $data);
    }
}
