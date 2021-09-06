<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Auth_model');
    }
    
    public function index() {
        if($this->session->userdata('auth_login')) {
			redirect('dashboard');
		}
        $this->load->view('pages/login');
    }

    public function login() {
        $post = [
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password')
        ];
        
        $getUser = $this->Auth_model->login($post);
        if($getUser->status) {
            $dataUser = $getUser->data;
            if($dataUser->role == 'admin') {
                $this->session->set_userdata([
                  'auth_login' => TRUE,
                  '_id' => $dataUser->_id, 
                  'username' => $dataUser->username,
                  'role' => $dataUser->role
                ]);
                redirect('dashboard');
            }else if($dataUser->role == 'user') {
                session_destroy();
                $this->session->set_flashdata(['flash_message' => TRUE, 'message' => 'Anda bukan admin']);
                redirect('Auth');
            }
        }else {
            session_destroy();
            $this->session->set_flashdata(['flash_message' => TRUE, 'message' => 'Email atau password tidak valid']);
            redirect('Auth');
        }
    }

    public function logout() {
        session_destroy();
        redirect('dashboard');
    }
}