<?php
class Categoria_model extends CI_model
{
	function __construct()
	{
		parent::__construct();
	}
	public function getCategoria($id)
	{
		$this->db->where('id_categoria', $id);
		$query = $this->db->get('com_categoria');
		return $query->result();
	}
	public function getAll()
	{
		$this->db->where('estado', 'activo');
		$this->db->where('id_categoria !=', '26');
		$this->db->where('id_categoria !=', '27');
		$this->db->order_by('categoria', 'asc');
		$query = $this->db->get('com_categoria');
		return $query->result();
	}
	public function getHomeCategory()
	{
		$this->db->where('estado', 'activo');
		$this->db->where('in_home', 'si');
		$this->db->order_by('categoria', 'asc');
		$query = $this->db->get('com_categoria');		
		return $query->result();
	}
	public function esPadre($id)
	{
		$this->db->select('id_categoria,categoria');
		$this->db->from('com_categoria');
		$this->db->where('id_padre', $id);
		$query = $this->db->get();
		return $query->result();
	}
	public function getArchivos($id)
	{
		$this->db->select('id_archivo,archivo,path_archivo,path_server,id_categoria,id_publicacion,fecha');
		$this->db->from('com_archivo');
		$this->db->where('id_categoria', $id);
		$this->db->order_by('fecha', 'desc');
		$query = $this->db->get();
		return $query->result();
	}
	public function getNews()
	{

		$hoy = date("Y-m-d H:i:s");
		$inicio = strtotime('-3 days',strtotime($hoy));
		$inicio = date ("Y-m-d H:i:s", $inicio);
		$this->db->from('com_archivo');
		$this->db->order_by('fecha', 'desc');
		$this->db->join('com_categoria', 'com_categoria.id_categoria = com_archivo.id_categoria','left');
		$this->db->where('id_album', 0);
		$this->db->where('com_archivo.id_categoria !=', 8); // no musica
		$this->db->where('com_archivo.id_categoria !=', 9); // no videos
		$this->db->where('com_archivo.id_categoria !=', 10); // no diapositivas
		$this->db->where('fecha <=', $hoy);
		$this->db->where('fecha >', $inicio);
		$this->db->limit(6);
		$query = $this->db->get();
		return $query->result();
	}
}