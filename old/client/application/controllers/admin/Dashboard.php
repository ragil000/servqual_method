<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if(!isset($_SESSION['auth_login'])) {
			redirect('admin/Auth');
		}
		$this->load->model('admin/All_model');
	}

	public function index($content = 'dashboard')
	{
		$data['usulan'] = $this->All_model->getUsulan();
		$data['artikel'] = $this->All_model->getArtikel();
		$data['jurnal'] = $this->All_model->getJurnal();
		$data['head']		= 'Dashboard';
		$data['content']	= 'Dashboard.';
		$data['title']		= 'Dashboard';
		$data['script']		= 'admin/'.$content.'.js';
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/pages/'.$content);
		$this->load->view('admin/templates/footer');
	}

}
