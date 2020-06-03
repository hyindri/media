<?php

class Profil extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        if($this->session->userdata('login_status')!=TRUE)
		{	
			$this->session->set_flashdata('msg', 'Mohon Login Dahulu');
			redirect(site_url(''));
        }
        $this->load->model('Medmas_model','medmas');
    }
    
    public function index(){        
        view('profil.index');
    }

    public function ubahpassword(){
        view('profil.forgotpassword');
    }

}


?>