<?php

defined('BASEPATH') or exit('No direct script access allowed');

class AturanModel extends CI_Model
{

    public function getAllAturan()
    {
        $sql = $this->db->select('*')->from('rule')->get();
        $query = $sql->result_array();
        return $query;
    }

    public function getAturan($id, $attr = null)
    {
        $sql = $this->db->select('*')->from('rule')->where(['id_rule' => $id])->get();
        $query = $sql->row_array();
        if ($attr != null) {
            return $query[$attr];
        }
        return $query;
    }

    public function getPenyakitIfExist($id = null)
    {
        $sql = 'select id_ms_penyakit, kode_penyakit, nama_penyakit from ms_penyakit where id_ms_penyakit not in (select id_ms_penyakit from rule)';
        if ($id != null) {
            $sql .= ' or id_ms_penyakit in (select id_ms_penyakit from rule where id_ms_penyakit = ' . $id . ' )';
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

            try {

                $gejala = implode(',', $post['gejala']);

                $data = [
                    'id_ms_penyakit' => $post['nama_penyakit'],
                    'gejala' => $gejala,
                ];
                $this->db->trans_begin();
                $this->db->insert('rule', $data);
                $id_rule = $this->db->insert_id();
                $this->db->trans_commit();

                for ($i = 0; $i < count($post['gejala']); $i++) {
                    if ($i == (count($post['gejala']) - 1)) {
                        $data = [
                            'id_rule' => $id_rule,
                            'id_ms_penyakit' => $post['nama_penyakit'],
                            'parent_ms_gejala' => $post['gejala'][$i],
                            'child_ms_gejala' => NULL
                        ];
                    } else {
                        $data = [
                            'id_rule' => $id_rule,
                            'id_ms_penyakit' => NULL,
                            'parent_ms_gejala' => $post['gejala'][$i],
                            'child_ms_gejala' => $post['gejala'][$i + 1]
                        ];
                    }

                    $data_cf = [
                        'id_penyakit' => $post['nama_penyakit'],
                        'id_gejala' => $post['gejala'][$i]
                    ];
                    $this->db->trans_begin();
                    $this->db->insert('rule_breadth', $data);
                    $this->db->insert('certainly_factor', $data_cf);
                    $this->db->trans_commit();
                }
            } catch (Exception $e) {

                $this->db->trans_rollback();
                return [
                    'status' => false,
                    'messages' => 'Error ' . $e->getMessage()
                ];
            }

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

            try {

                $gejala = implode(',', $post['gejala']);

                $data = [
                    'id_ms_penyakit' => $post['nama_penyakit'],
                    'gejala' => $gejala,
                ];
                $this->db->trans_begin();
                $this->db->where(['id_rule' => $id])->update('rule', $data);
                $this->db->trans_commit();

                // hapus semua rule_breadth
                $this->db->trans_begin();
                $this->db->where(['id_rule' => $id])->delete('rule_breadth');
                $this->db->trans_commit();

                for ($i = 0; $i < count($post['gejala']); $i++) {
                    if ($i == (count($post['gejala']) - 1)) {
                        $data = [
                            'id_rule' => $id,
                            'id_ms_penyakit' => $post['nama_penyakit'],
                            'parent_ms_gejala' => $post['gejala'][$i],
                            'child_ms_gejala' => NULL
                        ];
                    } else {
                        $data = [
                            'id_rule' => $id,
                            'id_ms_penyakit' => NULL,
                            'parent_ms_gejala' => $post['gejala'][$i],
                            'child_ms_gejala' => $post['gejala'][$i + 1]
                        ];
                    }
                    $this->db->trans_begin();
                    $this->db->insert('rule_breadth', $data);
                    $this->db->trans_commit();
                }
            } catch (Exception $e) {

                $this->db->trans_rollback();
                return [
                    'status' => false,
                    'messages' => 'Error ' . $e->getMessage()
                ];
            }

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
        $this->db->where(['id_rule' => $id])->delete('rule');
        return [
            'status' => true,
            'messages' => 'Data Sukses Dihapus'
        ];
    }
}
