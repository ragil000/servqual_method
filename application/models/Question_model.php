<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question_model extends CI_Model{

    public function get_data($page, $search=NULL, $questionnaire_id=NULL, $limit=10, $is_ranking=false){
        $page = (int)$page;
        $page = $page <= 0 ? 1 : $page;
        $start = ($page-1)*$limit;

                        $this->db->join('users', 'users._id=questions.created_by', 'left');
                        $this->db->join('labs', 'labs._id=questions.lab_id', 'left');
                        $this->db->join('dimensions', 'dimensions._id=questions.dimension_id', 'left');
                        $this->db->join('questionnaires', 'questionnaires._id=questions.questionnaire_id', 'left');
                        $this->db->where('questions.questionnaire_id', $questionnaire_id);
                        if($search) {
                            $this->db->like('questions.question', $search);
                            $this->db->or_like('dimensions.title', $search);
                        }
                        $this->db->where('questions.deleted_at', NULL);
                        $this->db->select('questions._id, questions.question, questions.sum_expectation_answer, questions.sum_reality_answer, questions.sum_total_answerer, questions.sum_expectation_average, questions.sum_reality_average, questions.sum_gap5, labs._id as lab_id, labs.title as lab_title, dimensions._id as dimension_id, dimensions.title as dimension_title, dimensions.description as dimension_description, questionnaires._id as questionnaire_id, questionnaires.is_publish, questionnaires.start_periode as questionnaire_start_periode, questionnaires.end_periode as questionnaire_end_periode, questionnaires.status as questionnaire_status, users.username as creator');
                        $this->db->limit($limit, $start);
                        if($is_ranking) {
                            $this->db->order_by('questions.sum_gap5', 'ASC');
                        }else {
                            $this->db->order_by('questions.dimension_id', 'ASC');
                        }
        $get_data =    $this->db->get('questions');

                    if($search) {
                        $this->db->like('questions.question', $search);
                        $this->db->or_like('dimensions.title', $search);
                    }
                    $this->db->where('questions.questionnaire_id', $questionnaire_id);
                    $this->db->where('questions.deleted_at', NULL);
        $count =    $this->db->count_all_results('questions');
        
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
                        $this->db->join('dimensions', 'dimensions._id=questions.dimension_id', 'left');
                        $this->db->select('questions._id, questions.question, questions.dimension_id, dimensions.title as dimension_title, questions.questionnaire_id, questions.lab_id');
        $get_data =    $this->db->get_where('questions', ['questions._id' => $_id]);

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
        $allow_post = ['question', 'dimension_id', 'questionnaire_id', 'lab_id', 'created_by'];
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

        $insert = $this->db->insert('questions', $post);
        $update_is_delete = $this->db->update('questionnaires', ['is_delete' => 'no'], ['_id' => $post['questionnaire_id']]);
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
        $allow_put = ['_id', 'question', 'dimension_id', 'questionnaire_id', 'lab_id', 'updated_by'];
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
        $update = $this->db->update('questions', $put, ['_id' => $_id]);
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
                    $this->db->join('questionnaires', 'questionnaires._id=questions.questionnaire_id', 'left');
                    $this->db->where('questions._id', $_id);
                    $this->db->select('questions._id, questions.questionnaire_id, questionnaires.is_publish');
        $get_data = $this->db->get('questions');

        if($get_data->num_rows() > 0) {
            $fetch_data = $get_data->row();
            $delete = null;
            if($fetch_data->is_publish == 'yes') {
                $delete = $this->db->update('questions', ['deleted_at' => date('Y-m-d H:i:s')], ['_id' => $_id]);
            }else {
                $delete = $this->db->delete('questions', ['_id' => $_id]);
            }
            
            if($delete) {
                                $this->db->where('questionnaire_id', $fetch_data->questionnaire_id);
                                $this->db->where('deleted_at', NULL);
                $count_data =   $this->db->count_all_results('questions');

                if($count_data <= 0) {
                    $update_is_delete = $this->db->update('questionnaires', ['is_delete' => 'yes'], ['_id' => $fetch_data->questionnaire_id]);
                }

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
        }else {
            $results = (object) [
                'status' => false,
                'message' => 'data tidak ditemukan.',
                'response_code' => 500
            ];
        }

        return $results;
    }
}