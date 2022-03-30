<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model{

    public function get_data($lab_id=NULL){

                                    if($lab_id) {
                                        $this->db->where('lab_id', $lab_id);
                                    }
                                    $this->db->where('status', 'active');
        $get_data_questionnaire =   $this->db->count_all_results('questionnaires');

                                            if($lab_id) {
                                                $this->db->where('lab_id', $lab_id);
                                            }
        $get_data_questionnaire_active =    $this->db->count_all_results('questionnaires');

                                if($lab_id) {
                                    $this->db->where('lab_id', $lab_id);
                                }
                                $this->db->group_by('nim');
        $get_data_answerer =     $this->db->count_all_results('answers');

        $get_data_lab =    $this->db->count_all_results('labs');

        $results = (object) [
            'status' => true,
            'message' => 'data tertampil',
            'data' => (object) [
                'questionnaire' => $get_data_questionnaire,
                'questionnaire_active' => $get_data_questionnaire_active,
                'answerer' => $get_data_answerer,
                'lab' => $get_data_lab
            ],
            'response_code' => 200
        ];
        
        return $results;
    }

}