<?php

defined('BASEPATH') or exit('No direct script access allowed');

class AturanModel extends CI_Model
{

    public function getAllAturan()
    {
        $sql = $this->db->select('*')->from('aturan')->get();
        $query = $sql->result_array();
        return $query;
    }

    public function getAturan($id, $attr = null)
    {
        $sql = $this->db->select('*')->from('aturan')->where(['id' => $id])->get();
        $query = $sql->row_array();
        if ($attr != null) {
            return $query[$attr];
        }
        return $query;
    }

    public function getPenyakitIfExist($id = null)
    {
        $sql = 'select id, kode_penyakit, nama_penyakit from penyakit where id not in (select id_penyakit from aturan)';
        if ($id != null) {
            $sql .= ' or id in (select id_penyakit from aturan where id_penyakit = ' . $id . ' )';
        }
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function store()
    {
        $post = $this->input->post();

        $this->form_validation->set_rules('nama_penyakit', 'Nama Penyakit', 'required');
        $this->form_validation->set_rules('gejala[]', 'Gejala', 'required');

        if ($this->form_validation->run()) {

            $gejala = implode(',', $post['gejala']);

            $data = [
                'id_penyakit' => $post['nama_penyakit'],
                'gejala' => $gejala,
            ];

            $this->db->trans_begin();

            try {

                $this->db->insert('aturan', $data);
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

        $this->form_validation->set_rules('nama_penyakit', 'Nama Penyakit', 'required');
        $this->form_validation->set_rules('gejala[]', 'Gejala', 'required');

        if ($this->form_validation->run()) {

            $gejala = implode(',', $post['gejala']);

            $data = [
                'id_penyakit' => $post['nama_penyakit'],
                'gejala' => $gejala,
            ];

            $this->db->trans_begin();

            try {

                $this->db->where(['id' => $id])->update('aturan', $data);
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
        $this->db->where(['id' => $id])->delete('aturan');
        return [
            'status' => true,
            'messages' => 'Data Sukses Dihapus'
        ];
    }
}
