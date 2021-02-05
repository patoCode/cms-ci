<?php
class Foto_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	public function getFoto()
	{
		$this->db->select('id_imagen,imagen');
		$this->db->from('com_imagen');
		$this->db->order_by('RAND()', 'asc');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->result();
	}
}