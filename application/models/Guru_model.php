<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Guru_model extends CI_Model
{

    public $table = 'guru';
    public $id = 'guru_id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->join('user', 'user.user_id = guru.user_id');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->join('user', 'user.user_id = guru.user_id');
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get total rows
    function total_rows($q = NULL)
    {
        $this->db->join('user', 'user.user_id = guru.user_id');
        $this->db->like('guru_id', $q);
        $this->db->or_like('nama_guru', $q);
        $this->db->or_like('jenis_kelamin', $q);
        $this->db->or_like('no_hp', $q);
        $this->db->or_like('alamat', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->join('user', 'user.user_id = guru.user_id');
        $this->db->order_by($this->id, $this->order);
        $this->db->like('guru_id', $q);
        $this->db->or_like('nama_guru', $q);
        $this->db->or_like('jenis_kelamin', $q);
        $this->db->or_like('no_hp', $q);
        $this->db->or_like('alamat', $q);
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

/* End of file Guru_model.php */
/* Location: ./application/models/Guru_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-03-23 13:22:05 */
/* http://harviacode.com */