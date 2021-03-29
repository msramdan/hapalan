<?php defined('BASEPATH') or exit('No direct script access allowed');

class Nilai_model extends CI_Model
{


    public function get($id = null)
    {
        $this->db->from('siswa');
        if ($id != null) {
            $this->db->where('siswa_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function view_siswa($id = null)
    {
        $this->db->select('siswa.*');
        $this->db->from('siswa');
        if ($id != null) {
            $this->db->where('kelas_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }
}
