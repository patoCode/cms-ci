<?php
class Archivo_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	public function getAllCategory($id)
	{
		$this->db->from('com_archivo');
		$this->db->where('id_categoria', $id);
		$this->db->order_by('fecha', 'desc');
		$query = $this->db->get();
		return $query->result();
	}
	public function albumFotografico()
	{
		$this->db->from('com_archivo');
		$this->db->where('id_categoria', '11');
		$this->db->order_by('fecha', 'desc');
		$this->db->limit(10);
		$query = $this->db->get();
		return $query->result();
	}
	public function playList()
	{
		$this->db->from('com_archivo');
		$this->db->where('id_categoria', '8');
		$this->db->order_by('fecha', 'desc');
		$query = $this->db->get();
		return $query->result();
	}
	public function videoteca()
	{
		$this->db->from('com_archivo');
		$this->db->where('id_categoria', '9');
		$this->db->order_by('fecha', 'desc');
		$query = $this->db->get();
		return $query->result();
	}
	public function buscar()
	{
		$this->db->select('*');
		$this->db->from('com_archivo');
		$this->db->like('archivo',$this->input->post('busqueda'));
		$this->db->or_like('path_archivo',$this->input->post('busqueda'));
		$this->db->or_like('fecha',$this->input->post('busqueda'));
		$this->db->order_by('fecha', 'desc');
		$query = $this->db->get();
		return $query->result();
	}
	function insert($data)
	{
		$this->db->insert('com_archivo', $data);
	}
	function truncate()
	{
		$this->db->truncate('com_archivo');
	}
}