<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		// $this->load->model('Auth_model');
    }
    
    public function index() {
        if(!$this->session->userdata('auth_signin')) {
			redirect('Auth');
		}
        $data['head'] 			= 'Dashboard';
		$data['content']		= 'Halaman awal admin';
		$data['title']			= 'Selamat Datang :)';
		// $data['node_modules']	= 'sweetalert2/dist/sweetalert2.all.min.js';
		$data['script']			= 'dashboard.js';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/dashboard');
		$this->load->view('templates/footer');
    }
}