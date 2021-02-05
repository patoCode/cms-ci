<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Encuesta_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getAll()
    {
        $this->db->from('com_encuesta');
        $query = $this->db->get();
        return $query->result();
    }
    public function getEncuestaById($id)
    {
        $this->db->from('com_encuesta');
        $this->db->where('id_encuesta', $id);
        $query = $this->db->get();
        return $query->row();
    }
    public function getOpcionById($id,$id_encuesta)
    {
        $this->db->from('com_encuesta_opciones');
        $this->db->where('id_encuesta_opcion', $id);
        $this->db->where('id_encuesta', $id_encuesta);
        $query = $this->db->get();
        return $query->row();
    }
    public function getParticipaciones($id)
    {
        $this->db->select('id_encuesta');
        $this->db->from('com_encuesta_usuario');
        $this->db->where('id_usuario', $id);
        $query = $this->db->get();
        return $query->result();
    }
    public function getOpciones($id)
    {
        $this->db->from('com_encuesta_opciones');
        $this->db->where('id_encuesta', $id);
        $query = $this->db->get();
        if($query->num_rows() > 0)
            return $query->result();
        else
            return "0";
        
    }
    public function getResults($id)
    {

        $this->db->select('id_encuesta,com_encuesta_votos.id_encuesta_opcion,COUNT(com_encuesta_votos.id_encuesta_opcion) as total');
        $this->db->from('com_encuesta_votos');
        $this->db->where('com_encuesta_votos.id_encuesta', $id);
        $this->db->group_by('com_encuesta_votos.id_encuesta_opcion');
        $query = $this->db->get();
        return $query->result();
    }
    public function votar($id_encuesta,$opcion,$id_usuario)
    {
        $data = array(
            'id_encuesta' => $id_encuesta,
            'id_encuesta_opcion' => $opcion
        );
        $dataUsuario = array(
            'id_encuesta' => $id_encuesta,
            'id_usuario' => $id_usuario
        );
        if($this->db->insert('com_encuesta_votos', $data) && $this->db->insert('com_encuesta_usuario', $dataUsuario))
            return true;
        else
            return false;
    }
}