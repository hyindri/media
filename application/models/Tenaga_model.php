<?php

class Tenaga_model extends CI_Model
{
    public $table = 'tmst_tenaga';    

    public $select_column = ('a.id as id_tenaga , a.media_massa_id, b.nama_media , a.jabatan_id, c.nama_jabatan , a.nama_tenaga , a.nik , a.file , a.no_hp , a.file_sertifikat');
    
    public $column_order = array(null,'a.id as id_tenaga','a.media_massa_id','a.jabatan_id','a.nama_tenaga','a.nik','a.file','a.no_hp','a.file_sertifikat');

    public $column_search = array('a.id as id_tenaga','a.media_massa_id','a.jabatan_id','a.nama_tenaga','a.nik','a.file','a.no_hp','a.file_sertifikat');
    public $order = array('a.id' => 'desc');

    public function _get_datatables_query()
    {
        $this->db->select($this->select_column);
        $this->db->from("$this->table as a");
        $this->db->join('tmst_media_massa as b','a.media_massa_id = b.id');
        $this->db->join('tmst_jabatan as c','a.jabatan_id = c.id');
        $this->db->where('a.media_massa_id',$this->session->userdata('id_media'));

        $i = 0;

        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {

                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) {
                    $this->db->group_end();
                }

            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }

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

    public function getAll()
    {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function getById($id)
    {                        
        $this->db->select($this->select_column);        
        $this->db->from("$this->table as a");
        $this->db->join('tmst_media_massa as b','a.media_massa_id = b.id');
        $this->db->join('tmst_jabatan as c','a.jabatan_id = c.id');
        $this->db->where('a.id', $id);        
        return $this->db->get()->result();
    }

    public function updatePersonel($id,$data)
    {
        $this->db->where('a.id',$id);
        $this->db->update('tmst_tenaga as a', $data);
    }

}



?>