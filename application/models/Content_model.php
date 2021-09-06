<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Content_model extends CI_Model{

    public function getData($type=KOMPETENSI){
        $ch = curl_init(BASE_API_URL.'content/'.$type);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        $serverOutput = curl_exec($ch);
        curl_close($ch);
        
        $serverOutput = json_decode($serverOutput);
        return $serverOutput;
    }

    public function getDetailData($type=KOMPETENSI, $_id){
        $ch = curl_init(BASE_API_URL.'content/detail/'.$type.'/'.$_id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        $serverOutput = curl_exec($ch);
        curl_close($ch);
        
        $serverOutput = json_decode($serverOutput);
        return $serverOutput;
    }

    public function postData($type=KOMPETENSI) {
        $post = [
            'menu_id' => KOMPETENSI,
            'title' => $this->input->post('title'),
            'youtube' => $this->input->post('youtube'),
            'image' => ($_FILES['file']['tmp_name'] ? new CURLFILE($_FILES['file']['tmp_name'], $_FILES['file']['type'], $_FILES['file']['name']) : null),
            'description' => $this->input->post('description'),
        ];

        $ch = curl_init(BASE_API_URL.'content/'.$type);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['content-type: multipart/form-data']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        $serverOutput = curl_exec($ch);
        curl_close($ch);
        
        $serverOutput = json_decode($serverOutput);
        return $serverOutput;
    }

    public function putData($_id) {
        $post = [
            'title' => $this->input->post('title'),
            'youtube' => $this->input->post('youtube'),
            'image' => ($_FILES['file']['tmp_name'] ? new CURLFILE($_FILES['file']['tmp_name'], $_FILES['file']['type'], $_FILES['file']['name']) : null),
            'description' => $this->input->post('description'),
        ];

        $ch = curl_init(BASE_API_URL.'content/update/'.$_id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['content-type: multipart/form-data']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        $serverOutput = curl_exec($ch);
        curl_close($ch);
        
        $serverOutput = json_decode($serverOutput);
        return $serverOutput;
    }
}