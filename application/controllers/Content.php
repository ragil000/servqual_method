<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Content extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('auth_login')) {
			redirect('Auth');
		}
		$this->load->model('Content_model');
		$this->load->model('All_model');
	}

	public function index() {
		$getData				= $this->Content_model->getData(KOMPETENSI);
		$data['data']			= $getData->data;
		$data['head'] 			= 'Konten Aplikasi';
		$data['content']		= 'Konten kompetensi';
		$data['title']			= 'Kompetensi';
		$data['node_modules']	= 'sweetalert2/dist/sweetalert2.all.min.js';
		$data['script']			= 'content/kompetensi-list.js';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/content/kompetensi-list');
		$this->load->view('templates/footer');
	}

	public function createKompetensi() {
		$data['head'] 			= 'Konten Aplikasi';
		$data['content']		= 'Konten kompetensi';
		$data['title']			= 'Kompetensi';
		$data['script']			= 'content/kompetensi-create.js';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/content/kompetensi-create');
		$this->load->view('templates/footer');
	}

	public function postKompetensi() {
		$results	= [
			'status'	=> TRUE,
			'message'	=> 'Konten kompetensi berhasil di tambahkan.'
		];

		$this->form_validation->set_rules('title', 'Judul', 'trim|required');
		$this->form_validation->set_rules('description', 'Isi', 'trim|required');
		if($this->form_validation->run()) {
			$postData = $this->Content_model->postData(KOMPETENSI);
			if(!$postData->status) {
				$results	= [
					'status'	=> FALSE,
					'message'	=> 'Konten kompetensi gagal di tambahkan.'
				];
			}
		}else {
			$results	= [
				'status'	=> FALSE,
				'message'	=> 'Data yang diinput tidak valid.'
			];
		}
		$this->session->set_flashdata(['flash_message' => TRUE, 'status' => ($results['status'] ? 'success' : 'failed'), 'message' => $results['message']]);
		redirect(base_url('content/createKompetensi'));
	}

	public function updateKompetensi($_id) {
		$getData				= $this->Content_model->getDetailData(KOMPETENSI, $_id);
		$data['_id']			= $_id;
		$data['data']			= $getData->data;
		$data['head'] 			= 'Konten Aplikasi';
		$data['content']		= 'Konten kompetensi';
		$data['title']			= 'Kompetensi';
		$data['script']			= 'content/kompetensi-update.js';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/content/kompetensi-update');
		$this->load->view('templates/footer');
	}

	public function materi() {
		$getData				= $this->Content_model->getData(MATERI);
		$data['data']			= $getData->data;
		$data['head'] 			= 'Konten Aplikasi';
		$data['content']		= 'Konten materi';
		$data['title']			= 'Materi';
		$data['node_modules']	= 'sweetalert2/dist/sweetalert2.all.min.js';
		$data['script']			= 'content/materi-list.js';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/content/materi-list');
		$this->load->view('templates/footer');
	}

	public function createMateri() {
		$data['head'] 			= 'Konten Aplikasi';
		$data['content']		= 'Konten materi';
		$data['title']			= 'Materi';
		$data['script']			= 'content/materi-create.js';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/content/materi-create');
		$this->load->view('templates/footer');
	}

	public function postMateri() {
		$results	= [
			'status'	=> TRUE,
			'message'	=> 'Konten materi berhasil di tambahkan.'
		];

		$this->form_validation->set_rules('title', 'Judul', 'trim|required');
		$this->form_validation->set_rules('description', 'Isi', 'trim|required');
		if($this->form_validation->run()) {
			$postData = $this->Content_model->postData(MATERI);
			if(!$postData->status) {
				$results	= [
					'status'	=> FALSE,
					'message'	=> 'Konten materi gagal di tambahkan.'
				];
			}
		}else {
			$results	= [
				'status'	=> FALSE,
				'message'	=> 'Data yang diinput tidak valid.'
			];
		}
		$this->session->set_flashdata(['flash_message' => TRUE, 'status' => ($results['status'] ? 'success' : 'failed'), 'message' => $results['message']]);
		redirect(base_url('content/createMateri'));
	}

	public function updateMateri($_id) {
		$getData				= $this->Content_model->getDetailData(MATERI, $_id);
		$data['_id']			= $_id;
		$data['data']			= $getData->data;
		$data['head'] 			= 'Konten Aplikasi';
		$data['content']		= 'Konten materi';
		$data['title']			= 'Materi';
		$data['script']			= 'content/materi-update.js';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/content/materi-update');
		$this->load->view('templates/footer');
	}

	public function tentang() {
		$getData				= $this->Content_model->getData(TENTANG);
		$data['data']			= $getData->data;
		$data['head'] 			= 'Konten Aplikasi';
		$data['content']		= 'Konten tentang';
		$data['title']			= 'Tentang';
		$data['node_modules']	= 'sweetalert2/dist/sweetalert2.all.min.js';
		$data['script']			= 'content/tentang-list.js';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/content/tentang-list');
		$this->load->view('templates/footer');
	}

	public function createTentang() {
		$data['head'] 			= 'Konten Aplikasi';
		$data['content']		= 'Konten tentang';
		$data['title']			= 'Tentang';
		$data['script']			= 'content/tentang-create.js';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/content/tentang-create');
		$this->load->view('templates/footer');
	}

	public function postTentang() {
		$results	= [
			'status'	=> TRUE,
			'message'	=> 'Konten tentang berhasil di tambahkan.'
		];

		$this->form_validation->set_rules('title', 'Judul', 'trim|required');
		$this->form_validation->set_rules('description', 'Isi', 'trim|required');
		if($this->form_validation->run()) {
			$postData = $this->Content_model->postData(TENTANG);
			if(!$postData->status) {
				$results	= [
					'status'	=> FALSE,
					'message'	=> 'Konten tentang gagal di tambahkan.'
				];
			}
		}else {
			$results	= [
				'status'	=> FALSE,
				'message'	=> 'Data yang diinput tidak valid.'
			];
		}
		$this->session->set_flashdata(['flash_message' => TRUE, 'status' => ($results['status'] ? 'success' : 'failed'), 'message' => $results['message']]);
		redirect(base_url('content/createTentang'));
	}

	public function updateTentang($_id) {
		$getData				= $this->Content_model->getDetailData(TENTANG, $_id);
		$data['_id']			= $_id;
		$data['data']			= $getData->data;
		$data['head'] 			= 'Konten Aplikasi';
		$data['content']		= 'Konten tentang';
		$data['title']			= 'Tentang';
		$data['script']			= 'content/tentang-update.js';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/content/tentang-update');
		$this->load->view('templates/footer');
	}

	public function bantuan() {
		$getData				= $this->Content_model->getData(BANTUAN);
		$data['data']			= $getData->data;
		$data['head'] 			= 'Konten Aplikasi';
		$data['content']		= 'Konten bantuan';
		$data['title']			= 'Bantuan';
		$data['node_modules']	= 'sweetalert2/dist/sweetalert2.all.min.js';
		$data['script']			= 'content/bantuan-list.js';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/content/bantuan-list');
		$this->load->view('templates/footer');
	}

	public function createBantuan() {
		$data['head'] 			= 'Konten Aplikasi';
		$data['content']		= 'Konten bantuan';
		$data['title']			= 'Bantuan';
		$data['script']			= 'content/bantuan-create.js';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/content/bantuan-create');
		$this->load->view('templates/footer');
	}

	public function postBantuan() {
		$results	= [
			'status'	=> TRUE,
			'message'	=> 'Konten bantuan berhasil di tambahkan.'
		];

		$this->form_validation->set_rules('title', 'Judul', 'trim|required');
		$this->form_validation->set_rules('description', 'Isi', 'trim|required');
		if($this->form_validation->run()) {
			$postData = $this->Content_model->postData(BANTUAN);
			if(!$postData->status) {
				$results	= [
					'status'	=> FALSE,
					'message'	=> 'Konten bantuan gagal di tambahkan.'
				];
			}
		}else {
			$results	= [
				'status'	=> FALSE,
				'message'	=> 'Data yang diinput tidak valid.'
			];
		}
		$this->session->set_flashdata(['flash_message' => TRUE, 'status' => ($results['status'] ? 'success' : 'failed'), 'message' => $results['message']]);
		redirect(base_url('content/createBantuan'));
	}

	public function updateBantuan($_id) {
		$getData				= $this->Content_model->getDetailData(BANTUAN, $_id);
		$data['_id']			= $_id;
		$data['data']			= $getData->data;
		$data['head'] 			= 'Konten Aplikasi';
		$data['content']		= 'Konten bantuan';
		$data['title']			= 'Bantuan';
		$data['script']			= 'content/bantuan-update.js';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/content/bantuan-update');
		$this->load->view('templates/footer');
	}

	public function putData($_id) {
		$results	= [
			'status'	=> TRUE,
			'message'	=> 'Konten kompetensi berhasil diubah.'
		];

		$this->form_validation->set_rules('title', 'Judul', 'trim|required');
		$this->form_validation->set_rules('description', 'Isi', 'trim|required');
		if($this->form_validation->run()) {
			$putData = $this->Content_model->putData($_id);
			if(!$putData->status) {
				$results	= [
					'status'	=> FALSE,
					'message'	=> 'Konten kompetensi gagal diubah.'
				];
			}
		}else {
			$results	= [
				'status'	=> FALSE,
				'message'	=> 'Data yang diinput tidak valid.'
			];
		}
		$this->session->set_flashdata(['flash_message' => TRUE, 'status' => ($results['status'] ? 'success' : 'failed'), 'message' => $results['message']]);
		redirect(base_url('content'));
	}
}
