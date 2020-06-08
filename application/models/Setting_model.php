<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Setting_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    var $table = 'tmst_sosmed';
    var $table_setting = 'tmst_setting';
    var $id = 'id';
    var $column_order = array(null, 'id', 'nama', 'logo');
    var $column_search = array('id', 'nama', 'logo');
    var $order = array('id' => 'asc'); // default order 


    private function _get_datatables_query()
    {

        $this->db->from($this->table);
        $i = 0;

        foreach ($this->column_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
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

    function simpan($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        $this->db->get($this->table)->row();
    }
    // update data
    function ubah($id, $data)
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

    function get_all()
    {
        return $this->db->get($this->table_setting)->result();
    }


    function update()
    {
        $id = $this->input->post('id');
        $data = array(
            'waktu' => $this->input->post('waktu'),
        );
        $this->db->where('id', $id);
        $this->db->update($this->table_setting, $data);
    }
}
