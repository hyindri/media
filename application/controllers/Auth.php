<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('users_model', 'users');

    }

    public function index()
    {
        if ($this->session->userdata('login_status') == true) {
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
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $user = $this->users->data_login($username)->row_array();
        // jika usernya ada
        if ($user) {
            // cek password
            if (password_verify($password, $user['password'])) {
                if ($user['status'] == 'aktif' || $user['status'] == 'registrasi') {
                    if($user['level'] == 'user'){
                        $media = $this->users->data_all($username)->row_array();
                        $data = [
                            'login_status' => true,
                            'id_media' => $media['id_media'],
                            'id_user' => $media['id_user'],
                            'username' => $media['username'],
                            'level' => $media['level'],
                            'status' => $media['status'],
                            'nama' => $media['nama'],
                            'tipe_publikasi' => $media['tipe_publikasi'],
                            'tipe_mediamassa' => $media['tipe_media_massa'],
                            'pemimpin' => $media['pemimpin'],
                            'nik' => $media['nik'],
                            'npwp' => $media['npwp'],
                            'mulai_mou' => $media['mulai_mou'],
                            'akhir_mou' => $media['akhir_mou']

                        ];
                    } else {
                        $data = [
                            'login_status' => true,
                            'id' => $user['id'],
                            'username' => $user['username'],
                            'level' => $user['level'],
                            'status' => $user['status']

                        ];
                    }
                    $this->session->set_userdata($data);            
                    redirect('dashboard');            
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
                'status' => 'registrasi',
            );

            $this->db->insert('tmst_user', $data);
            $ins_id = $this->db->insert_id();

            $data_media_massa = array(
                'user_id' => $ins_id,
                'nama' => $this->input->post('nama'),
                'nik' => $this->input->post('nik'),
                'npwp' => $this->input->post('npwp'),
                'pemimpin' => $this->input->post('pemimpin'),
                'tipe_publikasi' => $this->input->post('tipe_publikasi'),
                'tipe_media_massa' => $this->input->post('tipe_media_massa'),
                'mulai_mou' => date("Y-m-d", strtotime($this->input->post('mulai_mou'))),
                'akhir_mou' => date("Y-m-d", strtotime($this->input->post('akhir_mou'))),
            );
            $this->db->insert('tmst_media_massa', $data_media_massa);
            $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">Pendaftaran berhasil.</div>');
            redirect('auth');
        }
    }


    public function changepassword(){
        $data = $this->users->change_password();
        redirect(site_url('profil'));

    }

    public function logout()
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">You have been logged out!</div>');
        redirect('auth');
    }

}
