<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model {
	
	private $db_name = "users";
	
	public function get_user($id)
	{
		$data = $this->db->get_where($this->db_name, array('id' => $id), 1)->row();
		if ($data->id > 0)
			return $data;
		else
			return false;
	}
	
	public function create($session_id)
	{
		$data = array(
			'session_id' => $session_id,
			'date' => time(),
			);
		$this->db->insert($this->db_name, $data);
		return $this->db->insert_id();
	}
}