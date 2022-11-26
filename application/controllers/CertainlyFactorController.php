<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('MainController.php');

class CertainlyFactorController extends MainController
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged') || $this->session->userdata('role') != 1) {
            redirect('auth/');
        }
        $this->load->model('CertainlyFactorModel', 'cf');
        $this->load->model('PenyakitModel', 'penyakit');
        // $this->load->model('KategoriGejalaModel', 'kategori_gejala');
    }

    public function generateCF()
    {
        $generate = $this->cf->generateCF();
        if ($generate['status'] == true) {
            echo json_encode([
                "status" => "ok",
                "msg" => $generate['messages']
            ]);
        } else {
            echo json_encode([
                "status" => "failed",
                "msg" => $generate['messages']
            ]);
        }
    }

    public function index()
    {
        $penyakit = $this->penyakit->getAllPenyakit();
        $layout = 'cf/index';
        $data = [
            'penyakit' => $penyakit,
            'action' => base_url() . 'cf/get_cf'
        ];
        $this->getLayout($layout, $data);
    }

    public function getCF($id)
    {
        $data = $this->cf->getAllCertainlyFactor($id);
        // $data = [];
        // foreach ($cf as $key => $value) {
        //     $data[$value['id_penyakit']][] = $value;
        // }

        // set tabel
        $html = "";
        $html .= "<form method = 'post' action = '" . base_url() . "cf/store' id = 'mb_md_set'>";
        $html .= "<table id='aturan' class='table table-bordered table-hover'>";
        $html .= "<thead>";
        $html .= "<tr>";
        $html .= "<th>No</th>";
        $html .= "<th>Nama Gejala</th>";
        $html .= "<th>Nilai MB</th>";
        $html .= "<th>Nilai MD</th>";
        $html .= "</tr>";
        $html .= "</thead>";
        $html .= "<tbody>";
        $no = 0;
        foreach ($data as $key => $value) {
            $html .= "<tr>";
            $html .= "<td>" . $no + 1 .  "</td>";
            $html .= "<td>[ " . $value['nama_ms_kategori'] . " ] - " . $value['nama_gejala'] .  "</td>";
            $html .= "<td><input type='text' class='form-control rounded-0' name='nilai_mb[" . $value['id_certainly_factor'] . "]' id='nilai_mb' placeholder='' value='" . $value['mb_value'] . "'></td>";
            $html .= "<td><input type='text' class='form-control rounded-0' name='nilai_md[" . $value['id_certainly_factor'] . "]' id='nilai_mb' placeholder='' value='" . $value['md_value'] . "'></td>";
            $html .= "</tr>";
            $no++;
        }
        $html .= "<tbody>";
        $html .= "</table>";
        $html .= "<div style='float: right;'>";
        $html .= "<button type='submit' class='btn btn-primary btn-flat'><i class='fa fa-save'></i> Simpan</button>";
        // $html .= "<button type='reset' class='btn btn-warning btn-flat'><i class='fa fa-repeat'></i> Reset</button>";
        $html .= "</div>";
        $html .= "</form>";
        echo json_encode([
            'status' => 200,
            'html' => $html
        ]);
    }

    public function store()
    {
        $store = $this->cf->store();
        if($store['status'] == true) {
            $response = [
                'status' => 200,
                'messages' => $store['messages']
            ];
        } else {
            $response = [
                'status' => 400,
                'messages' => $store['messages']
            ];
        }
        echo json_encode($response);
    }
}
