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
        // $this->load->model('KategoriGejalaModel', 'kategori_gejala');
    }

    public function generateCF()
    {
        $generate = $this->cf->generateCF();
        if($generate['status'] == true) {
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
        $cf = $this->cf->getAllCertainlyFactor();
        $data = [];
        foreach($cf as $key => $value) {
            $data[$value['id_penyakit']][] = $value;
        }
        $this->maintence->Debug($data);
    }
}