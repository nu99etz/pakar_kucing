<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('MainController.php');

class AturanController extends MainController
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged') || $this->session->userdata('role') != 1) {
            redirect('auth/');
        }
        $this->load->model('PenyakitModel', 'penyakit');
        $this->load->model('GejalaModel', 'gejala');
        $this->load->model('AturanModel', 'aturan');
    }
    
    public function ajax()
    {
        $data = $this->aturan->getAllAturan();
        $no = 1;
        $record = [];
        foreach ($data as $value) {
            $row = [];
            $row[] = $no;
            if (!empty($value['gejala'])) {
                $explode = explode(',', $value['gejala']);
                $html = '';
                $html .= '<b>JIKA</b> ' . $this->gejala->getGejala($explode[0], 'kode_gejala') . " - " . strtoupper($this->gejala->getGejala($explode[0], 'nama_gejala')) . '<br/>';
                for ($i = 1; $i < count($explode); $i++) {
                    $html .= ' <b>DAN</b> ' . $this->gejala->getGejala($explode[$i], 'kode_gejala') . " - " . strtoupper($this->gejala->getGejala($explode[$i], 'nama_gejala')) . '<br/>';
                }
                $html .= ' <b>MAKA</b> ' . $this->penyakit->getPenyakit($value['id_ms_penyakit'], 'kode_penyakit') . " - " . strtoupper($this->penyakit->getPenyakit($value['id_ms_penyakit'], 'nama_penyakit')) . '<br/>';
                $row[] = $html;
            } else {
                $row[] = 'Kosong';
            }

            $button = '<button type="button" name="update" action="' . base_url() . 'aturan/edit/' . $value['id_rule'] . '" class="btn-edit btn btn-flat btn-warning btn-sm"><i class = "fa fa-edit"></i></button> ';
            $button .= '<button type="button" name="delete" action="' . base_url() . 'aturan/destroy/' . $value['id_rule'] . '" class="btn-delete btn btn-flat btn-danger btn-sm"><i class = "fa fa-trash"></i></button> ';
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
        $layout = 'aturan/index';
        $this->getLayout($layout);
    }

    public function create()
    {
        $layout = 'aturan/form';
        $gejala = $this->gejala->getAllGejala();
        $penyakit = $this->aturan->getPenyakitIfExist();
        $data = [
            'action' => base_url() . 'aturan/store',
            'gejala' => $gejala,
            'penyakit' => $penyakit,
        ];
        $this->load->view($layout, $data);
    }

    public function store()
    {
        $store = $this->aturan->store();
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
        $layout = 'aturan/form';
        $aturan = $this->aturan->getAturan($id);
        $id_penyakit = $this->aturan->getAturan($id, 'id_ms_penyakit');
        $gejala = $this->gejala->getAllGejala();
        $penyakit = $this->aturan->getPenyakitIfExist($id_penyakit);
        $data = [
            'action' => base_url() . 'aturan/update/' . $id,
            'gejala' => $gejala,
            'penyakit' => $penyakit,
            'aturan' => $aturan
        ];
        $this->load->view($layout, $data);
    }

    public function update($id)
    {
        $update = $this->aturan->update($id);
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
        $destroy = $this->aturan->destroy($id);
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
}
