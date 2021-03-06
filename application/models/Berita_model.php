<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Berita_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    var $table = 'tb_berita';
    var $table_media_massa = 'tmst_media_massa';
    var $id = 'id';
    var $column_order = array(null, 'tb_berita.id', 'tb_berita.media_massa_id', 'tmst_media_massa.nama', 'tb_berita.link_berita', 'tb_berita.screenshoot', 'tb_berita.share', 'tb_berita.jumlah_view', 'tb_berita.status_berita', 'tb_berita.keterangan', 'tb_berita.dibuat_oleh', 'tb_berita.dibuat_tanggal', 'tb_berita.dibuat_pukul');
    var $column_search = array('tb_berita.id', 'tb_berita.media_massa_id', 'tmst_media_massa.nama', 'tb_berita.link_berita', 'tb_berita.screenshoot', 'tb_berita.share', 'tb_berita.jumlah_view', 'tb_berita.status_berita', 'tb_berita.keterangan', 'tb_berita.dibuat_oleh', 'tb_berita.dibuat_tanggal', 'tb_berita.dibuat_pukul');
    var $order = array('tb_berita.id' => 'desc');

    private function _get_datatables_query()
    {
        $this->db->select('tb_berita.id as id_berita, tb_berita.media_massa_id, tmst_media_massa.nama, tb_berita.link_berita, tb_berita.screenshoot, 
        tb_berita.share, tb_berita.jumlah_view, tb_berita.status_berita, tb_berita.keterangan, tb_berita.dibuat_oleh, tb_berita.dibuat_tanggal, tb_berita.dibuat_pukul');
        
        if ($this->input->post('nama')) {
            $this->db->like('nama', $this->input->post('nama'));
        }
        if ($this->input->post('dibuat_tanggal')) {
            $this->db->like('dibuat_tanggal', $this->input->post('dibuat_tanggal'));
        }
        if ($this->input->post('status_berita')) {
            $this->db->like('status_berita', $this->input->post('status_berita'));
        }
        if ($this->session->userdata('level') == 'user'  && $this->session->userdata('status') == 'aktif' ) {
            $this->db->where('tmst_media_massa.id', $this->session->userdata('id_media'));
        }
        $this->db->from($this->table);
        $this->db->join($this->table_media_massa, 'tb_berita.media_massa_id = tmst_media_massa.id', 'left');

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

    function get_by_id($id)
    {
        $this->db->where('id',$id);
        return $this->db->get($this->table);
    }

    // get data by id
    function get_by_id_joined($id)
    {
        $this->db->select('tb_berita.id, tmst_media_massa.nama, tb_berita.link_berita, tb_berita.screenshoot, 
                            tb_berita.share, tb_berita.jumlah_view, tb_berita.status_berita, tb_berita.keterangan, tb_berita.dibuat_oleh, tb_berita.dibuat_tanggal, tb_berita.dibuat_pukul, tb_berita.diperiksa_oleh, tb_berita.diperiksa_pada');
        $this->db->join($this->table_media_massa, 'tb_berita.media_massa_id = tmst_media_massa.id');
        $this->db->where('tb_berita.id', $id);
        return $this->db->get($this->table);
    }

    function __get_media_massa()
    {
        $this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
        $this->db->group_by('nama');
        return $this->db->get($this->table_media_massa)->result();
    }

    function simpan($data)
    {
        $this->db->insert($this->table, $data);
    }

    function ubah($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
    }

    function hapus($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }


}
