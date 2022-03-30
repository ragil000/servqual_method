<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gap5 extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('auth_signin')) {
			redirect('Auth');
		}
		$this->load->model('Questionnaire_model');
		$this->load->model('Dimension_model');
		$this->load->model('Question_model');
		// $this->load->model('Answer_model');
		$this->load->model('SummaryServqual_model');
	}

    public function filter() {
        $this->session->set_userdata(['old_url' => str_replace('/servqual_method/', '',$_SERVER['REQUEST_URI']), 'old_query' => $_SERVER['QUERY_STRING']]);
        
		$data['head'] 			= 'Uji GAP 5';
		$data['content']		= 'Filter Kuesioner Uji GAP 5';
		$data['title']			= 'Uji GAP 5';
		$data['style']			= 'analysis/gap5/filter.css';
		$data['css_vendors']	= ['select2/css/select2.min.css'];
		$data['js_vendors'] 	= ['select2/js/select2.min.js'];
		$data['script']			= 'analysis/gap5/filter.js';

		$this->load->view('templates/header', $data);
		$this->load->view('pages/analysis/gap5/filter');
		$this->load->view('templates/footer');
	}

	public function index($page=1) {
        $this->session->set_userdata(['old_url' => str_replace('/servqual_method/', '',$_SERVER['REQUEST_URI']), 'old_query' => $_SERVER['QUERY_STRING']]);
        
        $search = $this->input->post('search') || $this->session->userdata('search_question');
        if($search) {
            $this->session->set_userdata(['search_question' => $search]);
        }

        $questionnaire_id = urldecode($this->input->post('questionnaire_id'));
        if($questionnaire_id) {
            $questionnaire_id = _decrypt($questionnaire_id, 'penyihir-cinta', true);
            $this->session->set_userdata(['current_questionnaire_id' => $questionnaire_id]);
        }

        $data['current_questionnaire'] = $this->Questionnaire_model->get_default_questionnaire();
        
		$page = floor(($page/10) + 1);
        $get_data				= $this->Question_model->get_data($page, $search, $data['current_questionnaire']->data->_id);

        //konfigurasi pagination
        $config['base_url'] = site_url('analysis/gap5/list'); //site url
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

		$data['head'] 			= 'Uji GAP 5';
		$data['content']		= 'Daftar Hasil Uji GAP 5';
		$data['title']			= 'Uji GAP 5';
		$data['style']			= 'analysis/gap5/list.css';
		$data['css_vendors']	= ['select2/css/select2.min.css'];
		$data['js_vendors']	    = ['sweetalert2/sweetalert2.all.min.js', 'select2/js/select2.min.js'];
		$data['script']			= 'analysis/gap5/list.js';

		$this->load->view('templates/header', $data);
		$this->load->view('pages/analysis/gap5/list');
		$this->load->view('templates/footer');
	}

    public function get_data_summary_servqual() {
        $question_id = $this->input->get('question_id');

        $get_data = $this->SummaryServqual_model->get_detail_data($question_id);

        echo json_encode($get_data);
    }

    public function get_data_questionnaire() {
        $page = $this->input->get('page');
        $search = $this->input->get('search');

        $data = $this->Questionnaire_model->get_data($page, $search);
        if($data->status) {
            $newData = [];
            foreach($data->data as $value) {
                $value->_id = urlencode(_encrypt($value->_id, 'penyihir-cinta', true));
                array_push($newData, $value);
            }
            $data->data = $newData;
        }

        echo json_encode($data);
    }

    public function get_data_dimension() {
        $page = $this->input->get('page');
        $search = $this->input->get('search');

        $data = $this->Dimension_model->get_data($page, $search);

        echo json_encode($data);
    }

	public function create() {
        $this->session->set_userdata(['old_url' => str_replace('/servqual_method/', '',$_SERVER['REQUEST_URI']), 'old_query' => $_SERVER['QUERY_STRING']]);
        $_id = $this->input->get('_id');

        if($_id) {
            $_id = _decrypt($_id, 'penyihir-cinta', true);
            $get_data = $this->Question_model->get_detail_data($_id);
            if($get_data->status) {
                $data['old_data'] = $get_data->data;
            }
        }
		$data['head'] 			= 'Pertanyaan';
		$data['content']		= 'Daftar Pertanyaan Kuesioner';
		$data['title']			= 'Pertanyaan';
		$data['style']			= 'questionnaire/question/create.css';
        $data['css_vendors']	= ['select2/css/select2.min.css'];
		$data['js_vendors']	    = ['select2/js/select2.min.js'];
		$data['script']			= 'questionnaire/question/create.js';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/questionnaire/question/create');
		$this->load->view('templates/footer');
	}

	public function post() {
		$results	= (object) [
			'status'	=> TRUE,
			'message'	=> 'Data berhasil di tambahkan.'
		];

		$this->form_validation->set_rules('dimension_id', 'Dimensi', 'trim|required');
		$this->form_validation->set_rules('question', 'Pertanyaan', 'trim|required');
		if($this->form_validation->run()) {
			$post = [
                'dimension_id' => $this->input->post('dimension_id'),
                'question' => $this->input->post('question'),
                'questionnaire_id' => $this->session->userdata('current_questionnaire_id'),
                'lab_id' => $this->session->userdata('lab_id'),
                'created_by' => $this->session->userdata('_id'),
            ];

			$results = $this->Question_model->post_data($post);
		}else {
			$results = (object) [
				'status'	=> FALSE,
				'message'	=> 'data yang diinput tidak valid.'
			];
		}
		$this->session->set_flashdata(['flash_message' => TRUE, 'status' => ($results->status ? 'success' : 'warning'), 'message' => $results->message]);
		redirect(base_url('questionnaire/question/create'));
	}

    public function put() {
		$results	= (object) [
			'status'	=> TRUE,
			'message'	=> 'Data berhasil di diubah.'
		];

		$this->form_validation->set_rules('dimension_id', 'Dimensi', 'trim|required');
		$this->form_validation->set_rules('question', 'Pertanyaan', 'trim|required');
		if($this->form_validation->run()) {
			$post = [
                '_id' => $this->input->post('_id'),
                'dimension_id' => $this->input->post('dimension_id'),
                'question' => $this->input->post('question'),
                'questionnaire_id' => $this->input->post('questionnaire_id'),
                'lab_id' => $this->input->post('lab_id'),
                'updated_by' => $this->session->userdata('_id'),
            ];

			$results = $this->Question_model->put_data($post);
		}else {
			$results = (object) [
				'status'	=> FALSE,
				'message'	=> 'data yang diinput tidak valid.'
			];
		}
		$this->session->set_flashdata(['flash_message' => TRUE, 'status' => ($results->status ? 'success' : 'warning'), 'message' => $results->message]);
        redirect($this->session->userdata('old_url'));
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
		redirect($this->session->userdata('old_url'));
    }
}
