<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Nilai_ujian_model extends CI_Model
{

    public $table = 'nilai';
    public $id = 'nilai_id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all($kelas_id)
    {
        $this->db->select('nilai.*, sq1.surat_indonesia as nama_surat1, sq2.surat_indonesia as nama_surat2,siswa.nama_siswa,tahun_ajaran.tahun_ajaran,tahun_ajaran.semester');
        $this->db->join('siswa', 'siswa.siswa_id = nilai.siswa_id', 'left');
        $this->db->join('kelas', 'kelas.kelas_id = siswa.kelas_id', 'left');
        $this->db->join('surat as sq1', 'sq1.surat_id = nilai.surat_id_mulai', 'left');
        $this->db->join('surat as sq2', 'sq2.surat_id = nilai.surat_id_selesai', 'left');
        $this->db->join('tahun_ajaran', 'tahun_ajaran.tahun_ajaran_id = nilai.tahun_ajaran_id', 'left');
        $this->db->where('tipe', '2');
        $this->db->where('siswa.kelas_id = ' . $kelas_id);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->select('nilai.*, sq1.surat_indonesia as nama_surat1, sq2.surat_indonesia as nama_surat2,siswa.nama_siswa,tahun_ajaran.tahun_ajaran,tahun_ajaran.semester');
        $this->db->join('siswa', 'siswa.siswa_id = nilai.siswa_id', 'left');
        $this->db->join('kelas', 'kelas.kelas_id = siswa.kelas_id', 'left');
        $this->db->join('surat as sq1', 'sq1.surat_id = nilai.surat_id_mulai', 'left');
        $this->db->join('surat as sq2', 'sq2.surat_id = nilai.surat_id_selesai', 'left');
        $this->db->join('tahun_ajaran', 'tahun_ajaran.tahun_ajaran_id = nilai.tahun_ajaran_id', 'left');
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get total rows
    function total_rows($q = NULL, $kelas_id)
    {
        $this->db->select('nilai.id');
        $this->db->join('siswa', 'siswa.siswa_id = nilai.siswa_id', 'left');
        $this->db->join('kelas', 'kelas.kelas_id = siswa.kelas_id', 'left');
        $this->db->join('surat as sq1', 'sq1.surat_id = nilai.surat_id_mulai', 'left');
        $this->db->join('surat as sq2', 'sq2.surat_id = nilai.surat_id_selesai', 'left');
        $this->db->join('tahun_ajaran', 'tahun_ajaran.tahun_ajaran_id = nilai.tahun_ajaran_id', 'left');
        $this->db->where('tipe', '2');
        $this->db->where('kelas.kelas_id = ' . $kelas_id);
        $this->db->group_start();
        $this->db->like('siswa.nama_siswa', $q);
        $this->db->or_like('sq1.surat_indonesia', $q);
        $this->db->or_like('sq2.surat_indonesia', $q);
        $this->db->or_like('nilai.ayat_mulai', $q);
        $this->db->or_like('nilai.ayat_selesai', $q);
        $this->db->or_like('nilai.juz', $q);
        $this->db->or_like('nilai.akumulasi', $q);
        $this->db->or_like('nilai.nilai', $q);
        $this->db->or_like('nilai.tanggal', $q);
        $this->db->or_like('tahun_ajaran', $q);
        $this->db->group_end();
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL, $kelas_id)
    {
        $this->db->select('nilai.*, sq1.surat_indonesia as nama_surat1, sq2.surat_indonesia as nama_surat2,siswa.nama_siswa,tahun_ajaran.tahun_ajaran,tahun_ajaran.semester');
        $this->db->join('siswa', 'siswa.siswa_id = nilai.siswa_id', 'left');
        $this->db->join('kelas', 'kelas.kelas_id = siswa.kelas_id', 'left');
        $this->db->join('surat as sq1', 'sq1.surat_id = nilai.surat_id_mulai', 'left');
        $this->db->join('surat as sq2', 'sq2.surat_id = nilai.surat_id_selesai', 'left');
        $this->db->join('tahun_ajaran', 'tahun_ajaran.tahun_ajaran_id = nilai.tahun_ajaran_id', 'left');
        $this->db->where('tipe', '2');
        $this->db->where('kelas.kelas_id = ' . $kelas_id);
        $this->db->group_start();
        $this->db->like('siswa.nama_siswa', $q);
        $this->db->or_like('nilai.siswa_id', $q);
        $this->db->or_like('sq1.surat_indonesia', $q);
        $this->db->or_like('sq2.surat_indonesia', $q);
        $this->db->or_like('ayat_mulai', $q);
        $this->db->or_like('ayat_selesai', $q);
        $this->db->or_like('juz', $q);
        $this->db->or_like('akumulasi', $q);
        $this->db->or_like('nilai', $q);
        $this->db->or_like('tanggal', $q);
        $this->db->or_like('tahun_ajaran', $q);
        $this->db->group_end();
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
}

/* End of file Nilai_siswa_model.php */
/* Location: ./application/models/Nilai_siswa_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-03-24 01:31:04 */
/* http://harviacode.com */