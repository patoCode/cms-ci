<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Publicacion extends CI_Controller
{
	public function __construct()
    {
		parent::__construct();
		$this->load->model('archivo_model','archivo');
    }
	public function index(){}
	public function getAllPublicacion()
	{
		$data['publicaciones'] = $this->publicacion->getPublicacion();
		$this->load->view('publicaciones', $data);
	}
	public function detalle($id)
	{
		verificar_get($id,'id_publicacion','com_publicacion');
		$data['sistemas'] = $this->sistema->getSistemas();
		$data['cumpleanieros_dia'] = $this->funcionario->getCumpleaneros(0);
		$data['cumpleanieros_mes'] = $this->funcionario->getCumpleaneros(1);
		$data['menu'] = $this->menu->getPrivilegios($this->session->userdata('id_cargo'));
		$data['publicacion'] = $this->publicacion->getDetailPublicacion($id);
		$data['detalle'] = 'publicacion';
		$this->load->view('detalle', $data);
	}
}
