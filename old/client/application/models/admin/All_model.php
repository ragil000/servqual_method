<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class All_model extends CI_Model{

    public function getUsulan(){
                $this->db->where('YEAR(`created_at`)', date('Y'));
        return $this->db->get('proposals')->num_rows();
    }

    public function getJurnal(){
        $this->db->where_in('type', ['sosial-pemerintahan', 'ekonomi-pembangunan']);
        $this->db->where('YEAR(`created_at`)', date('Y'));
        return $this->db->get('articles')->num_rows();
    }

    public function getArtikel(){
        $this->db->where('type', 'artikel-berita');
        $this->db->where('YEAR(`created_at`)', date('Y'));
        return $this->db->get('articles')->num_rows();
    }
}