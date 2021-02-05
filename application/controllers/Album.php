<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Album extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Album_model','album');
	}
	public function detalle($id)
	{
		verificar_get($id,'id_album','com_album');
		$data['sistemas']          = $this->sistema->getSistemas();
		$data['cumpleanieros_dia'] = $this->funcionario->getCumpleaneros(0);
		$data['cumpleanieros_mes'] = $this->funcionario->getCumpleaneros(1);
		$data['elementos']         = $this->album->fotos($id);
		$data['album']             = $this->album->detalle($id);
		$menu                      = $this->menu->getPrivilegios($this->session->userdata('id_cargo'));
		$data['menu']              = $menu;
		$this->load->view('frontend/detalles/album', $data);
	}
}