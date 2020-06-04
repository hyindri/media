<?php

class Dashboard_model extends CI_Model
{

	function __get_chart($id)
	{
		$this->db->select('dibuat_tanggal');
		$this->db->select('count(id) as berita');
		$this->db->where('YEAR(dibuat_tanggal)', date('Y'));
		if (!empty($id))
		{
			$this->db->where('media_massa_id', $this->session->userdata('id_media'));
		}
		$this->db->group_by('dibuat_tanggal');
		return $this->db->from('tb_berita')
			->get()
			->result();
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
		$this->db->where('dibuat_tanggal >=', 'date_add("2020-06-03", interval  -WEEKDAY("2020-06-03")-1 day)', FALSE);
		$this->db->where('dibuat_tanggal <=', 'date_add(date_add("2020-06-03", interval  -WEEKDAY("2020-06-03")-1 day), interval 6 day)', FALSE);
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



}
