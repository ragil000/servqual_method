<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('auth_login')) {
			redirect('Auth');
		}
		$this->load->model('All_model');
	}

	public function index($content = 'dashboard')
	{
		$data['news'] = [];
		$data['galery'] = [];
		$data['views'] = [];
		$data['head']		= 'Dashboard';
		$data['content']	= 'Dashboard.';
		$data['title']		= 'Dashboard';
		$data['script']		= $content.'.js';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/'.$content);
		$this->load->view('templates/footer');
	}

}
