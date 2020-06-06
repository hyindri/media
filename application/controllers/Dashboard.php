<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Dashboard_model', 'dashboard');
		$this->load->model('notifikasi_model', 'notifikasi');
		if ($this->session->userdata('login_status') != TRUE) {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger"><strong>Oops!</strong> Mohon Login Dahulu </div>');
			redirect(site_url(''));
		}
		$this->load->model('Medmas_model','medmas');
	}

	function index()
	{

		if ($this->session->userdata('username') && $this->session->userdata('level') == 'superadmin') {
			$id = '';
			//$data['hasil']=$this->dashboard->__get_chart_harian($id);
			//$data['media']=$this->dashboard->__get_chart_media();
			$data['medmas'] = $this->dashboard->__get_medmas();
			$data['berita_hariini'] = $this->dashboard->__get_berita_hari();
			$data['berita_mingguini'] = $this->dashboard->__get_berita_minggu($id);
			$data['berita_bulanini'] = $this->dashboard->__get_berita_bulan($id);
			$data['notif'] = $this->notifikasi->get_by_id($this->session->userdata('id'));
			$data['jumlah_notif']  = $this->notifikasi->get_by_jumlah($this->session->userdata('id'));
			view('superadmin.dashboard.index', $data);
		} elseif ($this->session->userdata('username') && $this->session->userdata('level') == 'admin') {
			$id = '';
			//$data['hasil']=$this->dashboard->__get_chart_harian($id);
			//$data['media']=$this->dashboard->__get_chart_media();
			$data['medmas'] = $this->dashboard->__get_medmas();
			$data['berita_hariini'] = $this->dashboard->__get_berita_hari();
			$data['berita_mingguini'] = $this->dashboard->__get_berita_minggu($id);
			$data['berita_bulanini'] = $this->dashboard->__get_berita_bulan($id);
			$data['notif'] = $this->notifikasi->get_by_id($this->session->userdata('id'));
			$data['jumlah_notif']  = $this->notifikasi->get_by_jumlah($this->session->userdata('id'));
			view('admin.dashboard.index', $data);
		} elseif ($this->session->userdata('username') && $this->session->userdata('level') == 'user') {
			$data['hasil'] = $this->dashboard->__get_chart_harian($this->session->userdata('id_media'));
			$data['status_berita'] = $this->dashboard->__get_statusBerita();
			$data['berita_mingguini'] = $this->dashboard->__get_berita_minggu($this->session->userdata('id_media'));
			$data['berita_bulanini'] = $this->dashboard->__get_berita_bulan($this->session->userdata('id_media'));
			$data['notif'] = $this->notifikasi->get_by_id($this->session->userdata('id_user'));
			$data['jumlah_notif']  = $this->notifikasi->get_by_jumlah($this->session->userdata('id_user'));
			view('user.dashboard.index', $data);
		}
	}

	function get_chart_harian()
	{
		if ($this->session->userdata('username') && $this->session->userdata('level') == 'superadmin') {
			$id = '';
			echo $this->dashboard->get_harian($id);
		} elseif ($this->session->userdata('username') && $this->session->userdata('level') == 'admin') {
			$id = '';
			echo $this->dashboard->get_harian($id);
		} elseif ($this->session->userdata('username') && $this->session->userdata('level') == 'user') {
			echo $this->dashboard->get_harian($this->session->userdata('id_media'));
		}
	}

	function get_chart_media()
	{
		$type = $this->input->post('type');
		echo $this->dashboard->get_media($type);
	}

	public function userprofile($id)
	{
		$row = $this->medmas->get_by_id($id);
		$data = array (
            'username' => $this->session->userdata('username'),
            'level' => $this->session->userdata('level'),
            'status' => $this->session->userdata('status'),
            'nama' => $row->nama,
            'tipe_mediamassa' => $row->tipe_media_massa,
            'tipe_publikasi' => $row->tipe_publikasi,
            'status' => $this->session->userdata('status'),
            'pimpinan' => $row->pimpinan,            
            'npwp' => $row->npwp,
            'mulai_mou' => date('d/m/Y', strtotime($row->mulai_mou)),
            'akhir_mou' => date('d/m/Y',strtotime($row->akhir_mou)),
            'perusahaan' => $row->perusahaan,
            'alamat_per' => $row->alamat,
            'rekening' => $row->rekening,
            'kabiro' => $row->kabiro,
            'surat_kabiro' => $row->surat_kabiro,
            'telp' => $row->no_telp,
            'wartawan' => $row->wartawan,
            'sertifikat' => $row->sertifikat_uji,
            'verifikasi' => $row->verifikasi_pers,
            'penawaran_kerjasama' => $row->penawaran_kerja_sama
            
        );      
		view('profil.index',$data);
	}
	
	function set_status_notif()
	{
        if ($this->session->userdata('level') == 'superadmin' || $this->session->userdata('level') == 'admin' ) {
			$id = $this->session->userdata('id');
		}else{
			$id = $this->session->userdata('id_user');
		}
		$data = array (
			'dibaca' => '2'
		);
		return $this->notifikasi->ubah_dibaca($id,$data);
		echo json_encode($data);
	}
}
