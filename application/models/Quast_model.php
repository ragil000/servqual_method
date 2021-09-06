<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quast_model extends CI_Model{

    public function getData($page){
        $ch = curl_init(BASE_API_URL.'quast/'.$page);
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

    public function postData() {
        $post = [
            'title' => $this->input->post('title'),
            'link' => $this->input->post('link')
        ];

        $ch = curl_init(BASE_API_URL.'quast/');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        $serverOutput = curl_exec($ch);
        curl_close($ch);
        
        $serverOutput = json_decode($serverOutput);
        return $serverOutput;
    }

    public function getDataHistory($page){
        $ch = curl_init(BASE_API_URL.'history/list_member_answer/'.$page);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        $serverOutput = curl_exec($ch);
        curl_close($ch);
        
        $serverOutput = json_decode($serverOutput);
        return $serverOutput;
    }

    public function getDetailDataHistory($_id){
        $ch = curl_init(BASE_API_URL.'history/detail_member_answer/'.$_id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        $serverOutput = curl_exec($ch);
        curl_close($ch);
        
        $serverOutput = json_decode($serverOutput);
        return $serverOutput;
    }
}