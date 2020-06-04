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
            'username' => $this->session->userdata('username'),
            'level' => $this->session->userdata('level'),
            'status' => $this->session->userdata('status'),
            'nama' => $this->session->userdata('nama'),
            'tipe_mediamassa' => $this->session->userdata('tipe_mediamassa'),
            'tipe_publikasi' => $this->session->userdata('tipe_publikasi'),
            'status' => $this->session->userdata('status'),
            'pemimpin' => $this->session->userdata('pemimpin'),
            'nik' => $this->session->userdata('nik'),
            'npwp' => $this->session->userdata('npwp'),
            'mulai_mou' => date('d/m/Y', strtotime($this->session->userdata('mulai_mou'))),
            'akhir_mou' => date('d/m/Y', strtotime($this->session->userdata('akhir_mou'))),
            
        );      
        view('profil.index',$data);
    }

    public function detail($id)
    {
        $row = $this->medmas->get_by_id($id);
        $data = array (
            'nama' => $row->nama,
            'tipe_mediamassa' => $row->tipe_media_massa,
            'tipe_publikasi' => $row->tipe_publikasi,
            'status' => $this->session->userdata('status'),
            'pemimpin' => $row->pemimpin,
            'nik' => $row->nik,
            'npwp' => $row->npwp,
            'mulai_mou' => date('d/m/Y', strtotime($row->mulai_mou)),
            'akhir_mou' => date('d/m/Y',strtotime($row->akhir_mou))
        );
        view('profil.index',$data);
    }

    public function ubahpassword(){
        view('profil.forgotpassword');
    }

}


?>