<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dimension_model extends CI_Model{

    public function get_data($page, $search=NULL){
        $limit = 10;
        $page = (int)$page;
        $page = $page <= 0 ? 1 : $page;
        $start = ($page-1)*$limit;

                        if($search) {
                            $this->db->like('dimensions.title', $search);
                        }
                        $this->db->select('dimensions._id, dimensions.title, dimensions.description');
                        $this->db->limit($limit, $start);
                        $this->db->order_by('dimensions.title', 'ASC');
        $get_data =    $this->db->get('dimensions');

                    if($search) {
                        $this->db->like('dimensions.title', $search);
                    }
        $count =    $this->db->count_all_results('dimensions');
        
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
}