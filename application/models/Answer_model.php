<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Answer_model extends CI_Model{

    public function check_user($nim, $questionnaire_id){
        $get_data =    $this->db->get_where('answers', ['nim' => $nim, 'questionnaire_id' => $questionnaire_id]);

        if($get_data->num_rows() > 0) {
            $results = (object) [
                'status' => true,
                'message' => 'data tertampil'
            ];
        }else {
            $results = (object) [
                'status' => false,
                'message' => 'data kosong'
            ];
        }
        return $results;
    }

    public function post_data($post) {
        try {
            $total_data = $post['total_data'];

            $data = [];
            $questionnaire_id = $post['questionnaire_id'];
            $lab_id = $post['lab_id'];
            $lab_count = @$post['lab_count'];
            $name = $post['name'];
            $nim = $post['nim'];
            for($i=1; $i <= $total_data; $i++) {
                $question_id = $post['question_id_'.$i];
                if($lab_count) {
                    $labs = [];
                    for($j = 1; $j <= $lab_count; $j++) {
                        array_push($labs, $post['lab_'.$j]);
                    }

                    // echo "<pre>";
                    // print_r($labs);
                    // echo "</pre>";
                    // die;

                    for($k = 1; $k <= $lab_count; $k++) {
                        $expectation_answer = $post['expectation_answer_'.$i.'-'.$labs[$k-1]];
                        $reality_answer = $post['reality_answer_'.$i.'-'.$labs[$k-1]];
        
                        $temp_data = [
                            'question_id' => $question_id,
                            'questionnaire_id' => $questionnaire_id,
                            'lab_id' => $labs[$k-1],
                            'name' => $name,
                            'nim' => $nim,
                            'expectation_answer' => $expectation_answer,
                            'reality_answer' => $reality_answer
                        ];
                        array_push($data, $temp_data);
                    }
                }else {
                    $expectation_answer = $post['expectation_answer_'.$i];
                    $reality_answer = $post['reality_answer_'.$i];
    
                    $temp_data = [
                        'question_id' => $question_id,
                        'questionnaire_id' => $questionnaire_id,
                        'lab_id' => $lab_id,
                        'name' => $name,
                        'nim' => $nim,
                        'expectation_answer' => $expectation_answer,
                        'reality_answer' => $reality_answer
                    ];
                    array_push($data, $temp_data);
                }
            }

            // echo "<pre>";
            // print_r($data);
            // echo "</pre>";
            // die;

            $this->db->insert_batch('answers', $data);

            foreach($data as $value) {
                $value = (object) $value;
                // echo "<pre>";
                // print_r($value);
                // echo "</pre>";
                // die;
                $check_expectation = $this->db->get_where('summary_servqual', ['question_id' => $value->question_id, 'lab_id' => $value->lab_id, 'type' => 'expectation', 'gap' => $value->expectation_answer]);
                $check_reality = $this->db->get_where('summary_servqual', ['question_id' => $value->question_id, 'lab_id' => $value->lab_id, 'type' => 'reality', 'gap' => $value->reality_answer]);

                if($check_expectation->num_rows() > 0) {
                    $fetch_data = $check_expectation->row();
                    $data = [
                        'sum_total_answerer' => $fetch_data->sum_total_answerer+1,
                        'sum_total_point' => $fetch_data->sum_total_point+$value->expectation_answer
                    ];
                    $update = $this->db->update('summary_servqual', $data, ['question_id' => $value->question_id, 'lab_id' => $value->lab_id, 'type' => 'expectation', 'gap' => $value->expectation_answer]);
                }else {
                    $data = [
                        'gap' => $value->expectation_answer,
                        'type' => 'expectation',
                        'question_id' => $value->question_id,
                        'questionnaire_id' => $value->questionnaire_id,
                        'lab_id' => $value->lab_id,
                        'sum_total_answerer' => 1,
                        'sum_total_point' => $value->expectation_answer
                    ];
                    $insert = $this->db->insert('summary_servqual', $data);
                }

                if($check_reality->num_rows() > 0) {
                    $fetch_data = $check_reality->row();
                    $data = [
                        'sum_total_answerer' => $fetch_data->sum_total_answerer+1,
                        'sum_total_point' => $fetch_data->sum_total_point+$value->reality_answer
                    ];
                    $update = $this->db->update('summary_servqual', $data, ['question_id' => $value->question_id, 'lab_id' => $value->lab_id, 'type' => 'reality', 'gap' => $value->reality_answer]);
                }else {
                    $data = [
                        'gap' => $value->reality_answer,
                        'type' => 'reality',
                        'question_id' => $value->question_id,
                        'questionnaire_id' => $value->questionnaire_id,
                        'lab_id' => $value->lab_id,
                        'sum_total_answerer' => 1,
                        'sum_total_point' => $value->reality_answer
                    ];
                    $insert = $this->db->insert('summary_servqual', $data);
                }

                $get_data = $this->db->get_where('temp_gap5', ['question_id' => $value->question_id, 'questionnaire_id' => $value->questionnaire_id, 'lab_id' => $value->lab_id])->row();
                if($get_data) {
                    $data = [
                        'sum_expectation_answer' => $get_data->sum_expectation_answer+$value->expectation_answer,
                        'sum_reality_answer' => $get_data->sum_reality_answer+$value->reality_answer,
                        'sum_total_answerer' => $get_data->sum_total_answerer+1,
                        'sum_expectation_average' => round($get_data->sum_expectation_answer+$value->expectation_answer/($get_data->sum_total_answerer+1), 2),
                        'sum_reality_average' => round($get_data->sum_reality_answer+$value->reality_answer/($get_data->sum_total_answerer+1), 2),
                        'sum_gap5' => round((round($get_data->sum_reality_answer+$value->reality_answer/($get_data->sum_total_answerer+1), 2))-(round($get_data->sum_expectation_answer+$value->expectation_answer/($get_data->sum_total_answerer+1), 2)), 2)
                    ];
                    $update = $this->db->update('temp_gap5', $data, ['question_id' => $value->question_id, 'questionnaire_id' => $value->questionnaire_id, 'lab_id' => $value->lab_id]);
                }else {
                    $data = [
                        'lab_id' => $value->lab_id,
                        'questionnaire_id' => $value->questionnaire_id,
                        'question_id' => $value->question_id,
                        'sum_expectation_answer' => $value->expectation_answer,
                        'sum_reality_answer' => $value->reality_answer,
                        'sum_total_answerer' => 1,
                        'sum_expectation_average' => round($value->expectation_answer, 2),
                        'sum_reality_average' => round($value->reality_answer, 2),
                        'sum_gap5' => round((round($value->reality_answer, 2))-(round($value->expectation_answer, 2)), 2)
                    ];
                    $insert = $this->db->insert('temp_gap5', $data);
                }

                // $update = $this->db->update('questions', $data, ['_id' => $value->question_id]);
            }

            $results = (object) [
                'status' => true,
                'message' => 'data berhasil ditambahkan.',
                'response_code' => 200
            ];

            return $results;
        }catch (Exception $e) {
            $results = (object) [
                'status' => false,
                'message' => $e->getMessage(),
                'response_code' => 500
            ];
            print_r($results);die;
            return $results;
        }
        
    }

}