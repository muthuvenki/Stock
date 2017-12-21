<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('report_model');
	}


	public function index()
	{
		$data['stock']=$this->report_model->get_all_stocks($this->session->userdata('user_id'));
		$this->load->view('report_view',$data);
	}
	
}
