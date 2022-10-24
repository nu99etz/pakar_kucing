<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('MainController.php');

class PenyakitController extends MainController
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged') || $this->session->userdata('role') != 1) {
            redirect('auth/');
        }
        $this->load->model('PenyakitModel', 'penyakit');
    }

    public function ajax()
    {
        $data = $this->penyakit->getAllPenyakit();
        $no = 1;
        $record = [];
        foreach($data as $value) {
            $row = [];
            $row[] = $no;
            $row[] = $value['kode_penyakit'];
            $row[] = $value['nama_penyakit'];
            $row[] = $value['solusi_penyakit'];
            $button ='<button type="button" name="update" action="' . base_url().'penyakit/edit/'.$value['id_ms_penyakit'] . '" class="btn-edit btn btn-flat btn-warning btn-sm"><i class = "fa fa-edit"></i></button> ';
            $button .= '<button type="button" name="delete" action="' . base_url().'penyakit/destroy/'.$value['id_ms_penyakit'] . '" class="btn-delete btn btn-flat btn-danger btn-sm"><i class = "fa fa-trash"></i></button> ';
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
        $layout = 'penyakit/index';
        $this->getLayout($layout);
    }

    public function create()
    {
        $layout = 'penyakit/form';
        $data = [
            'action' => base_url().'penyakit/store',
        ];
        $this->load->view($layout, $data);
    }

    public function createImport()
    {
        $data = [
            'action' => base_url() . 'penyakit/importExcel',
        ];
        return $this->load->view('penyakit/form_import', $data);
    }

    public function store()
    {
        $store = $this->penyakit->store();
        if($store['status'] == true) {
            $response = [
                'status' => 200,
                'messages' => $store['messages']
            ];
        } else if($store['status'] == false) {
            $response = [
                'status' => 422,
                'messages' => $store['messages']
            ];
        }
        echo json_encode($response);
    }

    public function edit($id)
    {
        $layout = 'penyakit/form';
        $penyakit = $this->penyakit->getPenyakit($id);
        $data = [
            'penyakit' => $penyakit,
            'action' => base_url().'penyakit/update/'. $id,
        ];
        $this->load->view($layout, $data);
    }

    public function update($id)
    {
        $update = $this->penyakit->update($id);
        if($update['status'] == true) {
            $response = [
                'status' => 200,
                'messages' => $update['messages']
            ];
        } else if($update['status'] == false) {
            $response = [
                'status' => 422,
                'messages' => $update['messages']
            ];
        }
        echo json_encode($response);
    }

    public function destroy($id)
    {
        $destroy = $this->penyakit->destroy($id);
        if($destroy['status'] == true) {
            $response = [
                'status' => 200,
                'messages' => $destroy['messages']
            ];
        } else if($destroy['status'] == false) {
            $response = [
                'status' => 422,
                'messages' => $destroy['messages']
            ];
        }
        echo json_encode($response);
    }

    public function importExcel()
    {
        $data = $this->import_excel($_FILES['upload'], 'xlsx');

        if ($data['status'] == 500) {
            $response = [
                'status' => 422,
                'messages' => $data['messages']
            ];
        } else if ($data['status'] == 200) {

            $import_excel = $this->penyakit->importExcel($data['data']);
            $response = [
                'status' => $import_excel['status'] == false ? 422 : 200,
                'messages' => $import_excel['messages']
            ];
        }

        echo json_encode($response);
    }
}