<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Calendario_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getEventos()
    {
        $this->db->from('com_evento');
        $query = $this->db->get();
        return $query->result();
    }
}