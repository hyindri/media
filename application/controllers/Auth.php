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
        if($this->session->userdata('login_status') == true){
            redirect('dashboard');
        }

        $this->form_validation->set_rules('username', 'username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {   
            $data['title'] = 'Sign In'; 
            view('auth.signin', $data);
        } else {
            $this->_signin();
        }
    }

    private function _signin()
    {
        $email = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->db->get_where('tmst_user', ['username' => $email])->row_array();

        // jika usernya ada
        if ($user) {
                // cek password
                if (password_verify($password, $user['password'])) {
                    if($user['status'] == 'aktif' || $user['status'] == 'registrasi'){
                        $data = [
                        	'login_status' => true,
                            'id' => $user['id'],
                            'username' => $user['username'],
                            'level' => $user['level'],
                            'status' => $user['status']
                        ];
                        $this->session->set_userdata($data);
                        if ($user['level'] == 'superadmin') {
                            redirect('sadmin/dashboard', $data);
                        } elseif ($user['level'] == 'admin') {
                            redirect('admin/dashboard', $data);  
                        } elseif ($user['level'] == 'user') {
                            redirect('user/dashboard', $data);  
                        }
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger text-center" role="alert">Akun sedang tidak aktif! Hubungi Admin.</div>');
                        redirect('auth');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger text-center" role="alert">Password Salah!</div>');
                    redirect('auth');
                } 
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger text-center" role="alert">Username belum terdaftar / salah!</div>');
            redirect('auth');
        }
    }

    public function signup()
    {
        $data['title'] = 'Sign Up';
        $this->form_validation->set_rules('npwp', 'NPWP', 'required|trim|is_unique[tmst_media_massa.npwp]', [
            'is_unique' => 'This username has already registered!']);
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[tmst_user.username]', [
            'is_unique' => 'This username has already registered!']);
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            view('auth.signup', $data);
        } else {
            // validasinya success
            $data = array(
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'level' => 'user',
                'dibuat_pada' => date('Y-m-d'),
                'status' => 'registrasi'
            );
        
            $this->db->insert('tmst_user', $data);
            $ins_id = $this->db->insert_id();

            $data_media_massa = array(
                'user_id' => $ins_id,
                'nama' => $this->input->post('nama'),
                'nik' => $this->input->post('nik'),
                'npwp' => $this->input->post('npwp'),
                'pendiri' => $this->input->post('pendiri'),
                'tipe_publikasi' => $this->input->post('tipe_publikasi'),
                'tipe_media_massa' => $this->input->post('tipe_media_massa'),
                'mulai_mou' => date("Y-m-d", strtotime($this->input->post('mulai_mou'))),
                'akhir_mou' => date("Y-m-d", strtotime($this->input->post('akhir_mou')))
            );
            $this->db->insert('tmst_media_massa', $data_media_massa);
            $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">Pendaftaran berhasil.</div>');
            redirect('auth');
        }
    }

    public function forgotpassword()
    {
        $data['title'] = 'Forgot Password';
        $this->form_validation->set_rules('username', 'Username', 'required|trim');

        if ($this->form_validation->run() == false) {
            view('auth.forgotpassword', $data);
        } else {
            // validasinya success
            $username = $this->input->post('username');
            $default = '12345';
            $password = password_hash($default, PASSWORD_DEFAULT);
            $user = $this->db->get_where('tmst_user', ['username' => $username])->row_array();

            if ($user) {
                $data = array(
                    'username' => $username,
                    'password' => $password
                );
                $this->db->where('username', $username)->update('tmst_user', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">Reset password berhasil.</div>');
                redirect('auth');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger text-center" role="alert">Username belum terdaftar / salah!</div>');
                view('auth.forgotpassword');
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">You have been logged out!</div>');
        redirect('auth');
    }


}
