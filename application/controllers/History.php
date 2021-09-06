<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('auth_login')) {
			redirect('Auth');
		}
		$this->load->model('History_model');
	}

	public function index($page=1) {
        $page = floor(($page/10) + 1);
        $getData				= $this->History_model->getData($page);

        //konfigurasi pagination
        $config['base_url'] = site_url('history'); //site url
        $config['total_rows'] = $getData->total_data; //total row
        $config['per_page'] = $getData->limit;  //show record per halaman
        $config["num_links"] = $getData->total_page;

        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = '<i class="fas fa-angle-right"></i>';
        $config['prev_link']        = '<i class="fas fa-angle-left"></i>';
        $config['full_tag_open']    = '<nav aria-label="..."><ul class="pagination justify-content-end mb-0">';
        $config['full_tag_close']   = '</ul></nav>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span class="sr-only">Next</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '<span class="sr-only">Previous</span></span></li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
 
        $this->pagination->initialize($config);
        $data['page'] = $page;
 
        //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 
        $data['data'] = $getData->data;           
 
        $data['pagination'] = $this->pagination->create_links();

		$data['head'] 			= 'Riwayat Kunjungan User';
		$data['content']		= 'Riwayat Kunjungan user';
		$data['title']			= 'Riwayat Kunjungan User';
		$data['node_modules']	= 'sweetalert2/dist/sweetalert2.all.min.js';
		$data['script']			= 'history/history-list.js';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/history/history-list');
		$this->load->view('templates/footer');
	}

	public function createQuast() {
		$data['head'] 			= 'Kuesioner';
		$data['content']		= 'Kuesioner';
		$data['title']			= 'Tambah Kuesioner';
		$data['script']			= 'quast/quast-create.js';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/quast/quast-create');
		$this->load->view('templates/footer');
	}

	public function postQuast() {
		$results	= [
			'status'	=> TRUE,
			'message'	=> 'Kuesioner berhasil di tambahkan.'
		];

		$this->form_validation->set_rules('title', 'Judul', 'trim|required');
		$this->form_validation->set_rules('link', 'Link', 'trim|required');
		if($this->form_validation->run()) {
			$postData = $this->History_model->postData();
			if(!$postData->status) {
				$results	= [
					'status'	=> FALSE,
					'message'	=> 'Kuesioner gagal di tambahkan.'
				];
			}
		}else {
			$results	= [
				'status'	=> FALSE,
				'message'	=> 'Data yang diinput tidak valid.'
			];
		}
		$this->session->set_flashdata(['flash_message' => TRUE, 'status' => ($results['status'] ? 'success' : 'failed'), 'message' => $results['message']]);
		redirect(base_url('quast/createQuast'));
	}

    public function history($page=1) {
        $page = floor(($page/10) + 1);
        $getData				= $this->History_model->getDataHistory($page);

        //konfigurasi pagination
        $config['base_url'] = site_url('quist'); //site url
        $config['total_rows'] = $getData->total_data; //total row
        $config['per_page'] = $getData->limit;  //show record per halaman
        $config["num_links"] = $getData->total_page;

        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = '<i class="fas fa-angle-right"></i>';
        $config['prev_link']        = '<i class="fas fa-angle-left"></i>';
        $config['full_tag_open']    = '<nav aria-label="..."><ul class="pagination justify-content-end mb-0">';
        $config['full_tag_close']   = '</ul></nav>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span class="sr-only">Next</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '<span class="sr-only">Previous</span></span></li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
 
        $this->pagination->initialize($config);
        $data['page'] = $page;
 
        //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 
        $data['data'] = $getData->data;           
 
        $data['pagination'] = $this->pagination->create_links();

		$data['head'] 			= 'Riwayat Evaluasi';
		$data['content']		= 'Riwayat evaluasi';
		$data['title']			= 'Riwayat Evaluasi';
		$data['node_modules']	= 'sweetalert2/dist/sweetalert2.all.min.js';
		$data['script']			= 'quist/quist-history-list.js';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/quist/quist-history-list');
		$this->load->view('templates/footer');
	}

    public function detailhistory($_id) {
		$getData				= $this->History_model->getDetailDataHistory($_id);
		$data['data']			= $getData->data;
		$data['head'] 			= 'Riwayat Evaluasi';
		$data['content']		= 'Riwayat Evaluasi';
		$data['title']			= 'Detail Riwayat evaluasi';
		$data['script']			= 'quist/quist-history-detail.js';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/quist/quist-history-detail');
		$this->load->view('templates/footer');
	}

	public function updateKompetensi($_id) {
		$getData				= $this->History_model->getDetailData(KOMPETENSI, $_id);
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
		$getData				= $this->History_model->getData(MATERI);
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
			$postData = $this->History_model->postData(MATERI);
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
		$getData				= $this->History_model->getDetailData(MATERI, $_id);
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
		$getData				= $this->History_model->getData(TENTANG);
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
			$postData = $this->History_model->postData(TENTANG);
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
		$getData				= $this->History_model->getDetailData(TENTANG, $_id);
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
		$getData				= $this->History_model->getData(BANTUAN);
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
			$postData = $this->History_model->postData(BANTUAN);
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
		$getData				= $this->History_model->getDetailData(BANTUAN, $_id);
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
			$putData = $this->History_model->putData($_id);
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
