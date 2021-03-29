<?php defined('BASEPATH') or exit('No direct script access allowed');

class akses_kelas_walikelas_model extends CI_Model
{


    public function get($id = null)
    {
        $this->db->select('akses_kelas_walikelas.*,kelas.nama_kelas as nama_kelas');
        $this->db->from('akses_kelas_walikelas');
        $this->db->join('user', 'user.user_id = akses_kelas_walikelas.user_id');
        $this->db->join('kelas', 'kelas.kelas_id = akses_kelas_walikelas.kelas_id');
        if ($id != null) {
            $this->db->where('akses_kelas_walikelas.user_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_akses($id = null)
    {
        // $this->db->select('akses_kelas_walikelas.*,kelas.nama_kelas as nama_kelas, akses_kelas_guru.*');
        // $this->db->from('akses_kelas_walikelas');
        // $this->db->join('user', 'user.user_id = akses_kelas_walikelas.user_id', 'left');
        // $this->db->join('kelas', 'kelas.kelas_id = akses_kelas_walikelas.kelas_id', 'left');
        // $this->db->join('akses_kelas_guru', 'akses_kelas_guru.user_id = user.user_id', 'left');
        // if ($id != null) {
        //     $this->db->where('akses_kelas_guru.user_id', $id);
        //     $this->db->or_where('akses_kelas_walikelas.user_id', $id);
        // }

        $query = $this->db->query("SELECT AW.user_id AS user_id, AW.kelas_id AS kelas_id, K.nama_kelas AS nama_kelas FROM AKSES_KELAS_WALIKELAS AW LEFT JOIN KELAS K ON AW.KELAS_ID = K.KELAS_ID LEFT JOIN USER U ON AW.USER_ID = U.USER_ID
        WHERE AW.USER_ID = '$id'
        UNION
        SELECT AG.USER_ID AS USER_ID, AG.KELAS_ID AS KELAS_ID, K.NAMA_KELAS AS NAMA_KELAS FROM AKSES_KELAS_GURU AG LEFT JOIN KELAS K ON AG.KELAS_ID = K.KELAS_ID LEFT JOIN USER U ON AG.USER_ID = U.USER_ID 
        WHERE AG.USER_ID = '$id'
        GROUP BY KELAS_ID")->result();

        return $query;
    }

    public function get2($user_id, $kelas_id)
    {
        $this->db->where('user_id', $user_id); // Untuk menambahkan Where Clause : username='$username'
        $this->db->where('kelas_id', $kelas_id);
        $result = $this->db->get('akses_kelas_walikelas')->row(); // Untuk mengeksekusi dan mengambil data hasil query
        return $result;
    }



    public function del($id)
    {
        $this->db->where('akses_kelas_walikelas_id', $id);
        $this->db->delete('akses_kelas_walikelas');
    }

    public function add($post)
    {
        $params = [
            'user_id' => $post['user_id'],
            'kelas_id' => $post['kelas_id'],
        ];
        $this->db->insert('akses_kelas_walikelas', $params);
    }
}
