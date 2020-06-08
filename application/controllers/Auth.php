<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('users_model', 'users');
        $this->load->model('notifikasi_model', 'notifikasi');
        $this->load->model('Log_model','aktivitas');

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
                            'id_user' => $media['id'],
                            'username' => $media['username'],
                            'level' => $media['level'],
                            'status' => $media['status'],
                            'nama' => $media['nama'],
                            'tipe_publikasi' => $media['tipe_publikasi'],
                            'tipe_mediamassa' => $media['tipe_media_massa'],
                            'pimpinan' => $media['pimpinan'],                            
                            'npwp' => $media['npwp'],
                            'mulai_mou' => $media['mulai_mou'],
                            'akhir_mou' => $media['akhir_mou'],
                            'perusahaan' => $media['perusahaan'],
                            'alamat_per' => $media['alamat'],
                            'rekening' => $media['rekening'],
                            'kabiro' => $media['kabiro'],
                            'surat_kabiro' => $media['surat_kabiro'],
                            'telp' => $media['no_telp'],
                            'wartawan' => $media['wartawan'],
                            'sertifikat' => $media['sertifikat_uji'],
                            'verifikasi' => $media['verifikasi_pers'],
                            'penawaran_kerjasama' => $media['penawaran_kerja_sama']                            

                        ];
                    } else {
                        $data = [
                            'login_status' => true,
                            'id_user' => $user['id'],
                            'username' => $user['username'],
                            'level' => $user['level'],
                            'status' => $user['status']

                        ];
                    }                    
                    $this->session->set_userdata($data);            
                    $this->aktivitas->log_login();
                    redirect('dashboard');            
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger text-center" role="alert">Akun sedang tidak aktif! Hubungi Admin.</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger text-center" role="alert">Password Salah! Mohon periksa kembali password anda</div>');
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
            $mediamassa = implode(',',$this->input->post('tipe_media_massa'));
            $data_media_massa = array(
                'id' => uniqid(),
                'user_id' => $ins_id,
                'nama' => $this->input->post('nama'),
                'perusahaan' => $this->input->post('perusahaan'),              
                'npwp' => $this->input->post('npwp'),
                'pimpinan' => $this->input->post('pimpinan'),
                'no_telp' => $this->input->post('no_telp'),
                'tipe_publikasi' => $this->input->post('tipe_publikasi'),
                'tipe_media_massa' => $mediamassa,
                'mulai_mou' => $this->input->post('mulai_mou'),
                'akhir_mou' => $this->input->post('akhir_mou'),
            );
            $this->db->insert('tmst_media_massa', $data_media_massa);

            $this->db->where('level', 'admin');
            $query = $this->db->get('tmst_user');
            foreach ($query->result() as $baris) {
                $notif = array(
                    'user_pengirim' => $ins_id,
                    'user_penerima' => $baris->id,
                    'judul' => 'Ada user baru',
                    'pesan' => ' Terdapat user baru dengan username ' . $this->input->post('username') .' dari media massa bernama '. $this->input->post('nama'),
                    'link' => $this->uri->segment(1),
                    'dibaca' => '1',
                    'dibuat_tanggal' => date('y-m-d'),
                    'dibuat_pukul' => date('h:i:s')
                );
                $this->notifikasi->simpan($notif);
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">Pendaftaran berhasil.</div>');
            redirect('auth');
        }
    }


    public function changepassword(){

		if ($this->users->change_password()==true)
		{
            $this->aktivitas->log_changepassword();
			$sesi_selesai = array(
                'login_status' => 'login_status',
                'id_media' => 'id_media',
                'id_user' =>'id_user',
                'username' => 'username',
                'level' => 'level',
                'status' => 'status',
                'nama' => 'nama',
                'tipe_publikasi' => 'tipe_publikasi',
                'tipe_mediamassa' => 'tipe_mediamassa',
                'pimpinan' => 'pimpinan',                            
                'npwp' => 'npwp',
                'mulai_mou' => 'mulai_mou',
                'akhir_mou' => 'akhir_mou',
                'perusahaan' => 'perusahaan',
                'alamat_per' => 'alamat_per',
                'rekening' => 'rekening',
                'kabiro' => 'kabiro',
                'surat_kabiro' => 'surat_kabiro',
                'telp' => 'telp',
                'wartawan' => 'wartawan',
                'sertifikat' => 'sertifikat',
                'verifikasi' => 'verifikasi',
                'penawaran_kerjasama' =>'penawaran_kerjasama' 
            );
            $this->session->unset_userdata($sesi_selesai);    
			$this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">Password berhasil diubah, silahkan login ulang!</div>');
			redirect('auth');
		}

        

    }

    public function logout()
    {
        $sesi_selesai = array(
            'login_status' => 'login_status',
            'id_media' => 'id_media',
            'id_user' =>'id_user',
            'username' => 'username',
            'level' => 'level',
            'status' => 'status',
            'nama' => 'nama',
            'tipe_publikasi' => 'tipe_publikasi',
            'tipe_mediamassa' => 'tipe_mediamassa',
            'pimpinan' => 'pimpinan',                            
            'npwp' => 'npwp',
            'mulai_mou' => 'mulai_mou',
            'akhir_mou' => 'akhir_mou',
            'perusahaan' => 'perusahaan',
            'alamat_per' => 'alamat_per',
            'rekening' => 'rekening',
            'kabiro' => 'kabiro',
            'surat_kabiro' => 'surat_kabiro',
            'telp' => 'telp',
            'wartawan' => 'wartawan',
            'sertifikat' => 'sertifikat',
            'verifikasi' => 'verifikasi',
            'penawaran_kerjasama' =>'penawaran_kerjasama' 
        );
        $this->aktivitas->log_logout();
        $this->session->unset_userdata($sesi_selesai);
        $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">Anda Telah Logout, Terima Kasih :)</div>');
        redirect('auth');
    }

}
