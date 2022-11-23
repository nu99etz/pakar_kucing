<?php

defined('BASEPATH') or exit('No direct script access allowed');

class CertainlyFactorModel extends CI_Model
{

    public function generateCF()
    {
        $rule = $this->db->select('*')->from('rule')->get()->result_array();
        $this->db->trans_begin();
        try {
            foreach ($rule as $key => $value) {
                $id_penyakit = $value['id_ms_penyakit'];
                $exp_gejala = explode(",", $value['gejala']);
                foreach ($exp_gejala as $value_gejala) {
                    $data = [
                        'id_gejala' => $value_gejala,
                        'id_penyakit' => $id_penyakit,
                    ];
                    $this->db->insert('certainly_factor', $data);
                }
            }
            $this->db->trans_commit();
            return [
                'status' => true,
                'messages' => 'Data Sukses Digenerate'
            ];
        } catch (Exception $e) {
            $this->db->trans_rollback();
            return [
                'status' => false,
                'messages' => 'Error ' . $e->getMessage()
            ];
        }
    }

    public function getAllCertainlyFactor()
    {
        $sql = $this->db->select('*')
            ->join('ms_penyakit', 'ms_penyakit.id_ms_penyakit = certainly_factor.id_penyakit', 'left')
            ->join('ms_gejala', 'ms_gejala.id_ms_gejala = certainly_factor.id_gejala', 'left')
            ->from('certainly_factor')->get();
        $query = $sql->result_array();
        return $query;
    }

    public function getCertainlyFactor($id, $attr = null)
    {
        $sql = $this->db->select('*')->from('certainly_factor')->where(['id_certainly_factor' => $id])->get();
        $query = $sql->row_array();
        if ($attr == null) {
            return $query;
        }
        return $query[$attr];
    }

    public function store()
    {
        $post = $this->input->post();

        $this->form_validation->set_rules('id_gejala', 'Nama Gejala', 'required');
        $this->form_validation->set_rules('id_penyakit', 'Nama Penyakit', 'required');
        $this->form_validation->set_rules('mb_value', 'Nilai MB', 'required');
        $this->form_validation->set_rules('md_value', 'Nilai MD', 'required');

        if ($this->form_validation->run()) {

            $data = [
                'id_gejala' => $_POST['id_gejala'],
                'id_penyakit' => $_POST['id_penyakit'],
                'mb_value' => $_POST['mb_value'],
                'md_value' => $_POST['md_value']
            ];

            $this->db->trans_begin();

            try {
                $this->db->insert('ms_kategori_gejala', $data);
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

        $this->form_validation->set_rules('nama_ms_kategori', 'Nama Kategori', 'required');

        if ($this->form_validation->run()) {

            $data = [
                'nama_ms_kategori' => ucwords($post['nama_ms_kategori'])
            ];

            $this->db->trans_begin();

            try {

                $this->db->where(['id_ms_kategori_gejala' => $id])->update('ms_kategori_gejala', $data);
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
        $this->db->where(['id_ms_kategori_gejala' => $id])->delete('ms_kategori_gejala');
        return [
            'status' => true,
            'messages' => 'Data Sukses Dihapus'
        ];
    }
}
