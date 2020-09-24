<?php

class Profil extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('login_status') != TRUE) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger"><strong>Oops!</strong> Mohon Login Dahulu </div>');
            redirect(site_url(''));
        }
        $this->load->model('Users_model', 'users');
        $this->load->model('Medmas_model', 'medmas');
        $this->load->model('notifikasi_model', 'notifikasi');
        $this->load->model('log_model', 'aktivitas');
        $this->load->model('Tenaga_model','tenaga');
    }

    public function index()
    {
        if ($this->session->userdata('level') == 'superadmin' || $this->session->userdata('level') == 'admin') {
            $data = array(
                'notif' => $this->notifikasi->get_by_id($this->session->userdata('id_user')),
                'jumlah_notif' => $this->notifikasi->get_by_jumlah($this->session->userdata('id_user'))
            );
            view('profil.index', $data);
        } else {
            $data = array(
                'username' => $this->session->userdata('username'),
                'level' => $this->session->userdata('level'),
                'status' => $this->session->userdata('status'),
                'nama' => $this->session->userdata('nama'),
                'perusahaan' => $this->session->userdata('perusahaan'),
                'alamat' => $this->session->userdata('alamat_per'),
                'npwp' => $this->session->userdata('npwp'),
                'rekening' => $this->session->userdata('rekening'),
                'telp' => $this->session->userdata('telp'),
                'email' => $this->session->userdata('email'),
                'username_fb' => $this->session->userdata('username_fb'),
                'username_ig' => $this->session->userdata('username_ig'),
                'username_twitter' => $this->session->userdata('username_twitter'),
                'channel_yt' => $this->session->userdata('channel_youtube'),
                'pengikut_fb' => $this->session->userdata('pengikut_fb'),
                'pengikut_ig' => $this->session->userdata('pengikut_ig'),
                'pengikut_twitter' => $this->session->userdata('pengikut_twitter'),
                'subs_yt' => $this->session->userdata('subscriber_youtube'),
                'tipe_mediamassa' => $this->session->userdata('tipe_mediamassa'),
                'tipe_publikasi' => $this->session->userdata('tipe_publikasi'),
                'jumlah_saham' => $this->session->userdata('jumlah_saham'),
                'mulai_mou' => date('d/m/Y', strtotime($this->session->userdata('mulai_mou'))),
                'akhir_mou' => date('d/m/Y', strtotime($this->session->userdata('akhir_mou'))),
                'file_logo_media' => $this->session->userdata('file_logo_media'),
                'file_akta_pendirian' => $this->session->userdata('file_akta_pendirian'),
                'file_situ' => $this->session->userdata('file_situ'),
                'file_siup' => $this->session->userdata('file_siup'),
                'file_tdp' => $this->session->userdata('file_tdp'),
                'file_npwp' => $this->session->userdata('file_npwp'),
                'file_rekening' => $this->session->userdata('file_rekening'),
                'file_sertifikat_uji' => $this->session->userdata('file_sertifikat_uji'),
                'file_laporan_pajak' => $this->session->userdata('file_laporan_pajak'),
                'file_verifikasi_pers' => $this->session->userdata('file_verifikasi_pers'),
                'file_mou' => $this->session->userdata('file_mou'),
                'file_sertifikat' => $this->session->userdata('file_sertifikat'),
                'notif' => $this->notifikasi->get_by_id($this->session->userdata('id_user')),
                'jumlah_notif' => $this->notifikasi->get_by_jumlah($this->session->userdata('id_user')),
            );         
            json_encode($data);
            view('profil.index', $data);
        }
    }

    public function json()
    {
        $list = $this->tenaga->get_datatables();
        $data = array();
        $no = $_POST['start'];
        $username = $this->session->userdata('username');                
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->nama_tenaga;
            $row[] = $field->nama_jabatan;
            $row[] = $field->nik;     
            $row[] = $field->no_hp;
            $row[] = '<a href="' . site_url() . 'upload/Media/' . $username .'/ktp/'.$field->file. '" class="btn bg-indigo">Lihat File</a>';
            $row[] = '<a href="' . site_url() . 'upload/Media/' . $username .'/sertifikat/'.$field->file_sertifikat. '" class="btn bg-indigo">Lihat File</a>';
            $row[] = '<button class="btn btn-info btn-sm edit-tenaga" data-id="' . $field->id_tenaga . '" >Edit</button>';
            $data[] = $row;
        }

        $output = array(
            'draw' => $_POST['draw'],
            'recordsTotal' => $this->tenaga->count_all(),
            'recordsFiltered' => $this->tenaga->count_filtered(),
            'data' => $data
        );

        echo json_encode($output);
    }


    public function detail($id)
    {
        if ($this->session->userdata('level') == 'superadmin' || $this->session->userdata('level') == 'admin') {
            $row = $this->medmas->get_by_id($id);
            $data = array(
                'nama' => $row->nama_media,
                'status' => $this->session->userdata('status'),
                'perusahaan' => $row->nama_perusahaan,
                'username' => $row->username,
                'alamat' => $row->alamat_perusahaan,
                'npwp' => $row->npwp,
                'rekening' => $row->rekening,
                'telp' => $row->no_telp,
                'email' => $row->email,
                'username_fb' => $row->username_fb,
                'username_ig' => $row->username_ig,
                'username_twitter' => $row->username_twitter,
                'channel_yt' => $row->channel_youtube,
                'pengikut_fb' => $row->pengikut_fb,
                'pengikut_ig' => $row->pengikut_ig,
                'pengikut_twitter' => $row->pengikut_twitter,
                'subs_yt' => $row->subscriber_youtube,
                'tipe_mediamassa' => $row->tipe_media_massa,
                'tipe_publikasi' => $row->tipe_publikasi,
                'jumlah_saham' => $row->jumlah_saham,
                'mulai_mou' => date('d/m/Y', strtotime($row->mulai_mou)),
                'akhir_mou' => date('d/m/Y', strtotime($row->akhir_mou)),
                'file_logo_media' => $row->file_logo_media,
                'file_akta_pendirian' => $row->file_akta_pendirian,
                'file_situ' => $row->file_situ,
                'file_siup' => $row->file_siup,
                'file_tdp' => $row->file_tdp,
                'file_npwp' => $row->file_npwp,
                'file_rekening' => $row->file_rekening,
                'file_sertifikat_uji' => $row->file_sertifikat_uji,
                'file_laporan_pajak' => $row->file_laporan_pajak,
                'file_verifikasi_pers' => $row->file_verifikasi_pers,
                'file_mou' => $row->file_mou,
                'file_sertifikat' => $row->file_sertifikat,
                'notif' => $this->notifikasi->get_by_id($this->session->userdata('id_user')),
                'jumlah_notif' => $this->notifikasi->get_by_jumlah($this->session->userdata('id_user'))
            );
            view('profil.index', $data);
        } else {
            $row = $this->medmas->get_by_id($id);
            $data = array(
                'nama' => $row->nama_media,
                'status' => $this->session->userdata('status'),
                'perusahaan' => $row->nama_perusahaan,
                'alamat' => $row->alamat_perusahaan,
                'npwp' => $row->npwp,
                'rekening' => $row->rekening,
                'telp' => $row->no_telp,
                'email' => $row->email,
                'username'=> $row->username,
                'username_fb' => $row->username_fb,
                'username_ig' => $row->username_ig,
                'username_twitter' => $row->username_twitter,
                'channel_yt' => $row->channel_youtube,
                'pengikut_fb' => $row->pengikut_fb,
                'pengikut_ig' => $row->pengikut_ig,
                'pengikut_twitter' => $row->pengikut_twitter,
                'subs_yt' => $row->subscriber_youtube,
                'tipe_mediamassa' => $row->tipe_media_massa,
                'tipe_publikasi' => $row->tipe_publikasi,
                'jumlah_saham' => $row->jumlah_saham,
                'mulai_mou' => date('d/m/Y', strtotime($row->mulai_mou)),
                'akhir_mou' => date('d/m/Y', strtotime($row->akhir_mou)),
                'file_logo_media' => $row->file_logo_media,
                'file_akta_pendirian' => $row->file_akta_pendirian,
                'file_situ' => $row->file_situ,
                'file_siup' => $row->file_siup,
                'file_tdp' => $row->file_tdp,
                'file_npwp' => $row->file_npwp,
                'file_rekening' => $row->file_rekening,
                'file_sertifikat_uji' => $row->file_sertifikat_uji,
                'file_laporan_pajak' => $row->file_laporan_pajak,
                'file_verifikasi_pers' => $row->file_verifikasi_pers,
                'file_mou' => $row->file_mou,
                'file_sertifikat' => $row->file_sertifikat,
                'notif' => $this->notifikasi->get_by_id($this->session->userdata('id_user')),
                'jumlah_notif' => $this->notifikasi->get_by_jumlah($this->session->userdata('id_user'))
            );
            view('profil.index', $data);
        }
    }

    public function ubahpassword()
    {
        if ($this->session->userdata('level') == 'superadmin' || $this->session->userdata('level') == 'admin') {
            $data =  array(
                'notif' => $this->notifikasi->get_by_id($this->session->userdata('id_user')),
                'jumlah_notif' => $this->notifikasi->get_by_jumlah($this->session->userdata('id_user'))
            );
        } else {
            $data =  array(
                'notif' => $this->notifikasi->get_by_id($this->session->userdata('id_user')),
                'jumlah_notif' => $this->notifikasi->get_by_jumlah($this->session->userdata('id_user'))
            );
        }
        view('profil.forgotpassword', $data);
    }

    public function ubah($id = null)
    {
        if (!isset($id)) redirect('profil');
        if ($this->session->userdata('level') == 'superadmin' || $this->session->userdata('level') == 'admin') {
            $data = array(
                'notif' => $this->notifikasi->get_by_id($this->session->userdata('id_user')),
                'jumlah_notif' => $this->notifikasi->get_by_jumlah($this->session->userdata('id_user'))
            );
        } else {
            $data = array(
                'notif' => $this->notifikasi->get_by_id($this->session->userdata('id_user')),
                'jumlah_notif' => $this->notifikasi->get_by_jumlah($this->session->userdata('id_user'))
            );
        }
        $data['data_profil'] = $this->users->getById($id);
        $data_select_tipe = explode(", ", $data['data_profil']->tipe_media_massa);
        $select_tipe = $data_select_tipe;
        if (!$data['data_profil']) show_404();
        $data['tipe_selected']  = $select_tipe;
        view('profil.edit', $data);
    }

    public function updatedata()
    {
        $id = $this->input->post('id_media');
        $username = $this->input->post('username');
        $data = array(
            'nama_media' => $this->input->post('nama_media'),
            'nama_perusahaan' => $this->input->post('nama_perusahaan'),
            'alamat_perusahaan' => $this->input->post('alamat_kantor'),
            'email' => $this->input->post('email_media'),
            'no_telp' => $this->input->post('no_telp'),
            'npwp' => $this->input->post('npwp'),      
            'rekening' => $this->input->post('no_rek'),
            'no_telp' => $this->input->post('no_telp'),              
            'tipe_media_massa' => $this->input->post('tipe_media_massa'),            
            // Sosial Media
            'username_fb' => $this->input->post('username_fb'),
            'username_twitter' => $this->input->post('username_twitter'),
            'username_ig' => $this->input->post('username_ig'),
            'channel_youtube' => $this->input->post('channel_youtube'),
            'pengikut_fb' => $this->input->post('pengikut_fb'),
            'pengikut_twitter' => $this->input->post('pengikut_twitter'),
            'pengikut_ig' => $this->input->post('pengikut_ig'),
            'subscriber_youtube' => $this->input->post('subscriber_youtube'),            
        );

        
        
        if (!empty($_FILES['file_logo_media']['name'])) {
            if (!empty($this->input->post('old_file_logo'))) {
                unlink('upload/media/'.$username.'/logo_media/' . $this->input->post('old_file_logo'));
            }
            $upload = $this->_do_upload_logo();
            $data['file_logo_media'] = $upload;
        }

        
        if (!empty($_FILES['file_npwp']['name'])) {
            if (!empty($this->input->post('old_file_npwp'))) {
                unlink('upload/media/'.$username.'/npwp/' . $this->input->post('old_file_npwp'));
            }
            $upload = $this->_do_upload_npwp();
            $data['file_npwp'] = $upload;
        }


        if (!empty($_FILES['file_rekening']['name'])) {
            if (!empty($this->input->post('old_file_rekening'))) {
                unlink('upload/media/'.$username.'/rekening/' . $this->input->post('old_file_rekening'));
            }
            $upload = $this->_do_upload_rekening();
            $data['file_rekening'] = $upload;
        }

        if (!empty($_FILES['file_sertifikat_uji']['name'])) {
            if (!empty($this->input->post('old_file_sertifikat_uji'))) {
                unlink('upload/media/'.$username.'/sertifikat_uji/' . $this->input->post('old_file_sertifikat_uji'));
            }
            $upload = $this->_do_upload_sertifikat_uji();
            $data['file_sertifikat_uji'] = $upload;
        }

        if (!empty($_FILES['file_verifikasi_pers']['name'])) {
            if (!empty($this->input->post('old_file_verifikasi_pers'))) {
                unlink('upload/media/'.$username.'/verifikasi_pers/'. $this->input->post('old_file_verifikasi_pers'));
            }
            $upload = $this->_do_upload_verifikasi_pers();
            $data['file_verifikasi_pers'] = $upload;
        }

        if (!empty($_FILES['file_mou']['name'])) {
            if (!empty($this->input->post('old_file_mou'))) {
                unlink('upload/media/'.$username.'/mou/' . $this->input->post('old_file_mou'));
            }                          
            $upload = $this->_do_upload_mou();
            $data['file_mou'] = $upload;
        }

        if (!empty($_FILES['file_akta_pendirian']['name'])) {
            if (!empty($this->input->post('old_file_akta_pendirian'))) {
                unlink('upload/media/'.$username.'/akta_pendirian/' . $this->input->post('old_file_akta_pendirian'));
            }                          
            $upload = $this->_do_upload_akta_pendirian();
            $data['file_akta_pendirian'] = $upload;
        }

        if (!empty($_FILES['file_situ']['name'])) {
            if (!empty($this->input->post('old_file_situ'))) {
                unlink('upload/media/'.$username.'/situ/' . $this->input->post('old_file_situ'));
            }                          
            $upload = $this->_do_upload_situ();
            $data['file_situ'] = $upload;
        }

        if (!empty($_FILES['file_siup']['name'])) {
            if (!empty($this->input->post('old_file_siup'))) {
                unlink('upload/media/'.$username.'/siup/' . $this->input->post('old_file_siup'));
            }                          
            $upload = $this->_do_upload_siup();
            $data['file_siup'] = $upload;
        }

        if (!empty($_FILES['file_tdp']['name'])) {
            if (!empty($this->input->post('old_file_tdp'))) {
                unlink('upload/media/'.$username.'/tdp/' . $this->input->post('old_file_tdp'));
            }                          
            $upload = $this->_do_upload_tdp();
            $data['file_tdp'] = $upload;
        }

        if (!empty($_FILES['file_laporan_pajak']['name'])) {
            if (!empty($this->input->post('old_file_laporan_pajak'))) {
                unlink('upload/media/'.$username.'/laporan_pajak/' . $this->input->post('old_file_laporan_pajak'));
            }                          
            $upload = $this->_do_upload_laporan_pajak();
            $data['file_laporan_pajak'] = $upload;
        }

        $this->medmas->updateProfil($id, $data);    
        $this->db->where('level', 'admin');
        $query = $this->db->get('tmst_user');
        foreach ($query->result() as $baris) {
            $notif = array(
                'user_pengirim' => $this->session->userdata('id_user'),
                'user_penerima' => $baris->id,
                'judul' => $this->session->userdata('nama') . ' Merubah Biodata',
                'pesan' => $this->session->userdata('nama') . ' merubah biodata, mohon segera diperiksa..',
                'link' => $this->uri->segment(1) . '/detail/' . $this->session->userdata('id_media'),
                'dibaca' => '1',
                'dibuat_tanggal' => date('y-m-d'),
                'dibuat_pukul' => date('h:i:s')
            );
            $this->notifikasi->simpan($notif);
        }

        $this->medmas->updateProfil($id, $data);
        $this->aktivitas->log_ubahprofil();
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
            'file_sertifikat_uji' => 'file_sertifikat_uji',
            'file_laporan_pajak' => 'file_laporan_pajak',
            'file_verifikasi_pers' => 'file_verifikasi_pers',      
        );
        $this->session->unset_userdata($sesi_selesai);
        $this->session->set_flashdata('message', '<div class="alert bg-green alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        Data Profil Berhasil Diubah. Mohon Login Kembali.
        </div>');
        redirect('auth');
    }


        
    private function _do_upload_logo()
    {
        $username = $this->session->userdata('username');
        if (!file_exists('upload/media/'.$username.'/logo_media/')) {
            mkdir('upload/media/'.$username.'/logo_media/', 0777, true);
        }
        $config['upload_path']          = 'upload/media/'.$username.'/logo_media/';
        $config['allowed_types']        = 'jpg|jpeg|png';
        $config['max_size']             = 2000; //set max size allowed in Kilobyte
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file_logo_media')) //upload and validate
        {
            $data['inputerror'][] = 'file_logo_media';
            $data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }


    private function _do_upload_npwp()
    {
        $username = $this->session->userdata('username');
        if (!file_exists('upload/media/'.$username.'/npwp/')) {
            mkdir('upload/media/'.$username.'/npwp/', 0777, true);
        }
        $config1['upload_path']          = 'upload/media/'.$username.'/npwp/';
        $config1['allowed_types']        = 'jpg|jpeg|png|pdf';
        $config1['max_size']             = 2000; //set max size allowed in Kilobyte
        $config1['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config1);

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
        $username = $this->session->userdata('username');
        if (!file_exists('upload/media/'.$username.'/rekening/')) {
            mkdir('upload/media/'.$username.'/rekening/', 0777, true);
        }
        $config2['upload_path']          = 'upload/media/'.$username.'/rekening/';
        $config2['allowed_types']        = 'jpg|jpeg|png|pdf';
        $config2['max_size']             = 2000; //set max size allowed in Kilobyte
        $config2['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config2);
        $this->upload->initialize($config2);

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

    private function _do_upload_sertifikat_uji()
    {
        $username = $this->session->userdata('username');
        if (!file_exists('upload/media/'.$username.'/sertifikat_uji/')) {
            mkdir('upload/media/'.$username.'/sertifikat_uji/', 0777, true);
        }
        $config3['upload_path']          = 'upload/media/'.$username.'/sertifikat_uji/';
        $config3['allowed_types']        = 'jpg|jpeg|png|pdf';
        $config3['max_size']             = 2000; //set max size allowed in Kilobyte
        $config3['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config3);
        $this->upload->initialize($config3);

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
        $username = $this->session->userdata('username');
        if (!file_exists('upload/media/'.$username.'/verifikasi_pers/')) {
            mkdir('upload/media/'.$username.'/verifikasi_pers/', 0777, true);
        }
        $config4['upload_path']          = 'upload/media/'.$username.'/verifikasi_pers/';
        $config4['allowed_types']        = 'jpg|jpeg|png|pdf';
        $config4['max_size']             = 2000; //set max size allowed in Kilobyte
        $config4['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config4);
        $this->upload->initialize($config4);

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

    private function _do_upload_mou()
    {

        $username = $this->session->userdata('username');
        if (!file_exists('upload/media/'.$username.'/mou/')) {
            mkdir('upload/media/'.$username.'/mou/', 0777, true);
        }
        $config5['upload_path']          = 'upload/media/'.$username.'/mou/';
        $config5['allowed_types']        = 'jpg|jpeg|png|pdf';
        $config5['max_size']             = 2000; //set max size allowed in Kilobyte
        $config5['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config5);
        $this->upload->initialize($config5);

        if (!$this->upload->do_upload('file_mou')) //upload and validate
        {
            $data['inputerror'][] = 'file_mou';
            $data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    private function _do_upload_akta_pendirian()
    {

        $username = $this->session->userdata('username');
        if (!file_exists('upload/media/'.$username.'/akta_pendirian/')) {
            mkdir('upload/media/'.$username.'/akta_pendirian/', 0777, true);
        }
        $config6['upload_path']          = 'upload/media/'.$username.'/akta_pendirian/';
        $config6['allowed_types']        = 'jpg|jpeg|png|pdf';
        $config6['max_size']             = 2000; //set max size allowed in Kilobyte
        $config6['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config6);
        $this->upload->initialize($config6);

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

        $username = $this->session->userdata('username');
        if (!file_exists('upload/media/'.$username.'/situ/')) {
            mkdir('upload/media/'.$username.'/situ/', 0777, true);
        }
        $config7['upload_path']          = 'upload/media/'.$username.'/situ/';
        $config7['allowed_types']        = 'jpg|jpeg|png|pdf';
        $config7['max_size']             = 2000; //set max size allowed in Kilobyte
        $config7['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config7);
        $this->upload->initialize($config7);

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

        $username = $this->session->userdata('username');
        if (!file_exists('upload/media/'.$username.'/siup/')) {
            mkdir('upload/media/'.$username.'/siup/', 0777, true);
        }
        $config8['upload_path']          = 'upload/media/'.$username.'/siup/';
        $config8['allowed_types']        = 'jpg|jpeg|png|pdf';
        $config8['max_size']             = 2000; //set max size allowed in Kilobyte
        $config8['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config8);
        $this->upload->initialize($config8);

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

        $username = $this->session->userdata('username');
        if (!file_exists('upload/media/'.$username.'/tdp/')) {
            mkdir('upload/media/'.$username.'/tdp/', 0777, true);
        }
        $config9['upload_path']          = 'upload/media/'.$username.'/tdp/';
        $config9['allowed_types']        = 'jpg|jpeg|png|pdf';
        $config9['max_size']             = 2000; //set max size allowed in Kilobyte
        $config9['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config9);
        $this->upload->initialize($config9);

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


    
    private function _do_upload_laporan_pajak()
    {

        $username = $this->session->userdata('username');
        if (!file_exists('upload/media/'.$username.'/laporan_pajak/')) {
            mkdir('upload/media/'.$username.'/laporan_pajak/', 0777, true);
        }
        $config10['upload_path']          = 'upload/media/'.$username.'/laporan_pajak/';
        $config10['allowed_types']        = 'jpg|jpeg|png|pdf';
        $config10['max_size']             = 2000; //set max size allowed in Kilobyte
        $config10['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config10);
        $this->upload->initialize($config10);

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

    public function get_detail_tenaga()
    {
        $id = $this->input->post('id_tenaga');
        $data = $this->tenaga->getById($id);
        $output = array();
        foreach ($data as $row) {
            $output['id_tenaga'] = $row->id_tenaga;    
            $output['id_jabatan'] = $row->jabatan_id;
            $output['nama_tenaga']  = $row->nama_tenaga; 
            $output['jabatan_tenaga'] = $row->nama_jabatan;            
            $output['no_handphone'] = $row->no_hp;
            $output['file_ktp'] = $row->file;
            $output['file_sertifikat'] = $row->file_sertifikat;
        }
       echo json_encode($output);    
    
    }

    public function ubah_personel()
    {
        $id = $this->input->post('edit_id');
        $username  = $this->session->userdata('username');
        $data = array(
            'nama_tenaga' => $this->input->post('nama_tenaga'),
            'jabatan_id' => $this->input->post('jabatan_idnya'),
            'no_hp' => $this->input->post('no_hp'),            
        );  

        if (!empty($_FILES['file_ktp']['name'])) {
            if (!empty($this->input->post('file_ktp_old'))) {
                unlink('upload/media/'.$username.'/ktp/' . $this->input->post('file_ktp_old'));
            }                          
            $upload = $this->_do_upload_ubah_ktp();
            $data['file'] = $upload;
        }

        if (!empty($_FILES['file_sertifikat']['name'])) {
            if (!empty($this->input->post('file_sertifikat_old'))) {
                unlink('upload/media/'.$username.'/sertifikat/' . $this->input->post('file_sertifikat_old'));
            }                          
            $upload = $this->_do_upload_ubah_sertifikat();
            $data['file_sertifikat'] = $upload;
        }

        $result = $this->tenaga->updatePersonel($id, $data);        
        echo json_encode($result);                
    }

    private function _do_upload_ubah_ktp()
    {

        $username = $this->session->userdata('username');
        if (!file_exists('upload/media/'.$username.'/ktp/')) {
            mkdir('upload/media/'.$username.'/ktp/', 0777, true);
        }
        $config8['upload_path']          = 'upload/media/'.$username.'/ktp/';
        $config8['allowed_types']        = 'jpg|jpeg|png|pdf';
        $config8['max_size']             = 2000; //set max size allowed in Kilobyte
        $config8['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config8);
        $this->upload->initialize($config8);

        if (!$this->upload->do_upload('file_ktp')) //upload and validate
        {
            $data['inputerror'][] = 'file_ktp';
            $data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }


    private function _do_upload_ubah_sertifikat()
    {

        $username = $this->session->userdata('username');
        if (!file_exists('upload/media/'.$username.'/sertifikat/')) {
            mkdir('upload/media/'.$username.'/sertifikat/', 0777, true);
        }
        $config8['upload_path']          = 'upload/media/'.$username.'/sertifikat/';
        $config8['allowed_types']        = 'jpg|jpeg|png|pdf';
        $config8['max_size']             = 2000; //set max size allowed in Kilobyte
        $config8['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config8);
        $this->upload->initialize($config8);

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




}
