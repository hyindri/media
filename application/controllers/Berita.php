<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Berita extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('login_status') != TRUE) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger"><strong>Oops!</strong> Mohon Login Dahulu </div>');
            redirect(site_url(''));
        }   
        $this->load->model('berita_model', 'berita');
        $this->load->model('notifikasi_model', 'notifikasi');
        $this->load->model('log_model','aktivitas');
        $this->load->library('pdf');
    }

    public function index()
    {
        if ($this->session->userdata('level') == 'superadmin') {
            $data = array(
                'title' => 'Berita',
                'media' => $this->berita->__get_media_massa(),
                'notif' => $this->notifikasi->get_by_id($this->session->userdata('id_user')),
                'jumlah_notif' => $this->notifikasi->get_by_jumlah($this->session->userdata('id_user'))
            );
            $data['id_berita'] = ['id' => 'id_berita', 'name' => 'id_berita', 'type' => 'hidden'];
            return view('superadmin.berita.index', $data);
        } else if ($this->session->userdata('level') == 'admin') {
            $data = array(
                'title' => 'Berita',
                'media' => $this->berita->__get_media_massa(),
                'notif' => $this->notifikasi->get_by_id($this->session->userdata('id_user')),
                'jumlah_notif' => $this->notifikasi->get_by_jumlah($this->session->userdata('id_user'))
            );
            $data['id_berita'] = ['id' => 'id_berita', 'name' => 'id_berita', 'type' => 'hidden'];
            return view('admin.berita.index', $data);
        } else if ($this->session->userdata('level') == 'user'  && $this->session->userdata('status') == 'aktif') {
            $data = array(
                'title' => 'Laporan Berita',
                'media' => $this->berita->__get_media_massa(),
                'notif' => $this->notifikasi->get_by_id($this->session->userdata('id_user')),
                'jumlah_notif' => $this->notifikasi->get_by_jumlah($this->session->userdata('id_user'))
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
                $row[] = '<a href="' . $q->link_berita . '" target="_blank" title=' . $q->link_berita . '>' . $q->judul_berita . '</a>';
                if ($q->status_berita == 'valid') {
                    $row[] = '<span class="badge bg-green">Valid</span>';
                } else if ($q->status_berita == 'oke') {
                    $row[] = '<span class="badge bg-blue">Draft Valid</span>';
                } else {
                    $row[] = '<span class="badge bg-red">Draft Belum Valid</span>';
                }
                $row[] = '<div class="btn-group"><button title="Lihat" type="button" data-id="' . $q->id_berita . '" class="verif btn btn-primary btn-xs"><i class="material-icons">visibility</i> </button></div>';
            } else if ($this->session->userdata('level') == 'admin') {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = date('d/m/Y', strtotime($q->dibuat_tanggal));
                $row[] = '<a href="' . site_url() . 'profil/detail/' . $q->media_massa_id . '" target="_blank">' . $q->nama . '</a>';
                $row[] = '<a href="' . $q->link_berita . '" target="_blank" title=' . $q->link_berita . '>' . $q->judul_berita . '</a>';
                if ($q->status_berita == 'valid') {
                    $row[] = '<span class="badge bg-green">Valid</span>';
                } else if ($q->status_berita == 'oke') {
                    $row[] = '<span class="badge bg-blue">Draft Valid</span>';
                } else {
                    $row[] = '<span class="badge bg-red">Draft Belum Valid</span>';
                }
                $row[] = '<div class="btn-group"><button title="Lihat" type="button" data-id="' . $q->id_berita . '" class="verif btn btn-primary btn-xs"><i class="material-icons">visibility</i> </button></div>';
            } else if ($this->session->userdata('level') == 'user'  && $this->session->userdata('status') == 'aktif') {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = date('d/m/Y', strtotime($q->dibuat_tanggal)) . ' (' . date('H:i:s', strtotime($q->dibuat_pukul)) . ')';
                $row[] = '<a href="' . $q->link_berita . '" target="_blank" title=' . $q->link_berita . '>' . $q->judul_berita . '</a>';

                if ($q->status_berita == 'valid') {
                    $row[] = '<a href="' . site_url() . '/upload/berita/' . $q->screenshoot . '" target="_blank" class="thumbnail"> <img class="img-responsive" src="' . site_url() . 'upload/berita/' . $q->screenshoot . '" width="200px" height="200px"></a>';
                    $row[] = '<span class="badge bg-green">Valid</span>';
                    $row[] = '<button title="lihat" type="button" data-id="' . $q->id_berita . '" class="lihat btn btn-primary btn-xs"><i class="material-icons">visibility</i> </button>';
                } elseif ($q->status_berita == 'oke') {
                    if ($q->screenshoot == '') {
                        $row[] = '<span class="badge bg-deep-purple">Silahkan upload data</span>';
                    } else {
                        $row[] = '<a href="' . site_url() . '/upload/berita/' . $q->screenshoot . '" target="_blank" class="thumbnail"> <img class="img-responsive" src="' . site_url() . 'upload/berita/' . $q->screenshoot . '" width="200px" height="200px"></a>';
                    }
                    $row[] = '<span class="badge bg-blue">Draft Valid</span>';
                    $row[] = '<div class="btn-group">
                    <button title="lihat" type="button" data-id="' . $q->id_berita . '" class="lihat btn btn-info btn-xs"><i class="material-icons">visibility</i> </button>
                    <button title="Upload" type="button" data-id="' . $q->id_berita . '" class="ubah btn btn-warning btn-xs"><i class="material-icons">cloud_upload</i> </button>
                    <button title="Hapus" type="button" data-id="' . $q->id_berita . '" class="hapus btn btn-danger btn-xs"><i class="material-icons">delete</i> </button></div>';
                } else {
                    $row[] = '-';
                    $row[] = '<span class="badge bg-red">Draft Belum Valid</span>';
                    $row[] = '<div class="btn-group">
                    <button title="lihat" type="button" data-id="' . $q->id_berita . '" class="lihat btn btn-info btn-xs"><i class="material-icons">visibility</i> </button>
                    <button title="Ubah" type="button" data-id="' . $q->id_berita . '" data-status="' . $q->status_berita . '" class="ubah btn btn-primary btn-xs"><i class="material-icons">edit</i> </button>
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
        $output = array();
        foreach ($data as $row) {
            $output['nama'] = $row->nama;
            $output['judul_berita'] = $row->judul_berita;
            $output['narasi_berita'] = $row->narasi_berita;
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
        $cek = $this->berita->get_by_id($id)->row();

        if ($this->input->post('verif_status') == 'oke') {
            $data = array(
                'status_berita' => $this->input->post('verif_status'),
                'diperiksa_oleh' => $this->session->userdata('username'),
                'diperiksa_pada' => date('Y-m-d h:i:s'),
                'keterangan' => $this->input->post('keterangan')
            );
        } else {
            $data = array(
                'status_berita' => 'belum',
                'diperiksa_oleh' => $this->session->userdata('username'),
                'diperiksa_pada' => date('Y-m-d h:i:s'),
                'keterangan' => $this->input->post('keterangan')
            );
        }

        if ($this->input->post('verif_status') == 'oke') {
            $this->db->where('id', $cek->media_massa_id);
            $query = $this->db->get('tmst_media_massa');
            foreach ($query->result() as $baris) {
                $notif = array(
                    'user_pengirim' => $this->session->userdata('id_user'),
                    'user_penerima' => $baris->user_id,
                    'judul' => $this->session->userdata('username') . ' Memverifikasi draft',
                    'pesan' => $this->session->userdata('username') . ' memverifikasi draft anda yang berjudul ' . $cek->judul_berita,
                    'link' => $this->uri->segment(1),
                    'dibaca' => '1',
                    'dibuat_tanggal' => date('y-m-d'),
                    'dibuat_pukul' => date('h:i:s')
                );
                $this->notifikasi->simpan($notif);
            }
        } else {
            $this->db->where('id', $cek->media_massa_id);
            $query = $this->db->get('tmst_media_massa');
            foreach ($query->result() as $baris) {
                $notif = array(
                    'user_pengirim' => $this->session->userdata('id_user'),
                    'user_penerima' => $baris->user_id,
                    'judul' => $this->session->userdata('username') . ' Membatalkan draft',
                    'pesan' =>  'Ada draft berita yang harus diperbaiki yang berjudul ' . $cek->judul_berita,
                    'link' => $this->uri->segment(1),
                    'dibaca' => '1',
                    'dibuat_tanggal' => date('y-m-d'),
                    'dibuat_pukul' => date('h:i:s')
                );
                $this->notifikasi->simpan($notif);
            }
        }
        $this->aktivitas->log_verifdraft();
        $result = $this->berita->ubah($id, $data);
        echo json_encode($result);
    }

    // public function belum_verif()
    // {
    //     $id = $this->input->post('id_berita');
    //     $data = array(
    //         'keterangan' => $this->input->post('keterangan'),
    //         'status_berita' => $this->input->post('verif_status'),
    //         'diperiksa_oleh' => $this->session->userdata('username'),
    //         'diperiksa_pada' => date('Y-m-d h:i:s'),
    //     );
    //     $result = $this->berita->ubah($id, $data);
    //     echo json_encode($result);
    // }

    // public function tambah()
    // {
    //     if (!empty($_FILES['file']['name'])) {
    //         $data = array(
    //             'link_berita' => $this->input->post('link_berita'),
    //             'share' => $this->input->post('share'),
    //             'jumlah_view' => $this->input->post('jumlah_view'),
    //             'status_berita' => 'belum',
    //             'keterangan' => ''
    //         );
    //     }
    //     $upload = $this->_do_upload();
    //     $data['screenshoot'] = $upload;
    //     return $this->berita->simpan($data);
    //     echo json_encode($data);
    // }

    public function draft()
    {
        if (!empty($this->input->post('narasi_berita'))) {
            $data = array(
                'id' => uniqid(),
                'media_massa_id' => $this->session->userdata('id_media'),
                'judul_berita' => $this->input->post('judul_berita'),
                'narasi_berita' => $this->input->post('narasi_berita'),
                'dibuat_oleh' => $this->session->userdata('username'),
                'dibuat_tanggal' => date('Y-m-d'),
                'dibuat_pukul' => date('h:i:s')
            );
            $this->db->where('level', 'admin');
            $query = $this->db->get('tmst_user');
            foreach ($query->result() as $baris) {
                $notif = array(
                    'user_pengirim' => $this->session->userdata('id_user'),
                    'user_penerima' => $baris->id,
                    'judul' => 'Ada draft berita baru',
                    'pesan' => $this->session->userdata('nama') . ' menambahkan draft berjudul ' . $data['judul_berita'],
                    'link' => $this->uri->segment(1),
                    'dibaca' => '1',
                    'dibuat_tanggal' => date('y-m-d'),
                    'dibuat_pukul' => date('h:i:s')
                );
                $this->notifikasi->simpan($notif);
            }
            $this->aktivitas->log_tambahdraft();
            return $this->berita->simpan_draft($data);
            echo json_encode($data);
        }
    }

    public function ubah()
    {
        $id = $this->input->post('edit_id_berita');
        $cek = $this->berita->get_by_id($id)->row();
        if ($cek->status_berita == 'oke') {
            $data = array(
                'link_berita' => $this->input->post('ubah_link_berita'),
                'share' => implode(", ", $this->input->post('check')),
                'jumlah_view' => $this->input->post('ubah_jumlah_view'),
                'status_berita' => 'valid',
                'dibuat_oleh' => $this->session->userdata('username'),
                'dibuat_tanggal' => date('Y-m-d'),
                'dibuat_pukul' => date('h:i:s'),
            );
            if (!empty($_FILES['file']['name'])) {
                $upload = $this->_do_upload();
                //delete file
                unlink('upload/berita/' . $cek->screenshoot);

                $data['screenshoot'] = $upload;
                $this->aktivitas->log_ubahberita();
                $data = $this->berita->ubah($id, $data);
            } else {
                $data['screenshoot'] = $this->input->post('old_file');
                $this->aktivitas->log_ubahberita();
                $data = $this->berita->ubah($id, $data);
            }

            $this->db->where('level', 'admin');
            $query = $this->db->get('tmst_user');
            foreach ($query->result() as $baris) {
                $notif = array(
                    'user_pengirim' => $this->session->userdata('id_user'),
                    'user_penerima' => $baris->id,
                    'judul' => $this->session->userdata('nama') . ' Mengupload Berita',
                    'pesan' => $this->session->userdata('nama') . ' mengupload berita link tercantum sebagai berikut ' . $this->input->post('ubah_link_berita'),
                    'link' => $this->uri->segment(1),
                    'dibaca' => '1',
                    'dibuat_tanggal' => date('y-m-d'),
                    'dibuat_pukul' => date('h:i:s')
                );
                $this->notifikasi->simpan($notif);
            }
        } else {
            $this->aktivitas->log_ubahdraft();
            $data = $this->db->insert('');
        }

        json_encode($data);
    }

    function ubah_draft()
    {
        $id = $this->input->post('edit_id_berita2');
        $data = array(
            'judul_berita' => $this->input->post('ubah_judul'),
            'narasi_berita' => $this->input->post('ubah_narasi'),
            'dibuat_oleh' => $this->session->userdata('username'),
            'dibuat_tanggal' => date('Y-m-d'),
            'dibuat_pukul' => date('h:i:s'),
        );
        $this->aktivitas->log_ubahdraft();
        $data = $this->berita->ubah_draft($id, $data);

        $this->db->where('level', 'admin');
        $query = $this->db->get('tmst_user');
        foreach ($query->result() as $baris) {
            $notif = array(
                'user_pengirim' => $this->session->userdata('id_user'),
                'user_penerima' => $baris->id,
                'judul' => $this->session->userdata('nama') . ' Mengubah Draft',
                'pesan' =>  $this->session->userdata('nama') . ' mengubah draft berjudul ' . $this->input->post('ubah_judul'),
                'link' => $this->uri->segment(1),
                'dibaca' => '1',
                'dibuat_tanggal' => date('y-m-d'),
                'dibuat_pukul' => date('h:i:s')
            );
            $this->notifikasi->simpan($notif);
        }

        json_encode($data);
    }

    public function hapus()
    {
        $id = $this->input->post('hapus_id_berita');
        $cek = $this->berita->get_by_id($id)->row();
        if ($cek->status_berita != 'valid') {
            $this->db->where('level', 'admin');
            $query = $this->db->get('tmst_user');
            foreach ($query->result() as $baris) {
                $notif = array(
                    'user_pengirim' => $this->session->userdata('id_user'),
                    'user_penerima' => $baris->id,
                    'judul' => $this->session->userdata('nama') . ' Menghapus Draft',
                    'pesan' =>  $this->session->userdata('nama') . ' menghapus draft berjudul ' . $cek->judul_berita,
                    'link' => $this->uri->segment(1),
                    'dibaca' => '1',
                    'dibuat_tanggal' => date('y-m-d'),
                    'dibuat_pukul' => date('h:i:s')
                );
                $this->notifikasi->simpan($notif);
            }
            $this->aktivitas->log_hapusberita();
            $this->berita->hapus($id);
        } else {
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


    public function export()
    {
        if ($this->session->userdata('level') == 'user'  && $this->session->userdata('status') == 'aktif') {
            $nama = $this->session->userdata('nama');
            $bulan = $this->input->post('export_bulan');
            $tahun = $this->input->post('export_tahun');
            $status = $this->input->post('export_status');
            $tanggal_awal = $this->input->post('export_tanggal_awal');
            $tanggal_akhir = $this->input->post('export_tanggal_akhir');
            $data['berita'] = $this->berita->export($nama, $bulan, $tahun, $status, $tanggal_awal, $tanggal_akhir);
            $this->load->view('user/berita/export', $data);
        } else {
            $nama = $this->input->post('export_nama');
            $bulan = $this->input->post('export_bulan');
            $tahun = $this->input->post('export_tahun');
            $status = $this->input->post('export_status');
            $tanggal_awal = $this->input->post('export_tanggal_awal');
            $tanggal_akhir = $this->input->post('export_tanggal_akhir');
            $data['berita'] = $this->berita->export($nama, $bulan, $tahun, $status, $tanggal_awal, $tanggal_akhir);
            $this->load->view('admin/berita/export', $data);
        }
        $html = $this->output->get_output();
        $this->pdf->set_paper('folio', 'landscape');
        $this->pdf->load_Html($html);
        $this->pdf->render();
        $this->pdf->stream("Daftar Berita.pdf", array("Attachment" => 0));
    }
}
