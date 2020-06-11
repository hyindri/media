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

            $this->medmas->simpan($data_media_massa);

            $jabatan_id 			= $_POST['jabatan_id'];
            $nama_tenaga 			= $_POST['nama_tenaga'];
            $nik 			        = $_POST['nik'];
            $no_hp 				    = $_POST['no_hp'];
            $data_tenaga 	        = array();

            $index = 0;
            foreach((array)$nama_tenaga as $nama_tenaga){
                if(!empty($nama_tenaga)){
                    array_push($data_tenaga, array(
                        'media_massa_id'	=>	$data_media_massa['id'],
                        'jabatan_id'		=>	$jabatan_id[$index],
                        'nama_tenaga'	    =>	$nama_tenaga,
                        'nik'		        =>	$nik[$index],
                        'no_hp'	            =>	$no_hp[$index]
                    ));
                    $index++;
                }
            }
            foreach((array)$_POST['file']['name'] as $file){
                if(!empty( $file)){
                    $upload[$index] = $this->_do_upload_ktp();
                    $data_tenaga['file'] = $upload[$index];
                }
                $index++;
            }

            // $upload = $this->_do_upload_ktp();
            // $data_tenaga['file'] = $upload;
            $this->db->insert_batch('tmst_tenaga', $data_tenaga);

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
    


    private function _do_upload_ktp_direktur()
    {
        if (!file_exists('upload/ktp')) {
            mkdir('upload/ktp/', 0777, true);
        }
        $config11['upload_path']          = 'upload/ktp/';
        $config11['allowed_types']        = 'pdf';
        $config11['max_size']             = 2000; //set max size allowed in Kilobyte
        $config11['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config11);
        $this->upload->initialize($config11);

        if (!$this->upload->do_upload('file_ktp_direktur')) //upload and validate
        {
            $data['inputerror'][] = 'file_laporan_pajak';
            $data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');


        // $dataInfo = array();
        // $files = $_FILES;
        // $cpt = count($_FILES['file']['name']);
        // for($i=0; $i<$cpt; $i++)
        // {           
        //     $_FILES['file']['name']= $files['file']['name'][$i];
        //     $_FILES['file']['type']= $files['file']['type'][$i];
        //     $_FILES['file']['tmp_name']= $files['file']['tmp_name'][$i];
        //     $_FILES['file']['error']= $files['file']['error'][$i];
        //     $_FILES['file']['size']= $files['file']['size'][$i];    

        //     $this->upload->initialize($this->set_upload_options());
        //     $this->upload->do_upload();
        //     $dataInfo[] = $this->upload->data();
        // }
        
        // $data = array();
        // // Count total files
        // $countfiles = count($_FILES['file']['name']);
        // // Looping all files
        // for($i=0;$i<$countfiles;$i++){
        //     if(!empty($_FILES['files']['name'][$i])){
        //         // Define new $_FILES array - $_FILES['file']
        //         $_FILES['file']['name'] = $_FILES['files']['name'][$i];
        //         $_FILES['file']['type'] = $_FILES['files']['type'][$i];
        //         $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
        //         $_FILES['file']['error'] = $_FILES['files']['error'][$i];
        //         $_FILES['file']['size'] = $_FILES['files']['size'][$i];
    
        //         // Set preference
        //         if (!file_exists('upload/ktp')) {
        //             mkdir('upload/ktp/', 0777, true);
        //         }
        //         $config12['upload_path'] = 'uploads/ktp/'; 
        //         $config12['allowed_types'] = 'jpg|jpeg|png';
        //         $config12['max_size'] = '2000'; // max_size in kb
        //         $temp = explode(".", $_FILES["files"]["name"][$i]);
        //         $newfilename = round(microtime(true)) . '.' . end($temp);
        //         $config12['file_name'] = $newfilename;
    
        //         //Load upload library
        //         $this->load->library('upload',$config12);
        //         $this->upload->initialize($config12);
    
        //         // File upload
        //         if($this->upload->do_upload('file')){
        //         // Get data about the file
        //         $uploadData = $this->upload->data();
        //         $filename = $uploadData['file_name'];
    
        //         // Initialize array
        //         $data['filenames'][] = $filename;
        //         }
        //     }
        // }
    }

    private function set_upload_options()
    {   
        //upload an image options
        $config12 = array();
        $config12['upload_path'] = 'upload/ktp/';
        $config12['allowed_types'] = 'gif|jpg|png';
        $config12['max_size']      = '2000';
        $config12['overwrite']     = FALSE;
    
        return $config12;
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
