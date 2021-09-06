<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penelitian extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Penelitian_model');
	}

	public function index($content = 'usulan-penelitian') {
		$data['agencies']					= $this->Penelitian_model->getAgencies();
		$data['new_articles']	= $this->Penelitian_model->getNewArticle();
		$data['head'] 		= 'Usulan Penelitian';
		$data['content']	= 'Form usulan penelitian netlitbang kabupaten Bombana.';
		$data['title']		= 'Usulan Penelitian';
		$data['link_map']	= [
			[
				'title'	=> 'beranda',
				'slug'	=> base_url()
			],
			[
				'title'	=> 'usualan penelitian',
				'slug'	=> NULL
			]
		];
		$this->load->view('templates/header');
		$this->load->view('templates/head-content', $data);
		$this->load->view('pages/'.$content);
		$this->load->view('templates/footer');
	}

	public function post() {
		$results	= [
			'status'	=> TRUE,
			'message'	=> 'Usulan penelitian berhasil dikirim.'
		];

		$this->form_validation->set_rules('title', 'Judul', 'trim|required');
		$this->form_validation->set_rules('problem', 'Idenifikasi Masalah', 'trim|required');
		$this->form_validation->set_rules('purpose', 'Tujuan', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		// $this->form_validation->set_rules('file', 'PDF', 'required');
		if($this->form_validation->run()) {
			$file	= $this->Penelitian_model->uploadPDF();
			if($file['status']) {
				$data	= [
					'title'			=> $this->input->post('title'),
					'problem'		=> $this->input->post('problem'),
					'purpose'		=> $this->input->post('purpose'),
					'agency'		=> $this->input->post('agency'),
					'email'			=> $this->input->post('email'),
					'tor'			=> $file['tor'],
					'icp'			=> $file['icp'],
					'created_by'	=> 1
				];
				$result	= $this->Penelitian_model->postData($data);
				if(!$result) {
					$results	= [
						'status'	=> FALSE,
						'message'	=> 'Usulan penelitian gagal dikirim.'
					];
				}
			}else {
				$results	= [
					'status'	=> FALSE,
					'message'	=> 'File gagal di unggah.'
				];
			}
		}else {
			$results	= [
				'status'	=> FALSE,
				'message'	=> 'Data yang diinput tidak valid.'
			];
		}

		if($results['status']) {
			$this->session->set_flashdata(['flash_message' => TRUE, 'status' => 'success', 'message' => $results['message']]);
			redirect(base_url('usulan-penelitian'));
		}else {
			$this->session->set_flashdata(['flash_message' => TRUE, 'status' => 'danger', 'message' => $results['message']]);
			redirect(base_url('usulan-penelitian'));
		}
	}
}
