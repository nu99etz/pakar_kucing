<?php

defined('BASEPATH') or exit('No direct script access allowed');

class PenyakitModel extends CI_Model
{
    public function getAllPenyakit()
    {
        $sql = $this->db->select('*')->from('ms_penyakit')->get();
        $query = $sql->result_array();
        return $query;
    }

    public function getPenyakit($id, $attr = null)
    {
        $sql = $this->db->select('*')->from('ms_penyakit')->where(['id_ms_penyakit' => $id])->get();
        $query = $sql->row_array();
        if($attr == null) {
            return $query;
        }
        return $query[$attr];
    }

    public function store()
    {
        $post = $this->input->post();

        $this->form_validation->set_rules('nama_penyakit', 'Nama Penyakit', 'required');
        $this->form_validation->set_rules('solusi_penyakit', 'Solusi Penyakit', 'required');

        if ($this->form_validation->run()) {

            // check data penyakit jika tidak ada maka id dimulai dari 1 dan kode P1
            $sql = $this->db->select('id_ms_penyakit')->from('ms_penyakit')->order_by('id_ms_penyakit', 'desc')->limit(1)->get();
            $query = $sql->row_array();

            if (empty($query['id'])) {
                $id = 1;
                $kodePenyakit = 'P1';
            } else {
                $id = $query['id'] + 1;
                $kodePenyakit = 'P' . $id;
            }

            $data = [
                'id_ms_penyakit' => $id,
                'kode_penyakit' => $kodePenyakit,
                'nama_penyakit' => ucwords($post['nama_penyakit']),
                'solusi_penyakit' => $post['solusi_penyakit'],
            ];

            $this->db->trans_begin();
            
            try {

                $this->db->insert('ms_penyakit', $data);

            } catch(Exception $e) {

                $this->db->trans_rollback();
                return [
                    'status' => false,
                    'messages' => 'Error '. $e->getMessage()
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

        $this->form_validation->set_rules('nama_penyakit', 'Nama Penyakit', 'required');
        $this->form_validation->set_rules('solusi_penyakit', 'Pengobatan Penyakit', 'required');

        if ($this->form_validation->run()) {


            $data = [
                'nama_penyakit' => ucwords($post['nama_penyakit']),
                'solusi_penyakit' => $post['solusi_penyakit'],
            ];

            $this->db->trans_begin();
            
            try {

                $this->db->where(['id_ms_penyakit' => $id])->update('ms_penyakit', $data);

            } catch(Exception $e) {

                $this->db->trans_rollback();
                return [
                    'status' => false,
                    'messages' => 'Error '. $e->getMessage()
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
        $this->db->where(['id_ms_penyakit' => $id])->delete('ms_penyakit');
        return [
            'status' => true,
            'messages' => 'Data Sukses Dihapus'
        ];
    }

    private function checkIfExists($value)
    {
        $sql = $this->db->select('kode_penyakit')->from('ms_penyakit')->where(['kode_penyakit' => $value])->get();
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

                if($value[0] == "" && $value[1] == "" && $value[2] == "") {
                    break;
                }

                $checkIfExists = $this->checkIfExists(ucwords($value[0]));

                if ($checkIfExists == false) {
                    $sql = $this->db->select('id_ms_penyakit')->from('ms_penyakit')->order_by('id_ms_penyakit', 'desc')->limit(1)->get();
                    $query = $sql->row_array();

                    if (empty($query['id_ms_penyakit'])) {
                        $id = 1;
                        $kodePenyakit = $value[0] == "" ? 'P01' : $value[0];
                    } else {
                        $id = $query['id_ms_penyakit'] + 1;
                        if ($id < 100) {
                            $kodePenyakit = $value[0] == "" ? 'P0' . $id : $value[0];
                        } else {
                            $kodePenyakit = $value[0] == "" ? 'P' . $id : $value[0];
                        }
                    }

                    $row['id_ms_penyakit'] = $id;
                    $row['kode_penyakit'] = $kodePenyakit;
                    $row['nama_penyakit'] = ucwords($value[1]);
                    $row['solusi_penyakit'] = ucwords($value[2]);

                    $this->db->insert('ms_penyakit', $row);
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
