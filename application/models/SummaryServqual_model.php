<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SummaryServqual_model extends CI_Model{

    public function get_detail_data($question_id){
        $get_data =    $this->db->get_where('summary_servqual', ['question_id' => $question_id, 'lab_id' => $this->session->userdata('lab_id')]);
        
        if($get_data->num_rows() > 0) {
            $fetch_data = $get_data->result();

            $total_answere = 0;
            $total_expectation_point = 0;
            $total_reality_point = 0;
            $temp_expectation = [];
            $temp_reality = [];
            foreach($fetch_data as $value) {
                if($value->type == 'expectation') {
                    array_push($temp_expectation, $value);
                    $total_expectation_point = $total_expectation_point+$value->sum_total_point;
                }else if($value->type == 'reality') {
                    array_push($temp_reality, $value);
                    $total_reality_point = $total_reality_point+$value->sum_total_point;
                    $total_answere = $total_answere + $value->sum_total_answerer;
                }
            }

            $temp_gap_expectation[1] = 0;
            $temp_gap_expectation[2] = 0;
            $temp_gap_expectation[3] = 0;
            $temp_gap_expectation[4] = 0;
            $temp_gap_expectation[5] = 0;

            $temp_gap_reality[1] = 0;
            $temp_gap_reality[2] = 0;
            $temp_gap_reality[3] = 0;
            $temp_gap_reality[4] = 0;
            $temp_gap_reality[5] = 0;

            foreach($temp_expectation as $value) {
                $temp_gap_expectation[$value->gap] = $temp_gap_expectation[$value->gap]+$value->sum_total_answerer;
            }

            foreach($temp_reality as $value) {
                $temp_gap_reality[$value->gap] = $temp_gap_reality[$value->gap]+$value->sum_total_answerer;
            }

            $data = (object) [
                'expectation' => $temp_gap_expectation,
                'reality' => $temp_gap_reality,
                'total_expectation_point' => $total_expectation_point,
                'total_reality_point' => $total_reality_point,
                'total_answere' => $total_answere
            ];

            $results = (object) [
                'status' => true,
                'message' => 'data tertampil',
                'data' => $data,
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

}