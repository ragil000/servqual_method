<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group_model extends CI_Model{

    public function get_data($group_id=NULL){

                        $this->db->join('detail_groups', 'detail_groups.group_id=groups._id', 'left');
                        $this->db->join('labs', 'labs._id=detail_groups.lab_id', 'left');
                        $this->db->where('labs.status', 'active');
                        if($group_id) {
                            $this->db->where('groups._id', $group_id);
                        }
                        $this->db->select('groups._id as group_id, detail_groups._id as detail_group_is, labs._id as lab_id, labs.title as lab_title');
        $get_data =    $this->db->get('groups');

        if($get_data->num_rows() > 0) {
            $results = (object) [
                'status' => true,
                'message' => 'data tertampil',
                'data' => $get_data->result()
            ];
        }else {
            $results = (object) [
                'status' => false,
                'message' => 'data kosong'
            ];
        }
        return $results;
    }
}