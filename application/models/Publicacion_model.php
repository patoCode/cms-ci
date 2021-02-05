<?php
class Publicacion_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getPublicacion()
    {
    	$this->db->select('*');
    	$this->db->from('com_publicacion');
        $this->db->order_by('fecha', 'desc');
    	$query = $this->db->get();
    	return $query->result();
    }
    public function getNews($cant = 0)
    {
    	$this->db->select('id_publicacion,titulo,descripcion,fecha,id_categoria');
    	$this->db->from('com_publicacion');
        if($cant > 0)
    	   $this->db->limit($cant);
    	$this->db->order_by('fecha', 'desc');
    	$query = $this->db->get();
    	return $query->result();
    }
    public function getFeatures($cant = 0)
    {
    	$this->db->select('id_publicacion,titulo,descripcion');
    	$this->db->from('com_publicacion');
    	$this->db->where('destacada', 'si');
    	if($cant > 0)
           $this->db->limit($cant);
    	$this->db->order_by('fecha', 'desc');
    	$query = $this->db->get();
    	return $query->result();
    }
    public function getPublicacionesPorCategoria($id)
    {
        $this->db->select('*');
        $this->db->from('com_publicacion');
        $this->db->join('com_archivo', 'com_archivo.id_publicacion = com_publicacion.id_publicacion');
        $this->db->where('com_publicacion.id_categoria', $id);
        $this->db->group_by('com_publicacion.id_publicacion');
        $query = $this->db->get();
        return $query->result();
    }
    public function getDetailPublicacion($id)
    {
        $this->db->from('com_publicacion');
        $this->db->where('id_publicacion', $id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result();
    }
    public function insert($data)
	{
		$this->db->insert('com_publicacion', $data);
	}
	public function truncate()
	{
		$this->db->truncate('com_publicacion');
	}
}