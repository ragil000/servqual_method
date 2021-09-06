<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat_model extends CI_Model{

    public function getData($page){
        $ch = curl_init(BASE_API_URL.'chat/pagination/'.$page);
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
            'question' => $this->input->post('question'),
            'answer_a' => $this->input->post('answer_a'),
            'answer_b' => $this->input->post('answer_b'),
            'answer_c' => $this->input->post('answer_c'),
            'answer_d' => $this->input->post('answer_d'),
            'is_correct' => $this->input->post('is_correct')
        ];

        $ch = curl_init(BASE_API_URL.'quist/');
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