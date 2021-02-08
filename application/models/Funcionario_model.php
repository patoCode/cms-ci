<?php
class Funcionario_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	public function getAll()
	{
		$this->db->select('id_funcionario,nombres,CONCAT(nombres," ",CONCAT(apellido_pat," ",apellido_mat)) as nombre_completo, apellido_pat, apellido_mat, nombres, cumpleanio, cargo, email_ende, jefe_inmediato, path_foto, interno, celular, lugar_trabajo,unidad_organizacional',FALSE);
		$this->db->from('com_funcionario');
		
		$this->db->order_by('nombres', 'desc');
		$query = $this->db->get();
		return $query->result();
	}
	public function getPagination($limit =12, $offset = 0)
	{
		$this->db->select('id_funcionario,CONCAT(nombres," ",CONCAT(apellido_pat," ",apellido_mat)) as nombre_completo, apellido_pat, apellido_mat, nombres, cumpleanio, cargo, email_ende, jefe_inmediato, path_foto, interno, celular, lugar_trabajo,unidad_organizacional',FALSE);
		$this->db->from('com_funcionario');
		$this->db->order_by('apellido_pat', 'asc');
		$this->db->limit($limit,$offset);
		$query = $this->db->get();
		return $query->result();
	}
	public function getFuncionario($id)
	{
		$this->db->select('id_funcionario,nombres, apellido_pat, apellido_mat, cumpleanio, cargo, email_ende, jefe_inmediato, path_foto, interno, celular, lugar_trabajo,unidad_organizacional');
		$this->db->from('com_funcionario');
		$this->db->where('id_funcionario', $id);
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->result();
	}
	public function getCumpleaneros($bandera)
	{
		$dia = date("d");
		$mes = date("m");
		$this->db->select('id_funcionario,nombres, apellido_pat,apellido_mat,unidad_organizacional,path_foto,cumpleanio');
		$this->db->from('com_funcionario');
		/*
		 * $bandera variable que indica 0 si se pide cumpleanieros del dia y 1 si se desea cumpleanieros del mes, mes es del tipo entero
		 */
		$this->db->where('estado', 'activo');
		if($bandera == 0):
			$this->db->where('MONTH(cumpleanio)', $mes);
			$this->db->where('DAY(cumpleanio)', $dia);
		else:
			$this->db->where('MONTH(cumpleanio)', $mes);
			$this->db->where('DAY(cumpleanio) != ', $dia);
		endif;
		$this->db->order_by('DAY(cumpleanio)', 'asc');
		$query = $this->db->get();
		return $query->result();
	}
	/* DELETED AFTER IMPORTATION */
	public function getFuncionarioTest()
	{
		$this->db->order_by('ID_FUNCIONARIO', 'asc');
		$query = $this->db->get('com_funcionario')->result();
		return $query;
	}
	public function getUsuarioTest()
	{
		$this->db->order_by('ID_USUARIO', 'asc');
		$query = $this->db->get('com_usuario_test')->result();
		return $query;
	}
	public function getId($like)
	{
		$this->db->like('email_ende', $like, 'after');
		$this->db->order_by('id_funcionario', 'asc');
		$query = $this->db->get('com_funcionario');
		return $query;
	}
	public function getEndeSIS()
	{
		$this->db->select('*');
		$this->db->order_by('id_persona_endesis', 'desc');
		$query = $this->db->get('integracion_comunidad_endesis')->result();
		return $query;
	}
	/* TO HERE */
	public function insert($data)
	{
		$this->db->insert('com_funcionario', $data);
	}
	public function truncate()
	{
		$this->db->truncate('com_funcionario');
	}
}