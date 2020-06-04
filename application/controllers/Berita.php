<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Berita extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('berita_model', 'berita');
    }

    public function index()
    {
        $data = array(
            'title' => 'Berita',
        );
        $data['id_berita'] = ['id' => 'id_berita', 'name' => 'id_berita', 'type' => 'hidden'];
        return view('admin.berita.index', $data);
    }

    public function json()
    {
        $list = $this->berita->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $q) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = '<a href="' . site_url() . 'profil/detail/' . $q->media_massa_id . '" target="_blank">' . $q->nama . '</a>';
            $row[] = '<a href="' . $q->link_berita . '" target="_blank">Link</a>';
            if($q->status_berita == 'oke'){
                $row[] = '<span class="badge bg-green">Valid</span>';
            }else{
                $row[] = '<span class="badge bg-red">Tidak Valid</span>';

            }
            $row[] = '<div class="btn-group"><button title="Lihat" type="button" data-id="' . $q->id_berita . '" class="verif btn btn-primary btn-xs"><i class="material-icons">visibility</i> </button>
            <div class="btn-group">';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->berita->count_all(),
            "recordsFiltered" => $this->berita->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function fetch_data()
    {
        $id = $this->input->post('id_berita');
        $data = $this->berita->get_by_id_joined($id)->result();
        foreach ($data as $row) {
            $output['nama'] = $row->nama;
            $output['link_berita'] = $row->link_berita;
            $output['screenshoot'] = $row->screenshoot;
            $output['share'] = $row->share;
            $output['jumlah_view'] = $row->jumlah_view;
            $output['status_berita'] = $row->status_berita;
            $output['keterangan'] = $row->keterangan;
            $output['dibuat_oleh'] = $row->dibuat_oleh;
            $output['dibuat_tanggal'] = date('d/m/Y', strtotime($row->dibuat_tanggal));
            $output['dibuat_pukul'] = $row->dibuat_pukul;
        }
        echo json_encode($output);
    }

    public function verif()
    {
        $id = $this->input->post('id_berita');
        $data = array(
            'status_berita' => $this->input->post('verif_status'),
            'keterangan'=>''
        );
        $result = $this->berita->ubah($id, $data);
        echo json_encode($result);
    }

    public function belum_verif()
    {
        $id = $this->input->post('id_berita');
        $data = array(
            'status_berita' => 'belum',
            'keterangan'=> $this->input->post('keterangan')
        );
        $result = $this->berita->ubah($id, $data);
        echo json_encode($result);
    }

}
