<?php

use function PHPSTORM_META\map;

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('users_model', 'users');
        $this->load->model('medmas_model', 'medmas');
        $this->load->model('jabatan_model', 'jabatan');
        $this->load->model('notifikasi_model', 'notifikasi');
        $this->load->model('Log_model', 'aktivitas');
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
                    if ($user['level'] == 'user') {
                        $media = $this->users->data_all($username)->row_array();
                        $data = [
                            'login_status' => true,
                            'id_media' => $media['id_media'],
                            'id_user' => $media['id'],
                            'username' => $media['username'],
                            'level' => $media['level'],
                            'status' => $media['status'],
                            'nama' => $media['nama_media'],
                            'perusahaan' => $media['nama_perusahaan'],
                            'alamat_per' => $media['alamat_perusahaan'],
                            'npwp' => $media['npwp'],
                            'rekening' => $media['rekening'],
                            'telp' => $media['no_telp'],
                            'email' => $media['email'],
                            'username_fb' => $media['username_fb'],
                            'username_ig' => $media['username_ig'],
                            'username_twitter' => $media['username_twitter'],
                            'channel_youtube' => $media['channel_youtube'],
                            'pengikut_fb' => $media['pengikut_fb'],
                            'pengikut_ig' => $media['pengikut_ig'],
                            'pengikut_twitter' => $media['pengikut_twitter'],
                            'subscriber_youtube' => $media['subscriber_youtube'],
                            'tipe_mediamassa' => $media['tipe_media_massa'],
                            'tipe_publikasi' => $media['tipe_publikasi'],
                            'jumlah_saham' => $media['jumlah_saham'],
                            'mulai_mou' => $media['mulai_mou'],
                            'akhir_mou' => $media['akhir_mou'],

                            'file_logo_media' => $media['file_logo_media'],
                            'file_akta_pendirian' => $media['file_akta_pendirian'],
                            'file_situ' => $media['file_situ'],
                            'file_siup' => $media['file_siup'],
                            'file_tdp' => $media['file_tdp'],
                            'file_npwp' => $media['file_npwp'],
                            'file_rekening' => $media['file_rekening'],
                            'file_mou' => $media['file_mou'],
                            'file_sertifikat' => $media['file_sertifikat'],
                            'file_sertifikat_uji' => $media['file_sertifikat_uji'],
                            'file_laporan_pajak' => $media['file_laporan_pajak'],
                            'file_verifikasi_pers' => $media['file_verifikasi_pers'],
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
            'is_unique' => 'This username has already registered!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            view('auth.signup', $data);
        } else {
            $username = $this->input->post('username');
            $nama_media = $this->input->post('nama_media');

            $u = $this->db->get_where('tmst_user', ['username' => $username])->row_array();
            if ($u) {
                $message = 'Username yang anda pilih sudah digunakan!';
                redirect('auth/signup', $message);
            } else {
                $med = $this->db->get_where('tmst_media_massa', ['nama_media' => $nama_media])->row_array();
                if ($med) {
                    $message = 'Media sudah terdaftar!';
                    redirect('auth/signup', $message);
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
                    $date = date('Y-m-d');
                    $data_media_massa = array(
                        'id' => uniqid(),
                        'user_id' => $ins_id,
                        'nama_media' => $this->input->post('nama_media'),
                        'nama_perusahaan' => $this->input->post('nama_perusahaan'),
                        'alamat_perusahaan' => $this->input->post('alamat_perusahaan'),
                        'npwp' => $this->input->post('npwp'),
                        'rekening' => $this->input->post('rekening'),
                        'no_telp' => $this->input->post('no_telp'),
                        'tipe_publikasi' => $this->input->post('tipe_publikasi'),
                        'tipe_media_massa' => $this->input->post('tipe_media_massa'),
                        'jumlah_saham' => $this->input->post('jumlah_saham'),
                        'batas_tanggal_post' => date('Y-m-d', strtotime($date . ' + 14 days')),
                        'email' => $this->input->post('email'),
                        'username_fb' => $this->input->post('username_fb'),
                        'pengikut_fb' => $this->input->post('pengikut_fb'),
                        'username_ig' => $this->input->post('username_ig'),
                        'pengikut_ig' => $this->input->post('pengikut_ig'),
                        'username_twitter' => $this->input->post('username_twitter'),
                        'pengikut_twitter' => $this->input->post('pengikut_twitter'),
                        'channel_youtube' => $this->input->post('channel_youtube'),
                        'subscriber_youtube' => $this->input->post('subscriber_youtube'),
                    );

                    $data = $this->medmas->simpan($data_media_massa);
                    $get_id = $data_media_massa['id'];
                    $this->uploadFile($get_id);

                    $this->db->where('level', 'admin');
                    $query = $this->db->get('tmst_user');
                    foreach ($query->result() as $baris) {
                        $notif = array(
                            'user_pengirim' => $ins_id,
                            'user_penerima' => $baris->id,
                            'judul' => 'Ada user baru',
                            'pesan' => ' Terdapat user baru dengan username ' . $this->input->post('username') . ' dari media massa bernama ' . $this->input->post('nama'),
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
        }
    }

    public function changepassword()
    {

        if ($this->users->change_password() == true) {
            $this->aktivitas->log_changepassword();
            $sesi_selesai = array(
                'login_status' => 'login_status',
                'id_media' => 'id_media',
                'id_user' => 'id_user',
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
                'telp' => 'telp',
                'wartawan' => 'wartawan',
                'file_logo_media' => 'file_logo_media',
                'file_npwp' => 'file_rekening',
                'file_rekening' => 'file_rekening',
                'file_mou' => 'file_mou',
                'file_sertifikat_uji' => 'file_sertifikat_uji',
                'file_penawaran_kerja_sama' => 'file_penawaran_kerja_sama',
                'file_verifikasi_pers' => 'file_verifikasi_pers',
            );
            $this->session->unset_userdata($sesi_selesai);
            $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">Password berhasil diubah, silahkan login ulang!</div>');
            redirect('auth');
        }
    }

    function uploadFile($get_id)
    {
        $album = $this->input->post('username');
        $config['upload_path']          = 'upload/media/' . $album;
        $config['allowed_types']        = 'png|jpg|pdf';
        $config['overwrite']            = false;
        $config['max_size']             = 2000;
        $config['file_name']            = round(microtime(true) * 1000);

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!is_dir('upload/media/' . $album)) {
            mkdir('upload/media/' . $album, 0777, true);
            for ($i = 1; $i <= 11; $i++) {
                if (!empty($_FILES['berkas_' . $i]['name'])) {
                    if ($this->upload->do_upload('berkas_' . $i)) {
                        $fileData = $this->upload->data();
                        $uploadData[$i]['file_name'] = $fileData['file_name'];
                    } else {
                        $error = array('message' => $this->upload->display_errors());
                        view('auth/signup', $error);
                    }
                }
            }

            $data = array(
                'file_akta_pendirian' => $uploadData['1']['file_name'],
                'file_situ' => $uploadData['2']['file_name'],
                'file_siup' => $uploadData['3']['file_name'],
                'file_tdp' => $uploadData['4']['file_name'],
                'file_npwp' => $uploadData['5']['file_name'],
                'file_rekening' => $uploadData['6']['file_name'],
                'file_sertifikat_uji' => $uploadData['7']['file_name'],
                'file_logo_media' => $uploadData['8']['file_name'],
                'file_verifikasi_pers' => $uploadData['9']['file_name'],
                'file_laporan_pajak' => $uploadData['10']['file_name'],
                'file_sertifikat' => $uploadData['11']['file_name'],
            );

            $result = $this->medmas->simpan_upload($get_id, $data);
            echo json_decode($result);
        }
    }


    public function logout()
    {
        $sesi_selesai = array(
            'login_status' => 'login_status',
            'id_media' => 'id_media',
            'id_user' => 'id_user',
            'username' => 'username',
            'level' => 'level',
            'status' => 'status',
            'nama' => 'nama',
            'perusahaan' => 'perusahaan',
            'alamat_per' => 'alamat_per',
            'npwp' => 'npwp',
            'rekening' => 'rekening',
            'telp' => 'telp',
            'email' => 'email',
            'username_fb' => 'username_fb',
            'username_ig' => 'username_ig',
            'username_twitter' => 'username_twitter',
            'channel_youtube' => 'channel_youtube',
            'pengikut_fb' => 'pengikut_fb',
            'pengikut_ig' => 'pengikut_ig',
            'pengikut_twitter' => 'pengikut_twitter',
            'subscriber_youtube' => 'subscriber_youtube',
            'tipe_mediamassa' => 'tipe_mediamassa',
            'tipe_publikasi' => 'tipe_publikasi',
            'jumlah_saham' => 'jumlah_saham',
            'mulai_mou' => 'mulai_mou',
            'akhir_mou' => 'akhir_mou',
            'file_logo_media' => 'file_logo_media',
            'file_akta_pendirian' => 'file_akta_pendirian',
            'file_situ' => 'file_situ',
            'file_siup' => 'file_siup',
            'file_tdp' => 'file_tdp',
            'file_npwp' => 'file_npwp',
            'file_rekening' => 'file_rekening',
            'file_mou' => 'file_mou',
            'file_sertifikat' => 'file_sertifikat',
            'file_sertifikat_uji' => 'file_sertifikat_uji',
            'file_laporan_pajak' => 'file_laporan_pajak',
            'file_verifikasi_pers' => 'file_verifikasi_pers',

        );
        $this->aktivitas->log_logout();
        $this->session->unset_userdata($sesi_selesai);
        $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">Anda Telah Logout, Terima Kasih :)</div>');
        redirect('auth');
    }
}
