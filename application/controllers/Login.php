<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Usuario_model','usuario');
		$this->load->model('Mensaje_model','mensaje');
		$this->load->model('Foto_model','foto');
	}
	public function index()
	{
		$this->load->view('index');
	}
	public function checkLogin()
	{
		$data['title']= COMPANY_INTRANET;
		$data['metas']= '';
		if($this->form_validation->run() == FALSE)
		{
			$verificacion = $this->usuario->checkLogin();
			if($verificacion)
			{
				foreach ($verificacion as $user)
				{
					if($user->id_cargo != null && $user->id_cargo > 0):
						$cargos = $this->menu->getCargo($this->session->userdata('id_cargo'));
					endif;
					$newdata = array(
						'id_usuario'   => $user->id_usuario,
						'nombres'      => $user->nombres,
						'apellido_pat' => $user->apellido_pat,
						'apellido_mat' => $user->apellido_mat,
						'usuario'      => $user->usuario,
						'id_cargo'     => $user->id_cargo,
						'cargo'        => $user->cargo,
						'ver'          => $user->ver,
						'editar'       => $user->editar,
						'crear'        => $user->crear,
						'borrar'       => $user->borrar,
						'foto_usuario' => $user->path_foto,
						'email_ende'   => $user->email_ende,
						'logged_in'    => TRUE
					);
					$this->session->set_userdata($newdata);
				}
				$data = array(
							'id_usuario'     => $this->session->userdata('id_usuario'),
							'nombre_usuario' => $this->session->userdata('usuario'),
							'categoria'      => 'login',
							'accion'         => 'Ingreso',
							'detalle_accion' => 'Login Exitóso',
							'fecha_accion'   => date("Y-m-d"),
							'hora_accion'    => date("H:i:s")
						);
				$this->bitacora->insert($data);
				redirect('home');
			}
			else
			{
				$this->load->view('index',$data);
			}
		}
		else
		{
			$this->load->view('index',$data);
		}
	}

	public function logOut()
	{
		$data = array(
					'id_usuario'     => $this->session->userdata('id_usuario'),
					'nombre_usuario' => $this->session->userdata('usuario'),
					'categoria'      => 'logout',
					'accion'         => 'Salida',
					'detalle_accion' => 'Salida',
					'fecha_accion'   => date("Y-m-d"),
					'hora_accion'    => date("H:i:s")
					);
		$this->bitacora->insert($data);
		session_destroy();
		$data['title']= 'Portal de la Comunidad | ENDE CORPORACI&Oacute;N';
		$this->load->view('index',$data);
	}

}