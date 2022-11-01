<?php

defined('BASEPATH') or exit('No direct script access allowed');

class AuthModel extends CI_Model
{
    public function doLogin()
    {
        $post = $this->input->post();
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run()) {
            $whereClause = [
                'username' => $post['username'],
                'password' => md5($post['password'])
            ];
            $sql = $this->db->select('*')->from('users')->where($whereClause)->get();
            $query = $sql->row_array();

            if (empty($query)) {
                $response = [
                    'status' => false,
                    'messages' => 'username dan password tidak ditemukan'
                ];
            } else {
                if ($query['username'] != $post['username']) {
                    $response = [
                        'status' => false,
                        'messages' => 'username yang diinput tidak cocok dengan sistem'
                    ];
                } else if ($query['password'] != md5($post['password'])) {
                    $response = [
                        'status' => false,
                        'messages' => 'password yang diinput tidak cocok dengan sistem'
                    ];
                } else {
                    $response = [
                        'status' => true,
                        'messages' => 'login sukses',
                        'data' => $query
                    ];
                }
            }
        } else {
            $response = [
                'status' => false,
                'messages' => validation_errors()
            ];
        }

        return $response;
    }

    public function doRegister()
    {
        $post = $this->input->post();
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('nama_user', 'Nama User', 'required');

        if ($this->form_validation->run()) {

            $data_insert = [
                "id_role" => 2,
                "nama_user" => $post['nama_user'],
                "username" => $post['username'],
                "password" => md5($post['passwrod']),
                "created_at" => date('Y-m-d H:i:s')
            ];

            $query = $this->db->insert('users', $data_insert);

            if (!$query) {
                $response = [
                    'status' => false,
                    'messages' => 'Gagal input user'
                ];
            } else {
                $response = [
                    'status' => true,
                    'messages' => 'Sukses input user',
                ];
            }
        } else {
            $response = [
                'status' => false,
                'messages' => validation_errors()
            ];
        }

        return $response;
    }
}
