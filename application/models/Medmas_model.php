<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Medmas_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    var $table = 'tmst_media_massa';
    var $table_user = 'tmst_user';
    var $id = 'id';
    var $column_order = array(null, 'tmst_media_massa.id','tmst_media_massa.user_id','tmst_media_massa.nama','tmst_media_massa.perusahaan', 'tmst_media_massa.alamat', 'tmst_media_massa.npwp', 'tmst_media_massa.rekening', 'tmst_media_massa.pimpinan', 'tmst_media_massa.kabiro', 'tmst_media_massa.surat_kabiro', 'tmst_media_massa.no_telp', 'tmst_media_massa.wartawan', 'tmst_media_massa.sertifikat_uji', 'tmst_media_massa.verifikasi_pers', 'tmst_media_massa.penawaran_kerja_sama','tmst_media_massa.tipe_publikasi','tmst_media_massa.tipe_media_massa','tmst_media_massa.mulai_mou','tmst_media_massa.akhir_mou','tmst_user.status'); //set column field database for datatable orderable
    var $column_search = array('tmst_media_massa.id','tmst_media_massa.user_id','tmst_media_massa.nama','tmst_media_massa.perusahaan', 'tmst_media_massa.alamat', 'tmst_media_massa.npwp', 'tmst_media_massa.rekening', 'tmst_media_massa.pimpinan', 'tmst_media_massa.kabiro', 'tmst_media_massa.surat_kabiro', 'tmst_media_massa.no_telp', 'tmst_media_massa.wartawan', 'tmst_media_massa.sertifikat_uji', 'tmst_media_massa.verifikasi_pers', 'tmst_media_massa.penawaran_kerja_sama','tmst_media_massa.tipe_publikasi','tmst_media_massa.tipe_media_massa','tmst_media_massa.mulai_mou','tmst_media_massa.akhir_mou','tmst_user.status'); //set column field database for datatable searchable 
    var $order = array('tmst_media_massa.id' => 'asc'); // default order 

 
    private function _get_datatables_query()
    {
         
        if($this->input->post('nama'))
        {
            $this->db->like('nama', $this->input->post('nama'));
        }
        if($this->input->post('npwp'))
        {
            $this->db->like('npwp', $this->input->post('npwp'));
        }
        if($this->input->post('pimpinan'))
        {
            $this->db->like('pimpinan', $this->input->post('pimpinan'));
        }
 
 
        $this->db->from($this->table);
        $this->db->join($this->table_user, 'tmst_media_massa.user_id = tmst_user.id');
        $i = 0;
     
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
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
	$this->db->or_like('tanggal', $q);
	$this->db->or_like('judul_agenda', $q);
	$this->db->or_like('isi_agenda', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('tanggal', $q);
	$this->db->or_like('judul_agenda', $q);
	$this->db->or_like('isi_agenda', $q);
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

    // update data
    function ubah($id, $data)
    {
        $this->db->where('user_id', $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    public function updateProfil()
    {
        $id['id'] = $this->input->post('id_media');
        $data = array(
            'nama' => $this->input->post('nama_media'),
            'perusahaan' => $this->input->post('nama_perusahaan'),
            'alamat' => $this->input->post('alamat_kantor'),
            'pimpinan' => $this->input->post('pimpinan'),
            'kabiro' => $this->input->post('kabiro'),
            'surat_kabiro' => $this->input->post('surat_kabiro'),
            'no_telp' => $this->input->post('no_telp'),
            'wartawan' => $this->input->post('wartawan'),
            'sertifikat_uji' => $this->input->post('sertifikat_uji'),
            'verifikasi_pers' => $this->input->post('verifikasi_pers'),
            'penawaran_kerja_sama' => $this->input->post('penawaran_kerjasama'),
            'tipe_media_massa' => $this->input->post('tipe_media_massa'),
        );
        $this->db->update($this->table,$data,$id);
    }

}
