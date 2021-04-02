<?php defined('BASEPATH') or exit('No direct script access allowed');

class Sekolah_model extends CI_Model
{
    public $table = 'sekolah';
    public $id = 'sekolah_id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    public function get()
    {
        // 
        $query = $this->db->get($this->table)->row();

        return $query;
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
    }
    public function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }
}
