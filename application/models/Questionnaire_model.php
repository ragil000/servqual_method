<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Questionnaire_model extends CI_Model{

    public function get_default_questionnaire($is_active_publish=false, $lab_id=NULL) {
        $current_questionnaire_id = $this->session->userdata('current_questionnaire_id');
        if(!$lab_id) {
            $lab_id = $this->session->userdata('lab_id');
        }

        $results = (object) [
            'status' => false,
            'message' => 'data kosong',
            'response_code' => 400
        ];

        $get_data = NULL;
        if($is_active_publish) {
                        $this->db->where('lab_id', $lab_id);
                        $this->db->where('status', 'active');
                        $this->db->where('is_publish', 'yes');
            $get_data = $this->db->get('questionnaires');
        }else {
                        $this->db->where('lab_id', $lab_id);
                        if($current_questionnaire_id) {
                            $this->db->where('_id', $current_questionnaire_id);
                        }else {
                            $this->db->order_by('questionnaires.status', 'ASC');
                            $this->db->order_by('questionnaires._id', 'DESC');
                        }
            $get_data = $this->db->get('questionnaires');
        }

        if($get_data->num_rows() > 0) {
            $results = (object) [
                'status' => true,
                'message' => 'data tertampil',
                'data' => $get_data->row(),
                'response_code' => 200
            ];
        }

        return $results;
    }

    public function get_data($page, $search=NULL, $is_publish=NULL){
        $limit = 10;
        $page = (int)$page;
        $page = $page <= 0 ? 1 : $page;
        $start = ($page-1)*$limit;

                        $this->db->join('users', 'users._id=questionnaires.created_by', 'left');
                        $this->db->join('labs', 'labs._id=questionnaires.lab_id', 'left');
                        if($this->session->userdata('role') == 'admin') {
                            $this->db->where('questionnaires.lab_id', $this->session->userdata('lab_id'));
                        }
                        if($search) {
                            $this->db->like('questionnaires.start_periode', $search);
                            $this->db->or_like('questionnaires.end_periode', $search);
                        }
                        if($is_publish == 'yes') {
                            $this->db->where('questionnaires.is_publish', 'yes');
                        }
                        $this->db->where('questionnaires.lab_id', $this->session->userdata('lab_id'));
                        $this->db->where('questionnaires.deleted_at', NULL);
                        $this->db->select('questionnaires._id, questionnaires.is_delete, questionnaires.is_publish, labs._id as lab_id, labs.title as lab_title, questionnaires.start_periode, questionnaires.end_periode, questionnaires.status, users.username as creator');
                        $this->db->limit($limit, $start);
                        $this->db->order_by('questionnaires.status', 'ASC');
                        $this->db->order_by('questionnaires._id', 'DESC');
        $get_data =    $this->db->get('questionnaires');

                    if($this->session->userdata('role') == 'admin') {
                        $this->db->where('questionnaires.lab_id', $this->session->userdata('lab_id'));
                    }
                    if($search) {
                        $this->db->like('questionnaires.start_periode', $search);
                        $this->db->or_like('questionnaires.end_periode', $search);
                    }
                    if($is_publish == 'yes') {
                        $this->db->where('questionnaires.is_publish', 'yes');
                    }
                    $this->db->where('questionnaires.lab_id', $this->session->userdata('lab_id'));
                    $this->db->where('questionnaires.deleted_at', NULL);
        $count =    $this->db->count_all_results('questionnaires');
        
        if($count > 0) {
            $results = (object) [
                'status' => true,
                'message' => 'data tertampil',
                'data' => $get_data->result(),
                'limit' => $limit,
                'is_next' => $page < ceil($count/$limit),
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
                'is_next' => false,
                'total_data' => 0,
                'total_page' => 0,
                'current_page' => 1,
                'response_code' => 200
            ];
        }
        return $results;
    }

    public function post_data($post) {
        $allow_post = ['start_periode', 'end_periode', 'lab_id', 'status', 'created_by'];
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

        $check_data = $this->db->get_where('questionnaires', ['start_periode' => $post['start_periode'], 'end_periode' => $post['end_periode'], 'deleted_at' => NULL]);
        if($check_data->num_rows() > 0) {
            $results = (object) [
                'status' => false,
                'message' => 'data periode tersebut sudah tersedia.',
                'response_code' => 400
            ];
        }else {
            $update_old_data = $this->db->update('questionnaires', ['status' => 'nonactive'], ['status' => 'active']);
            
            $insert = $this->db->insert('questionnaires', $post);
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
        }

        return $results;
    }

    public function activate_data($_id){
        $update_old_data = $this->db->update('questionnaires', ['status' => 'nonactive'], ['status' => 'active']);
        $update = $this->db->update('questionnaires', ['status' => 'active'], ['_id' => $_id]);
        if($update) {
            $results = (object) [
                'status' => true,
                'message' => 'data berhasil di aktifkan.',
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

    public function nonactivate_data($_id){
        $update = $this->db->update('questionnaires', ['status' => 'nonactive'], ['_id' => $_id]);
        if($update) {
            $results = (object) [
                'status' => true,
                'message' => 'data berhasil di non-aktifkan.',
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

    public function publish_data($_id){
        $update = $this->db->update('questionnaires', ['is_publish' => 'yes'], ['_id' => $_id]);
        if($update) {
            $results = (object) [
                'status' => true,
                'message' => 'data berhasil dipublis.',
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
        $delete = $this->db->update('questionnaires', ['deleted_at' => date('Y-m-d H:i:s')], ['_id' => $_id]);
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