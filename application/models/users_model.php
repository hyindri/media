<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Users_model extends CI_Model
{

    public $table = 'tmst_user';
    public $table_media = 'tmst_media_massa';

    var $column_order = array(null, 'tmst_user.id','username','level','dibuat_pada','status','pimpinan','tipe_publikasi','tipe_media_massa','dibuat_oleh','dibuat_pada'); //set column field database for datatable orderable
    var $column_search = array('tmst_user.id','username','level','dibuat_pada','status','pimpinan','tipe_publikasi','tipe_media_massa','dibuat_oleh','dibuat_pada'); //set column field database for datatable searchable 
    var $order = array('tmst_user.id' => 'asc'); // default order 
 
    private function _get_datatables_query()
    {
        $this->db->where('tmst_user.level','user');

        if ($this->input->post('nama')) {
            $this->db->like('nama', $this->input->post('nama'));
        }
        if ($this->input->post('status')) {
            $this->db->like('status', $this->input->post('status'));
        }
        if ($this->input->post('tipe_publikasi')) {
            $this->db->like('tipe_publikasi', $this->input->post('tipe_publikasi'));
        }
        if ($this->input->post('tipe_media_massa')) {
            $this->db->like('tipe_media_massa', $this->input->post('tipe_media_massa'));
        }
        $this->db->join('tmst_media_massa', 'tmst_media_massa.user_id = tmst_user.id', 'left');
        $this->db->from('tmst_user');
     
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

    public function get_table()
    {
        $table = "tmst_user";
        return $table;
    }

    public function getalluser()
    {
        $this->db->select('*');
        $this->db->where('tmst_user.level','user');
        $this->db->join('tmst_media_massa', 'tmst_user.id = tmst_media_massa.user_id');
        $this->db->from('tmst_user');
        $query = $this->db->get();
        return $query->result();
    }

    public function export($nama = "", $status = "", $publikasi = "", $tipemedia = "")
    {
        // $this->db->select('tmst_media_massa.nama, tmst_media_massa.perusahaan, tmst_media_massa.pimpinan, tmst_media_massa.kabiro, tmst_media_massa.tipe_publikasi, tmst_media_massa.tipe_media_massa, tmst_media_massa.mulai_mou, tmst_media_massa.akhir_mou');
        $this->db->select('*');
        $this->db->where('tmst_user.level','user');
        if (!empty($nama) || $nama != 0) {
            $this->db->like('nama', $nama);
        }
        if (!empty($status) || $status != 0) {
            $this->db->like('status', $status);
        }
        if (!empty($publikasi) || $publikasi != 0) {
            $this->db->like('tipe_publikasi', $publikasi);
        }
        if (!empty($tipemedia) || $tipemedia != 0) {
            $this->db->like('tipe_media_massa', $tipemedia);
        }
        $this->db->join('tmst_media_massa', 'tmst_media_massa.user_id = tmst_user.id');
        $this->db->from('tmst_user');
        $query = $this->db->get();
        return $query->result();
    }

    public function getdetailmedia($id)
    {
        $this->db->select('*');
        $this->db->where('tmst_media_massa.user_id', $id);
        $this->db->join('tmst_media_massa', 'tmst_user.id = tmst_media_massa.user_id');
        $this->db->from('tmst_user');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row();
    }

    public function update($id, $data)
    {
        return $this->db->where('id', $id)
            ->update('tmst_user', $data);
    }

    public function getALL()
    {
        $hasil = $this->db->get('tmst_user');

        if ($hasil->num_rows() > 0) {
            return $hasil->result();
        } else {
            return array();
        }
    }

    public function getUsers()
    {
        $this->db->where('level', 'user');
        $hasil = $this->db->get('tmst_user');

        if ($hasil->num_rows() > 0) {
            return $hasil->result();
        } else {
            return array();
        }
    }

    public function register($data)
    {
        $table = $this->get_table();
        $this->db->insert($table, $data);
    }

    public function delete($id)
    {
        //delete...where id= ...
        $this->db->where('id', $id)
            ->delete('tmst_user');
    }

    public function change_password()
    {
        $id['id'] = $this->input->post('id');
        $data = array(
            'password' => password_hash($this->input->post('new_password'), PASSWORD_DEFAULT),
        );

        return $this->db->update($this->table, $data, $id);
    }

    public function data_login($username)
    {
        $this->db->where('username', $username);
        return $this->db->get($this->table);
    }

    public function data_all($username)
    {
        $this->db->select('media.*,user.*, media.id as id_media, user.id as id_user');
        $this->db->from('tmst_user user');
        $this->db->join('tmst_media_massa media', 'media.user_id = user.id');
        $this->db->where('user.username', $username);
        return $this->db->get();
    }

    public function getById($id){
        return $this->db->get_where($this->table_media,['user_id' => $id])->row();
    }

    // public function _upload_logo()
    // {
    //     $file_lama = $this->input->post('logo_lama');
    //     if (!file_exists('./upload/logo-media/')) {
    //         mkdir('./upload/logo-media/', 0777, true);
    //     }
    //     $config['upload_path'] = './upload/logo-media/';
    //     $config['allowed_types'] = 'gif|jpg|png|jpeg';
    //     $config['file_name'] = 'logo-'.$this->session->userdata('id_media');
    //     $config['max-size'] = 2048;
    //     $this->load->library('upload',$config);
    //     if($this->upload->do_upload('file_logo_media')){
    //         unlink('./upload/logo-media/'.$file_lama);
    //         return $this->upload->data('file_name');
    //     }elseif($this->upload->do_upload('file_logo_media') == 0){
    //         return $file_lama;
    //     }
    // }

    // public function _upload_npwp()
    // {
    //     $file_lama = $this->input->post('old_file_npwp');
    //     // $album = $this->input->post('username');
    //     if (!file_exists('./upload/npwp/')) {
    //         mkdir('./upload/npwp/', 0777, true);
    //     }
    //     $config2['upload_path']          = './upload/npwp/';
    //     $config2['allowed_types']        = 'gif|jpg|png|jpeg';
    //     $config2['max_size']             = 2000; //set max size allowed in Kilobyte
    //     // $config2['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name
    //     $config2['file_name'] = 'npwp-'.$this->session->userdata('id_media');

    //     $this->load->library('upload', $config2);
    //     if($this->upload->do_upload('file_npwp')){
    //         unlink('./upload/npwp/'.$file_lama);
    //         return $this->upload->data('file_name');
    //     }elseif($this->upload->do_upload('file_npwp') == 0){
    //         return $file_lama;
    //     }

    //     // if (!$this->upload->do_upload('file_npwp')) //upload and validate
    //     // {
    //     //     $data['inputerror'][] = 'file_npwp';
    //     //     $data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
    //     //     $data['status'] = FALSE;
    //     //     echo json_encode($data);
    //     //     exit();
    //     // }
    //     // return $this->upload->data('file_name');
    // }







}
