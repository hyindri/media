<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    
    }



    public function index()
    {
        if($this->session->userdata('email') && $this->session->userdata('role') == 'Superadmin'){
            redirect('sadmin/dashboard');
        } elseif ($this->session->userdata('email') && $this->session->userdata('role') == 'Admin'){
            redirect('admin/dashboard');
        } elseif ($this->session->userdata('email') && $this->session->userdata('role') == 'User'){
            redirect('user/dashboard');
        }

        $this->form_validation->set_rules('email', 'email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {   
            $data['title'] = 'Sign In'; 
            view('auth.signin', $data);
        } else {
            $this->_login();
        }
    }
}
