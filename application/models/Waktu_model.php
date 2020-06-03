<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Waktu_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    var $table = "tmst_setting";

    
      function get_all()
      {
          return $this->db->get($this->table)->result();
      }
  

    function update()
    {
        $id = $this->input->post('id');
        $data = array(
            'waktu' => $this->input->post('waktu'),
        );
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
    }

}