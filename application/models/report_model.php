<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class report_model extends CI_Model
{

	var $table = 'stock';

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	public function get_all_stocks($user_id)
	{
		$query =   $this->db->query("SELECT exchange,comp_name, face_value,sum(num_Shares) as count, sum(num_shares * price_bought) as total FROM stock WHERE user_id = $user_id group by exchange,comp_name order by comp_name");
		return $query->result();
	}



}
