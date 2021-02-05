<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Funcionario extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Foto_model','foto');
		$this->load->model('Mensaje_model','mensaje');
	}
	public function index(){}
	public function detalle($id)
	{
		verificar_get($id,'id_funcionario','com_funcionario');
		$data['funcionario'] = $this->funcionario->getFuncionario($id);
		$data['foto'] = $this->foto->getFoto();
		$this->load->view('frontend/detalles/funcionario', $data);
	}
	public function detalleCumpleaniero($id)
	{
		verificar_get($id,'id_funcionario','com_funcionario');
		$data['funcionario'] = $this->funcionario->getFuncionario($id);
		$data['foto'] = $this->foto->getFoto();
		$this->load->view('frontend/detalles/cumpleaniero', $data);
	}
	public function getAllJSON()
	{
		echo json_encode($this->funcionario->getAll());
	}
}