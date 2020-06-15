<?php

class Dashboard_model extends CI_Model
{

	function __get_chart_harian($id)
	{
		$this->db->select('dibuat_tanggal');
		$this->db->select('count(id) as berita');
		$this->db->where('YEAR(dibuat_tanggal)', date('Y'));
		if (!empty($id))
		{
			$this->db->where('media_massa_id', $id);
		}
		$this->db->group_by('dibuat_tanggal');
		$query =  $this->db->from('tb_berita')
			->get();

		$res = array();
		foreach ( $query->result() as $item) {
			$res[]=array(
				"dibuat_tanggal"=>$item->dibuat_tanggal,
				"berita" => $item->berita
			);
		}

		return $res;
	}

	function get_harian($id)
	{
		$res = array(
			"harian" => $this->__get_chart_harian($id)
		);
		return json_encode($res);
	} 


	function __get_chart_media($type)
	{
		$this->db->select('a.nama_media');
		$this->db->select('count(b.id) as berita');

		if ($type==1)
		{
			$this->db->where('dibuat_tanggal', date('Y-m-d'));
		}elseif ($type==2){
			$this->db->where('YEAR(dibuat_tanggal)', date('Y'));
			$this->db->where('MONTH(dibuat_tanggal)', date('m'));
		}elseif ($type==3){
			$this->db->where('YEAR(dibuat_tanggal)', date('Y'));
		}



		$this->db->group_by('b.media_massa_id');
		$this->db->from('tb_berita as b');
		$query =  $this->db->join('tmst_media_massa as a', 'a.id=b.media_massa_id')
		 ->get();

		$res = array();
		foreach ( $query->result() as $item) {
			$res[]=array(
				"nama"=>$item->nama_media,
				"berita" => $item->berita
			);
		}
		return $res;
	}

	function get_media($type)
	{

		$res = array(
			"media" => $this->__get_chart_media($type)
		);
		return json_encode($res);
	}

	function __get_medmas()
	{
		$this->db->select('count(id) as total');
		return $this->db->get('tmst_media_massa')
			->row();

	}

	function __get_berita_hari()
	{
		$this->db->select('count(id) as total');
		$this->db->where('dibuat_tanggal', date('Y-m-d'));
		return $this->db->get('tb_berita')
			->row();
	}

	function __get_berita_minggu($id)
	{
		$this->db->select('count(id) as total');
		$this->db->where('dibuat_tanggal >=', 'date_add("'.date('Y-m-d').'", interval  -WEEKDAY("'.date('Y-m-d').'")-1 day)', FALSE);
		$this->db->where('dibuat_tanggal <=', 'date_add(date_add("'.date('Y-m-d').'", interval  -WEEKDAY("'.date('Y-m-d').'")-1 day), interval 6 day)', FALSE);
		if (!empty($id))
		{
			$this->db->where('media_massa_id', $this->session->userdata('id_media'));
		}
		return $this->db->get('tb_berita')
			->row();
	}

	function __get_berita_bulan($id)
	{
		$this->db->select('count(id) as total');
		$this->db->where('MONTH(dibuat_tanggal) ', date('m'));
		$this->db->where('YEAR(dibuat_tanggal) ', date('Y'));
		if (!empty($id))
		{
			$this->db->where('media_massa_id', $this->session->userdata('id_media'));
		}
		return $this->db->get('tb_berita')
			->row();
	}

	function __get_statusBerita()
	{
		$this->db->select('id');
		$this->db->where('dibuat_tanggal', date('Y-m-d'));
		$this->db->where('media_massa_id', $this->session->userdata('id_media'));
		return $this->db->get('tb_berita')
			->num_rows();
	}

	function __get_statusAkun()
	{
		$this->db->select('id, username, status');
		$this->db->where('id', $this->session->userdata('id_user'));
		$this->db->where('status', 'registrasi');
		return $this->db->get('tmst_user');
	}



}
