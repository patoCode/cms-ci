<?php
class Album_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	public function getAll()
	{
		$this->db->distinct();
		$this->db->select('com_album.id_album,path_imagen,album,descripcion');
		$this->db->from('com_album');
		$this->db->join('com_archivo', 'com_archivo.id_album = com_album.id_album','inner');
		$query = $this->db->get();
		return $query->result();
	}
	public function fotos($id)
	{
		$this->db->from('com_archivo');
		$this->db->where('id_album', $id);
		if($id == 0)
			$this->db->where('id_categoria', '11');

		$query = $this->db->get();
		return $query->result();
	}
	public function detalle($id)
	{
		$this->db->from('com_album');
		$this->db->where('id_album', $id);
		$query = $this->db->get();
		return $query->row();
	}
}