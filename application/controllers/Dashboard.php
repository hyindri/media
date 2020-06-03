<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		if($this->session->userdata('username') && $this->session->userdata('level') == 'superadmin'){
			view('sadmin/dashboard');
		} elseif ($this->session->userdata('username') && $this->session->userdata('level') == 'admin'){
			view('admin/dashboard/index');
		} elseif ($this->session->userdata('username') && $this->session->userdata('level') == 'user'){
			view('user/dashboard');
		}
	}
}
