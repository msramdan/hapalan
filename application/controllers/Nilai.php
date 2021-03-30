<?php defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Nilai extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('kelas_model');
        $this->load->model('nilai_model');
        $this->load->model('siswa_model');
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
        $this->template->load('template', 'nilai/nilai_data', $data);
    }

    public function ujian()
    {
        if ($this->fungsi->user_login()->level == 1) {
            $data['row'] = $this->kelas_model->get_all();
        } else {
            if ($this->fungsi->user_login()->level == 2) {
                $data['row'] = $this->akses_kelas_walikelas_model->get_akses($this->fungsi->user_login()->user_id);
            } else if ($this->fungsi->user_login()->level == 3) {
                $data['row'] = $this->akses_kelas_guru_model->get_akses($this->fungsi->user_login()->user_id);
            } else if ($this->fungsi->user_login()->level == 4) {
                $siswa = $this->siswa_model->get_by_userid($this->fungsi->user_login()->user_id);
                $data['row'] = $this->nilai_model->akses_siswa_ujian($siswa->siswa_id);
            }
        }
        $this->template->load('template', 'nilai/nilai_ujian', $data);
    }

    public function read_siswa($id)
    {
        $siswa = $this->siswa_model->get_by_userid($this->fungsi->user_login()->user_id);
        $row = $this->nilai_model->read_siswa($id);

        if ($row) {
            // jika nilai bukan punya siswa yang dimaksud
            if ($row->siswa_id != $siswa->siswa_id) {
                echo "Anda tidak punya akses";
                die;
            }

            $data = array(
                'nama_siswa' => $row->nama_siswa,
                'tahun_ajaran' => $row->tahun_ajaran,
                'semester' => $row->semester,
                'nama_surat1' => $row->nama_surat1,
                'nama_surat2' => $row->nama_surat2,
                'ayat_mulai' => $row->ayat_mulai,
                'ayat_selesai' => $row->ayat_selesai,
                'nilai' => $row->nilai,
                'tanggal' => $row->tanggal
            );
            $this->template->load('template', 'nilai/nilai_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('siswa'));
        }
    }

    public function read_ujian_siswa($id)
    {
        $siswa = $this->siswa_model->get_by_userid($this->fungsi->user_login()->user_id);
        $row = $this->nilai_model->read_siswa($id);

        if ($row) {
            // jika nilai bukan punya siswa yang dimaksud
            if ($row->siswa_id != $siswa->siswa_id) {
                echo "Anda tidak punya akses";
                die;
            }

            $data = array(
                'nama_siswa' => $row->nama_siswa,
                'juz' => $row->juz,
                'akumulasi' => $row->akumulasi,
                'tahun_ajaran' => $row->tahun_ajaran,
                'semester' => $row->semester,
                'nilai' => $row->nilai,
                'tanggal' => $row->tanggal
            );
            $this->template->load('template', 'nilai/nilai_ujian_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('siswa'));
        }
    }

    public function view_siswa($kelas_id)
    {
        $data['row'] = $this->nilai_model->view_siswa($kelas_id);
        $this->template->load('template', 'nilai/view_siswa', $data);
    }
}
