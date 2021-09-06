<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penelitian_model extends CI_Model{

    public function getAgencies(){
                      $this->db->order_by('created_at', 'DESC');
        $results    = $this->db->get('agencies')->result_array();
        return $results;
    }

    public function getNewArticle(){
                      $this->db->limit(3);
                      $this->db->order_by('created_at', 'DESC');
        $results    = $this->db->get_where('articles', ['type' => 'artikel-berita'])->result_array();
        return $results;
    }

    public function postData($data){
        $result = $this->db->insert('proposals', $data);
        if($result) {
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function uploadPDF(){
        $this->load->library('upload');
        $time                       = time();
        $config['upload_path']      = './uploads/files/';
        $config['allowed_types']    = 'pdf';
        $config['file_name']        = 'tor-'.$time.'.pdf';
        $config['overwrite']		= TRUE;
        $config['max_size']         =  2548;

        
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('tor')){
            $results        = [
                'status'    => FALSE
            ];
        }else{
            $tor = $config['file_name'];

            $time                       = time();
            $config['upload_path']      = './uploads/files/';
            $config['allowed_types']    = 'pdf';
            $config['file_name']        = 'icp-'.$time.'.pdf';
            $config['overwrite']		= TRUE;
            $config['max_size']         =  2548;
            
            $this->upload->initialize($config, true);
            if (!$this->upload->do_upload('tor')){
                $results        = [
                    'status'    => FALSE
                ];
            }else {
                $results        = [
                    'status'    => TRUE,
                    'tor'       => $tor,
                    'icp'       => $config['file_name']
                ];
            }
        }
        return $results;
    }

}