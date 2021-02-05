<?php
class Sistema_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getSistemas()
    {
    	$this->db->select('sistema, icono, link');
    	$this->db->from('com_sistema');
    	$query = $this->db->get();
    	return $query->result();
    }
}