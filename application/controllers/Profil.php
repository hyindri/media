<?php

class Profil extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        if($this->session->userdata('login_status')!=TRUE)
		{	
			$this->session->set_flashdata('msg', '<div class="alert alert-danger"><strong>Oops!</strong> Mohon Login Dahulu </div>');
			redirect(site_url(''));
        }
        $this->load->model('Medmas_model','medmas');
    }
    
    public function index()
    {  
        $data = array (
            'nama' => $this->session->userdata('nama'),
        );      
        view('profil.index',$data);
    }

    public function detail($id)
    {
        $row = $this->medmas->get_by_id($id);
        $data = array (
            'nama' => $row->nama
        );
        view('profil.index',$data);
    }

    public function ubahpassword(){
        view('profil.forgotpassword');
    }

}


?>