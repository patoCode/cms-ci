<?php
class Menu_model extends CI_model
{
	function __construct()
	{
		parent::__construct();
	}
	public function getCargo($id)
	{
		$this->db->from('com_cargo');
		$this->db->where('id_cargo', $id);
		$query = $this->db->get();
		return $query->row();
	}
	public function getPrivilegios($id)
	{
		$this->db->from('privilegio_cargo');
		$this->db->join('com_privilegio', 'privilegio_cargo.id_privilegio = com_privilegio.id_privilegio', 'left');
		$this->db->where('privilegio_cargo.id_cargo', $id);
		$this->db->order_by('com_privilegio.privilegio', 'asc');
		$query = $this->db->get();
		return $query->result();
	}
}