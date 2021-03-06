<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Siswa_model extends CI_Model
{

    public $table = 'siswa';
    public $id = 'siswa_id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    function get_total()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table);
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get all
    function get_all_kelas($kelas_id)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->where('kelas_id', $kelas_id);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('siswa_id', $q);
	$this->db->or_like('nis', $q);
	$this->db->or_like('nama_siswa', $q);
	$this->db->or_like('jenis_kelamin', $q);
	$this->db->or_like('kelas_id', $q);
	$this->db->or_like('nama_ibu', $q);
	$this->db->or_like('nama_ayah', $q);
	$this->db->or_like('no_hp_wali_murid', $q);
	$this->db->or_like('user_id', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($kelas_id,$limit, $start = 0, $q = NULL) {
        $this->db->join('kelas', 'siswa.kelas_id = kelas.kelas_id', 'left');
        $this->db->order_by($this->id, $this->order);
        $this->db->group_start();
        $this->db->like('siswa_id', $q);
	$this->db->or_like('nis', $q);
	$this->db->or_like('nama_siswa', $q);
	$this->db->or_like('jenis_kelamin', $q);
	$this->db->or_like('kelas.nama_kelas', $q);
	$this->db->or_like('nama_ibu', $q);
	$this->db->or_like('nama_ayah', $q);
	$this->db->or_like('no_hp_wali_murid', $q);
	$this->db->or_like('user_id', $q);
    $this->db->group_end();
	$this->db->limit($limit, $start);
    $this->db->where('siswa.kelas_id', $kelas_id);
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

/* End of file Siswa_model.php */
/* Location: ./application/models/Siswa_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-12-01 10:07:57 */
/* http://harviacode.com */