<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Auth_model');
    }
    
    public function index() {
        if($this->session->userdata('auth_signin')) {
			redirect('dashboard');
		}
        $this->session->set_userdata(['old_url' => str_replace('/servqual_method/', '',$_SERVER['REQUEST_URI']), 'old_query' => $_SERVER['QUERY_STRING']]);
        $this->load->view('pages/signin');
    }

    public function signin() {
        $post = [
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'lab_id' => $this->input->post('lab_id')
        ];
        
        $get_user = $this->Auth_model->signin($post);
        if($get_user->status) {
            $data_user = $get_user->data;
            if($data_user->role == 'admin') {
                $this->session->set_userdata([
                  'auth_signin' => TRUE,
                  '_id' => $data_user->_id, 
                  'username' => $data_user->username,
                  'role' => $data_user->role,
                  'lab_id' => $data_user->lab_id,
                  'lab_title' => $data_user->lab_title
                ]);
                redirect('dashboard');
            }else if($data_user->role == 'super') {
                $this->session->set_userdata([
                    'auth_signin' => TRUE,
                    '_id' => $data_user->_id, 
                    'username' => $data_user->username,
                    'role' => $data_user->role
                ]);
                redirect('dashboard');
            }else {
                // session_destroy();
                $this->session->set_flashdata(['flash_message' => TRUE, 'message' => $get_user->message]);
                redirect($this->session->userdata('old_url').($this->session->userdata('old_query') ? '?'.$this->session->userdata('old_query') : ''));
            }
        }else {
            // session_destroy();
            $this->session->set_flashdata(['flash_message' => TRUE, 'message' => $get_user->message]);
            redirect($this->session->userdata('old_url').($this->session->userdata('old_query') ? '?'.$this->session->userdata('old_query') : ''));
            redirect('Auth');
        }
    }

    public function register() {
        if($this->session->userdata('auth_signin')) {
			redirect('dashboard');
		}
        $this->load->view('pages/signup');
    }

    public function signup() {
        $post = [
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'role' => $this->input->post('role')
        ];

        if(!empty($this->input->post('lab_id'))) {
            $post['lab_id'] = $this->input->post('lab_id');
        }
        
        $set_user = $this->Auth_model->signup($post);
        if($set_user->status) {
            // session_destroy();
            $this->session->set_flashdata(['flash_message' => TRUE, 'message' => $set_user->message]);
            redirect('Auth/register');
        }else {
            // session_destroy();
            $this->session->set_flashdata(['flash_message' => TRUE, 'message' => $set_user->message]);
            redirect('Auth/register');
        }
    }

    public function logout() {
        session_destroy();
        redirect('Auth');
    }
}