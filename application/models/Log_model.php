<?php
class Log_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	public function insert($data)
	{
		$this->db->insert('com_log', $data);
	}
}