<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if($this->session->userdata('login_status')!=TRUE)
		{				
			redirect(site_url('auth'));
        }
        $this->load->model('Model_akun');
    }

    function index()
    {
        view('akun.index');
    }

    function ambil_data()
    {
        $fetch_data = $this->Model_akun->make_datatables();
        $data = array();
        $no = 1;
        foreach($fetch_data as $row)
        {
            $sub_array      = array();
            $sub_array[]    = $no++;
            $sub_array[]    = $row->username;
            $sub_array[]    = $row->email;
            $sub_array[]    = $row->full_name;
            $sub_array[]    = $row->phone;
            $sub_array[]    = $row->role;
            $sub_array[]    = '<button type="button" class="btn btn-info btn-sm mb-2" data-id="'.$row->id_user.'" id="get-ubahModal">Ubah</button> <br> <button type="button" class="btn btn-danger btn-sm" id="get-hapusModal" data-id="'.$row->id_user.'">Hapus</button>';
            $data[]         = $sub_array;
        }

        $output = array(
            'draw' => intval($_POST['draw']),
            'recordsTotal'  => $this->Model_akun->get_all_data(),
            'recordsFiltered'   => $this->Model_akun->get_filtered_data(),
            'data'  => $data
        );
        echo json_encode($output);
    }

    function tambah_data()
    {
        $data = $this->Model_akun->tambahAkun();
        json_encode($data);
    }

    function ambil_satu_data()
    {
        $output = array();
        $data = $this->Model_akun->ambilSatuData($this->input->post('id_user'));
        foreach($data as $row)
        {
            $output['id']       = $row->id_user;
            $output['email']    = $row->email;
            $output['username'] = $row->username;            
            $output['nama'] = $row->full_name;   
            $output['nomor_hp'] = $row->phone;
            $output['level_akses'] = $row->role;
        }
        echo json_encode($output);
    }

    function ubah_data()
    {
        $data = $this->Model_akun->ubahData();
        json_encode($data);
    }

    function hapus_data()
    {
        $data = $this->Model_akun->hapusData();
        json_encode($data);
    }


}