<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jabatan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('jabatan_model', 'jabatan');
        $this->load->model('notifikasi_model', 'notifikasi');
        $this->load->model('log_model','aktivitas');
    }

    public function index()
    {
        $data =  array(
            'notif' => $this->notifikasi->get_by_id($this->session->userdata('id_user')),
            'jumlah_notif' => $this->notifikasi->get_by_jumlah($this->session->userdata('id_user')) 
        );
        return view('admin.jabatan.index',$data);
        
    }

    public function json()
    {
        $list = $this->jabatan->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $q) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $q->nama_jabatan;
            $row[] = '<div class="btn-group"><button type="button" name="ubah" data-id="' . $q->id . '" data-nama_jabatan="' . $q->nama_jabatan . '" class="ubah btn btn-primary btn-xs"><i class="material-icons">edit</i></button>
            <div class="btn-group">';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->jabatan->count_all(),
            "recordsFiltered" => $this->jabatan->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    
    public function tambah()
    {
        $data = array(
            'nama_jabatan' => $this->input->post('nama_jabatan')
        );
    
        $this->db->where('nama_jabatan', $data['nama_jabatan']);
        $query = $this->db->get('tmst_jabatan');

        if ($query->num_rows() > 0) {
            return $this->db->insert('');
        } else {
            $this->aktivitas->log_tambahjabatan();
            return $this->jabatan->simpan($data);
            echo json_encode($data);
        }
    }

    public function ubah()
    {
        $id = $this->input->post('edit_id');
        $laporan = $this->jabatan->get_by_id($id);
        $data = array(
            'nama_jabatan' => $this->input->post('edit_nama_jabatan')
        );

        $this->db->where('nama_jabatan', $data['nama_jabatan']);
        $query = $this->db->get('tmst_jabatan');

        if ($query->num_rows() > 0) {
            return $this->db->insert('');
        } else {
            $this->aktivitas->log_ubahjabatan();
            $data = $this->jabatan->ubah($id, $data);
            json_encode($data);
        }

    }
}
