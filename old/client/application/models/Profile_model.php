<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_model extends CI_Model{

    public function getContentData($type, $table, $limit, $start){
                      $this->db->limit($limit, $start);
                      $this->db->order_by('created_at', 'DESC');
        $results    = $this->db->get_where($table, ['type' => $type])->result_array();
        return $results;
    }

    public function getNewArticle(){
                      $this->db->limit(3);
                      $this->db->order_by('created_at', 'DESC');
        $results    = $this->db->get_where('articles', ['type' => 'artikel-berita'])->result_array();
        return $results;
    }

    public function getTotalData($type, $table){
        $results    = $this->db->get_where($table, ['type' => $type])->num_rows();
        return $results;
    }

    public function getDetailData($table, $slug) {
        $results    = $this->db->get_where($table, ['slug' => $slug])->result_array();
        return $results;
    }

}