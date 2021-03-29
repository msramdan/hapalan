<?php defined('BASEPATH') OR exit('No direct script access allowed');

class akses_kelas_guru_model extends CI_Model {


	public function get($id = null)
    {
        $this->db->select('akses_kelas_guru.*,kelas.nama_kelas as nama_kelas');
        $this->db->from('akses_kelas_guru');
        $this->db->join('user', 'user.user_id = akses_kelas_guru.user_id');
        $this->db->join('kelas', 'kelas.kelas_id = akses_kelas_guru.kelas_id');
        if ($id !=null){
            $this->db->where('akses_kelas_guru.user_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_akses($id = null)
    {
        $this->db->select('akses_kelas_guru.*,kelas.nama_kelas as nama_kelas');
        $this->db->from('akses_kelas_guru');
        $this->db->join('user', 'user.user_id = akses_kelas_guru.user_id');
        $this->db->join('kelas', 'kelas.kelas_id = akses_kelas_guru.kelas_id');
        if ($id !=null){
            $this->db->where('akses_kelas_guru.user_id', $id);
        }
        $query = $this->db->get()->result();
        return $query;
    }



    public function get2($user_id,$kelas_id){
        $this->db->where('user_id', $user_id); // Untuk menambahkan Where Clause : username='$username'
        $this->db->where('kelas_id', $kelas_id);
        $result = $this->db->get('akses_kelas_guru')->row(); // Untuk mengeksekusi dan mengambil data hasil query
        return $result;
    }



    public function del($id)
    {
      $this->db->where('akses_kelas_guru_id',$id);
      $this->db->delete('akses_kelas_guru');
    }
    
    public function add($post){
        $params = [
        'user_id' => $post['user_id'],
        'kelas_id' => $post['kelas_id'],
      ];
        $this->db->insert('akses_kelas_guru',$params);
    }
}
