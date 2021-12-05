<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kelompok_model extends CI_Model
{

    public $table = 'kelompok';
    public $id = 'kelompok_id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->join('tahun_ajaran', 'kelompok.tahun_ajaran_id = tahun_ajaran.tahun_ajaran_id', 'left');
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('kelompok_id', $q);
	$this->db->or_like('nama_kelompok', $q);
	$this->db->or_like('tahun_ajaran_id', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->select('kelompok.*,tahun_ajaran.*,tingkat.*');
        $this->db->from('kelompok');
        $this->db->join('tahun_ajaran', 'tahun_ajaran.tahun_ajaran_id = kelompok.tahun_ajaran_id');
        $this->db->join('tingkat', 'tingkat.tingkat_id = kelompok.tingkat_id');
        $this->db->order_by('tingkat.tingkat_id', 'DESC');
        $this->db->group_start();
        $this->db->like('kelompok_id', $q);
	$this->db->or_like('nama_kelompok', $q);
	$this->db->or_like('tahun_ajaran', $q);
    $this->db->or_like('nama_tingkat', $q);
    $this->db->group_end();
	$this->db->limit($limit, $start);
    $this->db->where('tahun_ajaran.status','1');
        return $this->db->get()->result();
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

/* End of file Kelompok_model.php */
/* Location: ./application/models/Kelompok_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-12-01 10:04:02 */
/* http://harviacode.com */