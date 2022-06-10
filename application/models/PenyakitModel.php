<?php

defined('BASEPATH') or exit('No direct script access allowed');

class PenyakitModel extends CI_Model
{
    public function getAllPenyakit()
    {
        $sql = $this->db->select('*')->from('penyakit')->get();
        $query = $sql->result_array();
        return $query;
    }

    public function getPenyakit($id, $attr = null)
    {
        $sql = $this->db->select('*')->from('penyakit')->where(['id' => $id])->get();
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
        $this->form_validation->set_rules('pengobatan_penyakit', 'Pengobatan Penyakit', 'required');

        if ($this->form_validation->run()) {

            // check data penyakit jika tidak ada maka id dimulai dari 1 dan kode P1
            $sql = $this->db->select('id')->from('penyakit')->order_by('id', 'desc')->limit(1)->get();
            $query = $sql->row_array();

            if (empty($query['id'])) {
                $id = 1;
                $kodePenyakit = 'P1';
            } else {
                $id = $query['id'] + 1;
                $kodePenyakit = 'P' . $id;
            }

            $data = [
                'id' => $id,
                'kode_penyakit' => $kodePenyakit,
                'nama_penyakit' => ucwords($post['nama_penyakit']),
                'pengobatan_penyakit' => $post['pengobatan_penyakit'],
            ];

            $this->db->trans_begin();
            
            try {

                $this->db->insert('penyakit', $data);

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
        $this->form_validation->set_rules('pengobatan_penyakit', 'Pengobatan Penyakit', 'required');

        if ($this->form_validation->run()) {


            $data = [
                'nama_penyakit' => ucwords($post['nama_penyakit']),
                'pengobatan_penyakit' => $post['pengobatan_penyakit'],
            ];

            $this->db->trans_begin();
            
            try {

                $this->db->where(['id' => $id])->update('penyakit', $data);

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
        $this->db->where(['id' => $id])->delete('penyakit');
        return [
            'status' => true,
            'messages' => 'Data Sukses Dihapus'
        ];
    }
}
