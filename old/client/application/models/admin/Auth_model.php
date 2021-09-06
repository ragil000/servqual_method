<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model{

    public function checkAccount($email, $password) {
        $result = $this->db->get_where('admins', ['email' => $email, 'password' => $password]);
        return $result;
    }

}