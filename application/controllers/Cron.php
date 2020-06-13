<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cron extends CI_Controller
{

	function __construct()
	{
		parent::__construct();


	}


	public function index()
	{
		$this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
		$this->db->select('a.id as id_media, a.mulai_mou, b.id as id_berita, b.dibuat_tanggal, status, batas_tanggal_post, a.user_id as id_user, count(b.id) as jumlah');
		$this->db->from('tmst_media_massa a');
		$this->db->join('tb_berita b', 'a.id=b.media_massa_id', 'left');
		$this->db->join('tmst_user c', 'a.user_id=c.id', 'left');
		$this->db->where('status', 'aktif');
		$this->db->group_by('id_media');
		$query = $this->db->get()->result();

		$y = array();
		$x = array();

		foreach ($query as $data){
			if (date('Y-m-d')==$data->batas_tanggal_post)
			{
				array_push($y, $data->id_media);

				$this->db->select('media_massa_id, count(a.id) as jumlah_berita, c.id as id_user');
				$this->db->from('tb_berita a');
				$this->db->join('tmst_media_massa b','a.media_massa_id=b.id');
				$this->db->join('tmst_user c','c.id=b.user_id');
				$this->db->where_in('media_massa_id', $y);
				$this->db->where('dibuat_tanggal >=', "date_add( '".$data->batas_tanggal_post."', INTERVAL - 14 DAY )", FALSE);
				$this->db->where('dibuat_tanggal <=', $data->batas_tanggal_post);
				$this->db->group_by('media_massa_id');
				$query2 = $this->db->get()->result();

				foreach ($query2 as $data)
				{
					array_push($y, $data->media_massa_id);
					if ($data->jumlah_berita<7)
					{
						$this->db->set('status', 'suspend');
						$this->db->where('id', $data->id_user);
						$this->db->update('tmst_user');
					}
				}

			}elseif (date('Y-m-d')>$data->batas_tanggal_post){
				array_push($x, $data->id_media);
				$this->db->set('batas_tanggal_post', 'date_add( batas_tanggal_post, INTERVAL + 14 DAY )', FALSE);
				$this->db->where('id', $data->id_media);
				$this->db->update('tmst_media_massa');
			}
		}
	}

}
