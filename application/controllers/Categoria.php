<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Categoria extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}
	public function listarCategoria($id)
	{
		verificar_get($id,'id_categoria','com_categoria');
		$data['publicaciones'] = $this->publicacion->getPublicacionesPorCategoria($id);
		$data['categoria'] = $this->categoria->getCategoria($id);
		$this->load->view('categoria', $data);
	}
}