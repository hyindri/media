<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('login_status') != TRUE) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger"><strong>Oops!</strong> Mohon Login Dahulu </div>');
            redirect(site_url(''));
        }
        $this->load->model('Setting_model', 'setting');
        $this->load->model('Notifikasi_model', 'notifikasi');
    }

    public function index()
    {
        $data = array(
            'title' => 'Setting',
            'notif' => $this->notifikasi->get_by_id($this->session->userdata('id_user')),
            'jumlah_notif' => $this->notifikasi->get_by_jumlah($this->session->userdata('id_user'))
        );
        return view('admin.setting.index', $data);
    }


    public function json()
    {
        $list = $this->setting->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $q) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $q->nama;
            $row[] = '<a href="' . site_url() . '/upload/logo/' . $q->logo . '" target="_blank" class="thumbnail"> <img class="img-responsive" src="' . site_url() . 'upload/logo/' . $q->logo . '" width="50px" height="50px"></a>';
            $row[] = '<div class="btn-group"><button type="button" name="ubah" data-id="' . $q->id . '"  data-nama="' . $q->nama . '" data-logo="' . $q->logo . '" class="ubah btn btn-primary btn-xs"><i class="material-icons">edit</i></button>
            <div class="btn-group">';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->setting->count_all(),
            "recordsFiltered" => $this->setting->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }


    public function tambah()
    {
        if (!empty($_FILES['file']['name'])) {
            $data = array(
                'nama' => $this->input->post('nama'),
                'dibuat_tanggal' => date('y-m-d'),
                'dibuat_pukul' => date('h:i:s'),
            );
        }
        $upload = $this->_do_upload();
        $data['logo'] = $upload;

        $this->db->where('nama', $data['nama']);
        $q = $this->db->get('tmst_sosmed');
        if ($q->num_rows() > 0) {
            return $this->db->insert('');
        } else {
            return $this->setting->simpan($data);
            echo json_encode($data);
        }
    }

    public function ubah()
    {
        $id = $this->input->post('edit_id');
        $cek = $this->setting->get_by_id($id);
        $data = array(
            'nama' => $this->input->post('edit_nama'),
            'dibuat_tanggal' => date('y-m-d'),
            'dibuat_pukul' => date('h:i:s'),
        );
        if (!empty($_FILES['file']['name'])) {
            $upload = $this->_do_upload();
            //delete file
            unlink('upload/logo/' . $cek->logo);

            $data['logo'] = $upload;
            $data = $this->setting->ubah($id, $data);
        } else {
            $data = $this->setting->ubah($id, $data);
        }
        json_encode($data);
    }

    private function _do_upload()
    {
        if (!file_exists('upload/logo')) {
            mkdir('upload/logo/', 0777, true);
        }
        $config['upload_path']          = 'upload/logo/';
        $config['allowed_types']        = 'jpg|jpeg|png|pdf';
        $config['max_size']             = 500; //set max size allowed in Kilobyte
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

    function json_waktu()
    {
        $data = $this->setting->get_all();
        foreach ($data as $row) {
            $output['id'] = $row->id;
            $output['setting'] = $row->waktu;
        }
        echo json_encode($output);
    }

    function ubah_jam()
    {
        $data = $this->setting->update();
        json_encode($data);
    }
}
