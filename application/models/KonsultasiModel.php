<?php

defined('BASEPATH') or exit('No direct script access allowed');

class KonsultasiModel extends CI_Model
{

    public function getAllKonsultasi($where = null)
    {
        if ($where != null) {
            $konsultasi = $this->db->select('*')->from('konsultasi')->where(['id' => $where])->get()->row_array();
            $detail_gejala = $this->db->query("select a.*, b.* from detail_gejala_konsultasi a left join gejala b on a.id_gejala = b.id where a.id_konsultasi = $where")->result_array();
            $detail_penyakit = $this->db->query("select a.*, b.* from detail_penyakit_konsultasi a left join penyakit b on a.id_penyakit = b.id where a.id_konsultasi = $where")->result_array();
            return [
                'konsultasi' => $konsultasi,
                'detail_gejala' => $detail_gejala,
                'detail_penyakit' => $detail_penyakit
            ];
        }

        $konsultasi = $this->db->select('*')->from('konsultasi')->order_by('tanggal_konsultasi', 'desc')->get();
        return $konsultasi->result_array();
    }

    public function checkIDExist()
    {
        $konsultasi = $this->db->select('id')->from('konsultasi')->order_by('id', 'desc')->get()->row_array();
        // return $konsultasi->row_array();
        if (empty($konsultasi)) {
            $id = 1;
            return $id;
        } else {
            $id = $konsultasi['id'] + 1;
            return $id;
        }
    }

    public function insertKonsultasi($dataKonsultasi)
    {

        $checkID = $this->db->query("select count(id) as total from konsultasi where id = " . $dataKonsultasi['dataDiri']['id'])->row_array();
        if ($checkID['total'] < 1) {

            // insert konsultasi dulu
            $this->db->trans_begin();

            try {

                $this->db->insert('konsultasi', $dataKonsultasi['dataDiri']);

                foreach ($dataKonsultasi['jawabanYa'] as $key => $value) {
                    $dataGejala = [
                        'id_konsultasi' => $dataKonsultasi['dataDiri']['id'],
                        'id_gejala' => $value['gejala']['id'],
                        'jawaban' => $value['jawaban']
                    ];
                    $this->db->insert('detail_gejala_konsultasi', $dataGejala);
                }

                foreach ($dataKonsultasi['penyakit'] as $key => $value) {
                    $dataPenyakit = [
                        'id_konsultasi' => $dataKonsultasi['dataDiri']['id'],
                        'id_penyakit' => $value['id'],
                    ];
                    $this->db->insert('detail_penyakit_konsultasi', $dataPenyakit);
                }
            } catch (Exception $e) {

                $this->db->trans_rollback();
                return [
                    'status' => false,
                    'messages' => 'Error ' . $e->getMessage()
                ];
            }

            $this->db->trans_commit();
        }
    }
}
