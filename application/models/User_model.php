<?php defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function login($post)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('username', $post['username']);
        $this->db->where('password', sha1($post['password']));
        $query = $this->db->get();
        return $query;
    }

    public function get($id = null)
    {
        $this->db->select('user.*');
        $this->db->from('user');
        if ($id != null) {
            $this->db->where('user_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function addHistory($user_id, $info, $tanggal, $user_agent) {
        return $this->db->insert('history_karyawan', array('user_id' => $user_id, 'info' => $info, 'tanggal' => $tanggal, 'user_agent' =>$user_agent));
    }

}
