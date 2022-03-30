<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
        if(!$this->session->userdata('auth_signin')) {
			redirect('Auth');
		}
		$this->load->model('Dashboard_model');
    }
    
    public function index() {
        $role = $this->session->userdata('role');
        $lab_id = $this->session->userdata('lab_id');
        $lab_title = $this->session->userdata('lab_title');

        if($role == 'super') {
            $data['data']           = $this->Dashboard_model->get_data();
        }else {
            $data['data']           = $this->Dashboard_model->get_data($lab_id);
        }
        $data['head'] 			= 'Dashboard';
		$data['content']		= 'Halaman awal admin';
        if($role == 'super') {
            $data['title']			= 'Selamat datang di halaman <span class="text-primary">Super Admin</span> :)';
        }else {
            $data['title']			= 'Selamat datang di halaman admin <span class="text-primary">'.$lab_title.'</span> :)';
        }
		// $data['node_modules']	= 'sweetalert2/dist/sweetalert2.all.min.js';
		$data['script']			= 'dashboard.js';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/dashboard');
		$this->load->view('templates/footer');
    }
}