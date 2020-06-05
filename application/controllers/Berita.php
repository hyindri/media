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
        if ($this->session->userdata('level') == 'superadmin') {
            $data = array(
                'title' => 'Berita',
                'media' => $this->berita->__get_media_massa()
            );
            $data['id_berita'] = ['id' => 'id_berita', 'name' => 'id_berita', 'type' => 'hidden'];
            return view('superadmin.berita.index', $data);
        } else if ($this->session->userdata('level') == 'admin') {
            $data = array(
                'title' => 'Berita',
                'media' => $this->berita->__get_media_massa()
            );
            $data['id_berita'] = ['id' => 'id_berita', 'name' => 'id_berita', 'type' => 'hidden'];
            return view('admin.berita.index', $data);
        } else if ($this->session->userdata('level') == 'user'  && $this->session->userdata('status') == 'aktif') {
            $data = array(
                'title' => 'Laporan Berita',
                'media' => $this->berita->__get_media_massa()
            );
            $data['id_berita'] = ['id' => 'id_berita', 'name' => 'id_berita', 'type' => 'hidden'];
            return view('user.berita.index', $data);
        }
    }

    public function json()
    {
        $list = $this->berita->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $q) {
            if ($this->session->userdata('level') == 'superadmin') {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = date('d/m/Y', strtotime($q->dibuat_tanggal));
                $row[] = '<a href="' . site_url() . 'profil/detail/' . $q->media_massa_id . '" target="_blank">' . $q->nama . '</a>';
                $row[] = '<a href="' . $q->link_berita . '" target="_blank" title=' . $q->link_berita . '>'.$q->judul_berita.'</a>';
                if ($q->status_berita == 'oke') {
                    $row[] = '<span class="badge bg-green">Valid</span>';
                } else {
                    $row[] = '<span class="badge bg-red">Belum Valid</span>';
                }
                $row[] = '<div class="btn-group"><button title="Lihat" type="button" data-id="' . $q->id_berita . '" class="verif btn btn-primary btn-xs"><i class="material-icons">visibility</i> </button></div>';
            } else if ($this->session->userdata('level') == 'admin') {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = date('d/m/Y', strtotime($q->dibuat_tanggal));
                $row[] = '<a href="' . site_url() . 'profil/detail/' . $q->media_massa_id . '" target="_blank">' . $q->nama . '</a>';
                $row[] = '<a href="' . $q->link_berita . '" target="_blank" title=' . $q->link_berita . '>'.$q->judul_berita.'</a>';
                if ($q->status_berita == 'oke') {
                    $row[] = '<span class="badge bg-green">Valid</span>';
                } else {
                    $row[] = '<span class="badge bg-red">Belum Valid</span>';
                }
                $row[] = '<div class="btn-group"><button title="Lihat" type="button" data-id="' . $q->id_berita . '" class="verif btn btn-primary btn-xs"><i class="material-icons">visibility</i> </button></div>';
            } else if ($this->session->userdata('level') == 'user'  && $this->session->userdata('status') == 'aktif') {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = date('d/m/Y', strtotime($q->dibuat_tanggal)).' ('.date('H:i:s', strtotime($q->dibuat_pukul)).')';
                $row[] = '<a href="' . $q->link_berita . '" target="_blank" title=' . $q->link_berita . '>'.$q->judul_berita.'</a>';
                $row[] = '<a href="'.site_url().'/upload/berita/' . $q->screenshoot . '" target="_blank" class="thumbnail"> <img class="img-responsive" src="'.site_url().'upload/berita/'. $q->screenshoot .'" width="200px" height="200px"></a>';
                $row[] = $q->share;
                $row[] = number_format($q->jumlah_view, 0,'.',',');

                if ($q->status_berita == 'oke') {
                    $row[] = '<span class="badge bg-green">Valid</span>';
                    $row[] = '<button title="lihat" type="button" data-id="' . $q->id_berita . '" class="lihat btn btn-primary btn-xs"><i class="material-icons">visibility</i> </button>';
                } else {
                    $row[] = '<span class="badge bg-red">Belum Valid</span>';
                    $row[] = '<div class="btn-group">
                    <button title="lihat" type="button" data-id="' . $q->id_berita . '" class="lihat btn btn-info btn-xs"><i class="material-icons">visibility</i> </button>
                    <button title="Ubah" type="button" data-id="' . $q->id_berita . '" class="ubah btn btn-primary btn-xs"><i class="material-icons">edit</i> </button>
                    <button title="Hapus" type="button" data-id="' . $q->id_berita . '" class="hapus btn btn-danger btn-xs"><i class="material-icons">delete</i> </button></div>';
                }
            }
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
            $output['diperiksa_oleh'] = $row->diperiksa_oleh;
            $output['diperiksa_pada'] = $row->diperiksa_pada;
        }
        echo json_encode($output);
    }

    public function verif()
    {
        $id = $this->input->post('id_berita');
        $data = array(
            'status_berita' => $this->input->post('verif_status'),
            'diperiksa_oleh' => $this->session->userdata('username'),
            'diperiksa_pada' => date('Y-m-d h:i:s'),
            'keterangan' => ''
        );
        $result = $this->berita->ubah($id, $data);
        echo json_encode($result);
    }

    public function belum_verif()
    {
        $id = $this->input->post('id_berita');
        $data = array(
            'status_berita' => 'belum',
            'diperiksa_oleh' => $this->session->userdata('username'),
            'diperiksa_pada' => date('Y-m-d h:i:s'),
            'keterangan' => $this->input->post('keterangan')
        );
        $result = $this->berita->ubah($id, $data);
        echo json_encode($result);
    }

    public function tambah()
    {
        if (!empty($_FILES['file']['name'])) {
            $data = array(
                'id' => uniqid(),
                'media_massa_id' => $this->session->userdata('id_media'),
                'link_berita' => $this->input->post('link_berita'),
                'share' => $this->input->post('share'),
                'jumlah_view' => $this->input->post('jumlah_view'),
                'status_berita' => 'belum',
                'keterangan' => '',
                'dibuat_oleh' => $this->session->userdata('username'),
                'dibuat_tanggal' => date('Y-m-d'),
                'dibuat_pukul' => date('h:i:s'),

            );
        }
        $upload = $this->_do_upload();
        $data['screenshoot'] = $upload;
        return $this->berita->simpan($data);
        echo json_encode($data);
    }

    public function ubah()
    {
        $id = $this->input->post('edit_id_berita');
        $cek = $this->berita->get_by_id($id)->row();
        if($cek->status_berita == 'belum'){
        $data = array(
            'link_berita' => $this->input->post('ubah_link_berita'),
            'share' => $this->input->post('ubah_share'),
            'jumlah_view' => $this->input->post('ubah_jumlah_view'),
            'status_berita' => 'belum',
            'dibuat_oleh' => $this->session->userdata('username'),
            'dibuat_tanggal' => date('Y-m-d'),
            'dibuat_pukul' => date('h:i:s'),
        );
        if (!empty($_FILES['file']['name'])) {
            $upload = $this->_do_upload();
            //delete file
            unlink('upload/berita/' . $cek->screenshoot);

            $data['screenshoot'] = $upload;
            $data = $this->berita->ubah($id, $data);
        } else {
            $data['screenshoot'] = $this->input->post('old_file');
            $data = $this->berita->ubah($id, $data);
        }
        }else{
            $data = $this->db->insert('');
        }

        json_encode($data);
    }

    public function hapus()
    {
        $id = $this->input->post('hapus_id_berita');
        $cek = $this->berita->get_by_id($id)->row();
        if($cek->status_berita == 'belum'){
            $this->berita->hapus($id);
         }else{
             $this->db->insert('');
         }

    }

    private function _do_upload()
    {
        $config['upload_path']          = 'upload/berita/';
        $config['allowed_types']        = 'jpg|jpeg|png';
        $config['max_size']             =  5000; //set max size allowed in Kilobyte
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file')) //upload and validate
        {
            $data['inputerror'][] = 'file';
            $data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

   
}
