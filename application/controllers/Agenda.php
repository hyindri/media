<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Agenda extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('agenda_model', 'agenda');
        $this->load->model('notifikasi_model', 'notifikasi');
        $this->load->model('log_model','aktivitas');
    }

    public function index()
    {
        if($this->session->userdata('level') == 'user'){
            $data =  array(
                'notif' => $this->notifikasi->get_by_id($this->session->userdata('id_user')),
                'jumlah_notif' => $this->notifikasi->get_by_jumlah($this->session->userdata('id_user'))
            );
            return view('user.agenda.index', $data);
        } elseif($this->session->userdata('level') == 'admin'){
            $data =  array(
                'notif' => $this->notifikasi->get_by_id($this->session->userdata('id_user')),
                'jumlah_notif' => $this->notifikasi->get_by_jumlah($this->session->userdata('id_user')) 
            );
            return view('admin.agenda.index', $data);
        } elseif($this->session->userdata('level') == 'superadmin'){
            $data =  array(
                'notif' => $this->notifikasi->get_by_id($this->session->userdata('id_user')),
                'jumlah_notif' => $this->notifikasi->get_by_jumlah($this->session->userdata('id_user')) 
            );
            return view('superadmin.agenda.index',$data);
        }
    }

    public function json()
    {
        $list = $this->agenda->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $q) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = '<p class="text-center">'.$q->tanggal.'</p>';
            $row[] = $q->judul;
            $row[] = '<a class="text-center" href="' . site_url() . 'upload/agenda/' . $q->file . '" target="_blank">Download</a>';
            if($q->status == 'aktif'){
                $row[] = '<p class="col-teal text-center">Aktif</p>';
            }else{
                $row[] = '<p class="font-line-through col-red text-center">Aktif</p>';
            }
            $row[] = '<div class="btn-group"><button type="button" name="ubah" data-id="' . $q->id . '" data-judul="' . $q->judul . '" data-tanggal="' . $q->tanggal . '" data-status="' . $q->status . '" data-file="'.$q->file.'" class="ubah btn btn-primary btn-xs"><i class="material-icons">edit</i></button>
            <div class="btn-group">';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->agenda->count_all(),
            "recordsFiltered" => $this->agenda->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    // public function fetch_data()
    // { 
    //     $list = $this->agenda->get_datatables();
    //     $data = array();
    //     $no = $_POST['start'];
    //     foreach ($list as $la) {
    //         $no++;
    //         $row = array();
    //         $row[] = $no;
    //         $row[] = $la->judul;
    //         $row[] = $la->tanggal;
    //         $row[] = $la->status;
    //         $row[] = '<a href="' . site_url() . 'upload/agenda/' . $la->file . '" target="_blank">Download</a>';
    //         $data[] = $row;
    //     }

    //     $output = array(
    //         "draw" => $_POST['draw'],
    //         "recordsTotal" => $this->agenda->count_all(),
    //         "recordsFiltered" => $this->agenda->count_filtered(),
    //         "data" => $data,
    //     );
    //     //output to json format
    //     echo json_encode($output);
    // }
    

    public function tambah()
    {
        if(!empty($_FILES['file']['name']))
        {
            $data = array(
                'judul' => $this->input->post('judul'),
                'tanggal' => date("Y-m-d", strtotime($this->input->post('tanggal'))),
                'status' => $this->input->post('status'),
                'dibuat_oleh' => $this->session->userdata('username'),
                'dibuat_pada' => date('Y-m-d')
            );
        }

        $upload = $this->_do_upload();
        $data['file'] = $upload;

        $this->db->where('level', 'user');
        $query = $this->db->get('tmst_user');
        foreach ($query->result() as $baris) {
            $notif = array(
                'user_pengirim' => $this->session->userdata('id_user'),
                'user_penerima' => $baris->id,
                'judul' => $this->session->userdata('username') . ' Menambahkan Agenda',
                'pesan' => $this->session->userdata('username') . ' menambahkan agenda berjudul ' . $this->input->post('judul'),
                'link' => $this->uri->segment(1),
                'dibaca' => '1',
                'dibuat_tanggal' => date('y-m-d'),
                'dibuat_pukul' => date('h:i:s')
            );
            $this->notifikasi->simpan($notif);
        }

        $this->db->where('judul', $data['judul']);
        $q = $this->db->get('tb_agenda');
        if ($q->num_rows() > 0) {
            return $this->db->insert('');
        } else {
            $this->aktivitas->log_tambahagenda();
            return $this->agenda->simpan($data);
         echo json_encode($data);
        }
    }

    public function ubah()
    {
        $id = $this->input->post('edit_id');
        $laporan = $this->agenda->get_by_id($id);
        $data = array(
            'judul' => $this->input->post('edit_judul'),
            'tanggal' => date("Y-m-d", strtotime($this->input->post('edit_tanggal'))),
            'status' => $this->input->post('edit_status'),
        );

        
        $this->db->where('level', 'user');
        $query = $this->db->get('tmst_user');
        foreach ($query->result() as $baris) {
            $notif = array(
                'user_pengirim' => $this->session->userdata('id_user'),
                'user_penerima' => $baris->id,
                'judul' => $this->session->userdata('username') . ' Merubah Agenda',
                'pesan' => ' Ada perubahan pada agenda yang berjudul ' . $this->input->post('edit_judul'),
                'link' => $this->uri->segment(1),
                'dibaca' => '1',
                'dibuat_tanggal' => date('y-m-d'),
                'dibuat_pukul' => date('h:i:s')
            );
            $this->notifikasi->simpan($notif);
        }
        
        if(!empty($_FILES['file']['name']))
        {
            $upload = $this->_do_upload();
            //delete file
                unlink('upload/agenda/'.$laporan->file);
        
            $data['file'] = $upload;            
            $data = $this->agenda->ubah($id, $data);
        } else {
            $this->aktivitas->log_ubahagenda();
            $data = $this->agenda->ubah($id, $data);
        }
     json_encode($data);

    }

    private function _do_upload()
    {
        if (!file_exists('upload/agenda')) {
            mkdir('upload/agenda/', 0777, true);
        }
        $config['upload_path']          = 'upload/agenda/';
        $config['allowed_types']        = 'jpg|jpeg|png|pdf';
        $config['max_size']             = 8000; //set max size allowed in Kilobyte
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name
 
        $this->load->library('upload', $config);
 
        if(!$this->upload->do_upload('file')) //upload and validate
        {
            $data['inputerror'][] = 'file';
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }
}
