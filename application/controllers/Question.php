<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('auth_signin')) {
			redirect('Auth');
		}
		$this->load->model('Questionnaire_model');
		$this->load->model('Question_model');
	}

	public function index($page=1) {
        $questionnaire_id = $this->input->get('questionnaire_id');
        if($questionnaire_id) {
            $questionnaire_id = _decrypt($questionnaire_id, 'penyihir-cinta', true);
            $this->session->set_userdata(['questionnaire_id' => $questionnaire_id]);
        }
        
        $this->session->set_userdata(['old_url' => str_replace('/servqual_method/', '',$_SERVER['REQUEST_URI']), 'old_query' => $_SERVER['QUERY_STRING']]);
		$page = floor(($page/10) + 1);
        $get_data				= $this->Question_model->get_data($page);

        //konfigurasi pagination
        $config['base_url'] = site_url('questionnaire/question'); //site url
        $config['total_rows'] = $get_data->total_data; //total row
        $config['per_page'] = $get_data->limit;  //show record per halaman
        $config["num_links"] = $get_data->total_page;

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
 
        $data['data'] = $get_data->data;           
 
        $data['pagination'] = $this->pagination->create_links();

		$data['head'] 			= 'Pertanyaan';
		$data['content']		= 'Daftar Pertanyaan Kuesioner';
		$data['title']			= 'Pertanyaan';
		$data['css_vendors']	= ['select2/css/select2.min.css'];
		$data['js_vendors']	= ['sweetalert2/sweetalert2.all.min.js', 'select2/js/select2.min.js'];
		$data['script']			= 'questionnaire/question/list.js';

		$this->load->view('templates/header', $data);
		$this->load->view('pages/questionnaire/question/list');
		$this->load->view('templates/footer');
	}

    public function test_data() {
        $page = $this->input->get('page');
        $search = $this->input->get('search');

        $data = $this->Questionnaire_model->get_data($page, $search);
        echo json_encode($data);
    }

	public function create() {
		$data['head'] 			= 'Kuesioner';
		$data['content']		= 'Daftar Kuesioner';
		$data['title']			= 'Kuesioner';
		$data['script']			= 'questionnaire/questionnaire/create.js';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/questionnaire/questionnaire/create');
		$this->load->view('templates/footer');
	}

	public function post() {
		$results	= (object) [
			'status'	=> TRUE,
			'message'	=> 'Data berhasil di tambahkan.'
		];

		$this->form_validation->set_rules('start_periode', 'Periode Awal', 'trim|required');
		$this->form_validation->set_rules('end_periode', 'Periode Akhir', 'trim|required');
		if($this->form_validation->run()) {
			$post = [
                'start_periode' => $this->input->post('start_periode'),
                'end_periode' => $this->input->post('end_periode'),
                'status' => 'active',
                'lab_id' => $this->session->userdata('lab_id'),
                'created_by' => $this->session->userdata('_id')
            ];

			$results = $this->Question_model->post_data($post);
		}else {
			$results = (object) [
				'status'	=> FALSE,
				'message'	=> 'data yang diinput tidak valid.'
			];
		}
		$this->session->set_flashdata(['flash_message' => TRUE, 'status' => ($results->status ? 'success' : 'warning'), 'message' => $results->message]);
		redirect(base_url('questionnaire/questionnaire/create'));
	}

    public function activate() {
        $_id = $this->input->get('_id');
        $results = (object) [
            'status'	=> FALSE,
            'message'	=> 'parameter _id tidak ditemukan.'
        ];

        if($_id) {
            $_id = _decrypt($_id, 'penyihir-cinta', true);
            $results = $this->Question_model->activate_data($_id);
        }

        $this->session->set_flashdata(['flash_message' => TRUE, 'status' => ($results->status ? 'success' : 'warning'), 'message' => $results->message]);
		redirect($this->session->userdata('old_url').($this->session->userdata('old_query') ? '?'.$this->session->userdata('old_query') : ''));
    }

    public function delete() {
        $_id = $this->input->get('_id');
        $results = (object) [
            'status'	=> FALSE,
            'message'	=> 'parameter _id tidak ditemukan.'
        ];

        if($_id) {
            $_id = _decrypt($_id, 'penyihir-cinta', true);
            $results = $this->Question_model->delete_data($_id);
        }

        $this->session->set_flashdata(['flash_message' => TRUE, 'status' => ($results->status ? 'success' : 'warning'), 'message' => $results->message]);
		redirect($this->session->userdata('old_url').($this->session->userdata('old_query') ? '?'.$this->session->userdata('old_query') : ''));
    }
}
