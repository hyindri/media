<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Dashboard_model', 'dashboard');
		if($this->session->userdata('login_status')!=TRUE)
		{	
			$this->session->set_flashdata('msg', '<div class="alert alert-danger"><strong>Oops!</strong> Mohon Login Dahulu </div>');
			redirect(site_url(''));
        }
	}

	function index()
	{

		if($this->session->userdata('username') && $this->session->userdata('level') == 'superadmin'){
			view('superadmin.dashboard.index');
		} elseif ($this->session->userdata('username') && $this->session->userdata('level') == 'admin'){
			$id='';
			$data['hasil']=$this->dashboard->__get_chart($id);
			$data['medmas']=$this->dashboard->__get_medmas();
			$data['berita_hariini']=$this->dashboard->__get_berita_hari();
			$data['berita_mingguini']=$this->dashboard->__get_berita_minggu($id);
			$data['berita_bulanini']=$this->dashboard->__get_berita_bulan($id);
			view('admin.dashboard.index', $data);
		} elseif ($this->session->userdata('username') && $this->session->userdata('level') == 'user'){
			$data['hasil']=$this->dashboard->__get_chart($this->session->userdata('id_media'));
			$data['status_berita']=$this->dashboard->__get_statusBerita();
			$data['berita_mingguini']=$this->dashboard->__get_berita_minggu($this->session->userdata('id_media'));
			$data['berita_bulanini']=$this->dashboard->__get_berita_bulan($this->session->userdata('id_media'));
			view('user.dashboard.index', $data);
		}
	}
}
