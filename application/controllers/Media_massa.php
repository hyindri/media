<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Media_massa extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Medmas_model', 'medmas');
        if($this->session->userdata('login_status')!=TRUE)
		{	
			$this->session->set_flashdata('msg', '<div class="alert alert-danger"><strong>Oops!</strong> Mohon Login Dahulu </div>');
			redirect(site_url(''));
        }
    }

    public function index()
    {
        return view('admin.media_massa.index');
    }

    public function json()
    {
        $list = $this->medmas->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $q) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $q->nama;
            $row[] = $q->nik;
            $row[] = $q->npwp;
            $row[] = $q->pendiri;
            $row[] = '<a href="' . site_url() . 'upload/profil/' . $q->id . '" class="btn btn-xs btn-primary"> <i class="fa fa-eye"></i> Lihat Data </a>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->medmas->count_all(),
            "recordsFiltered" => $this->medmas->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
}
