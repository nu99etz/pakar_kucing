<?php

defined('BASEPATH') or exit('No direct script access allowed');

class KategoriGejalaModel extends CI_Model
{

    protected $test;

    public function getAllKategoriGejala()
    {
        $sql = $this->db->select('*')->from('ms_kategori_gejala')->get();
        $query = $sql->result_array();
        return $query;
    }

    public function getKategoriGejala($id, $attr = null)
    {
        $sql = $this->db->select('*')->from('ms_kategori_gejala')->where(['id_ms_kategori_gejala' => $id])->get();
        $query = $sql->row_array();
        if ($attr == null) {
            return $query;
        }
        return $query[$attr];
    }

    public function store()
    {
        $post = $this->input->post();

        $this->form_validation->set_rules('nama_ms_kategori', 'Nama Kategori', 'required');

        if ($this->form_validation->run()) {

            $data = [
                'nama_ms_kategori' => ucwords($post['nama_ms_kategori'])
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
