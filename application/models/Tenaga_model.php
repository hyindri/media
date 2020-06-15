<?php

class Tenaga_model extends CI_Model
{
    public $table = 'tmst_tenaga';
    public $column_order = array(null,'tmst_tenaga.id','tmst_media_massa.media_massa_id','tmst_jabatan.jabatan_id','nama_tenaga','tmst_tenaga.nik','tmst_tenaga.file_ktp','tmst_tenaga.file_sertifikat','tmst_tenaga.no_hp');
    public $column_search = array('tmst_tenaga.id','tmst_media_massa.media_massa_id','tmst_jabatan.jabatan_id','tmst_tenaga.nama_tenaga','tmst_tenaga.nik','tmst_tenaga.file_ktp','tmst_tenaga.file_sertifikat','tmst_tenaga.no_hp');
    public $order = array('tmst_tenaga.id' => 'desc');

    public function _get_datatables_query()
    {
        $this->db->from($this->table);
        $this->db->join('tmst_media_massa','tmst_media_massa.id = tmst_tenaga.media_massa_id','left');
        $this->db->join('tmst_jabatan','tmst_jabatan.id = tmst_tenaga.jabatan_id','left');
        $this->db->where('tmst_tenaga.media_massa_id',$this->session->userdata('id_media'));

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
}



?>