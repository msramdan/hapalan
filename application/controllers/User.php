<?php defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        is_login();
        check_admin();
        $this->load->model('user_m');
        $this->load->model('Kelas_model');
        $this->load->model('Akses_kelas_guru_model');
        $this->load->model('Akses_kelas_walikelas_model');
        $this->load->model('User_role_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['row'] = $this->user_m->get();
        $this->template->load('template', 'user/user_data', $data);
    }
    public function add()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|is_unique[user.username]');
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[user.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
        $this->form_validation->set_rules(
            'passconf',
            'Password Confirmation',
            'required|matches[password]',
            array('matches' => '%s Tidak Sesuai dengan Password')
        );
        $this->form_validation->set_rules('level', 'Level', 'required');

        $this->form_validation->set_message('required', '%s Masih kosong, Silahkan diisi');
        $this->form_validation->set_message('min_length', '%s Minimal 5 Karakter');
        $this->form_validation->set_message('is_unique', '%s Ini sudah terpakai, Silahkan ganti');
        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');


        if ($this->form_validation->run() == FALSE) {

            $level = $this->User_role_model->get()->result();
            $data = [
                'level' => $level
            ];
            $this->template->load('template', 'user/user_form_add', $data);
        } else {
            $post = $this->input->post(null, TRUE);
            $this->user_m->add($post);
            if ($this->db->affected_rows() > 0) {
                echo "<script>alert('Data berhasil di simpan');</script>";
            }
            echo "<script>window.location='" . site_url('user') . "'</script>";
        }
    }

    public function del()
    {
        // check_admin();
        $id = $this->input->post('user_id');
        $this->user_m->del($id);
        if ($this->db->affected_rows() > 0) {
            echo "<script>alert('Data berhasil di hapus');</script>";
        }
        echo "<script>window.location='" . site_url('user') . "'</script>";
    }
    public function edit_profil($id)
    {
        $data = array(
            'email'         => $this->input->post('email', true),
        );
        $this->user_m->ubah_data($data, $id);
        echo "<script> alert('Data Berhasil diupdate')</script>";
        echo "<script>window.location='" . site_url('profil') . "'</script>";
    }
    public function edit_password($id)
    {
        if (sha1($this->input->post('lama')) == $this->fungsi->user_login()->password) {
            $data = array(
                'password'          => sha1($this->input->post('password', true)),
            );
            $this->user_m->ubah_data($data, $id);
            echo "<script> alert('Data Password Berhasil diupdate')</script>";
            echo "<script>window.location='" . site_url('auth/logout') . "'</script>";
        } else {
            echo "<script> alert('Password Lama Salah')</script>";
            echo "<script>window.location='" . site_url('profil') . "'</script>";
        }
    }


    public function edit($id)
    {
        // check_admin();
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|callback_username_check');
        // $this->form_validation->set_rules('email', 'Email', 'required|is_unique[user.email]');

        if ($this->input->post('password')) {
            $this->form_validation->set_rules('password', 'Password', 'min_length[5]');
            $this->form_validation->set_rules(
                'passconf',
                'Password Confirmation',
                'matches[password]',
                array('matches' => '%s Tidak Sesuai dengan Password')
            );
        }
        if ($this->input->post('passconf')) {
            $this->form_validation->set_rules(
                'passconf',
                'Password Confirmation',
                'matches[password]',
                array('matches' => '%s Tidak Sesuai dengan Password')
            );
        }

        $this->form_validation->set_rules('level', 'Level', 'required');

        $this->form_validation->set_message('required', '%s Masih kosong, Silahkan diisi');
        $this->form_validation->set_message('min_length', '%s Minimal 5 Karakter');
        $this->form_validation->set_message('is_unique', '%s Ini sudah terpakai, Silahkan ganti');
        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');


        if ($this->form_validation->run() == FALSE) {
            $query = $this->user_m->get($id);
            if ($query->num_rows() > 0) {
                $level = $this->User_role_model->get()->result();
                $data = [
                    'level' => $level
                ];
                $data['row'] = $query->row();
                $this->template->load('template', 'user/user_form_edit', $data);
            } else {
                echo "<script>alert('Data Tidak ditemukan');>";
                echo "window.location='" . site_url('user') . "'</script>";
            }
        } else {

            $post = $this->input->post(null, TRUE);
            $this->user_m->edit($post);
            if ($this->db->affected_rows() > 0) {
                echo "<script>alert('Data berhasil di simpan');</script>";
            }
            echo "<script>window.location='" . site_url('user') . "'</script>";
        }
    }
    function username_check()
    {
        $post = $this->input->post(null, TRUE);
        $query = $this->db->query("SELECT * FROM user WHERE username = '$post[username]' AND user_id !='$post[user_id]'");
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('username_check', '%s Ini sudah dipakai, Silahkan ganti');
            return false;
        } else {
            return TRUE;
        }
    }

    function akses_kelas_guru($user_id)
    {
        $user = $this->user_m->get($user_id)->row_array();
        $kelas = $this->Kelas_model->get_all();
        $akses = $this->Akses_kelas_guru_model->get($user_id);
        $data = array(
            'kelas' => $kelas,
            'user' => $user,
            'row' => $akses

        );
        $this->template->load('template', 'user/akses_kelas_guru', $data);
    }
    function akses_kelas_walikelas($user_id)
    {
        $user = $this->user_m->get($user_id)->row_array();
        $kelas = $this->Kelas_model->get_all();
        $akses = $this->Akses_kelas_walikelas_model->get($user_id);
        $data = array(
            'kelas' => $kelas,
            'user' => $user,
            'row' => $akses

        );
        $this->template->load('template', 'user/akses_kelas_walikelas', $data);
    }

    public function tambah_akses_guru($uri)
    {
        $user_id   = $this->input->post('user_id');
        $kelas_id  = $this->input->post('kelas_id');
        $sudah       = $this->Akses_kelas_guru_model->get2($user_id, $kelas_id);

        if ($sudah == null || $sudah == '') {
            $post = $this->input->post(null, TRUE);
            if (isset($_POST['add_akses'])) {
                $this->Akses_kelas_guru_model->add($post);

                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('oke', 'di Simpan');
                }
                redirect('user/akses_kelas_guru/' . $uri);
            }
        } else {
            echo "<script>
                alert('Nama kelas ini sudah bisa di akses GURU');
                window.location='" . site_url('user/akses_kelas_guru/' . $uri) . "'</script>";
        }
    }

    public function tambah_akses_walikelas($uri)
    {
        $user_id   = $this->input->post('user_id');
        $kelas_id  = $this->input->post('kelas_id');
        $sudah       = $this->Akses_kelas_walikelas_model->get2($user_id, $kelas_id);

        if ($sudah == null || $sudah == '') {
            $post = $this->input->post(null, TRUE);
            if (isset($_POST['add_akses'])) {
                $this->Akses_kelas_walikelas_model->add($post);

                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('oke', 'di Simpan');
                }
                redirect('user/akses_kelas_walikelas/' . $uri);
            }
        } else {
            echo "<script>
                alert('Nama kelas ini sudah bisa di akses WALI KELAS');
                window.location='" . site_url('user/akses_kelas_walikelas/' . $uri) . "'</script>";
        }
    }

    public function del_akses_guru($id, $uri)
    {
        $this->Akses_kelas_guru_model->del($id);
        $error = $this->db->error();
        if ($error['code'] != 0) {
            echo "<script> alert('Data tidak dapat dihapus (Sudah Berelasi)')</script>";
        } else {
            $this->session->set_flashdata('oke', 'di Hapus');
        }
        echo "<script>window.location='" . site_url('user/akses_kelas_guru/' . $uri) . "'</script>";
    }

    public function del_akses_walikelas($id, $uri)
    {
        $this->Akses_kelas_walikelas_model->del($id);
        $error = $this->db->error();
        if ($error['code'] != 0) {
            echo "<script> alert('Data tidak dapat dihapus (Sudah Berelasi)')</script>";
        } else {
            $this->session->set_flashdata('oke', 'di Hapus');
        }
        echo "<script>window.location='" . site_url('user/akses_kelas_walikelas/' . $uri) . "'</script>";
    }
}
