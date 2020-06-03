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
		$data['hasil']=$this->dashboard->__get_chart();
		$data['medmas']=$this->dashboard->__get_medmas();
		$data['berita_hariini']=$this->dashboard->__get_berita_hari();
		$data['berita_mingguini']=$this->dashboard->__get_berita_minggu();
		$data['berita_bulanini']=$this->dashboard->__get_berita_bulan();
		if($this->session->userdata('username') && $this->session->userdata('level') == 'superadmin'){
			view('superadmin.dashboard.index');
		} elseif ($this->session->userdata('username') && $this->session->userdata('level') == 'admin'){
			view('admin.dashboard.index', $data);
		} elseif ($this->session->userdata('username') && $this->session->userdata('level') == 'user'){
			view('user.dashboard.index');
		}
	}
}
