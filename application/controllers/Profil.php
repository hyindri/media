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
        $this->load->model('Users_model','users');
    }
    
    public function index()
    {  
        redirect('dashboard');
    }

    public function detail($id)
    {
        $row = $this->medmas->get_by_id($id);
        $data = array (
            'nama' => $row->nama,
            'tipe_mediamassa' => $row->tipe_media_massa,
            'tipe_publikasi' => $row->tipe_publikasi,
            'status' => $this->session->userdata('status'),
            'pimpinan' => $row->pimpinan,            
            'npwp' => $row->npwp,
            'mulai_mou' => date('d/m/Y', strtotime($row->mulai_mou)),
            'akhir_mou' => date('d/m/Y',strtotime($row->akhir_mou)),
            'perusahaan' => $row->perusahaan,
            'alamat_per' => $row->alamat,
            'rekening' => $row->rekening,
            'kabiro' => $row->kabiro,
            'surat_kabiro' => $row->surat_kabiro,
            'telp' => $row->no_telp,
            'wartawan' => $row->wartawan,
            'sertifikat' => $row->sertifikat_uji,
            'verifikasi' => $row->verifikasi_pers,
            'penawaran_kerjasama' => $row->penawaran_kerja_sama
        );
        view('profil.index',$data);
    }

    public function ubahpassword(){
        view('profil.forgotpassword');
    }

    public function ubah($id = null)
    {
       if(!isset($id)) redirect('profil');
       
       $data['data_profil'] = $this->users->getById($id);

       if (!$data['data_profil']) show_404();
       view('profil.edit',$data);
    }

    public function updatedata()
    {
        $this->users->updateProfil();
        $this->session->set_flashdata('notif','<div class="alert bg-green alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        Data Profil Berhasil Diubah
        </div>');
        redirect('profil');
    }

}


?>