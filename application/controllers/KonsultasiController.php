<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('MainController.php');
require_once("Formula.php");

class KonsultasiController extends MainController
{

    protected $gejalaSekarang;
    protected $gejalaSebelum;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('GejalaModel', 'gejala');
        $this->load->model('PenyakitModel', 'penyakit');
        $this->load->model('KonsultasiModel', 'konsultasi');
        $this->load->model('ForwardChainningModel', 'fc');
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
        if (count($gejala) > 1) {
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
        $sqlGejala = "select*from ms_gejala left join ms_kategori_gejala on ms_kategori_gejala.id_ms_kategori_gejala = ms_gejala.id_ms_kategori_gejala where id_ms_gejala = $id";
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
            $exp = explode(",", $value['gejala']);
            if (in_array($gejala, $exp)) {
                $data[] = $queryAturan[$key];
            }
        }
        return $data;
    }

    private function getForwardChainning($answer)
    {
        $nodeJawabanYa = [];
        $penyakitNode = [];

        foreach ($answer as $key => $value) {
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

        if (!empty($nodeJawabanYa)) {
            $implodeJawabanYa = implode(',', $nodeJawabanYa);
            if (!empty($penyakitNode)) {
                // cocokan node dan hasil query dari aturan
                $match = [];
                for ($i = 0; $i < count($penyakitNode); $i++) {
                    for ($j = 0; $j < count($penyakitNode[$i]); $j++) {
                        if ($implodeJawabanYa == $penyakitNode[$i][$j]['gejala']) {
                            $match[$penyakitNode[$i][$j]['id_ms_penyakit']] = 0;
                        } else {
                            $match[$penyakitNode[$i][$j]['id_ms_penyakit']] = 1;
                        }
                    }
                }

                // cek apakah ada nilai 0 dalam setiap kecocokan node
                foreach ($match as $key => $value) {
                    if ($value == 0) {
                        $cekPenyakit = $key;
                    }
                }

                if (empty($cekPenyakit)) {
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

    private function mappingKonsultasi($data)
    {
        $konsultasi = [];
        foreach ($data as $key => $value) {
            $row = [];
            $row['kode_gejala'] = $this->gejala->getGejala($value['id_ms_gejala'], 'kode_gejala');
            $row['nama_gejala'] = $this->gejala->getGejala($value['id_ms_gejala'], 'nama_gejala');
            if ($value['answer'] == 0) {
                $answer = 'Ya';
            } else if ($value['answer'] == 1) {
                $answer = 'Tidak';
            }
            $row['answer'] = $answer;
            $konsultasi[] = $row;
        }
        return $konsultasi;
    }

    private function mappingPenyakit($data)
    {
        $penyakit = [];
        $penyakit['id_ms_penyakit'] = $this->penyakit->getPenyakit($data, 'id_ms_penyakit');
        $penyakit['kode_penyakit'] = $this->penyakit->getPenyakit($data, 'kode_penyakit');
        $penyakit['nama_penyakit'] = $this->penyakit->getPenyakit($data, 'nama_penyakit');
        $penyakit['solusi_penyakit'] = $this->penyakit->getPenyakit($data, 'solusi_penyakit');
        return $penyakit;
    }

    // public function index()
    // {
    //     if (!$this->session->userdata('logged')) {
    //         redirect('auth/');
    //     }

    //     $id_user = $this->session->userdata('id_user');
    //     $this->fc->removeTempKonsultasi($id_user);

    //     $sql = "select*from ms_gejala where id_ms_gejala = 1 and is_utama = 1";
    //     $gejala = $this->db->query($sql)->row_array();
    //     $layout = 'konsultasi/index';
    //     $data = [
    //         'parent_gejala' => 0,
    //         'gejala' => $gejala,
    //         'action' => base_url() . 'konsultasi/nextQuestion'
    //     ];
    //     $this->getLayout($layout, $data);
    // }

    public function index()
    {
        if (!$this->session->userdata('logged')) {
            redirect('auth/');
        }

        $id_user = $this->session->userdata('id_user');
        $this->fc->removeTempKonsultasi($id_user);

        $gejala = $this->konsultasi->getAllGejalaGrouping();
        // $this->maintence->Debug($gejala);
        $layout = 'konsultasi/index';
        $data = [
            // 'parent_gejala' => 0,
            'gejala' => $gejala,
            'action' => base_url() . 'konsultasi/result'
        ];
        $this->getLayout($layout, $data);
    }

    public function result()
    {
        $post = $this->input->post();
        if (!empty($post['jawaban']) && count($post['jawaban']) >= 3) {
            $forward_chainning = $this->getForwardChainning($post['jawaban']);
            $data = [
                // 'parent_gejala' => 0,
                'konsultasi' => $forward_chainning,
                'action' => base_url() . 'konsultasi/saveResult'
            ];
            $layout = 'konsultasi/konsultasi_view';
            $this->getLayout($layout, $data);
        } else {
            $validation = [
                'validation' => "Silahkan memilih minimal 3 gejala"
            ];
            $this->session->set_userdata($validation);
            redirect('konsultasi/');
        }
    }

    // public function nextQuestion()
    // {
    //     if (!$this->session->userdata('logged')) {
    //         redirect('auth/');
    //     }

    //     $post = $this->input->post();
    //     $id_user = $this->session->userdata('id_user');

    //     if (!isset($post['answer'])) {
    //         die("silahkan memilih jawaban terlebih dahulu");
    //     }

    //     if ($post['parent_gejala'] == 0) {
    //         $parent_gejala = NULL;
    //     } else {
    //         $parent_gejala = $post['parent_gejala'];
    //     }

    //     $check_tmp_konsultasi_exist = $this->db->select('*')->from('tmp_konsultasi')->where([
    //         'id_user' => $id_user,
    //         'id_ms_gejala' => $post['child_gejala'],
    //         'id_prev_gejala' => $parent_gejala,
    //     ])->get()->row_array();

    //     if (empty($check_tmp_konsultasi_exist)) {
    //         $this->db->trans_begin();
    //         try {
    //             $insert_tmp_konsultasi = [
    //                 'id_ms_gejala' => $post['child_gejala'],
    //                 'id_prev_gejala' => $parent_gejala,
    //                 'id_user' => $id_user,
    //                 'answer' => $post['answer']
    //             ];
    //             $this->db->insert('tmp_konsultasi', $insert_tmp_konsultasi);
    //             $this->db->trans_commit();
    //         } catch (Exception $e) {
    //             $this->db->trans_rollback();
    //         }
    //     }

    //     $konsul = $this->db->select('*')->from('tmp_konsultasi')->where([
    //         'id_user' => $id_user
    //     ])->get()->result_array();

    //     if ($post['parent_gejala'] == 0 && $post['answer'] == 1) {
    //         $sql = "select*from ms_gejala where is_utama = 1 and id_ms_gejala != 1 and id_ms_gejala not in (select id_ms_gejala from tmp_konsultasi) order by id_ms_gejala asc limit 1";
    //         $gejala = $this->db->query($sql)->row_array();

    //         if (empty($gejala)) {
    //             $layout = 'konsultasi/form_konsultasi';
    //             $data = [
    //                 'konsultasi' => $this->mappingKonsultasi($konsul),
    //                 'action' => base_url() . "konsultasi/store",
    //                 'penyakit' => NULL
    //             ];
    //             $this->getLayout($layout, $data);
    //         } else {
    //             $layout = 'konsultasi/index';
    //             $data = [
    //                 'parent_gejala' => 0,
    //                 'gejala' => $gejala,
    //                 'action' => base_url() . 'konsultasi/nextQuestion'
    //             ];
    //             $this->getLayout($layout, $data);
    //         }
    //     } else if ($post['parent_gejala'] == 0 && $post['answer'] == 0) {
    //         $sql_aturan = "select*from rule_breadth where parent_ms_gejala = " . $post['child_gejala'] . " and child_ms_gejala not in (select id_ms_gejala from tmp_konsultasi) order by child_ms_gejala asc limit 1";
    //         $aturan = $this->db->query($sql_aturan)->row_array();

    //         $sql_gejala = "select*from ms_gejala where id_ms_gejala = " . $aturan['child_ms_gejala'];
    //         $gejala = $this->db->query($sql_gejala)->row_array();

    //         $data = [
    //             'gejala' => $gejala,
    //             'parent_gejala' => $post['child_gejala'],
    //             'action' => base_url() . 'konsultasi/nextQuestion'
    //         ];
    //         $layout = 'konsultasi/index';
    //         $this->getLayout($layout, $data);
    //     } else {
    //         if ($post['answer'] == 0) {

    //             // cek penyakit
    //             $sql_cek_penyakit = "select*from rule_breadth where parent_ms_gejala = " . $post['parent_gejala'] . " and child_ms_gejala = " . $post['child_gejala'];
    //             $cek_penyakit = $this->db->query($sql_cek_penyakit)->row_array();

    //             if (!empty($cek_penyakit)) {
    //                 if ($cek_penyakit['id_ms_penyakit'] != null) {
    //                     // die("Penyakit ketemu");
    //                     $layout = 'konsultasi/form_konsultasi';
    //                     $data = [
    //                         'konsultasi' => $this->mappingKonsultasi($konsul),
    //                         'action' => base_url() . "konsultasi/store",
    //                         'penyakit' => $this->mappingPenyakit($cek_penyakit['id_ms_penyakit']),
    //                     ];
    //                     $this->getLayout($layout, $data);
    //                 } else {
    //                     // jika penyakit == null maka lanjut mencari gejala selanjutnya
    //                     $sql_aturan = "select*from rule_breadth where parent_ms_gejala = " . $post['child_gejala'] . " and child_ms_gejala not in (select id_ms_gejala from tmp_konsultasi) order by child_ms_gejala asc limit 1";
    //                     $aturan = $this->db->query($sql_aturan)->row_array();

    //                     if (empty($aturan)) {
    //                         $sql_cek_penyakit = "select*from rule_breadth where parent_ms_gejala = " . $post['child_gejala'] . "";
    //                         $cek_penyakit = $this->db->query($sql_cek_penyakit)->row_array();

    //                         $layout = 'konsultasi/form_konsultasi';
    //                         $data = [
    //                             'konsultasi' => $this->mappingKonsultasi($konsul),
    //                             'action' => base_url() . "konsultasi/store",
    //                             'penyakit' => $this->mappingPenyakit($cek_penyakit['id_ms_penyakit']),
    //                         ];
    //                         $this->getLayout($layout, $data);
    //                     } else {
    //                         $sql_gejala = "select*from ms_gejala where id_ms_gejala = " . $aturan['child_ms_gejala'];
    //                         $gejala = $this->db->query($sql_gejala)->row_array();

    //                         $data = [
    //                             'gejala' => $gejala,
    //                             'parent_gejala' => $post['child_gejala'],
    //                             'action' => base_url() . 'konsultasi/nextQuestion'
    //                         ];
    //                         $layout = 'konsultasi/index';
    //                         $this->getLayout($layout, $data);
    //                     }
    //                 }
    //             } else {
    //                 // jika penyakit == null maka lanjut mencari gejala selanjutnya
    //                 $sql_aturan = "select*from rule_breadth where parent_ms_gejala = " . $post['child_gejala'] . " and child_ms_gejala not in (select id_ms_gejala from tmp_konsultasi) order by child_ms_gejala asc limit 1";
    //                 $aturan = $this->db->query($sql_aturan)->row_array();

    //                 $sql_gejala = "select*from ms_gejala where id_ms_gejala = " . $aturan['child_ms_gejala'];
    //                 $gejala = $this->db->query($sql_gejala)->row_array();

    //                 $data = [
    //                     'gejala' => $gejala,
    //                     'parent_gejala' => $post['child_gejala'],
    //                     'action' => base_url() . 'konsultasi/nextQuestion'
    //                 ];
    //                 $layout = 'konsultasi/index';
    //                 $this->getLayout($layout, $data);
    //             }
    //         } else if ($post['answer'] == 1) {
    //             $sql_aturan = "select*from rule_breadth where parent_ms_gejala = " . $post['parent_gejala'] . " and child_ms_gejala not in (select id_ms_gejala from tmp_konsultasi) order by child_ms_gejala asc limit 1";
    //             $aturan = $this->db->query($sql_aturan)->row_array();

    //             if (!empty($aturan)) {

    //                 if ($aturan['id_ms_penyakit'] != null) {
    //                     $layout = 'konsultasi/form_konsultasi';
    //                     $data = [
    //                         'konsultasi' => $this->mappingKonsultasi($konsul),
    //                         'action' => base_url() . "konsultasi/store",
    //                         'penyakit' => $this->mappingPenyakit($aturan['id_ms_penyakit'])
    //                     ];
    //                     $this->getLayout($layout, $data);
    //                 } else {
    //                     $sql_gejala = "select*from ms_gejala where id_ms_gejala = " . $aturan['child_ms_gejala'];
    //                     $gejala = $this->db->query($sql_gejala)->row_array();

    //                     $data = [
    //                         'gejala' => $gejala,
    //                         'parent_gejala' => $post['parent_gejala'],
    //                         'action' => base_url() . 'konsultasi/nextQuestion'
    //                     ];
    //                     $layout = 'konsultasi/index';
    //                     $this->getLayout($layout, $data);
    //                 }
    //             } else {
    //                 // $this->maintence->Debug($post['child_gejala']);
    //                 $sql_aturan = "select*from rule_breadth where parent_ms_gejala = " . $post['parent_gejala'] . " and child_ms_gejala not in (select id_ms_gejala from tmp_konsultasi) order by child_ms_gejala asc limit 1";
    //                 $aturan = $this->db->query($sql_aturan)->row_array();

    //                 $layout = 'konsultasi/form_konsultasi';
    //                 $data = [
    //                     'konsultasi' => $this->mappingKonsultasi($konsul),
    //                     'action' => base_url() . "konsultasi/store",
    //                     'penyakit' => NULL
    //                 ];
    //                 $this->getLayout($layout, $data);
    //             }
    //         }
    //     }
    // }

    // public function store()
    // {
    //     $post = $this->input->post();
    //     $id_user = $this->session->userdata('id_user');

    //     $konsultasi = $this->konsultasi->getTempKonsultasi($id_user);
    //     $param = [
    //         "id_user" => $id_user,
    //         "id_penyakit" => $post['id_penyakit'],
    //         "tanggal_konsultasi" => date('Y-m-d'),
    //         "konsultasi" => $konsultasi
    //     ];
    //     $insert_konsultasi = $this->konsultasi->storeKonsultasi($param);
    //     if ($insert_konsultasi) {
    //         $this->fc->removeTempKonsultasi($id_user);
    //         $response = [
    //             'status' => 200,
    //             'messages' => "Konsultasi berhasil disimpan",
    //             'url' => base_url()
    //         ];
    //     } else {
    //         $response = [
    //             'status' => 200,
    //             'messages' => "Konsultasi gagal disimpan"
    //         ];
    //     }
    //     echo json_encode($response);
    // }

    public function store()
    {
        $post = $this->input->post();
        $id_user = $this->session->userdata('id_user');

        $konsultasi = $this->konsultasi->getTempKonsultasi($id_user);
        $param = [
            "id_user" => $id_user,
            "id_penyakit" => $post['id_penyakit'],
            "tanggal_konsultasi" => date('Y-m-d'),
            "konsultasi" => $konsultasi
        ];
        $insert_konsultasi = $this->konsultasi->storeKonsultasi($param);
        if ($insert_konsultasi) {
            $this->fc->removeTempKonsultasi($id_user);
            $response = [
                'status' => 200,
                'messages' => "Konsultasi berhasil disimpan",
                'url' => base_url()
            ];
        } else {
            $response = [
                'status' => 200,
                'messages' => "Konsultasi gagal disimpan"
            ];
        }
        echo json_encode($response);
    }

    public function ajax()
    {
        $konsultasi = $this->konsultasi->getAllKonsultasi();
        $no = 1;
        $record = [];
        foreach ($konsultasi as $value) {
            $row = [];
            $row[] = $no;
            $row[] = $value['nama_pemilik_hewan'];
            $row[] = $value['nama_hewan'];
            $row[] = $value['usia_hewan'];
            $row[] = $value['tanggal_konsultasi'];
            $row[] = '<button type="button" name="lihat" action="' . base_url() . 'rep_konsultasi/' . $value['id'] . '" class="btn-lihat btn btn-flat btn-primary btn-sm"><i class = "fa fa-eye"></i> Lihat Hasil</button> ';
            $no++;
            $record[] = $row;
        }
        echo json_encode([
            'data' => $record
        ]);
    }

    public function indexReport()
    {
        if (!$this->session->userdata('logged') || $this->session->userdata('role') != 1) {
            redirect('auth/');
        }
        $layout = 'konsultasi/list_report';
        $this->getLayout($layout);
    }

    public function getReport($id)
    {
        $layout = 'konsultasi/konsultasi_view';
        $konsultasi = $this->konsultasi->getAllKonsultasi($id);
        $data = [
            'konsultasi' => $konsultasi,
        ];
        $this->load->view($layout, $data);
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
}
