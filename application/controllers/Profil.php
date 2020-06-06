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
        $this->load->model('Medmas_model', 'medmas');
        $this->load->model('notifikasi_model', 'notifikasi');
    }

    public function index()
    {
        if ($this->session->userdata('level') == 'superadmin' || $this->session->userdata('level') == 'admin') {
            $data = array(
                'notif' => $this->notifikasi->get_by_id($this->session->userdata('id')),
                'jumlah_notif' => $this->notifikasi->get_by_jumlah($this->session->userdata('id'))
            );
            view('profil.index', $data);
        } else {
            $data = array(
                'username' => $this->session->userdata('username'),
                'level' => $this->session->userdata('level'),
                'status' => $this->session->userdata('status'),
                'nama' => $this->session->userdata('nama'),
                'tipe_mediamassa' => $this->session->userdata('tipe_mediamassa'),
                'tipe_publikasi' => $this->session->userdata('tipe_publikasi'),
                'status' => $this->session->userdata('status'),
                'pimpinan' => $this->session->userdata('pimpinan'),
                'npwp' => $this->session->userdata('npwp'),
                'mulai_mou' => date('d/m/Y', strtotime($this->session->userdata('mulai_mou'))),
                'akhir_mou' => date('d/m/Y', strtotime($this->session->userdata('akhir_mou'))),
                'perusahaan' => $this->session->userdata('perusahaan'),
                'alamat_per' => $this->session->userdata('alamat_per'),
                'rekening' => $this->session->userdata('rekening'),
                'kabiro' => $this->session->userdata('kabiro'),
                'surat_kabiro' => $this->session->userdata('surat_kabiro'),
                'telp' => $this->session->userdata('telp'),
                'wartawan' => $this->session->userdata('wartawan'),
                'sertifikat' => $this->session->userdata('sertifikat'),
                'verifikasi' => $this->session->userdata('verifikasi'),
                'penawaran_kerjasama' => $this->session->userdata('penawaran_kerjasama'),
                'notif' => $this->notifikasi->get_by_id($this->session->userdata('id_user')),
                'jumlah_notif' => $this->notifikasi->get_by_jumlah($this->session->userdata('id_user'))

            );
            view('profil.index', $data);
        }
    }

    public function detail($id)
    {
        if ($this->session->userdata('level') == 'superadmin' || $this->session->userdata('level') == 'admin') {
            $row = $this->medmas->get_by_id($id);
            $data = array(
                'nama' => $row->nama,
                'tipe_mediamassa' => $row->tipe_media_massa,
                'tipe_publikasi' => $row->tipe_publikasi,
                'status' => $this->session->userdata('status'),
                'pimpinan' => $row->pimpinan,
                'npwp' => $row->npwp,
                'mulai_mou' => date('d/m/Y', strtotime($row->mulai_mou)),
                'akhir_mou' => date('d/m/Y', strtotime($row->akhir_mou)),
                'perusahaan' => $row->perusahaan,
                'alamat_per' => $row->alamat,
                'rekening' => $row->rekening,
                'kabiro' => $row->kabiro,
                'surat_kabiro' => $row->surat_kabiro,
                'telp' => $row->no_telp,
                'wartawan' => $row->wartawan,
                'sertifikat' => $row->sertifikat_uji,
                'verifikasi' => $row->verifikasi_pers,
                'penawaran_kerjasama' => $row->penawaran_kerja_sama,
                'notif' => $this->notifikasi->get_by_id($this->session->userdata('id')),
                'jumlah_notif' => $this->notifikasi->get_by_jumlah($this->session->userdata('id'))
            );
            view('profil.index', $data);
        } else {
            $row = $this->medmas->get_by_id($id);
            $data = array(
                'nama' => $row->nama,
                'tipe_mediamassa' => $row->tipe_media_massa,
                'tipe_publikasi' => $row->tipe_publikasi,
                'status' => $this->session->userdata('status'),
                'pimpinan' => $row->pimpinan,
                'npwp' => $row->npwp,
                'mulai_mou' => date('d/m/Y', strtotime($row->mulai_mou)),
                'akhir_mou' => date('d/m/Y', strtotime($row->akhir_mou)),
                'perusahaan' => $row->perusahaan,
                'alamat_per' => $row->alamat,
                'rekening' => $row->rekening,
                'kabiro' => $row->kabiro,
                'surat_kabiro' => $row->surat_kabiro,
                'telp' => $row->no_telp,
                'wartawan' => $row->wartawan,
                'sertifikat' => $row->sertifikat_uji,
                'verifikasi' => $row->verifikasi_pers,
                'penawaran_kerjasama' => $row->penawaran_kerja_sama,
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
                'notif' => $this->notifikasi->get_by_id($this->session->userdata('id')),
                'jumlah_notif' => $this->notifikasi->get_by_jumlah($this->session->userdata('id'))
            );
        } else {
            $data =  array(
                'notif' => $this->notifikasi->get_by_id($this->session->userdata('id_user')),
                'jumlah_notif' => $this->notifikasi->get_by_jumlah($this->session->userdata('id_user'))
            );
        }
        view('profil.forgotpassword', $data);
    }
}
