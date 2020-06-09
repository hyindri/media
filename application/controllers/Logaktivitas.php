<?php

class Logaktivitas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('login_status') != TRUE) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger"><strong>Oops!</strong> Mohon Login Dahulu </div>');
            redirect(site_url(''));
        }   
        $this->load->model('log_model','aktivitas');
        $this->load->model('notifikasi_model','notifikasi');
    }

    public function index()
    {
        if ($this->session->userdata('level') == 'superadmin' || $this->session->userdata('level') == 'admin') {
            $data = array(
                'notif' => $this->notifikasi->get_by_id($this->session->userdata('id_user')),
                'jumlah_notif' => $this->notifikasi->get_by_jumlah($this->session->userdata('id_user'))
            );
            view('admin.logaktivitas.index', $data);
        } else {
            $data = array(
                'notif' => $this->notifikasi->get_by_id($this->session->userdata('id_user')),
                'jumlah_notif' => $this->notifikasi->get_by_jumlah($this->session->userdata('id_user'))
            );
            view('admin.logaktivitas.index',$data);
        }
    }

    public function json()
    {
        $list = $this->aktivitas->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach($list as $field)
        {
            $no++;
            $row = array();
            $row[] = $no;            
            $row[] = $field->oleh;
            $row[] = $field->aktivitas;
            $row[] = date('d/m/Y - H:i:s',strtotime($field->pada));

            $data[] = $row;
        }        

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->aktivitas->count_all(),
            "recordsFiltered" => $this->aktivitas->count_filtered(),
            "data" => $data,
        );

        echo json_encode($output);
    }


}


?>