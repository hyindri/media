<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model{


	function get_table() {
		$table = "tmst_user";
		return $table; 
	}

	function getdetailmedia($id){
		$this->db->select('*');
		$this->db->where('tmst_media_massa.user_id', $id);
		$this->db->join('users', 'tmst_user.id = tmst_media_massa.user_id');
		$this->db->from('tmst_user'); //sekolah
		$this->db->limit(1);
		$query = $this->db->get();
    	return $query->row();
	}

	public function update($id, $data){
		return $this->db->where('id', $id)
				 ->update('tmst_user', $data);
	}


	function getALL(){
		$hasil = $this->db->get('tmst_user');

		if($hasil->num_rows() > 0){
			return $hasil->result();
		} else {
			return array();
		}
	}

	function getUsers(){
		$this->db->where('level', 'user');
		$hasil = $this->db->get('tmst_user');

		if($hasil->num_rows() > 0){
			return $hasil->result();
		} else {
			return array();
		}
    }
    
	public function register($data){
		$table = $this->get_table();
		$this->db->insert($table, $data);
	}

	public function delete($id){
		//delete...where id= ...
		$this->db->where('id', $id)
				 ->delete('tmst_user');
	}

}