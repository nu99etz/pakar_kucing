<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ForwardChainningModel extends CI_Model
{
    private function getGejala($id_gejala, $column)
    {
        $gejala = $this->db->select('*')->from('ms_gejala')->where(['id_ms_gejala' => $id_gejala])->get()->row_array();
        return $gejala[$column];
    }

    public function getPrimaryGejala()
    {
        $primary_gejala = $this->db->select('*')->from('ms_gejala')->where(['is_utama' => 1])->get();
        return $primary_gejala->result_array();
    }

    public function getChildGejala($id_gejala)
    {
        $gejala = [];
        $child_gejala = $this->db->select('*')->from('rule_breadth')->where(['parent_ms_gejala' => $id_gejala])->group_by('child_ms_gejala')->get();
        $arr_gejala = $child_gejala->result_array();
        if (count($arr_gejala) > 0) {
            foreach ($arr_gejala as $key => $value) {
                $temp = [];
                $temp['id_ms_gejala'] = $value['child_ms_gejala'] == null ? null : $this->getGejala($value['child_ms_gejala'], 'id_ms_gejala');
                $temp['kode_gejala'] = $value['child_ms_gejala'] == null ? null : $this->getGejala($value['child_ms_gejala'], 'kode_gejala');
                $temp['nama_gejala'] = $value['child_ms_gejala'] == null ? null : $this->getGejala($value['child_ms_gejala'], 'nama_gejala');
                $temp['is_utama'] = $value['child_ms_gejala'] == null ? null : $this->getGejala($value['child_ms_gejala'], 'is_utama');
                $temp['is_priority'] = $value['child_ms_gejala'] == null ? null : $this->getGejala($value['child_ms_gejala'], 'is_priority');
                $temp['id_ms_penyakit'] = $value['id_ms_penyakit'];
                $gejala[] = $temp;
            }
        }
        return $gejala;
    }

    public function checkPenyakitIfStop($id_gejala)
    {
    }

    public function insertTempKonsultasi($param)
    {
        try {
            $this->db->trans_begin();
            $this->db->insert('tmp_konsultasi', $param);
            $this->db->trans_commit();
        } catch (Exception $e) {
            $this->db->trans_rollback();
            return [
                'status' => false,
                'messages' => 'Error ' . $e->getMessage()
            ];
        }
    }

    public function getTempKonsultasi($id_user, $is_single = false)
    {
        $tmp_konsultasi = $this->db->select('*')->from('tmp_konsultasi')->where(['id_user' => $id_user]);
        if ($is_single) {
            return $tmp_konsultasi->order_by('id_tmp_konsultasi', 'DESC')->get()->row_array();
        } else {
            return $tmp_konsultasi->get()->result_array();
        }
    }

    public function removeTempKonsultasi($id_user)
    {
        $this->db->where(['id_user' => $id_user])->delete('tmp_konsultasi');
    }
}
