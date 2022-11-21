<?php

defined('BASEPATH') or exit('No direct script access allowed');

class GejalaModel extends CI_Model
{

    protected $test;

    public function getAllGejala()
    {
        $sql = $this->db->select('*')->from('ms_gejala')->join('ms_kategori_gejala', 'ms_kategori_gejala.id_ms_kategori_gejala = ms_gejala.id_ms_kategori_gejala', 'left')->get();
        $query = $sql->result_array();
        return $query;
    }

    public function getGejala($id, $attr = null)
    {
        $sql = $this->db->select('*')->from('ms_gejala')->where(['id_ms_gejala' => $id])->get();
        $query = $sql->row_array();
        if ($attr == null) {
            return $query;
        }
        return $query[$attr];
    }

    public function store()
    {
        $post = $this->input->post();

        $this->form_validation->set_rules('nama_gejala', 'Nama Gejala', 'required');

        if ($this->form_validation->run()) {

            // check data gejala jika tidak ada maka id dimulai dari 1 dan kode G1
            $sql = $this->db->select('id_ms_gejala')->from('ms_gejala')->order_by('id_ms_gejala', 'desc')->limit(1)->get();
            $query = $sql->row_array();

            if (empty($query['id_ms_gejala'])) {
                $id = 1;
                $kodeGejala = 'G01';
            } else {
                $id = $query['id_ms_gejala'] + 1;
                if ($id < 10) {
                    $kodeGejala = 'G0' . $id;
                } else {
                    $kodeGejala = 'G' . $id;
                }
            }

            $data = [
                'id_ms_gejala' => $id,
                'id_ms_kategori_gejala' => $post['id_ms_kategori_gejala'],
                'kode_gejala' => $kodeGejala,
                'nama_gejala' => ucwords($post['nama_gejala']),
            ];

            $this->db->trans_begin();

            try {
                $this->db->insert('ms_gejala', $data);
            } catch (Exception $e) {

                $this->db->trans_rollback();
                return [
                    'status' => false,
                    'messages' => 'Error ' . $e->getMessage()
                ];
            }

            $this->db->trans_commit();
            return [
                'status' => true,
                'messages' => 'Data Sukses Diinput'
            ];
        } else {
            return [
                'status' => false,
                'messages' => validation_errors()
            ];
        }
    }

    public function update($id)
    {
        $post = $this->input->post();

        $this->form_validation->set_rules('nama_gejala', 'Nama Gejala', 'required');

        if ($this->form_validation->run()) {

            $data = [
                'nama_gejala' => ucwords($post['nama_gejala']),
                'id_ms_kategori_gejala' => $post['id_ms_kategori_gejala'],
            ];

            $this->db->trans_begin();

            try {

                $this->db->where(['id_ms_gejala' => $id])->update('ms_gejala', $data);
            } catch (Exception $e) {

                $this->db->trans_rollback();
                return [
                    'status' => false,
                    'messages' => 'Error ' . $e->getMessage()
                ];
            }

            $this->db->trans_commit();
            return [
                'status' => true,
                'messages' => 'Data Sukses Diubah'
            ];
        } else {
            return [
                'status' => false,
                'messages' => validation_errors()
            ];
        }
    }

    public function destroy($id)
    {
        $this->db->where(['id_ms_gejala' => $id])->delete('ms_gejala');
        return [
            'status' => true,
            'messages' => 'Data Sukses Dihapus'
        ];
    }

    private function checkIfExists($value)
    {
        $sql = $this->db->select('kode_gejala')->from('ms_gejala')->where(['kode_gejala' => $value])->get();
        $query = $sql->row_array();

        if (empty($query)) {
            return false;
        } else {
            return true;
        }
    }

    public function importExcel($data)
    {
        $row = [];
        $record = [];

        $this->db->trans_start();

        try {
            foreach ($data as $value) {

                $checkIfExists = $this->checkIfExists(ucwords($value[0]));

                if ($checkIfExists == false) {
                    $sql = $this->db->select('id_ms_gejala')->from('ms_gejala')->order_by('id_ms_gejala', 'desc')->limit(1)->get();
                    $query = $sql->row_array();

                    if (empty($query['id_ms_gejala'])) {
                        $id = 1;
                        $kodeGejala = $value[0] == "" ? 'G01' : $value[0];
                    } else {
                        $id = $query['id_ms_gejala'] + 1;
                        if ($id < 100) {
                            $kodeGejala = $value[0] == "" ? 'G0' . $id : $value[0];
                        } else {
                            $kodeGejala = $value[0] == "" ? 'G' . $id : $value[0];
                        }
                    }

                    $row['id_ms_gejala'] = $id;
                    $row['kode_gejala'] = $kodeGejala;
                    $row['nama_gejala'] = ucwords($value[1]);

                    $this->db->insert('ms_gejala', $row);
                }
            }
        } catch (Exception $e) {
            $this->db->trans_rollback();
            return [
                'status' => false,
                'messages' => 'Error ' . $e->getMessage()
            ];
        }

        $this->db->trans_commit();

        return [
            'status' => true,
            'messages' => 'Data Sukses Diimport'
        ];
    }
}
