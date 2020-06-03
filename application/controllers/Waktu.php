<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Waktu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Waktu_model', 'waktu');
    
    }

    public function index()
    {
        return view('admin.waktu.index');

    }

    function json()
    {
        $data = $this->waktu->get_all();
        foreach ($data as $row){
            $output['id'] = $row->id;
            $output['waktu'] = $row->waktu;
        }
        echo json_encode($output);
    }
    
    function ubah_jam()
	{
		$data = $this->waktu->update();
		json_encode($data);
	}
}
