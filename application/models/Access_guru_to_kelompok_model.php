<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Access_guru_to_kelompok_model extends CI_Model
{

    public $table = 'access_guru_to_kelompok';
    public $id = 'access_guru_to_kelompok_id';
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


}

/* End of file Kelompok_model.php */
/* Location: ./application/models/Kelompok_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-12-01 10:04:02 */
/* http://harviacode.com */