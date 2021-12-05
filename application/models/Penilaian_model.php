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
        $this->db->select('kelompok_member.*,siswa.nis,siswa.nama_siswa,kelas.nama_kelas');
        $this->db->from('kelompok_member');
        $this->db->join('siswa', 'siswa.siswa_id = kelompok_member.siswa_id');
        $this->db->join('kelas', 'kelas.kelas_id = siswa.kelas_id');
        $this->db->where('kelompok_id', $kelompok_id);
        return $this->db->get()->result();
    }

}
