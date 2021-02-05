<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Listado extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Archivo_model','archivo');
		$this->load->model('Menu_model','menu');
		$this->load->model('Album_model','album');
	}
	public function index()
	{
		redirect('home');
	}
	public function archivo($id_categoria)
	{
		verificar_get($id_categoria,'id_categoria','com_categoria');
		$data['sistemas']          = $this->sistema->getSistemas();
		$data['cumpleanieros_dia'] = $this->funcionario->getCumpleaneros(0);
		$data['cumpleanieros_mes'] = $this->funcionario->getCumpleaneros(1);
		$hijos = $this->categoria->esPadre($id_categoria);
		$elementos = array();
		if(count($hijos) > 0)
		{
			foreach ($hijos as $hijo)
			{
				$elementos[$hijo->categoria] = $this->archivo->getAllCategory($hijo->id_categoria);
			}
			$data['elementos']          = $elementos;
			$data['lista']             = 'archivo_child';
		}
		else
		{
			$data['elementos']          = $this->archivo->getAllCategory($id_categoria);
			$data['lista']             = 'archivo';
		}
		$menu                      = $this->menu->getPrivilegios($this->session->userdata('id_cargo'));
		$data['menu']              = $menu;
		$this->load->view('lista', $data);
	}
	public function publicacion()
	{
		$data['sistemas']          = $this->sistema->getSistemas();
		$data['cumpleanieros_dia'] = $this->funcionario->getCumpleaneros(0);
		$data['cumpleanieros_mes'] = $this->funcionario->getCumpleaneros(1);
		$data['lista']             = 'publicacion';
		$data['elementos']         = $this->publicacion->getPublicacion();
		$data['titulo']            = 'Publicaciones';
		$menu                      = $this->menu->getPrivilegios($this->session->userdata('id_cargo'));
		$data['menu']              = $menu;
		$this->load->view('lista', $data);
	}
	public function funcionario()
	{
		$data['sistemas']          = $this->sistema->getSistemas();
		$data['funcionarios']      = $this->funcionario->getAll();
		$data['cumpleanieros_dia'] = $this->funcionario->getCumpleaneros(0);
		$data['cumpleanieros_mes'] = $this->funcionario->getCumpleaneros(1);
		$data['lista']             = 'funcionario';
		$menu                      = $this->menu->getPrivilegios($this->session->userdata('id_cargo'));
		$data['menu']              = $menu;
		$this->load->view('lista', $data);
	}
	public function albumes()
	{
		$menu                      = $this->menu->getPrivilegios($this->session->userdata('id_cargo'));
		$data['sistemas']          = $this->sistema->getSistemas();
		$data['cumpleanieros_dia'] = $this->funcionario->getCumpleaneros(0);
		$data['cumpleanieros_mes'] = $this->funcionario->getCumpleaneros(1);
		$data['elementos']         = $this->album->getAll();
		$data['lista']             = 'foto';
		$data['menu']              = $menu;
		$this->load->view('lista', $data);
	}
	public function musica()
	{
		$data['sistemas']          = $this->sistema->getSistemas();
		$data['cumpleanieros_dia'] = $this->funcionario->getCumpleaneros(0);
		$data['cumpleanieros_mes'] = $this->funcionario->getCumpleaneros(1);
		$data['elementos']         = $this->archivo->playList();
		$data['lista']             = 'musica';
		$menu                      = $this->menu->getPrivilegios($this->session->userdata('id_cargo'));
		$data['menu']              = $menu;
		$this->load->view('lista', $data);
	}
	public function video()
	{
		$data['sistemas']          = $this->sistema->getSistemas();
		$data['cumpleanieros_dia'] = $this->funcionario->getCumpleaneros(0);
		$data['cumpleanieros_mes'] = $this->funcionario->getCumpleaneros(1);
		$data['elementos']         = $this->archivo->videoteca();
		$data['lista']             = 'video';
		$menu = $this->menu->getPrivilegios($this->session->userdata('id_cargo'));
		$data['menu'] = $menu;
		$this->load->view('lista', $data);
	}
	public function buscar()
	{
		$data['sistemas']          = $this->sistema->getSistemas();
		$data['cumpleanieros_dia'] = $this->funcionario->getCumpleaneros(0);
		$data['cumpleanieros_mes'] = $this->funcionario->getCumpleaneros(1);

		if(trim($_POST['busqueda']) != '')
			$data['busqueda'] 	   = trim($_POST['busqueda']);
		else
			redirect('home');

		$data['elementos']         = $this->archivo->buscar();
		$data['lista']             = 'resultados';
		$menu 					   = $this->menu->getPrivilegios($this->session->userdata('id_cargo'));
		$data['menu'] 			   = $menu;
		$this->load->view('lista', $data);
	}
	public function eventos()
	{
		$data['sistemas']          = $this->sistema->getSistemas();
		$data['cumpleanieros_dia'] = $this->funcionario->getCumpleaneros(0);
		$data['cumpleanieros_mes'] = $this->funcionario->getCumpleaneros(1);
		$data['elementos']         = $this->archivo->videoteca();
		$data['lista']             = 'eventos';
		$menu = $this->menu->getPrivilegios($this->session->userdata('id_cargo'));
		$data['menu'] = $menu;
		$this->load->view('lista', $data);
	}
	public function statics()
	{
		$data['sistemas']          = $this->sistema->getSistemas();
		$data['cumpleanieros_dia'] = $this->funcionario->getCumpleaneros(0);
		$data['cumpleanieros_mes'] = $this->funcionario->getCumpleaneros(1);
		$data['lista'] = 'statics/main_static';
		$menu = $this->menu->getPrivilegios($this->session->userdata('id_cargo'));
		$data['menu'] = $menu;

		$this->load->view('lista', $data);
	}


}