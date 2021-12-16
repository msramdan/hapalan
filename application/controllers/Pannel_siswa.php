<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pannel_siswa extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        is_login();
        check_siswa();
        $this->load->model('App_setting_model');
        $this->load->model('Tahun_ajaran_model');

    }

	function index()
	{
		$data = array(
            'tahun_ajaran' =>$this->Tahun_ajaran_model->get_all_aktif(),
            'app_setting' =>$this->App_setting_model->get_by_id(1),
        );
		$this->template->load('home_siswa','pannel_siswa/home',$data);
	}

    function edit()
    {
        $data = array(
            'app_setting' =>$this->App_setting_model->get_by_id(1),
        );
        $this->template->load('home_siswa', 'pannel_siswa/profile',$data);
    }

    function edit_password($id)
    {
        if (sha1($this->input->post('lama')) == $this->fungsi->user_login()->password) {
            $data = array(
                'password'          => sha1($this->input->post('password', true)),
            );
            $this->User_model->ubah_data($data, $id);
             $this->session->set_flashdata('message', 'Update Record Success');
            echo "<script>window.location='" . site_url('auth/logout') . "'</script>";
        } else {
            echo "<script> alert('Password Lama Salah')</script>";
            echo "<script>window.location='" . site_url('pannel_siswa/edit') . "'</script>";
        }
    }

    function raport (){
        $tahun_ajaran_detail_id = $this->input->post('tahun_ajaran_detail_id');
        $ambil_tahun_ajaran = "SELECT * from tahun_ajaran_detail where tahun_ajaran_detail_id='$tahun_ajaran_detail_id'";
        $hasil = $this->db->query($ambil_tahun_ajaran)->row();
        $tahun_ajaran_id = $hasil->tahun_ajaran_id;
        $semester = $hasil->semester;
        $siswa_id = $this->fungsi->siswa_login()->siswa_id;

        $ttd = "SELECT access_guru_to_kelompok.guru_id, guru.nama_guru, guru.tanda_tangan,kelompok.tahun_ajaran_id, kelompok_member.siswa_id from access_guru_to_kelompok
              join guru on guru.guru_id=access_guru_to_kelompok.guru_id
              join kelompok on kelompok.kelompok_id = access_guru_to_kelompok.kelompok_id
              join kelompok_member on kelompok_member.kelompok_id = kelompok.kelompok_id where $tahun_ajaran_id='$tahun_ajaran_id' and siswa_id='$siswa_id'
      ";
      $hasil = $this->db->query($ttd)->row();
       $this->load->library('dompdf_gen');
       $data = array(
            'app_setting' =>$this->App_setting_model->get_by_id(1),
            'siswa' =>$this->db->get_where('siswa', array('siswa_id' => $siswa_id))->row(),
            'tahun_ajaran' =>$this->db->get_where('tahun_ajaran', array('tahun_ajaran_id' => $tahun_ajaran_id))->row(),
            'semester' =>$semester,
            'kelas' =>$this->db->get_where('history_kelas', array(
              'siswa_id' => $siswa_id,
              'tahun_ajaran_id' => $tahun_ajaran_id,
            ))->row(),
            'hasil' =>$hasil,
            'sikap'=> $this->db->get_where('sikap', array(
              'siswa_id' => $siswa_id,
              'tahun_ajaran_id' => $tahun_ajaran_id,
              'semester' => $semester,
            ))->row(),

            'tahfizh'=> $this->db->get_where('tahfizh', array(
              'siswa_id' => $siswa_id,
              'tahun_ajaran_id' => $tahun_ajaran_id,
              'semester' => $semester,
            ))->result(),

            'tahzin'=> $this->db->get_where('tahzin', array(
              'siswa_id' => $siswa_id,
              'tahun_ajaran_id' => $tahun_ajaran_id,
              'semester' => $semester,
            ))->row(),


        );
       $this->load->view('penilaian/nilai',$data);
       $paper_size = 'A4';
       $orientation = 'portrait';
       $html = $this->output->get_output();
       $this->dompdf->set_paper($paper_size, $orientation);

       $this->dompdf->load_html($html);
       $this->dompdf->render();
       $this->dompdf->stream("raport_siswa.pdf", array('Attachment' =>0));

    }
}
