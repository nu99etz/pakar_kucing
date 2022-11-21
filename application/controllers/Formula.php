<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('MainController.php');

class Formula extends MainController
{

    protected $gejalaSekarang;
    protected $gejalaSebelum;
    protected $answer;

    public function __construct($answer)
    {
        parent::__construct();
        $this->answer = $answer;
    }

    private function setGejalaSebelum($gejala)
    {
        $this->gejalaSebelum[] = $gejala;
    }

    private function setGejalaSekarang($gejala)
    {
        // if ($gejala[0]) {
        //     $this->gejalaSekarang = $gejala[0] . ",";
        // } else {
        //     $this->gejalaSekarang = implode(',', $gejala);
        // }
        if(count($gejala) > 1) {
            $this->gejalaSekarang = implode(',', $gejala);
        } else {
            $this->gejalaSekarang = $gejala[0] . ",";
        }
    }

    private function getGejalaSekarang()
    {
        return $this->gejalaSekarang;
    }

    private function getGejala($id)
    {
        $sqlGejala = "select*from ms_gejala where id_ms_gejala = $id";
        $queryGejala = $this->db->query($sqlGejala);
        $gejala = $queryGejala->result_array();
        return $gejala;
    }

    private function getPenyakit($id)
    {
        $sqlPenyakit = "select*from ms_penyakit where id_ms_penyakit = $id";
        $queryPenyakit = $this->db->query($sqlPenyakit);
        $penyakit = $queryPenyakit->result_array();
        return $penyakit;
    }

    private function forwardChainning($gejala)
    {
        $this->setGejalaSebelum($gejala);

        // gabungkan semua gejala jawaban ya mulai dari gejala sebelumnya
        // G1->G2 dst sampai gejala yang dipilih habis
        $this->setGejalaSekarang($this->gejalaSebelum);

        // node gabungan gejala sekarang
        $whereLike = $this->getGejalaSekarang() . '%';

        // query ke tabel aturan sesuai node yang sudah digabung menjadi satu
        $sqlAturan = "select*from rule where gejala like '$whereLike'";
        $queryAturan = $this->db->query($sqlAturan)->result_array();
        $data = [];
        foreach ($queryAturan as $key => $value) {
            $exp = explode(",", $value['aturan']);
            if (in_array($gejala, $exp)) {
                $data[] = $queryAturan[$key];
            }
        }
        return $data;
    }

    public function getForwardChainning()
    {
        $nodeJawabanYa = [];
        $penyakitNode = [];

        foreach ($this->answer as $key => $value) {
            // cek semua jawaban node jika jawaban ya maka gabung node menjadi satu
            if (isset($value)) {
                if ($value == "0") {
                    // Maintence::debug($key);
                    $nodeJawabanYa[] = $key;
                    $penyakit = $this->forwardChainning($key);
                    if (!empty($penyakit)) {
                        $penyakitNode[] = $penyakit;
                    }
                }
            }
        }

        // echo "<pre>";
        // print_r($penyakitNode);
        // echo "</pre>";
        // die();

        if(!empty($nodeJawabanYa)) {
            $implodeJawabanYa = implode(',', $nodeJawabanYa);
            if(!empty($penyakitNode)) {
                // cocokan node dan hasil query dari aturan
                $match = [];
                for($i = 0; $i < count($penyakitNode); $i++) {
                    for($j = 0; $j < count($penyakitNode[$i]); $j++) {
                        if($implodeJawabanYa == $penyakitNode[$i][$j]['gejala']) {
                            $match[$penyakitNode[$i][$j]['id_ms_penyakit']] = 0;
                        } else {
                            $match[$penyakitNode[$i][$j]['id_ms_penyakit']] = 1;
                        }
                    }
                }

                // cek apakah ada nilai 0 dalam setiap kecocokan node
                foreach($match as $key => $value) {
                    if($value == 0) {
                        $cekPenyakit = $key;
                    }
                }

                if(empty($cekPenyakit)) {
                    $penyakit = [];
                    foreach ($match as $key => $value) {
                        $penyakit[] = $this->getPenyakit($key);
                    }
                    $kemungkinan = 0;
                } else {
                    $penyakit = [];
                    $penyakit[] = $this->getPenyakit($cekPenyakit);
                    $kemungkinan = 1;
                }
            } else {
                $penyakit = [];
                $kemungkinan = 1;
            }

            // mapping jawaban iya
            $jawabanYa = [];
            foreach ($nodeJawabanYa as $value) {
                $jawabanYa[] = $this->getGejala($value);
            }
        } else {
            $penyakit = [];
            $jawabanYa = [];
        }

        $data = [
            'jawabanYa' => $jawabanYa,
            'penyakit' => $penyakit,
            'kemungkinan' => $kemungkinan
        ];

        return $data;
    }
}