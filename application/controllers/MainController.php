<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once(__DIR__ . '/../../vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Csv;

class MainController extends CI_Controller
{

    // public function __construct()
    // {

    //     parent::__construct();

    //     if (!$this->session->userdata('logged')) {
    //         redirect('auth/');
    //     }
    // }

    public function getLayout($layout, $data = null)
    {
        $this->load->view('include/header', $data);
        $this->load->view('include/navbar', $data);
        $this->load->view('include/sidebar', $data);
        if (is_array($layout)) {
            foreach ($layout as $layouts) {
                $this->load->view($layouts, $data);
            }
        } else {
            $this->load->view($layout, $data);
        }
        $this->load->view('include/footer', $data);
    }

    public function import_excel($files, $type = 'csv')
    {

        if (empty($files['name'])) {
            $response = [
                'status' => 500,
                'messages' => 'File Tidak Ditemukan'
            ];

            return $response;
        } else if (!empty($files)) {
            if (isset($files['name'])) {
                $arr_file = explode(".", $files['name']);
                $extension = end($arr_file);

                if ($extension == 'csv') {
                    $reader = new Csv();
                } else if ($extension == 'xlsx') {
                    $reader = new Xlsx();
                }

                $spreadsheet = $reader->load($files['tmp_name']);

                $sheetData = $spreadsheet->getActiveSheet()->toArray();
                $response = [
                    'status' => 200,
                    'data' => $sheetData
                ];
            }
        }
        return $response;
    }

    public function error404()
    {
        $this->getLayout('error404');
    }
}
