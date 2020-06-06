<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notifikasi_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    var $table = 'tb_notifikasi';
    var $id = 'id';
    var $order = 'desc';

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table);
    }

    // get data by id
    function get_by_id($id)
    {   
        $this->db->where('user_penerima', $id);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table, 20, 0);
    }

    // get data by id
    function get_by_jumlah($id)
    {
        $this->db->where('user_penerima', $id);
        $this->db->where('dibaca', '1');
        return $this->db->count_all_results($this->table);
    }

    // insert data
    function simpan($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function ubah_dibaca($id, $data)
    {
        $this->db->where('user_penerima',$id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}
