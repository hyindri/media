<?php

class Log_model extends CI_Model
{
    public $table = 'tb_log';
    public $column_order = array(null,'id','aktivitas','oleh','pada');
    public $column_search = array('id','aktivitas','oleh','pada');
    public $order = array('id' => 'desc');

    public function _get_datatables_query()
    {
        $this->db->from($this->table);
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

    // Log Login
    public function log_login()
    {
        $data = array(            
            'aktivitas' => 'Telah Login pada sistem',            
            'oleh' => $this->session->userdata('username'),
            'pada' => date('Y-m-d H:i:s')
        );

        return $this->db->insert($this->table,$data);
    }

    public function log_logout()
    {
        $data = array(            
            'aktivitas' => 'Telah Logout dari sistem',
            'oleh' => $this->session->userdata('username'),
            'pada' => date('Y-m-d H:i:s')
        );

        return $this->db->insert($this->table,$data);
    }

    public function log_changepassword()
    {
        $data = array(            
            'aktivitas' => 'Telah mengubah password akun',
            'oleh' => $this->session->userdata('username'),
            'pada' => date('Y-m-d H:i:s')
        );

        return $this->db->insert($this->table,$data);
    }

    // Log Agenda

    public function log_tambahagenda()
    {
        $data = array(            
            'aktivitas' => 'Telah menambahkan agenda terbaru',
            'oleh' => $this->session->userdata('username'),
            'pada' => date('Y-m-d H:i:s')
        );

        return $this->db->insert($this->table,$data);
    }

    public function log_ubahagenda()
    {
        $data = array(            
            'aktivitas' => 'Telah mengubah data agenda',
            'oleh' => $this->session->userdata('username'),
            'pada' => date('Y-m-d H:i:s')
        );

        return $this->db->insert($this->table,$data);
    }

    // Log Berita

    public function log_tambahdraft()
    {
        $data = array(            
            'aktivitas' => 'Telah menambahkan draft terbaru',
            'oleh' => $this->session->userdata('username'),
            'pada' => date('Y-m-d H:i:s')
        );

        return $this->db->insert($this->table,$data);
    }

    public function log_ubahdraft()
    {
        $data = array(            
            'aktivitas' => 'Telah mengubah data draft',
            'oleh' => $this->session->userdata('username'),
            'pada' => date('Y-m-d H:i:s')
        );

        return $this->db->insert($this->table,$data);
    }

    public function log_ubahberita()
    {
        $data = array(            
            'aktivitas' => 'Telah mengubah data berita',
            'oleh' => $this->session->userdata('username'),
            'pada' => date('Y-m-d H:i:s')
        );

        return $this->db->insert($this->table,$data);
    }

    public function log_hapusberita()
    {
        $data = array(            
            'aktivitas' => 'Telah menghapus data berita',
            'oleh' => $this->session->userdata('username'),
            'pada' => date('Y-m-d H:i:s')
        );

        return $this->db->insert($this->table,$data);
    }

    public function log_verifdraft(){

        $data = array(            
            'aktivitas' => 'Telah verifikasi data berita',
            'oleh' => $this->session->userdata('username'),
            'pada' => date('Y-m-d H:i:s')
        );

        return $this->db->insert($this->table,$data);
    }

    // log ubah profil

    public function log_ubahprofil()
    {
        $data = array(            
            'aktivitas' => 'Telah mengubah data profil',
            'oleh' => $this->session->userdata('username'),
            'pada' => date('Y-m-d H:i:s')
        );

        return $this->db->insert($this->table,$data);
    }

    // log ubah manajemen akun (admin)
    public function log_ubahakun()
    {
        $data = array(            
            'aktivitas' => 'Telah mengubah data akun',
            'oleh' => $this->session->userdata('username'),
            'pada' => date('Y-m-d H:i:s')
        );

        return $this->db->insert($this->table,$data);
    }



}


?>