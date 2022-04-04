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

        $gejala = $this->gejala->getAllGejala();
        $konsultasiIDExist = $this->konsultasi->checkIDExist();
        $layout = 'konsultasi/index';
        $data = [
            'gejala' => $gejala,
            'action' => base_url() . 'konsultasi/store',
            'idKonsul' => $konsultasiIDExist
        ];
        $this->getLayout($layout, $data);
    }

    public function store()
    {
        $post = $this->input->post();

        if ($post['nama_pemilik_hewan'] == "" || $post['nama_hewan'] == "") {
            $url = base_url() . 'konsultasi';
            $this->session->set_userdata([
                'validation' => 'Silahkan untuk mengisi data diri terlebih dahulu'
            ]);
            redirect($url);
        }

        $nodeJawabanYa = [];
        $penyakitNode = [];
        foreach ($post['jawaban'] as $key => $value) {
            // cek semua jawaban node jika jawaban ya maka gabung node menjadi satu
            if (isset($value)) {
                if ($value == 0) {
                    $nodeJawabanYa[] = $key;
                    $penyakit = $this->forwardChainning($key);

                    if (!empty($penyakit)) {
                        $penyakitNode[] = $penyakit;
                        $nodeAkhir = $penyakit;
                    }
                }
            }
        }

        if (count($nodeJawabanYa) >= 6) {
            $implodeJawabanYa = implode(',', $nodeJawabanYa);

            if (!empty($nodeAkhir)) {
                // cocokan node dan hasil query dari aturan
                $cocok = [];
                foreach ($nodeAkhir as $value) {
                    if ($implodeJawabanYa == $value['gejala']) {
                        // jika cocok berikan nilai 0
                        $cocok[$value['id_penyakit']] = 0;
                    } else {
                        // jika tidak cocok beri nilai 1
                        $cocok[$value['id_penyakit']] = 1;
                    }
                }

                // $this->maintence->Debug($cocok);

                // cek apakah ada nilai 0 dalam setiap kecocokan node
                foreach ($cocok as $key => $value) {
                    if ($value == 0) {
                        $cekPenyakit = $key;
                    }
                }

                // jika setiap node tidak kecocokan maka tampilkan semua aturan yang diperoleh dari node tersebut sehingga akan menampilkan beberapa penyakit dikarenakan tidak ada kecocokan antar node
                if (empty($cekPenyakit)) {
                    $penyakit = [];
                    foreach ($cocok as $key => $value) {
                        $penyakit[] = $this->penyakit->getPenyakit($key);
                    }
                    $kemungkinan = 0;
                } else {
                    $penyakit = [];
                    $penyakit[] = $this->penyakit->getPenyakit($cekPenyakit);
                    $kemungkinan = 1;
                }

                $jawabanDipilih = [];
                foreach ($post['jawaban'] as $key => $value) {
                    $gejalaV = $this->gejala->getGejala($key);
                    if ($value == 0) {
                        $jawaban = 'Ya';
                    } else if ($value == 1) {
                        $jawaban = 'Tidak';
                    }
                    $jawabanDipilih[] = [
                        'gejala' => $gejalaV,
                        'jawaban' => $jawaban
                    ];
                }
            } else {
                $penyakit = [];
                $jawabanDipilih = [];
            }

            $data = [
                'jawabanYa' => $jawabanDipilih,
                'penyakit' => $penyakit,
                'kemungkinan' => $kemungkinan,
                'dataDiri' => [
                    'id' => $post['id_konsul'],
                    'nama_pemilik_hewan' => $post['nama_pemilik_hewan'],
                    'nama_hewan' => $post['nama_hewan'],
                    'usia_hewan' => $post['usia_hewan'],
                    'tanggal_konsultasi' => date('Y-m-d'),
                ]
            ];

            // $this->maintence->Debug($data);

            $this->konsultasi->insertKonsultasi($data);

            $layout = 'konsultasi/hasil_konsultasi';

            $this->getLayout($layout, $data);
        } else {
            // jika belum memilih satu gejala keluar alert dan kembali ke menu konsultasi
            $url = base_url() . 'konsultasi';
            $this->session->set_userdata([
                'validation' => 'Silahkan memilih minimal 6 gejala'
            ]);
            redirect($url);
        }
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
