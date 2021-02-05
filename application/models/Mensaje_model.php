<?php
class Mensaje_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	public function getMensajeDiario($fecha = NULL)
	{
		$this->db->select('mensaje,autor');
		$this->db->from('com_mensaje');
		$this->db->limit(1);
		$this->db->where('fecha !=', 'NULL');
		$this->db->order_by('RAND()', 'asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function insert($data)
	{
		$this->db->insert('com_mensaje', $data);
	}
	public function truncate()
	{
		$this->db->truncate('com_mensaje');
	}
}