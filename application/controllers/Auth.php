<?php
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
        $data['jabatan'] = $this->jabatan->get_all();
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[tmst_user.username]', [
            'is_unique' => 'This username has already registered!']);
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            view('auth.signup', $data);
        } else {

            $username = $this->input->post('username');
            $nama_media = $this->input->post('nama_media');
            $nik1 = $this->input->post('nik1');
            $nik2 = $this->input->post('nik2');
            $nik3 = $this->input->post('nik3');
            $nik4 = $this->input->post('nik4');
            $nik5 = $this->input->post('nik5');
            $nik6 = $this->input->post('nik6');
            $nik7 = $this->input->post('nik7');

            $user = $this->db->get_where('tmst_user', ['username' => $username])->row_array();
            if($u){
                $message = 'Username yang anda pilih sudah digunakan!';
                redirect('auth/signup', $message);
            } else {
                $med = $this->db->get_where('tmst_media_massa', ['nama_media' => $nama_media])->row_array();
                if($med){
                    $message = 'Media sudah terdaftar!';
                    redirect('auth/signup', $message);
                } else {
                    $ten1 = $this->db->get_where('tmst_tenaga', ['nik' => $nik1])->row_array();
                    if($ten1){
                        $message = 'Personel sudah terdaftar dengan media lain!';
                        redirect('auth/signup', $message);
                    } else {
                        $ten2 = $this->db->get_where('tmst_tenaga', ['nik' => $nik2])->row_array();
                        if($ten2){
                            $message = 'Personel sudah terdaftar dengan media lain!';
                            redirect('auth/signup', $message);
                        } else {
                            $ten3 = $this->db->get_where('tmst_tenaga', ['nik' => $nik3])->row_array();
                            if($ten3){
                                $message = 'Personel sudah terdaftar dengan media lain!';
                                redirect('auth/signup', $message);
                            } else {
                                $ten4 = $this->db->get_where('tmst_tenaga', ['nik' => $nik4])->row_array();
                                if($ten4){
                                    $message = 'Personel sudah terdaftar dengan media lain!';
                                    redirect('auth/signup', $message);
                                } else {
                                    $ten5 = $this->db->get_where('tmst_tenaga', ['nik' => $nik5])->row_array();
                                    if($ten5){
                                        $message = 'Personel sudah terdaftar dengan media lain!';
                                        redirect('auth/signup', $message);
                                    } else {
                                        $ten6 = $this->db->get_where('tmst_tenaga', ['nik' => $nik6])->row_array();
                                        if($ten6){
                                            $message = 'Personel sudah terdaftar dengan media lain!';
                                            redirect('auth/signup', $message);
                                        } else {
                                            $ten7 = $this->db->get_where('tmst_tenaga', ['nik' => $nik7])->row_array();
                                            if($ten7){
                                                $message = 'Personel sudah terdaftar dengan media lain!';
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

                                                $upload = $this->_do_upload_akta_pendirian();
                                                $data_media_massa['file_akta_pendirian'] = $upload;

                                                $upload = $this->_do_upload_situ();
                                                $data_media_massa['file_situ'] = $upload;

                                                $upload = $this->_do_upload_siup();
                                                $data_media_massa['file_siup'] = $upload;

                                                $upload = $this->_do_upload_tdp();
                                                $data_media_massa['file_tdp'] = $upload;

                                                $upload = $this->_do_upload_npwp();
                                                $data_media_massa['file_npwp'] = $upload;

                                                $upload = $this->_do_upload_rekening();
                                                $data_media_massa['file_rekening'] = $upload;

                                                $upload = $this->_do_upload_mou();
                                                $data_media_massa['file_mou'] = $upload;

                                                $upload = $this->_do_upload_logo_media();
                                                $data_media_massa['file_logo_media'] = $upload;

                                                $upload = $this->_do_upload_sertifikat_uji();
                                                $data_media_massa['file_sertifikat_uji'] = $upload;

                                                $upload = $this->_do_upload_verifikasi_pers();
                                                $data_media_massa['file_verifikasi_pers'] = $upload;

                                                $upload = $this->_do_upload_laporan_pajak();
                                                $data_media_massa['file_laporan_pajak'] = $upload;

                                                $upload = $this->_do_upload_sertifikat();
                                                $data_media_massa['file_sertifikat'] = $upload;

                                                $this->medmas->simpan($data_media_massa);

                                                $data_tenaga1 = array(
                                                    'media_massa_id'	=>	$data_media_massa['id'],
                                                    'jabatan_id'		=>	$this->input->post('jabatan_id1'),
                                                    'nama_tenaga'	    =>	$this->input->post('nama_tenaga1'),
                                                    'nik'		        =>	$this->input->post('nik1'),
                                                    'no_hp'	            =>	$this->input->post('no_hp1')
                                                );
                                                $upload1 = $this->_do_upload_ktp1();
                                                $data_tenaga1['file'] = $upload1;
                                                $up1 = $this->_do_upload_sertifikat1();
                                                $data_tenaga1['file_sertifikat'] = $up1;
                                                $this->db->insert('tmst_tenaga', $data_tenaga1);

                                                $data_tenaga2 = array(
                                                    'media_massa_id'	=>	$data_media_massa['id'],
                                                    'jabatan_id'		=>	$this->input->post('jabatan_id2'),
                                                    'nama_tenaga'	    =>	$this->input->post('nama_tenaga2'),
                                                    'nik'		        =>	$this->input->post('nik2'),
                                                    'no_hp'	            =>	$this->input->post('no_hp2')
                                                );
                                                $upload2 = $this->_do_upload_ktp2();
                                                $data_tenaga2['file'] = $upload2;
                                                $up2 = $this->_do_upload_sertifikat2();
                                                $data_tenaga2['file_sertifikat'] = $up2;
                                                $this->db->insert('tmst_tenaga', $data_tenaga2);

                                                $data_tenaga3 = array(
                                                    'media_massa_id'	=>	$data_media_massa['id'],
                                                    'jabatan_id'		=>	$this->input->post('jabatan_id3'),
                                                    'nama_tenaga'	    =>	$this->input->post('nama_tenaga3'),
                                                    'nik'		        =>	$this->input->post('nik3'),
                                                    'no_hp'	            =>	$this->input->post('no_hp3')
                                                );
                                                $upload3 = $this->_do_upload_ktp4();
                                                $data_tenaga3['file'] = $upload3;
                                                $up3 = $this->_do_upload_sertifikat3();
                                                $data_tenaga3['file_sertifikat'] = $up3;
                                                $this->db->insert('tmst_tenaga', $data_tenaga3);

                                                $data_tenaga4 = array(
                                                    'media_massa_id'	=>	$data_media_massa['id'],
                                                    'jabatan_id'		=>	$this->input->post('jabatan_id4'),
                                                    'nama_tenaga'	    =>	$this->input->post('nama_tenaga4'),
                                                    'nik'		        =>	$this->input->post('nik4'),
                                                    'no_hp'	            =>	$this->input->post('no_hp4')
                                                );
                                                $upload4 = $this->_do_upload_ktp4();
                                                $data_tenaga4['file'] = $upload4;
                                                $up4 = $this->_do_upload_sertifikat4();
                                                $data_tenaga4['file_sertifikat'] = $up4;
                                                $this->db->insert('tmst_tenaga', $data_tenaga4);

                                                $data_tenaga5 = array(
                                                    'media_massa_id'	=>	$data_media_massa['id'],
                                                    'jabatan_id'		=>	$this->input->post('jabatan_id5'),
                                                    'nama_tenaga'	    =>	$this->input->post('nama_tenaga5'),
                                                    'nik'		        =>	$this->input->post('nik5'),
                                                    'no_hp'	            =>	$this->input->post('no_hp5')
                                                );
                                                $upload5 = $this->_do_upload_ktp5();
                                                $data_tenaga5['file'] = $upload5;
                                                $up5 = $this->_do_upload_sertifikat5();
                                                $data_tenaga5['file_sertifikat'] = $up5;
                                                $this->db->insert('tmst_tenaga', $data_tenaga5);

                                                $data_tenaga6 = array(
                                                    'media_massa_id'	=>	$data_media_massa['id'],
                                                    'jabatan_id'		=>	$this->input->post('jabatan_id6'),
                                                    'nama_tenaga'	    =>	$this->input->post('nama_tenaga6'),
                                                    'nik'		        =>	$this->input->post('nik6'),
                                                    'no_hp'	            =>	$this->input->post('no_hp6')
                                                );
                                                $upload6 = $this->_do_upload_ktp6();
                                                $data_tenaga6['file'] = $upload6;
                                                $up6 = $this->_do_upload_sertifikat6();
                                                $data_tenaga6['file_sertifikat'] = $up6;
                                                $this->db->insert('tmst_tenaga', $data_tenaga6);

                                                $data_tenaga7 = array(
                                                    'media_massa_id'	=>	$data_media_massa['id'],
                                                    'jabatan_id'		=>	$this->input->post('jabatan_id7'),
                                                    'nama_tenaga'	    =>	$this->input->post('nama_tenaga7'),
                                                    'nik'		        =>	$this->input->post('nik7'),
                                                    'no_hp'	            =>	$this->input->post('no_hp7')
                                                );
                                                $upload7 = $this->_do_upload_ktp7();
                                                $data_tenaga7['file'] = $upload7;
                                                $up7 = $this->_do_upload_sertifikat7();
                                                $data_tenaga7['file_sertifikat'] = $up7;
                                                $this->db->insert('tmst_tenaga', $data_tenaga7);
                                            
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
                                    } 
                                } 
                            }  
                        }
                    }
                }
            }
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

    private function _do_upload_akta_pendirian()
    {
        if (!file_exists('upload/akta_pendirian')) {
            mkdir('upload/akta_pendirian/', 0777, true);
        }
        $config['upload_path']          = 'upload/akta_pendirian/';
        $config['allowed_types']        = 'pdf';
        $config['max_size']             = 2000; //set max size allowed in Kilobyte
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file_akta_pendirian')) //upload and validate
        {
            $data['inputerror'][] = 'file_akta_pendirian';
            $data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    private function _do_upload_situ()
    {
        if (!file_exists('upload/situ')) {
            mkdir('upload/situ/', 0777, true);
        }
        $config2['upload_path']          = 'upload/situ/';
        $config2['allowed_types']        = 'pdf';
        $config2['max_size']             = 2000; //set max size allowed in Kilobyte
        $config2['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config2);
        $this->upload->initialize($config2);

        if (!$this->upload->do_upload('file_situ')) //upload and validate
        {
            $data['inputerror'][] = 'file_situ';
            $data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    private function _do_upload_siup()
    {
        if (!file_exists('upload/siup')) {
            mkdir('upload/siup/', 0777, true);
        }
        $config3['upload_path']          = 'upload/siup/';
        $config3['allowed_types']        = 'pdf';
        $config3['max_size']             = 2000; //set max size allowed in Kilobyte
        $config3['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config3);
        $this->upload->initialize($config3);

        if (!$this->upload->do_upload('file_siup')) //upload and validate
        {
            $data['inputerror'][] = 'file_siup';
            $data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    private function _do_upload_tdp()
    {
        if (!file_exists('upload/tdp')) {
            mkdir('upload/tdp/', 0777, true);
        }
        $config4['upload_path']          = 'upload/tdp/';
        $config4['allowed_types']        = 'pdf';
        $config4['max_size']             = 2000; //set max size allowed in Kilobyte
        $config4['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config4);
        $this->upload->initialize($config4);

        if (!$this->upload->do_upload('file_tdp')) //upload and validate
        {
            $data['inputerror'][] = 'file_tdp';
            $data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    private function _do_upload_npwp()
    {
        if (!file_exists('upload/npwp')) {
            mkdir('upload/npwp/', 0777, true);
        }
        $config5['upload_path']          = 'upload/npwp/';
        $config5['allowed_types']        = 'jpg|jpeg|png';
        $config5['max_size']             = 2000; //set max size allowed in Kilobyte
        $config5['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config5);
        $this->upload->initialize($config5);

        if (!$this->upload->do_upload('file_npwp')) //upload and validate
        {
            $data['inputerror'][] = 'file_npwp';
            $data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    private function _do_upload_rekening()
    {
        if (!file_exists('upload/rekening')) {
            mkdir('upload/rekening/', 0777, true);
        }
        $config6['upload_path']          = 'upload/rekening/';
        $config6['allowed_types']        = 'jpg|jpeg|png';
        $config6['max_size']             = 2000; //set max size allowed in Kilobyte
        $config6['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config6);
        $this->upload->initialize($config6);

        if (!$this->upload->do_upload('file_rekening')) //upload and validate
        {
            $data['inputerror'][] = 'file_rekening';
            $data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    private function _do_upload_mou()
    {
        if (!file_exists('upload/mou')) {
            mkdir('upload/mou/', 0777, true);
        }
        $config7['upload_path']          = 'upload/mou/';
        $config7['allowed_types']        = 'pdf';
        $config7['max_size']             = 2000; //set max size allowed in Kilobyte
        $config7['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name
 
        $this->load->library('upload', $config7);
        $this->upload->initialize($config7);
 
        if(!$this->upload->do_upload('file_mou')) //upload and validate
        {
            $data['inputerror'][] = 'file_mou';
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    private function _do_upload_logo_media()
    {
        if (!file_exists('upload/logo-media')) {
            mkdir('upload/logo-media/', 0777, true);
        }
        $config8['upload_path']          = 'upload/logo-media/';
        $config8['allowed_types']        = 'jpg|jpeg|png';
        $config8['max_size']             = 2000; //set max size allowed in Kilobyte
        $config8['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name
 
        $this->load->library('upload', $config8);
        $this->upload->initialize($config8);
 
        if(!$this->upload->do_upload('file_logo_media')) //upload and validate
        {
            $data['inputerror'][] = 'file_logo_media';
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    private function _do_upload_sertifikat_uji()
    {
        if (!file_exists('upload/sertifikat_uji')) {
            mkdir('upload/sertifikat_uji/', 0777, true);
        }
        $config9['upload_path']          = 'upload/sertifikat_uji/';
        $config9['allowed_types']        = 'pdf';
        $config9['max_size']             = 2000; //set max size allowed in Kilobyte
        $config9['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config9);
        $this->upload->initialize($config9);

        if (!$this->upload->do_upload('file_sertifikat_uji')) //upload and validate
        {
            $data['inputerror'][] = 'file_sertifikat_uji';
            $data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    private function _do_upload_verifikasi_pers()
    {
        if (!file_exists('upload/verifikasi_pers')) {
            mkdir('upload/verifikasi_pers/', 0777, true);
        }
        $config10['upload_path']          = 'upload/verifikasi_pers/';
        $config10['allowed_types']        = 'pdf';
        $config10['max_size']             = 2000; //set max size allowed in Kilobyte
        $config10['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config10);
        $this->upload->initialize($config10);

        if (!$this->upload->do_upload('file_verifikasi_pers')) //upload and validate
        {
            $data['inputerror'][] = 'file_verifikasi_pers';
            $data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    private function _do_upload_laporan_pajak()
    {
        if (!file_exists('upload/laporan_pajak')) {
            mkdir('upload/laporan_pajak/', 0777, true);
        }
        $config11['upload_path']          = 'upload/laporan_pajak/';
        $config11['allowed_types']        = 'pdf';
        $config11['max_size']             = 2000; //set max size allowed in Kilobyte
        $config11['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config11);
        $this->upload->initialize($config11);

        if (!$this->upload->do_upload('file_laporan_pajak')) //upload and validate
        {
            $data['inputerror'][] = 'file_laporan_pajak';
            $data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }
    
    private function _do_upload_ktp1()
    {
        if (!file_exists('upload/ktp')) {
            mkdir('upload/ktp/', 0777, true);
        }
        $config12['upload_path']          = 'upload/ktp/';
        $config12['allowed_types']        = 'jpg|jpeg|png';
        $config12['max_size']             = 2000; //set max size allowed in Kilobyte
        $config12['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config12);
        $this->upload->initialize($config12);

        if (!$this->upload->do_upload('file1')) //upload and validate
        {
            $data['inputerror'][] = 'file1';
            $data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    private function _do_upload_ktp2()
    {
        if (!file_exists('upload/ktp')) {
            mkdir('upload/ktp/', 0777, true);
        }
        $config13['upload_path']          = 'upload/ktp/';
        $config13['allowed_types']        = 'jpg|jpeg|png';
        $config13['max_size']             = 2000; //set max size allowed in Kilobyte
        $config13['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config13);
        $this->upload->initialize($config13);

        if (!$this->upload->do_upload('file2')) //upload and validate
        {
            $data['inputerror'][] = 'file2';
            $data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    private function _do_upload_ktp3()
    {
        if (!file_exists('upload/ktp')) {
            mkdir('upload/ktp/', 0777, true);
        }
        $config14['upload_path']          = 'upload/ktp/';
        $config14['allowed_types']        = 'jpg|jpeg|png';
        $config14['max_size']             = 2000; //set max size allowed in Kilobyte
        $config14['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config14);
        $this->upload->initialize($config14);

        if (!$this->upload->do_upload('file3')) //upload and validate
        {
            $data['inputerror'][] = 'file3';
            $data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    private function _do_upload_ktp4()
    {
        if (!file_exists('upload/ktp')) {
            mkdir('upload/ktp/', 0777, true);
        }
        $config15['upload_path']          = 'upload/ktp/';
        $config15['allowed_types']        = 'jpg|jpeg|png';
        $config15['max_size']             = 2000; //set max size allowed in Kilobyte
        $config15['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config15);
        $this->upload->initialize($config15);

        if (!$this->upload->do_upload('file4')) //upload and validate
        {
            $data['inputerror'][] = 'file4';
            $data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    private function _do_upload_ktp5()
    {
        if (!file_exists('upload/ktp')) {
            mkdir('upload/ktp/', 0777, true);
        }
        $config16['upload_path']          = 'upload/ktp/';
        $config16['allowed_types']        = 'jpg|jpeg|png';
        $config16['max_size']             = 2000; //set max size allowed in Kilobyte
        $config16['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config16);
        $this->upload->initialize($config16);

        if (!$this->upload->do_upload('file5')) //upload and validate
        {
            $data['inputerror'][] = 'file5';
            $data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    private function _do_upload_ktp6()
    {
        if (!file_exists('upload/ktp')) {
            mkdir('upload/ktp/', 0777, true);
        }
        $config17['upload_path']          = 'upload/ktp/';
        $config17['allowed_types']        = 'jpg|jpeg|png';
        $config17['max_size']             = 2000; //set max size allowed in Kilobyte
        $config17['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config17);
        $this->upload->initialize($config17);

        if (!$this->upload->do_upload('file6')) //upload and validate
        {
            $data['inputerror'][] = 'file6';
            $data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    private function _do_upload_ktp7()
    {
        if (!file_exists('upload/ktp')) {
            mkdir('upload/ktp/', 0777, true);
        }
        $config18['upload_path']          = 'upload/ktp/';
        $config18['allowed_types']        = 'jpg|jpeg|png';
        $config18['max_size']             = 2000; //set max size allowed in Kilobyte
        $config18['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config18);
        $this->upload->initialize($config18);

        if (!$this->upload->do_upload('file7')) //upload and validate
        {
            $data['inputerror'][] = 'file7';
            $data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    private function _do_upload_sertifikat()
    {
        if (!file_exists('upload/sertifikat')) {
            mkdir('upload/sertifikat/', 0777, true);
        }
        $config19['upload_path']          = 'upload/sertifikat/';
        $config19['allowed_types']        = 'pdf';
        $config19['max_size']             = 2000; //set max size allowed in Kilobyte
        $config19['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config19);
        $this->upload->initialize($config19);

        if (!$this->upload->do_upload('file_sertifikat')) //upload and validate
        {
            $data['inputerror'][] = 'file_sertifikat';
            $data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    private function _do_upload_sertifikat1()
    {
        if (!file_exists('upload/sertifikat')) {
            mkdir('upload/sertifikat/', 0777, true);
        }
        $config19['upload_path']          = 'upload/sertifikat/';
        $config19['allowed_types']        = 'pdf';
        $config19['max_size']             = 2000; //set max size allowed in Kilobyte
        $config19['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config19);
        $this->upload->initialize($config19);

        if (!$this->upload->do_upload('file_sertifikat1')) //upload and validate
        {
            $data['inputerror'][] = 'file_sertifikat1';
            $data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    private function _do_upload_sertifikat2()
    {
        if (!file_exists('upload/sertifikat')) {
            mkdir('upload/sertifikat/', 0777, true);
        }
        $config20['upload_path']          = 'upload/sertifikat/';
        $config20['allowed_types']        = 'pdf';
        $config20['max_size']             = 2000; //set max size allowed in Kilobyte
        $config20['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config20);
        $this->upload->initialize($config20);

        if (!$this->upload->do_upload('file_sertifikat2')) //upload and validate
        {
            $data['inputerror'][] = 'file_sertifikat2';
            $data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    private function _do_upload_sertifikat3()
    {
        if (!file_exists('upload/sertifikat')) {
            mkdir('upload/sertifikat/', 0777, true);
        }
        $config21['upload_path']          = 'upload/sertifikat/';
        $config21['allowed_types']        = 'pdf';
        $config21['max_size']             = 2000; //set max size allowed in Kilobyte
        $config21['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config21);
        $this->upload->initialize($config21);

        if (!$this->upload->do_upload('file_sertifikat3')) //upload and validate
        {
            $data['inputerror'][] = 'file_sertifikat3';
            $data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    private function _do_upload_sertifikat4()
    {
        if (!file_exists('upload/sertifikat')) {
            mkdir('upload/sertifikat/', 0777, true);
        }
        $config22['upload_path']          = 'upload/sertifikat/';
        $config22['allowed_types']        = 'pdf';
        $config22['max_size']             = 2000; //set max size allowed in Kilobyte
        $config22['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config22);
        $this->upload->initialize($config22);

        if (!$this->upload->do_upload('file_sertifikat4')) //upload and validate
        {
            $data['inputerror'][] = 'file_sertifikat4';
            $data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    private function _do_upload_sertifikat5()
    {
        if (!file_exists('upload/sertifikat')) {
            mkdir('upload/sertifikat/', 0777, true);
        }
        $config23['upload_path']          = 'upload/sertifikat/';
        $config23['allowed_types']        = 'pdf';
        $config23['max_size']             = 2000; //set max size allowed in Kilobyte
        $config23['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config23);
        $this->upload->initialize($config23);

        if (!$this->upload->do_upload('file_sertifikat5')) //upload and validate
        {
            $data['inputerror'][] = 'file_sertifikat5';
            $data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    private function _do_upload_sertifikat6()
    {
        if (!file_exists('upload/sertifikat')) {
            mkdir('upload/sertifikat/', 0777, true);
        }
        $config24['upload_path']          = 'upload/sertifikat/';
        $config24['allowed_types']        = 'pdf';
        $config24['max_size']             = 2000; //set max size allowed in Kilobyte
        $config24['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config24);
        $this->upload->initialize($config24);

        if (!$this->upload->do_upload('file_sertifikat6')) //upload and validate
        {
            $data['inputerror'][] = 'file_sertifikat6';
            $data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    private function _do_upload_sertifikat7()
    {
        if (!file_exists('upload/sertifikat')) {
            mkdir('upload/sertifikat/', 0777, true);
        }
        $config25['upload_path']          = 'upload/sertifikat/';
        $config25['allowed_types']        = 'pdf';
        $config25['max_size']             = 2000; //set max size allowed in Kilobyte
        $config25['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config25);
        $this->upload->initialize($config25);

        if (!$this->upload->do_upload('file_sertifikat7')) //upload and validate
        {
            $data['inputerror'][] = 'file_sertifikat7';
            $data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
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
        $this->aktivitas->log_logout();
        $this->session->unset_userdata($sesi_selesai);
        $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">Anda Telah Logout, Terima Kasih :)</div>');
        redirect('auth');
    }

}
