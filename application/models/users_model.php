<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Users_model extends CI_Model
{

    public $table = 'tmst_user';

    public function get_table()
    {
        $table = "tmst_user";
        return $table;
    }

    public function getdetailmedia($id)
    {
        $this->db->select('*');
        $this->db->where('tmst_media_massa.user_id', $id);
        $this->db->join('users', 'tmst_user.id = tmst_media_massa.user_id');
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
        $this->db->select('media.*,user.*');
        $this->db->from('tmst_user user');
        $this->db->join('tmst_media_massa media', 'media.user_id = user.id');
        $this->db->where('user.username', $username);
        return $this->db->get();
    }

}
