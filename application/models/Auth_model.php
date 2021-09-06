<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model{

    public function login($post) {
        $ch = curl_init(BASE_API_URL.'auth/signin');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        $serverOutput = curl_exec($ch);
        curl_close($ch);
        
        $serverOutput = json_decode($serverOutput);
        return $serverOutput;
    }

}