<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_model extends CI_Model{

    public function getContentData($type, $table, $limit, $start){
                      $this->db->limit($limit, $start);
                      $this->db->order_by('created_at', 'DESC');
                      $where = ['type' => $type];
                      if($this->session->userdata('levelNama') != 'foundation') {
                        $this->db->where('level', $this->session->userdata('levelNama'));
                      }
        $results    = $this->db->get_where($table, $where)->result_array();
        return $results;
    }

    public function getTotalData($type, $table){
        $results    = $this->db->get_where($table, ['type' => $type])->num_rows();
        return $results;
    }

    public function getDetail($table, $id){
        $results    = $this->db->get_where($table, ['id' => $id])->result_array();
        return $results;
    }

    public function postData($table, $data){
      $data['level'] = @$this->session->levelNama;
        $result = $this->db->insert($table, $data);
        if($result) {
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function putData($table, $id, $data){
        $result = $this->db->update($table, $data, ['id' => $id]);
        if($result) {
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function deleteData($table, $id){
        $result = $this->db->delete($table, ['id' => $id]);
        if($result) {
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function uploadPDF(){
        $time                       = time();
        $config['upload_path']      = './uploads/files/';
        $config['allowed_types']    = 'pdf';
        $config['file_name']        = $time.'.pdf';
        $config['overwrite']		= TRUE;

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('file')){
            $results        = [
                'status'    => FALSE
            ];
        }else{
            $results        = [
                'status'    => TRUE,
                'file_name' => $config['file_name']
            ];
        }
        return $results;
    }

    public function uploadImage(){
        $time                       = time();
        $config['upload_path']      = './uploads/images/';
        $config['allowed_types']    = 'jpeg|jpg|png';
        $config['file_name']        = $time.'.jpg';
        $config['overwrite']		= TRUE;
        // $config['max_size']             =  2048;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('file')){
            $results        = [
                'status'    => FALSE
            ];
        }else{
            $results        = [
                'status'    => TRUE,
                'file_name' => $config['file_name']
            ];
            $resize_image   = $this->__createThumbs($config['file_name']);
            if(!$resize_image) {
                $results    = [
                    'status'    => FALSE
                ];
            }
        }
        return $results;
    }

    protected function __createThumbs($file_name){
        $status     = TRUE;
        // Image resizing config
        $config = array(
            // image Medium
            array(
                'image_library' => 'GD2',
                'source_image'  => './uploads/images/'.$file_name,
                'maintain_ratio'=> FALSE,
                'width'         => 600,
                'height'        => 400,
                'new_image'     => './uploads/images/smalls/'.$file_name
                ),
            // Image Small
            array(
                'image_library' => 'GD2',
                'source_image'  => './uploads/images/'.$file_name,
                'maintain_ratio'=> FALSE,
                'width'         => 80,
                'height'        => 60,
                'new_image'     => './uploads/images/thumbs/'.$file_name
            )
        );
 
        $this->load->library('image_lib', $config[0]);
        foreach ($config as $item){
            $this->image_lib->initialize($item);
            if(!$this->image_lib->resize()){
                $status    = FALSE;
            }
            $this->image_lib->clear();
        }
        return $status;
    }
}