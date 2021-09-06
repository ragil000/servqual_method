<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model{

    public function signin($post) {
        $allow_post = ['username', 'password', 'lab_id'];
        $check_post = true;
        $count_post = 0;
        foreach($post as $key => $value) {
            if(!in_array($key, $allow_post)) {
                $results = (object) [
                    'status' => false,
                    'message' => 'data ['.$key.'] tidak dikenali',
                    'response_code' => 400
                ];
                return $results;
            }
            
            if(empty($value)){
                $check_post = false;
            }
            $count_post++;
        }

        if($count_post != count($allow_post)) {
            $check_post = false;
        }

        if(!$check_post) {
            $results = (object) [
                'status' => false,
                'message' => 'data request salah',
                'response_code' => 400
            ];
            return (object) $results;
        }

        $check_role = true;
        $check_password = false;

        $get = $this->db->get_where('users', ['username' => $post['username']]);
        if($get->num_rows() > 0) {
            $row = $get->row();
            if($row->role == 'admin') {
                if($row->lab_id == $post['lab_id']) {
                    $check_password = password_verify($post['password'], $row->password);
                }else {
                    $check_role = false;
                }
            }else if($row->role == 'user') {
                $check_password = password_verify($post['password'], $row->password);
            }

            if($check_role && $check_password) {
                $results = (object) [
                    'status' => true,
                    'message' => 'berhasil masuk',
                    'data' => (object) [
                        '_id' => $row->_id,
                        'username' => $row->username,
                        'role' => $row->role,
                        'status' => $row->status,
                        'lab_id' => $post['lab_id']
                    ],
                    'response_code' => 200
                ];
            }else {
                $results = (object) [
                    'status' => false,
                    'message' => 'username atau password salah',
                    'response_code' => 400
                ];
            }
        }else {
            $results = (object) [
                'status' => false,
                'message' => 'username salah',
                'response_code' => 400
            ];
        }
        return (object) $results;
    }

    public function signup($post) {
        $allowPost = ['username', 'password', 'role'];
        $optionalPost = ['lab_id'];
        $checkPost = true;
        $countPost = 0;
        $post['role'] = 'user';
        foreach($post as $key => $value) {
            if(!in_array($key, $allowPost)) {
                if(!in_array($key, $optionalPost)) {
                    $results = (object) [
                        'status' => false,
                        'message' => 'data ['.$key.'] tidak dikenali',
                        'response_code' => 400
                    ];
                    return (object) $results;
                }else {
                    $countPost--;
                }
            }
            
            if(empty($value)){
                $checkPost = false;
            }
            $countPost++;
        }

        if($count_post != count($allow_post)) {
            $check_post = false;
        }

        if(!$checkPost) {
            $results = (object) [
                'status' => false,
                'message' => 'data request salah',
                'response_code' => 400
            ];
            return (object) $results;
        }

        $get = $this->db->get_where('users', ['username' => $post['username']]);
        if($get->num_rows() > 0) {
            $results = (object) [
                'status' => false,
                'message' => 'username sudah dipakai',
                'response_code' => 400
            ];
        }else {
            $password_hash = password_hash($post['password'], PASSWORD_BCRYPT);
            $post['password'] = $password_hash;
            $insert = $this->db->insert('users', $post);
            if($insert) {
                $results = (object) [
                    'status' => true,
                    'message' => 'berhasil mendaftar',
                    'response_code' => 200
                ];
            }else {
                $results = (object) [
                    'status' => false,
                    'message' => 'kesalahan saat memproses request',
                    'response_code' => 500
                ];
            }
        }
        return (object) $results;
    }

}