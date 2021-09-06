<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class All_model extends CI_Model{

    public function getNews(){
                if($this->session->userdata('levelNama') != 'foundation') {
                    $this->db->where('level', $this->session->userdata('levelNama'));
                }
                $this->db->where('YEAR(`created_at`)', date('Y'));
        return $this->db->get_where('articles', ['type' => 'news'])->num_rows();
    }

    public function getGalery(){
        if($this->session->userdata('levelNama') != 'foundation') {
            $this->db->where('level', $this->session->userdata('levelNama'));
        }
        $this->db->where('YEAR(`created_at`)', date('Y'));
        return $this->db->get_where('articles', ['type' => 'images'])->num_rows();
    }

    public function getViews(){
        if($this->session->userdata('levelNama') != 'foundation') {
            $this->db->where('level', $this->session->userdata('levelNama'));
        }
        $this->db->where('YEAR(`created_at`)', date('Y'));
        $this->db->select('SUM(views) as views');
        return $this->db->get_where('articles', ['type' => 'news'])->result_array();
    }
}