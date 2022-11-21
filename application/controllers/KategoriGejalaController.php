<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('MainController.php');

class KategoriGejalaController extends MainController
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged') || $this->session->userdata('role') != 1) {
            redirect('auth/');
        }
        $this->load->model('KategoriGejalaModel', 'kategori_gejala');
    }

    public function ajax()
    {
        $data = $this->kategori_gejala->getAllKategoriGejala();
        $no = 1;
        $record = [];
        foreach ($data as $value) {
            $row = [];
            $row[] = $no;
            $row[] = $value['nama_ms_kategori'];
            $button = '<button type="button" name="update" action="' . base_url() . 'kategori_gejala/edit/' . $value['id_ms_kategori_gejala'] . '" class="btn-edit btn btn-flat btn-warning btn-sm"><i class = "fa fa-edit"></i></button> ';
            $button .= '<button type="button" name="delete" action="' . base_url() . 'kategori_gejala/destroy/' . $value['id_ms_kategori_gejala'] . '" class="btn-delete btn btn-flat btn-danger btn-sm"><i class = "fa fa-trash"></i></button> ';
            $row[] = $button;
            $no++;
            $record[] = $row;
        }
        echo json_encode([
            'data' => $record
        ]);
    }

    public function index()
    {
        $layout = 'kategori_gejala/index';
        $this->getLayout($layout);
    }

    public function create()
    {
        $layout = 'kategori_gejala/form';
        $data = [
            'action' => base_url() . 'kategori_gejala/store',
        ];
        $this->load->view($layout, $data);
    }

    public function store()
    {
        $store = $this->kategori_gejala->store();
        if ($store['status'] == true) {
            $response = [
                'status' => 200,
                'messages' => $store['messages']
            ];
        } else if ($store['status'] == false) {
            $response = [
                'status' => 422,
                'messages' => $store['messages']
            ];
        }
        echo json_encode($response);
    }

    public function edit($id)
    {
        $layout = 'kategori_gejala/form';
        $kategori_gejala = $this->kategori_gejala->getKategoriGejala($id);
        $data = [
            'kategori_gejala' => $kategori_gejala,
            'action' => base_url() . 'kategori_gejala/update/' . $id,
        ];
        $this->load->view($layout, $data);
    }

    public function update($id)
    {
        $update = $this->kategori_gejala->update($id);
        if ($update['status'] == true) {
            $response = [
                'status' => 200,
                'messages' => $update['messages']
            ];
        } else if ($update['status'] == false) {
            $response = [
                'status' => 422,
                'messages' => $update['messages']
            ];
        }
        echo json_encode($response);
    }

    public function destroy($id)
    {
        $destroy = $this->kategori_gejala->destroy($id);
        if ($destroy['status'] == true) {
            $response = [
                'status' => 200,
                'messages' => $destroy['messages']
            ];
        } else if ($destroy['status'] == false) {
            $response = [
                'status' => 422,
                'messages' => $destroy['messages']
            ];
        }
        echo json_encode($response);
    }

    public function penjelasanGejala($id)
    {
        $layout = 'kategori_gejala/form_penjelasan';
        $kategori_gejala = $this->kategori_gejala->getGejala($id);
        $data = [
            'kategori_gejala' => $kategori_gejala,
        ];
        $this->load->view($layout, $data);
    }

    public function createImport()
    {
        $data = [
            'action' => base_url() . 'kategori_gejala/importExcel',
        ];
        return $this->load->view('kategori_gejala/form_import', $data);
    }
}
