<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('stock_model');
	}


	public function index()
	{
		$data['stock']=$this->stock_model->get_all_stocks($this->session->userdata('user_id'));
		$this->load->view('stock_view',$data);
	}
	public function stock_add()
	{
		$data = array(
			'user_id' => $this->input->post('user_id'),
			'date'=> $this->input->post('stock_date'),
			'exchange' => $this->input->post('stock_exc'),
			'comp_name'=> $this->input->post('stock_name'),
			'face_value'=> $this->input->post('stock_val'),
			'num_shares'=> $this->input->post('stock_num'),
			'price_bought'=> $this->input->post('stock_price'),
			);
		$insert = $this->stock_model->stock_add($data);
		echo json_encode(array("status" => TRUE));
	}
	public function ajax_edit($id)
	{
		$data = $this->stock_model->get_by_id($id);



		echo json_encode($data);
	}

	public function stock_update()
	{
		$data = array(
			'date'=> $this->input->post('stock_date'),
			'exchange' => $this->input->post('stock_exc'),
			'comp_name'=> $this->input->post('stock_name'),
			'face_value'=> $this->input->post('stock_val'),
			'num_shares'=> $this->input->post('stock_num'),
			'price_bought'=> $this->input->post('stock_price'),
			);
		$this->stock_model->stock_update(array('stock_id' => $this->input->post('user_id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function stock_delete($id)
	{
		$this->stock_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

}
