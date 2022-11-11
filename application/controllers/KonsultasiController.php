<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('MainController.php');

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
        $this->gejalaSekarang = implode(',', $gejala);
    }

    private function getGejalaSekarang()
    {
        return $this->gejalaSekarang;
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

    private function forwardChainning($gejala)
    {
        // masukkan gejala dengan jawaban ya ke gejala sebelum nya
        // ex : G1
        $this->setGejalaSebelum($gejala);

        // gabungkan semua gejala jawaban ya mulai dari gejala sebelumnya
        // G1->G2 dst sampai gejala yang dipilih habis
        $this->setGejalaSekarang($this->gejalaSebelum);

        // node gabungan gejala sekarang
        $whereLike = $this->getGejalaSekarang() . '%';

        // query ke tabel aturan sesuai node yang sudah digabung menjadi satu
        $sqlAturan = "select*from aturan where gejala like '$whereLike'";
        $queryAturan = $this->db->query($sqlAturan)->result_array();
        return $queryAturan;
    }

    public function index()
    {
        if (!$this->session->userdata('logged')) {
            redirect('auth/');
        }

        $id_user = $this->session->userdata('id_user');
        $this->fc->removeTempKonsultasi($id_user);

        $sql = "select*from ms_gejala where id_ms_gejala = 1 and is_utama = 1";
        $gejala = $this->db->query($sql)->row_array();
        $layout = 'konsultasi/index';
        $data = [
            'parent_gejala' => 0,
            'gejala' => $gejala,
            'action' => base_url() . 'konsultasi/nextQuestion'
        ];
        $this->getLayout($layout, $data);
    }

    public function nextQuestion()
    {
        if (!$this->session->userdata('logged')) {
            redirect('auth/');
        }

        $post = $this->input->post();
        $id_user = $this->session->userdata('id_user');

        if (!isset($post['answer'])) {
            die("silahkan memilih jawaban terlebih dahulu");
        }

        if ($post['parent_gejala'] == 0) {
            $parent_gejala = NULL;
        } else {
            $parent_gejala = $post['parent_gejala'];
        }

        $check_tmp_konsultasi_exist = $this->db->select('*')->from('tmp_konsultasi')->where([
            'id_user' => $id_user,
            'id_ms_gejala' => $post['child_gejala'],
            'id_prev_gejala' => $parent_gejala,
        ])->get()->row_array();

        if (empty($check_tmp_konsultasi_exist)) {
            $this->db->trans_begin();
            try {
                $insert_tmp_konsultasi = [
                    'id_ms_gejala' => $post['child_gejala'],
                    'id_prev_gejala' => $parent_gejala,
                    'id_user' => $id_user,
                    'answer' => $post['answer']
                ];
                $this->db->insert('tmp_konsultasi', $insert_tmp_konsultasi);
                $this->db->trans_commit();
            } catch (Exception $e) {
                $this->db->trans_rollback();
            }
        }

        $konsul = $this->db->select('*')->from('tmp_konsultasi')->where([
            'id_user' => $id_user
        ])->get()->result_array();

        if ($post['parent_gejala'] == 0 && $post['answer'] == 1) {
            $sql = "select*from ms_gejala where is_utama = 1 and id_ms_gejala != 1 and id_ms_gejala not in (select id_ms_gejala from tmp_konsultasi) order by id_ms_gejala asc limit 1";
            $gejala = $this->db->query($sql)->row_array();

            if (empty($gejala)) {
                $layout = 'konsultasi/form_konsultasi';
                $data = [
                    'konsultasi' => $this->mappingKonsultasi($konsul),
                    'action' => base_url() . "konsultasi/store",
                    'penyakit' => NULL
                ];
                $this->getLayout($layout, $data);
            } else {
                $layout = 'konsultasi/index';
                $data = [
                    'parent_gejala' => 0,
                    'gejala' => $gejala,
                    'action' => base_url() . 'konsultasi/nextQuestion'
                ];
                $this->getLayout($layout, $data);
            }
        } else if ($post['parent_gejala'] == 0 && $post['answer'] == 0) {
            $sql_aturan = "select*from rule_breadth where parent_ms_gejala = " . $post['child_gejala'] . " and child_ms_gejala not in (select id_ms_gejala from tmp_konsultasi) order by child_ms_gejala asc limit 1";
            $aturan = $this->db->query($sql_aturan)->row_array();

            $sql_gejala = "select*from ms_gejala where id_ms_gejala = " . $aturan['child_ms_gejala'];
            $gejala = $this->db->query($sql_gejala)->row_array();

            $data = [
                'gejala' => $gejala,
                'parent_gejala' => $post['child_gejala'],
                'action' => base_url() . 'konsultasi/nextQuestion'
            ];
            $layout = 'konsultasi/index';
            $this->getLayout($layout, $data);
        } else {
            if ($post['answer'] == 0) {

                // cek penyakit
                $sql_cek_penyakit = "select*from rule_breadth where parent_ms_gejala = " . $post['parent_gejala'] . " and child_ms_gejala = " . $post['child_gejala'];
                $cek_penyakit = $this->db->query($sql_cek_penyakit)->row_array();

                if (!empty($cek_penyakit)) {
                    if ($cek_penyakit['id_ms_penyakit'] != null) {
                        // die("Penyakit ketemu");
                        $layout = 'konsultasi/form_konsultasi';
                        $data = [
                            'konsultasi' => $this->mappingKonsultasi($konsul),
                            'action' => base_url() . "konsultasi/store",
                            'penyakit' => $this->mappingPenyakit($cek_penyakit['id_ms_penyakit']),
                        ];
                        $this->getLayout($layout, $data);
                    } else {
                        // jika penyakit == null maka lanjut mencari gejala selanjutnya
                        $sql_aturan = "select*from rule_breadth where parent_ms_gejala = " . $post['child_gejala'] . " and child_ms_gejala not in (select id_ms_gejala from tmp_konsultasi) order by child_ms_gejala asc limit 1";
                        $aturan = $this->db->query($sql_aturan)->row_array();

                        if (empty($aturan)) {
                            $sql_cek_penyakit = "select*from rule_breadth where parent_ms_gejala = " . $post['child_gejala'] . "";
                            $cek_penyakit = $this->db->query($sql_cek_penyakit)->row_array();

                            $layout = 'konsultasi/form_konsultasi';
                            $data = [
                                'konsultasi' => $this->mappingKonsultasi($konsul),
                                'action' => base_url() . "konsultasi/store",
                                'penyakit' => $this->mappingPenyakit($cek_penyakit['id_ms_penyakit']),
                            ];
                            $this->getLayout($layout, $data);
                        } else {
                            $sql_gejala = "select*from ms_gejala where id_ms_gejala = " . $aturan['child_ms_gejala'];
                            $gejala = $this->db->query($sql_gejala)->row_array();

                            $data = [
                                'gejala' => $gejala,
                                'parent_gejala' => $post['child_gejala'],
                                'action' => base_url() . 'konsultasi/nextQuestion'
                            ];
                            $layout = 'konsultasi/index';
                            $this->getLayout($layout, $data);
                        }
                    }
                } else {
                    // jika penyakit == null maka lanjut mencari gejala selanjutnya
                    $sql_aturan = "select*from rule_breadth where parent_ms_gejala = " . $post['child_gejala'] . " and child_ms_gejala not in (select id_ms_gejala from tmp_konsultasi) order by child_ms_gejala asc limit 1";
                    $aturan = $this->db->query($sql_aturan)->row_array();

                    $sql_gejala = "select*from ms_gejala where id_ms_gejala = " . $aturan['child_ms_gejala'];
                    $gejala = $this->db->query($sql_gejala)->row_array();

                    $data = [
                        'gejala' => $gejala,
                        'parent_gejala' => $post['child_gejala'],
                        'action' => base_url() . 'konsultasi/nextQuestion'
                    ];
                    $layout = 'konsultasi/index';
                    $this->getLayout($layout, $data);
                }
            } else if ($post['answer'] == 1) {
                $sql_aturan = "select*from rule_breadth where parent_ms_gejala = " . $post['parent_gejala'] . " and child_ms_gejala not in (select id_ms_gejala from tmp_konsultasi) order by child_ms_gejala asc limit 1";
                $aturan = $this->db->query($sql_aturan)->row_array();

                if (!empty($aturan)) {

                    if ($aturan['id_ms_penyakit'] != null) {
                        $layout = 'konsultasi/form_konsultasi';
                        $data = [
                            'konsultasi' => $this->mappingKonsultasi($konsul),
                            'action' => base_url() . "konsultasi/store",
                            'penyakit' => $this->mappingPenyakit($aturan['id_ms_penyakit'])
                        ];
                        $this->getLayout($layout, $data);
                    } else {
                        $sql_gejala = "select*from ms_gejala where id_ms_gejala = " . $aturan['child_ms_gejala'];
                        $gejala = $this->db->query($sql_gejala)->row_array();

                        $data = [
                            'gejala' => $gejala,
                            'parent_gejala' => $post['parent_gejala'],
                            'action' => base_url() . 'konsultasi/nextQuestion'
                        ];
                        $layout = 'konsultasi/index';
                        $this->getLayout($layout, $data);
                    }
                } else {
                    // $this->maintence->Debug($post['child_gejala']);
                    $sql_aturan = "select*from rule_breadth where parent_ms_gejala = " . $post['parent_gejala'] . " and child_ms_gejala not in (select id_ms_gejala from tmp_konsultasi) order by child_ms_gejala asc limit 1";
                    $aturan = $this->db->query($sql_aturan)->row_array();

                    $layout = 'konsultasi/form_konsultasi';
                    $data = [
                        'konsultasi' => $this->mappingKonsultasi($konsul),
                        'action' => base_url() . "konsultasi/store",
                        'penyakit' => NULL
                    ];
                    $this->getLayout($layout, $data);
                }
            }
        }
    }

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
