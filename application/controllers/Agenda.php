<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Agenda extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('agenda_model', 'agenda');
    }

    public function index()
    {
        if($this->session->userdata('level') == 'user'){
            return view('user.agenda.index');
        } elseif($this->session->userdata('level') == 'admin'){
            return view('admin.agenda.index');
        } elseif($this->session->userdata('level') == 'superadmin'){
            return view('superadmin.agenda.index');
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
            $row[] = $q->judul;
            $row[] = $q->tanggal;
            $row[] = $q->status;
            $row[] = '<a href="' . site_url() . 'upload/agenda/' . $q->file . '" target="_blank">Download</a>';
            $row[] = $q->dibuat_oleh;
            $row[] = $q->dibuat_pada;
            $row[] = '<div class="btn-group"><button type="button" name="ubah" data-id="' . $q->id . '" data-judul="' . $q->judul . '" data-tanggal="' . $q->tanggal . '" data-status="' . $q->status . '" class="ubah btn btn-primary btn-xs"><i class="material-icons">edit</i></button>
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

    public function fetch_data()
    { 
        $list = $this->agenda->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $la) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $la->judul;
            $row[] = $la->tanggal;
            $row[] = $la->status;
            $row[] = '<a href="' . site_url() . 'upload/agenda/' . $la->file . '" target="_blank">Download</a>';
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

        $this->db->where('judul', $data['judul']);
        $q = $this->db->get('tb_agenda');
        if ($q->num_rows() > 0) {
            return $this->db->insert('');
        } else {
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
        
        if(!empty($_FILES['file']['name']))
        {
            $upload = $this->_do_upload();
            //delete file
                unlink('upload/agenda/'.$laporan->file);
        
            $data['file'] = $upload;
            $data = $this->agenda->ubah($id, $data);
        } else {
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
