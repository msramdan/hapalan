<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Penilaian_model extends CI_Model
{
    public $table = 'kelompok_member_member';
    public $id = 'kelompok_member_member_id';
    public $order = 'DESC';


    function __construct()
    {
        parent::__construct();
    }

    function get_all_kelompok($kelompok_id)
    {
        $this->db->select('kelompok_member.*,siswa.nis,siswa.nama_siswa,kelas.nama_kelas,tahun_ajaran.*,kelompok.nama_kelompok');
        $this->db->from('kelompok_member');
        $this->db->join('siswa', 'siswa.siswa_id = kelompok_member.siswa_id');
        $this->db->join('kelas', 'kelas.kelas_id = siswa.kelas_id');
        
        $this->db->join('kelompok', 'kelompok.kelompok_id = kelompok_member.kelompok_id');
        $this->db->join('tahun_ajaran', 'tahun_ajaran.tahun_ajaran_id = kelompok.tahun_ajaran_id');
        $this->db->where('kelompok_member.kelompok_id', $kelompok_id);
        return $this->db->get()->result();
    }


    function sikap($siswa_id,$semester)
    {
        $this->db->where('siswa_id', $siswa_id);
        $this->db->where('semester', $semester);
        return $this->db->get('sikap')->row();
    }

    function delete_sikap($sikap_id)
    {
        $this->db->where('sikap_id', $sikap_id);
        $this->db->delete('sikap');
    }

}
