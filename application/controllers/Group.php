<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('auth_signin')) {
			redirect('Auth');
		}
		$this->load->model('Group_model');
	}

	public function get_data_group() {
        $group_id = $this->input->get('group_id');

        $data = $this->Group_model->get_data($group_id);
        // if($data->status) {
        //     $newData = [];
        //     foreach($data->data as $value) {
        //         $value->_id = urlencode(_encrypt($value->_id, 'penyihir-cinta', true));
        //         array_push($newData, $value);
        //     }
        //     $data->data = $newData;
        // }

        echo json_encode($data);
    }
}
