<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Code_model extends CI_Model {
	
	private $db_name = "codes";
	
	function __construct()
    {
        parent::__construct();
    }
	
	public function get_code($id)
	{
		$data = $this->db->get_where($this->db_name, array('id' => $id), 1)->row();
		if ($data)
			return $data;
		else
			return false;
	}
	
	public function get_code_secret($id)
	{
		$data = $this->db->get_where($this->db_name, array('secret' => $id), 1)->row();
		if ($data)
			return $data;
		else
			return false;
	}
	
	public function update($id, $link, $user_id)
	{
		$db_id = $this->db->get_where($this->db_name, array('id' => $id))->result();
			if ($db_id)
				return $this->db->where('id', $id)->update($this->db_name, array('data' => $link, 'user_id' => $user_id));
			else
				return false;
	}
	
	/*
	 * Accepterar validerat data, lägger sedan in i DB:n
	 */
	
	public function insert_code($link, $user_id = NULL)
	{
		$id =  $this->generate_id();
		$filter = substr($link, 0, 6);
		if ($filter != "http://")
			$link = "http://".$link;
		
		$data = array('data' => $link, 'user_id' => $user_id, 'id' => $id, 'secret' => $secret);
		return $this->db->insert($this->db_name, $data);
	}
	
		public function update_clicks($id)
		{
			$data = $this->get_code($id);
			$clicks = $data->clicks + 1;
			$this->db->where('id', $id)->update($this->db_name, array('clicks' => $clicks));
		}
	
	public function create()
	{
		$id =  $this->generate_id();
		$secret = hash('sha256', $id.time().mt_rand()."DASHslashDASH");
		$data = array('date' => time(), 'id' => $id, 'secret' => $secret);
		$this->db->insert($this->db_name, $data);
		return $id;
	}
	
	private function generate_id()
	{
		$id = FALSE;
		while ( ! $id)
		{
			$tmp_id = NULL;
			$tmp_id = substr(base64_encode(uniqid(mt_rand(), true).mt_rand()), 1, 5);
			$db_id = $this->db->get_where($this->db_name, array('id' => $tmp_id))->result();
			if ( ! $db_id)
				$id = $tmp_id;
		}
		
		return $id;
	}
}