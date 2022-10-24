<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('MainController.php');

class GejalaController extends MainController
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged') || $this->session->userdata('role') != 1) {
            redirect('auth/');
        }
        $this->load->model('GejalaModel', 'gejala');
    }

    public function ajax()
    {
        $data = $this->gejala->getAllGejala();
        $no = 1;
        $record = [];
        foreach ($data as $value) {
            $row = [];
            $row[] = $no;
            $row[] = $value['kode_gejala'];
            $row[] = $value['nama_gejala'];
            $row[] = $value['is_utama'] == 0 ? "Tidak" : "Ya";
            $row[] = $value['is_priority'] == 0 ? "Tidak" : "Ya";
            $button = '<button type="button" name="update" action="' . base_url() . 'gejala/edit/' . $value['id_ms_gejala'] . '" class="btn-edit btn btn-flat btn-warning btn-sm"><i class = "fa fa-edit"></i></button> ';
            $button .= '<button type="button" name="delete" action="' . base_url() . 'gejala/destroy/' . $value['id_ms_gejala'] . '" class="btn-delete btn btn-flat btn-danger btn-sm"><i class = "fa fa-trash"></i></button> ';
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
        $layout = 'gejala/index';
        $this->getLayout($layout);
    }

    public function create()
    {
        $layout = 'gejala/form';
        $data = [
            'action' => base_url() . 'gejala/store',
        ];
        $this->load->view($layout, $data);
    }

    public function store()
    {
        $store = $this->gejala->store();
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
        $layout = 'gejala/form';
        $gejala = $this->gejala->getGejala($id);
        $data = [
            'gejala' => $gejala,
            'action' => base_url() . 'gejala/update/' . $id,
        ];
        $this->load->view($layout, $data);
    }

    public function update($id)
    {
        $update = $this->gejala->update($id);
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
        $destroy = $this->gejala->destroy($id);
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
        $layout = 'gejala/form_penjelasan';
        $gejala = $this->gejala->getGejala($id);
        $data = [
            'gejala' => $gejala,
        ];
        $this->load->view($layout, $data);
    }

    public function createImport()
    {
        $data = [
            'action' => base_url() . 'gejala/importExcel',
        ];
        return $this->load->view('gejala/form_import', $data);
    }

    public function importExcel()
    {
        $data = $this->import_excel($_FILES['upload'], 'xlsx');

        $this->maintence->Debug($data);

        if ($data['status'] == 500) {
            $response = [
                'status' => 422,
                'messages' => $data['messages']
            ];
        } else if ($data['status'] == 200) {

            $import_excel = $this->gejala->importExcel($data['data']);
            $response = [
                'status' => $import_excel['status'] == false ? 422 : 200,
                'messages' => $import_excel['messages']
            ];
        }

        echo json_encode($response);
    }
}
