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
                'mulai_mou' => $this->session->userdata('mulai_mou'),
                'akhir_mou' => $this->session->userdata('akhir_mou'),
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
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->nama_tenaga;
            $row[] = $field->nama_jabatan;
            $row[] = $field->nik;
            $row[] = $field->no_hp;
            $row[] = $field->file;
            // $row[] = $field->file_sertifikat;      
            
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
        //dd($data);
        view('profil.edit', $data);
    }

    public function updatedata()
    {
        $id = $this->input->post('id_media');
        $data = array(
            'nama' => $this->input->post('nama_media'),
            'perusahaan' => $this->input->post('nama_perusahaan'),
            'alamat' => $this->input->post('alamat_kantor'),
            'npwp' => $this->input->post('npwp'),
            'pimpinan' => $this->input->post('pimpinan'),
            'kabiro' => $this->input->post('kabiro'),                   
            'no_telp' => $this->input->post('no_telp'),
            'wartawan' => $this->input->post('wartawan'),            
            'tipe_media_massa' => $this->input->post('tipe_media_massa'),
            'file_logo_media' => $this->users->_uploadLogo()
        );

        if (!empty($_FILES['file_npwp']['name'])) {
            if (!empty($this->input->post('old_file_npwp'))) {
                unlink('upload/npwp/' . $this->input->post('old_file_npwp'));
            }
            $upload = $this->_do_upload_npwp();
            $data['file_npwp'] = $upload;
        }

        if (!empty($_FILES['file_rekening']['name'])) {
            if (!empty($this->input->post('old_file_rekening'))) {
                unlink('upload/rekening/' . $this->input->post('old_file_rekening'));
            }
            $upload = $this->_do_upload_rekening();
            $data['file_rekening'] = $upload;
        }

        if (!empty($_FILES['file_sertifikat_uji']['name'])) {
            if (!empty($this->input->post('old_file_sertifikat_uji'))) {
                unlink('upload/sertifikat_uji/' . $this->input->post('old_file_sertifikat_uji'));
            }
            $upload = $this->_do_upload_sertifikat_uji();
            $data['file_sertifikat_uji'] = $upload;
        }

        if (!empty($_FILES['file_verifikasi_pers']['name'])) {
            if (!empty($this->input->post('old_file_verifikasi_pers'))) {
                unlink('upload/verifikasi_pers/' . $this->input->post('old_file_verifikasi_pers'));
            }
            $upload = $this->_do_upload_verifikasi_pers();
            $data['file_verifikasi_pers'] = $upload;
        }

        if (!empty($_FILES['file_penawaran_kerja_sama']['name'])) {
            if (!empty($this->input->post('old_file_penawaran_kerja_sama'))) {
                unlink('upload/penawaran_kerja_sama/' . $this->input->post('old_file_penawaran_kerja_sama'));
            }                          
            $upload = $this->_do_upload_penawaran_kerja_sama();
            $data['file_penawaran_kerja_sama'] = $upload;
        }

        if(!empty($_FILES['file_surat_kabiro']['name'])){
            if(!empty($this->input->post('old_file_surat_kabiro'))){
                unlink('upload/surat_kabiro/'.$this->input->post('old_file_surat_kabiro'));
            }
            $upload = $this->_do_upload_surat_kabiro();
            $data['file_surat_kabiro'] = $upload;
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

    private function _do_upload_npwp()
    {
        if (!file_exists('upload/npwp')) {
            mkdir('upload/npwp/', 0777, true);
        }
        $config['upload_path']          = 'upload/npwp/';
        $config['allowed_types']        = 'jpg|jpeg|png';
        $config['max_size']             = 2000; //set max size allowed in Kilobyte
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config);

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
        $config2['upload_path']          = 'upload/rekening/';
        $config2['allowed_types']        = 'jpg|jpeg|png';
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
        if (!file_exists('upload/sertifikat_uji')) {
            mkdir('upload/sertifikat_uji/', 0777, true);
        }
        $config3['upload_path']          = 'upload/sertifikat_uji/';
        $config3['allowed_types']        = 'pdf';
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
        if (!file_exists('upload/verifikasi_pers')) {
            mkdir('upload/verifikasi_pers/', 0777, true);
        }
        $config4['upload_path']          = 'upload/verifikasi_pers/';
        $config4['allowed_types']        = 'pdf';
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

    private function _do_upload_penawaran_kerja_sama()
    {
        if (!file_exists('upload/penawaran_kerja_sama')) {
            mkdir('upload/penawaran_kerja_sama/', 0777, true);
        }
        $config5['upload_path']          = 'upload/penawaran_kerja_sama/';
        $config5['allowed_types']        = 'pdf';
        $config5['max_size']             = 2000; //set max size allowed in Kilobyte
        $config5['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config5);
        $this->upload->initialize($config5);

        if (!$this->upload->do_upload('file_penawaran_kerja_sama')) //upload and validate
        {
            $data['inputerror'][] = 'file_penawaran_kerja_sama';
            $data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }


    private function _do_upload_surat_kabiro()
    {
        if (!file_exists('upload/surat_kabiro')) {
            mkdir('upload/surat_kabiro/', 0777, true);
        }
        $config6['upload_path']          = 'upload/surat_kabiro/';
        $config6['allowed_types']        = 'pdf';
        $config6['max_size']             = 2000; //set max size allowed in Kilobyte
        $config6['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name
 
        $this->load->library('upload', $config6);
        $this->upload->initialize($config6);
 
        if(!$this->upload->do_upload('file_surat_kabiro')) //upload and validate
        {
            $data['inputerror'][] = 'file_surat_kabiro';
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }


}
