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
            $sql = $this->db->select('id_role, username, password')->from('users')->where($whereClause)->get();
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
}
