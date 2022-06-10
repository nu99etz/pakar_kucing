<?php

defined('BASEPATH') or exit('No direct script access allowed');

class GejalaModel extends CI_Model
{

    protected $test;

    public function getAllGejala()
    {
        $sql = $this->db->select('*')->from('gejala')->get();
        $query = $sql->result_array();
        return $query;
    }

    public function getGejala($id, $attr = null)
    {
        $sql = $this->db->select('*')->from('gejala')->where(['id' => $id])->get();
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
            $sql = $this->db->select('id')->from('gejala')->order_by('id', 'desc')->limit(1)->get();
            $query = $sql->row_array();

            if (empty($query['id'])) {
                $id = 1;
                $kodeGejala = 'G01';
            } else {
                $id = $query['id'] + 1;
                if ($id < 100) {
                    $kodeGejala = 'G0' . $id;
                } else {
                    $kodeGejala = 'G' . $id;
                }
            }

            if($post['penjelasan_gejala'] == '') {
                $penjelasanGejala = '';
            } else {
                $penjelasanGejala = $post['penjelasan_gejala'];
            }

            $data = [
                'id' => $id,
                'kode_gejala' => $kodeGejala,
                'nama_gejala' => ucwords($post['nama_gejala']),
                'penjelasan_gejala' => $penjelasanGejala
            ];

            $this->db->trans_begin();

            try {

                $this->db->insert('gejala', $data);
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

            if($post['penjelasan_gejala'] == '') {
                $penjelasanGejala = '';
            } else {
                $penjelasanGejala = $post['penjelasan_gejala'];
            }

            $data = [
                'nama_gejala' => ucwords($post['nama_gejala']),
                'penjelasan_gejala' => $penjelasanGejala,
            ];

            $this->db->trans_begin();

            try {

                $this->db->where(['id' => $id])->update('gejala', $data);
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
        $this->db->where(['id' => $id])->delete('gejala');
        return [
            'status' => true,
            'messages' => 'Data Sukses Dihapus'
        ];
    }

    private function checkIfExists($value)
    {
        $sql = $this->db->select('kode_gejala')->from('gejala')->where(['nama_gejala' => $value])->get();
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
        foreach ($data as $value) {

            $checkIfExists = $this->checkIfExists(ucwords($value[0]));

            if ($checkIfExists == false) {
                $sql = $this->db->select('id')->from('gejala')->order_by('id', 'desc')->limit(1)->get();
                $query = $sql->row_array();

                if (empty($query['id'])) {
                    $id = 1;
                    $kodeGejala = 'G01';
                } else {
                    $id = $query['id'] + 1;
                    if ($id < 100) {
                        $kodeGejala = 'G0' . $id;
                    } else {
                        $kodeGejala = 'G' . $id;
                    }
                }

                $row['id'] = $id;
                $row['kode_gejala'] = $kodeGejala;
                $row['nama_gejala'] = ucwords($value[0]);
                

                $this->db->trans_start();

                try {
                    $this->db->insert('gejala', $row);
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

        return [
            'status' => true,
            'messages' => 'Data Sukses Diimport'
        ];
    }
}
