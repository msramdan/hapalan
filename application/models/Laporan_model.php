<?php defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_model extends CI_Model
{
    public function nilai_harian($id, $tahun_ajaran_id)
    {
        // 
        $this->db->select('*, s1.surat_indonesia as nama_surat1, s2.surat_indonesia as nama_surat2');
        $this->db->from('nilai');
        $this->db->join('tahun_ajaran', 'tahun_ajaran.tahun_ajaran_id = nilai.tahun_ajaran_id', 'left');
        $this->db->join('surat as s1', 's1.surat_id = nilai.surat_id_mulai', 'left');
        $this->db->join('surat as s2', 's2.surat_id = nilai.surat_id_selesai', 'left');
        $this->db->where('nilai.tipe', '1');
        $this->db->where('siswa_id', $id);
        $this->db->where('nilai.tahun_ajaran_id', $tahun_ajaran_id);
        $query = $this->db->get()->result();

        return $query;
    }

    public function nilai_ujian($id, $tahun_ajaran_id)
    {
        // 
        $this->db->select('*, s1.surat_indonesia as nama_surat1, s2.surat_indonesia as nama_surat2');
        $this->db->from('nilai');
        $this->db->join('tahun_ajaran', 'tahun_ajaran.tahun_ajaran_id = nilai.tahun_ajaran_id', 'left');
        $this->db->join('surat as s1', 's1.surat_id = nilai.surat_id_mulai', 'left');
        $this->db->join('surat as s2', 's2.surat_id = nilai.surat_id_selesai', 'left');
        $this->db->where('nilai.tipe', '2');
        $this->db->where('siswa_id', $id);
        $this->db->where('nilai.tahun_ajaran_id', $tahun_ajaran_id);
        $query = $this->db->get()->result();

        return $query;
    }
}
