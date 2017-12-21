<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class stock_model extends CI_Model
{

	var $table = 'stock';

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	public function get_all_stocks($user_id)
	{
		$this->db->from('stock');
		$this->db->where('user_id',$user_id);
		$query=$this->db->get();
		return $query->result();
	}


	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('stock_id',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function stock_add($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function stock_update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('stock_id', $id);
		$this->db->delete($this->table);
	}


}
