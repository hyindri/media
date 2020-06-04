<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Agenda_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    var $table = 'tb_agenda';
    var $column_order = array(null, 'id','judul','tanggal','status','file','dibuat_oleh','dibuat_pada'); //set column field database for datatable orderable
    var $column_search = array('id','judul','tanggal','status','file','dibuat_oleh','dibuat_pada'); //set column field database for datatable searchable 
    var $order = array('tb_agenda.id' => 'asc'); // default order 
 
    private function _get_datatables_query()
    {
        $this->db->from($this->table);
     
        $i=0;
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    public function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    public function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
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
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // insert data
    function simpan($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function ubah($id, $data)
    {
        $this->db->where('id',$id);
        $this->db->update('tb_agenda', $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}
