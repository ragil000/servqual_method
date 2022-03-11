<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laboratorium_model extends CI_Model{

    public function get_data($page, $search=NULL){
        $limit = 10;
        $page = (int)$page;
        $page = $page <= 0 ? 1 : $page;
        $start = ($page-1)*$limit;

                        if($search) {
                            $this->db->like('title', $search);
                        }
                        $this->db->where('deleted_at', NULL);
                        $this->db->select('_id, title');
                        $this->db->limit($limit, $start);
        $get_data =    $this->db->get('labs');

                    if($search) {
                        $this->db->like('title', $search);
                    }
                    $this->db->where('status', 'active');
                    $this->db->where('deleted_at', NULL);
        $count =    $this->db->count_all_results('labs');
        
        if($count > 0) {
            $results = (object) [
                'status' => true,
                'message' => 'data tertampil',
                'data' => $get_data->result(),
                'limit' => $limit,
                'total_data_displayed' => $get_data->num_rows(),
                'total_data' => $count,
                'total_page' => ceil($count/$limit),
                'current_page' => $page,
                'response_code' => 200
            ];
        }else {
            $results = (object) [
                'status' => false,
                'message' => 'data kosong',
                'data' => null,
                'limit' => 10,
                'total_data_displayed' => 0,
                'total_data' => 0,
                'total_page' => 0,
                'current_page' => 1,
                'response_code' => 200
            ];
        }
        return $results;
    }

    public function get_detail_data($_id){
                $this->db->where('labs._id', $_id);
                $this->db->select('labs._id, labs.title');
        $get_data =    $this->db->get('labs');

        if($get_data->num_rows() > 0) {
            $results = (object) [
                'status' => true,
                'message' => 'data tertampil',
                'data' => $get_data->row(),
                'response_code' => 200
            ];
        }else {
            $results = (object) [
                'status' => false,
                'message' => 'data kosong',
                'data' => null,
                'response_code' => 200
            ];
        }
        return $results;
    }

    public function post_data($post) {
        $allow_post = ['title'];
        $optional_post = [];
        $check_post = true;
        $count_post = 0;
        foreach($post as $key => $value) {
            if(!in_array($key, $allow_post)) {
                if(!in_array($key, $optional_post)) {
                    $results = (object) [
                        'status' => false,
                        'message' => 'data ['.$key.'] tidak dikenali.',
                        'response_code' => 400
                    ];
                    return $results;
                }else {
                    $count_post--;
                }
            }else {
                if(empty($value)){
                    $check_post = false;
                }
                $count_post++;
            }
        }

        if($count_post != count($allow_post)) {
            $check_post = false;
        }

        if(!$check_post) {
            $results = (object) [
                'status' => false,
                'message' => 'data request salah.',
                'response_code' => 400
            ];
            return $results;
        }

        $insert = $this->db->insert('labs', $post);
        if($insert) {
            $results = (object) [
                'status' => true,
                'message' => 'data berhasil ditambahkan.',
                'response_code' => 200
            ];
        }else {
            $results = (object) [
                'status' => false,
                'message' => 'kesalahan saat memproses request.',
                'response_code' => 500
            ];
        }

        return $results;
    }

    public function put_data($put) {
        $allow_put = ['_id', 'title'];
        $optional_put = [];
        $check_put = true;
        $count_put = 0;
        foreach($put as $key => $value) {
            if(!in_array($key, $allow_put)) {
                if(!in_array($key, $optional_put)) {
                    $results = (object) [
                        'status' => false,
                        'message' => 'data ['.$key.'] tidak dikenali.',
                        'response_code' => 400
                    ];
                    return $results;
                }else {
                    $count_put--;
                }
            }else {
                if(empty($value)){
                    $check_put = false;
                }
                $count_put++;
            }
        }

        if($count_put != count($allow_put)) {
            $check_put = false;
        }

        if(!$check_put) {
            $results = (object) [
                'status' => false,
                'message' => 'data request salah.',
                'response_code' => 400
            ];
            return $results;
        }

        $_id = $put['_id'];
        unset($put['_id']);

        $update = $this->db->update('labs', $put, ['_id' => $_id]);
        if($update) {
            $results = (object) [
                'status' => true,
                'message' => 'data berhasil diupdate.',
                'response_code' => 200
            ];
        }else {
            $results = (object) [
                'status' => false,
                'message' => 'kesalahan saat memproses request.',
                'response_code' => 500
            ];
        }

        return $results;
    }

    public function delete_data($_id){
        $delete = $this->db->update('labs', ['deleted_at' => date('Y-m-d H:i:s')], ['_id' => $_id]);
        if($delete) {
            $results = (object) [
                'status' => true,
                'message' => 'data berhasil dihapus.',
                'response_code' => 200
            ];
        }else {
            $results = (object) [
                'status' => false,
                'message' => 'kesalahan saat memproses request.',
                'response_code' => 500
            ];
        }

        return $results;
    }
}