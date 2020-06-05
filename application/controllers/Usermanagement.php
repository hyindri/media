<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usermanagement extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('users_model', 'users');
        $this->load->model('medmas_model', 'medmas');
        $this->load->library('pdf');
    }

    public function index()
    {
        if($this->session->userdata('level') == 'admin'){
            return view('admin.usermanagement.index');
        } elseif($this->session->userdata('level') == 'superadmin'){
            return view('superadmin.media.index');
        }
    }

    public function json()
    {
        $list = $this->users->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $q) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $q->username;
            $row[] = $q->dibuat_pada;
            $row[] = $q->status;
            $row[] = '<a href="' . site_url() . 'profil/detail/' . $q->id . '" target="_blank">' . $q->nama . '</a>';
            $row[] = $q->mulai_mou;
            $row[] = $q->akhir_mou;
            $row[] = '<div class="btn-group"><button type="button" name="ubah" data-id="' . $q->user_id . '" data-username="' . $q->username . '" data-dibuat_pada="' . $q->dibuat_pada . '" data-status="' . $q->status . '" data-mulai_mou="' . $q->mulai_mou . '" data-akhir_mou="' . $q->akhir_mou . '" class="ubah btn btn-primary btn-xs"><i class="material-icons">edit</i></button>
            <div class="btn-group">';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->users->count_all(),
            "recordsFiltered" => $this->users->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function fetch_data()
    {
        $list = $this->users->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $q) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $q->username;
            $row[] = $q->dibuat_pada;
            $row[] = $q->status;
            $row[] = '<a href="' . site_url() . 'profil/detail/' . $q->id . '" target="_blank">' . $q->nama . '</a>';
            $row[] = $q->mulai_mou;
            $row[] = $q->akhir_mou;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->users->count_all(),
            "recordsFiltered" => $this->users->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ubah()
    {
        $id = $this->input->post('edit_id');
        $data_user = array(
            'status' => $this->input->post('edit_status'),
        );
        $data_media = array(
            'mulai_mou' => date("Y-m-d", strtotime($this->input->post('edit_mulai_mou'))),
            'akhir_mou' => date("Y-m-d", strtotime($this->input->post('edit_akhir_mou'))),
        );
        $data = $this->users->update($id, $data_user);
        $data = $this->medmas->ubah($id, $data_media);
        json_encode($data);
    }

    function export()
    {
        
        $data['mediamassa'] = $this->users->export();
        $this->load->view('admin/usermanagement/export', $data);
        
        $html = $this->output->get_output();
		$this->pdf->set_paper('folio', 'landscape');
		$this->pdf->load_Html($html);
		$this->pdf->render();
		$this->pdf->stream("Daftar Media Massa.pdf", array("Attachment"=>0));
    }
}
