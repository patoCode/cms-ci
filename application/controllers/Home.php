<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Foto_model','foto');
		$this->load->model('Mensaje_model','mensaje');
		$this->load->model('Alertas_model','alerta');
		$this->load->model('Calendario_model','calendario');
	}
	public function index()
	{
		$fecha = date("Y-m-d");
		$data['mensaje'] = $this->mensaje->getMensajeDiario($fecha);
		$data['sistemas'] = $this->sistema->getSistemas();
		$data['funcionarios'] = $this->funcionario->getAll();
		$data['cumpleanieros_dia'] = $this->funcionario->getCumpleaneros(0);
		$data['cumpleanieros_mes'] = $this->funcionario->getCumpleaneros(1);

		/* CATEGORIAS */
		$categorias = $this->categoria->getHomeCategory();

		/* NOTICIAS NUEVAS - COOKIE */
		$data['news'] = $this->categoria->getNews();

		/* MENÚ */
		$data['menu'] = $this->menu->getPrivilegios($this->session->userdata('id_cargo'));
		$data['categorias'] = $this->categoriaPublicaciones($categorias);
		$data['nuevas'] = $this->categoriaPublicaciones($this->categoria->getCategoria(27));	/* El ID de Publicaciones es 27 */
		$data['rrhh'] = $this->categoriaPublicaciones($this->categoria->getCategoria(26));		/* El ID de RRHH es 26 */
		$data['foto'] = $this->foto->getFoto();
		$data['fixed'] = TRUE;
		$this->load->view('home', $data);
	}
	private function categoriaPublicaciones($categorias)
	{
		$categorias_home = array();
		$i = 0;
		foreach ($categorias as $categoria):
			$publicaciones = $this->categoria->getArchivos($categoria->id_categoria);
			if(count($publicaciones)>0):
				$categorias_home[$i] = array($categoria,$publicaciones);
				$i++;
			endif;
		endforeach;
		return $categorias_home;
	}
}