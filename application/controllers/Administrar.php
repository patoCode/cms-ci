<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// 21232f297a57a5a743894a0e4a801fc3
// abdul.dominguez
class Administrar extends CI_Controller
{
	public $menu;
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Usuario_model','usuario');
		$this->load->model('Encuesta_model','encuesta');

	}
	public function index()
	{
		$data['title'] ="Publicacion";
		$data['title_page'] ="Administracion de Publicaciones";
		$menu = $this->menu->getPrivilegios($this->session->userdata('id_cargo'));
		$data['menu'] = $menu;
	}

	public function categoria(){
		$data['title'] ="Publicacion";
		$data['title_page'] ="Administracion de Categorias";
		$menu = $this->menu->getPrivilegios($this->session->userdata('id_cargo'));
		$data['menu'] = $menu;
		$crud = new grocery_CRUD();
		$crud->set_table('com_categoria')
			 ->set_subject('Categoria')
			 ->columns(
				 		'categoria',
				 		'descripcion',
				 		'icono',
				 		'estado',
				 		'id_padre'
				 	   )
			 ->display_as('categoria','Nombre')
			 ->display_as('descripcion','Descripcion')
			 ->display_as('icono','Icono')
			 ->display_as('estado','Estado')
			 ->display_as('id_padre','Superior');
		$crud->fields(
				'categoria',
				'descripcion',
				'icono',
				'estado',
				'id_padre'
			);
		$crud->required_fields(
				'categoria',
				'descripcion',
				'icono',
				'estado'
					);
		$crud->change_field_type('descripcion','text');
		$crud->change_field_type('estado','enum',array('activo','inactivo'));

		$_POST['tabla']     = 'com_categoria';
		$_POST['categoria_'] ='Administrar/categoria';
		$crud->callback_before_upload(array($this, 'change_path'));
		$crud->callback_after_insert(array($this, 'log_after_insert'));
		$crud->callback_after_update(array($this, 'log_after_update'));
		$crud->callback_before_delete(array($this, 'log_before_delete'));


		if($this->session->userdata('ver') == 'no'):
			$crud->unset_read();
		endif;
		if($this->session->userdata('editar') == 'no'):
			$crud->unset_edit();
		endif;
		if($this->session->userdata('borrar') == 'no'):
			$crud->unset_delete();
		endif;
		if($this->session->userdata('crear') == 'no'):
			$crud->unset_add();
		endif;


		$output = $crud->render();
		$data['output'] = $output;
		$data['plantilla'] = 'categoria';
		$this->load->view('admin/administrar', $data);
	}


	public function multimedia($bandera)
	{
		$data['title'] ="Informacion Compartida";
		$menu = $this->menu->getPrivilegios($this->session->userdata('id_cargo'));
		$data['menu'] = $menu;

		$crud = new grocery_CRUD();
		$_POST['tabla']     = 'com_mensaje';
		switch ($bandera) {
			case 1: // Musica
				$crud->where('com_archivo.id_categoria','8');
				$data['title_page'] ="Administracion de Música";
				$_POST['categoria_'] ='Administrar/multimedia/1';
				break;
			case 2: // Video
				$crud->where('com_archivo.id_categoria','9');
				$data['title_page'] ="Administracion de Videos";
				$_POST['categoria_'] ='Administrar/multimedia/2';
				break;
			case 3: // Diapositivas
				$crud->where('com_archivo.id_categoria','10');
				$data['title_page'] ="Administracion de Diapositivas";
				$_POST['categoria_'] ='Administrar/multimedia/3';
				break;
		}
		$crud->set_table('com_archivo')
			->set_subject('Informacion')
			->columns(
				'archivo',
				'path_archivo',
				'id_categoria'
			)
			->display_as('archivo','Título')
			->display_as('path_archivo','Archivo')
			->display_as('id_categoria','Categoria');
		$crud->fields(
						'archivo',
						'path_archivo',
						'id_categoria'
					);

		$crud->required_fields(
								'archivo',
								'path_archivo',
								'id_categoria'
							);

		$crud->set_field_upload('path_archivo',PATH_FILE_RRHH);

		// /* RENAME IMAGE */
		// $_POST['ruta']      = PATH_FILE_RRHH;
		// $crud->callback_before_insert(array($this,'change_name_image'));
		// $crud->callback_before_update(array($this,'change_name_image'));

		switch ($bandera) {
			case 1: // Musica
				$crud->set_relation('id_categoria','com_categoria','{categoria}',array('id_categoria' => '8'));
				break;
			case 2: // Video
				$crud->set_relation('id_categoria','com_categoria','{categoria}',array('id_categoria' => '9'));
				break;
			case 3: // Diapositivas
				$crud->set_relation('id_categoria','com_categoria','{categoria}',array('id_categoria' => '10'));
				break;
		}


		$crud->callback_after_insert(array($this, 'log_after_insert'));
		$crud->callback_after_update(array($this, 'log_after_update'));
		$crud->callback_before_delete(array($this, 'log_before_delete'));

		if($this->session->userdata('ver') == 'no'):
			$crud->unset_read();
		endif;
		if($this->session->userdata('editar') == 'no'):
			$crud->unset_edit();
		endif;
		if($this->session->userdata('borrar') == 'no'):
			$crud->unset_delete();
		endif;
		if($this->session->userdata('crear') == 'no'):
			$crud->unset_add();
		endif;

		$output = $crud->render();
		$data['output'] = $output;
		$data['plantilla'] = 'multimedia';
		$this->load->view('admin/administrar', $data);
	}
	public function publicacion()
	{
		$data['title'] ="Publicacion";
		$data['title_page'] ="Administracion de Publicaciones";
		$menu = $this->menu->getPrivilegios($this->session->userdata('id_cargo'));
		$data['menu'] = $menu;
		$crud = new grocery_CRUD();
		$crud->set_table('com_publicacion')
			 ->set_subject('Publicación')
			 ->columns(
				 		'titulo',
				 		'destacada',
				 		'id_tipo_publicacion',
				 		'id_categoria',
				 		'fecha'
				 	   )
			 ->display_as('titulo','Publicación')
			 ->display_as('destacada','Destacada')
			 ->display_as('id_tipo_publicacion','Tipo')
			 ->display_as('id_categoria','Categoria')
			 ->display_as('fecha','Fecha');

		$crud->fields(
						'titulo',
						'descripcion',
						'destacada',
						'id_tipo_publicacion',
						'id_categoria'
					);
		$crud->required_fields(
					'titulo',
					'descripcion',
					'id_categoria',
					'id_tipo_publicacion',
					'destacada'
					);
		$crud->change_field_type('descripcion','text');
		$crud->change_field_type('destacada','enum',array('si','no'));

		// $crud->set_field_upload('path_image',PATH_IMG_PUBLICACION);
		// $crud->set_field_upload('path_file',PATH_FILE_PUBLICACION);


		$_POST['tabla']     = 'com_publicacion';
		$_POST['categoria_'] ='Administrar/publicacion';
		$crud->callback_before_upload(array($this, 'change_path'));
		$crud->callback_after_insert(array($this, 'log_after_insert'));
		$crud->callback_after_update(array($this, 'log_after_update'));
		$crud->callback_before_delete(array($this, 'log_before_delete'));


		$crud->set_relation('id_categoria','com_categoria','{categoria}',array('id_categoria !=' => '26','estado'=>'activo'));
		$crud->set_relation('id_tipo_publicacion','com_tipo_publicacion','{descripcion}');

		if($this->session->userdata('ver') == 'no'):
			$crud->unset_read();
		endif;
		if($this->session->userdata('editar') == 'no'):
			$crud->unset_edit();
		endif;
		if($this->session->userdata('borrar') == 'no'):
			$crud->unset_delete();
		endif;
		if($this->session->userdata('crear') == 'no'):
			$crud->unset_add();
		endif;


		$output = $crud->render();
		$data['output'] = $output;
		$data['plantilla'] = 'publicacion';
		$this->load->view('admin/administrar', $data);
	}
	public function publicacion_file()
	{
		$data['title'] ="Publicacion";
		$data['title_page'] ="Administracion de Publicaciones";
		$menu = $this->menu->getPrivilegios($this->session->userdata('id_cargo'));
		$data['menu'] = $menu;
		$crud = new grocery_CRUD();
		$crud->where('com_archivo.id_categoria','27');
		$crud->set_table('com_archivo')
			->set_subject('Publicación')
			->columns(
				'archivo',
				'path_archivo',
				'fecha'
			)
			->display_as('archivo','Título')
			->display_as('path_archivo','Archivo')
			->display_as('id_categoria','Categoria')
			->display_as('fecha','Fecha');

		$crud->fields(
						'archivo',
						'path_archivo',
						'id_categoria',
						'path_server'
					);

		$crud->required_fields(
								'archivo',
								'path_archivo',
								'id_categoria',
								'path_server'
							);

		$crud->set_field_upload('path_archivo',PATH_FILE_RRHH);
		$crud->set_relation('id_categoria','com_categoria','{categoria}',array('id_categoria' => '27'));
		$crud->field_type('path_server', 'hidden', PATH_FILE_RRHH);
		$crud->order_by('fecha','desc');

		/* LOG */
		$_POST['tabla']     = 'com_archivo';
		$_POST['categoria_'] = 'Administrar/publicacion_file';
		$crud->callback_after_insert(array($this, 'log_after_insert'));
		$crud->callback_after_update(array($this, 'log_after_update'));
		$crud->callback_before_delete(array($this, 'log_before_delete'));

		if($this->session->userdata('ver') == 'no'):
			$crud->unset_read();
		endif;
		if($this->session->userdata('editar') == 'no'):
			$crud->unset_edit();
		endif;
		if($this->session->userdata('borrar') == 'no'):
			$crud->unset_delete();
		endif;
		if($this->session->userdata('crear') == 'no'):
			$crud->unset_add();
		endif;

		$output = $crud->render();
		$data['output'] = $output;
		$data['plantilla'] = 'publicacion';
		$this->load->view('admin/administrar', $data);
	}
	public function rrhh()
	{
		$data['title'] ="Archivo";
		$data['title_page'] ="Administracion de Avidos de RRHH";
		$menu = $this->menu->getPrivilegios($this->session->userdata('id_cargo'));
		$data['menu'] = $menu;
		$crud = new grocery_CRUD();
		$crud->where('com_archivo.id_categoria','26');
		$crud->set_table('com_archivo')
			->set_subject('Aviso RRHH')
			->columns(
				'archivo',
				'path_archivo',
				'fecha'
			)
			->display_as('archivo','Título')
			->display_as('path_archivo','Archivo')
			->display_as('id_categoria','Categoria')
			->display_as('fecha','Fecha');

		$crud->fields(
						'archivo',
						'path_archivo',
						'path_server',
						'id_categoria'
					);

		$crud->required_fields(
								'archivo',
								'path_archivo',
								'path_server',
								'id_categoria'
							);

		$crud->set_field_upload('path_archivo',PATH_FILE_RRHH);
		$crud->set_relation('id_categoria','com_categoria','{categoria}',array('id_categoria' => '26'));
		$crud->field_type('path_server', 'hidden', PATH_FILE_RRHH);
		$crud->order_by('fecha','desc');

		/* LOG */
		$_POST['tabla']     = 'com_archivo';
		$_POST['categoria_'] ='Administrar/rrhh';
		$crud->callback_after_insert(array($this, 'log_after_insert'));
		$crud->callback_after_update(array($this, 'log_after_update'));
		$crud->callback_before_delete(array($this, 'log_before_delete'));

		if($this->session->userdata('ver') == 'no'):
			$crud->unset_read();
		endif;
		if($this->session->userdata('editar') == 'no'):
			$crud->unset_edit();
		endif;
		if($this->session->userdata('borrar') == 'no'):
			$crud->unset_delete();
		endif;
		if($this->session->userdata('crear') == 'no'):
			$crud->unset_add();
		endif;

		$output = $crud->render();
		$data['output'] = $output;
		$data['plantilla'] = 'rrhh';
		$this->load->view('admin/administrar', $data);
	}
	public function archivo()
	{
		$data['title']      ="Informacion Compartida";
		$data['title_page'] ="Administracion de Archivos";
		$menu               = $this->menu->getPrivilegios($this->session->userdata('id_cargo'));
		$data['menu']       = $menu;
		$crud               = new grocery_CRUD();

		$crud->where('com_archivo.id_categoria != ','8');
		$crud->where('com_archivo.id_categoria != ','9');
		$crud->where('com_archivo.id_categoria != ','10');
		$crud->where('com_archivo.id_categoria != ','11');
		$crud->where('com_archivo.id_categoria != ','12');
		$crud->where('com_archivo.id_categoria != ','26');
		$crud->where('com_archivo.id_categoria != ','27');
		$crud->where('com_archivo.id_categoria != ','23');


		$crud->set_table('com_archivo')
			->set_subject('Informacion')
			->columns(
				'archivo',
				'path_archivo',
				'id_categoria',
				'fecha'
			)
			->display_as('archivo','Título')
			->display_as('path_archivo','Archivo')
			->display_as('id_categoria','Categoria');

		$crud->fields(
						'archivo',
						'path_archivo',
						'id_categoria',
						'path_server',
						'fecha'
					);
		$crud->order_by('com_archivo.fecha','debsc');
		$crud->required_fields(
								'archivo',
								'path_archivo',
								'id_categoria',
								'path_server'
							);
		$crud->set_field_upload('path_archivo',PATH_FILE_RRHH);
		$crud->set_relation('id_categoria','com_categoria','{categoria}',
							 array(
										'com_categoria.id_categoria !=' => '8',
										'com_categoria.id_categoria !=' => '9',
										'com_categoria.id_categoria !=' => '10',
										'com_categoria.id_categoria !=' => '11',
										'com_categoria.id_categoria !=' => '12',
										'com_categoria.id_categoria != '=> '26',
										'com_categoria.id_categoria != '=> '27',
										'estado'                    	=> 'activo'
							 	)
							);
		$crud->field_type('path_server', 'hidden', PATH_FILE_RRHH);
		$crud->field_type('fecha', 'hidden', date("Y-m-d H:i:s"));
		$crud->order_by('fecha','desc');

		/* LOG */
		$_POST['tabla']     = 'com_archivo';
		$_POST['categoria_'] ='Administrar/archivo';
		$crud->callback_after_insert(array($this, 'log_after_insert'));
		$crud->callback_after_update(array($this, 'log_after_update'));
		$crud->callback_before_delete(array($this, 'log_before_delete'));

		if($this->session->userdata('ver') == 'no'):
			$crud->unset_read();
		endif;
		if($this->session->userdata('editar') == 'no'):
			$crud->unset_edit();
		endif;
		if($this->session->userdata('borrar') == 'no'):
			$crud->unset_delete();
		endif;
		if($this->session->userdata('crear') == 'no'):
			$crud->unset_add();
		endif;

		$output = $crud->render();
		$data['output'] = $output;
		$data['plantilla'] = 'rrhh';
		$this->load->view('admin/administrar', $data);
	}
	public function funcionario()
	{
		//revisar si es admin
		$data['title']      ="Funcionario";
		$data['title_page'] ="Administracion de Funcionarios";
		$menu               = $this->menu->getPrivilegios($this->session->userdata('id_cargo'));
		$data['menu']       = $menu;
		$crud = new grocery_CRUD();
		$crud->set_table('com_funcionario')
			 ->set_subject('Funcionario')
			 ->columns(
				 		'nombres',
				 		'apellido_pat',
				 		'apellido_mat',
				 		'telefono_fijo',
				 		'interno',
				 		'email_ende',
				 		'unidad_organizacional',
				 		'estado'
					)
					->display_as('nombres','Nombres')
					->display_as('apellido_pat','Apellido Pat.')
					->display_as('apellido_mat','Apellido Mat.')
					->display_as('telefono_fijo','Telefono Fijo')
					->display_as('celular','Celular')
					->display_as('interno','Interno')
					->display_as('email_ende','Email ENDE')
					->display_as('email_personal','E-mail Personal')
					->display_as('email_personal_opc','E-mail Personal 2')
					->display_as('profesion','Profesión')
					->display_as('cargo','Cargo')
					->display_as('unidad_organizacional','Unidad')
					->display_as('jefe_inmediato','Jefe Inmediato')
					->display_as('lugar_trabajo','Lugar')
					->display_as('cumpleanio','Cumpleaños')
					->display_as('path_foto','Fotografía')
					->display_as('tipo_sangre','Sangre')
					->display_as('estado','Estado');

		$crud->fields(
						'nombres',
				 		'apellido_pat',
				 		'apellido_mat',
				 		'telefono_fijo',
				 		'celular',
				 		'interno',
				 		'email_ende',
				 		'email_personal',
				 		'email_personal_opc',
				 		'profesion',
				 		'cargo',
				 		'unidad_organizacional',
				 		'jefe_inmediato',
				 		'lugar_trabajo',
				 		'cumpleanio',
				 		'path_foto',
				 		'tipo_sangre',
				 		'estado'
					);
		$crud->required_fields(
						'nombres',
				 		// 'apellido_pat',
				 		// 'apellido_mat',
				 		// 'telefono_fijo',
				 		// 'celular',
				 		'email_personal',
				 		'interno',
				 		'email_ende',
				 		'profesion',
				 		'cargo',
				 		'unidad_organizacional',
				 		// 'jefe_inmediato',
				 		'lugar_trabajo',
				 		'cumpleanio',
				 		'path_foto',
				 		'tipo_sangre',
				 		'estado'
					);

		$crud->change_field_type('estado','enum',array('activo','inactivo'));
		$crud->change_field_type('cumpleanio','date');
		$crud->set_field_upload('path_foto',PATH_FOTO_FUNCIONARIO);
		// $crud->set_relation('jefe_inmediato','com_funcionario','{nombres} {apellido_pat} {apellido_mat}');

		/* LOG */
		$_POST['tabla']     = 'com_funcionario';
		$_POST['categoria_'] ='Administrar/funcionario';
		$crud->callback_after_insert(array($this, 'log_after_insert'));
		$crud->callback_after_update(array($this, 'log_after_update'));
		$crud->callback_before_delete(array($this, 'log_before_delete'));

		if($this->session->userdata('ver') == 'no'):
			$crud->unset_read();
		endif;
		if($this->session->userdata('editar') == 'no'):
			$crud->unset_edit();
		endif;
		if($this->session->userdata('borrar') == 'no'):
			$crud->unset_delete();
		endif;
		if($this->session->userdata('crear') == 'no'):
			$crud->unset_add();
		endif;

		$output = $crud->render();
		$data['output'] = $output;
		$data['plantilla'] = 'funcionario';
		$this->load->view('admin/administrar', $data);
	}
	public function mensaje()
	{
		$data['title'] ="Mensaje";
		$data['title_page'] ="Administracion de Mensaje";
		$menu = $this->menu->getPrivilegios($this->session->userdata('id_cargo'));
		$data['menu'] = $menu;
		$crud = new grocery_CRUD();
		$crud->set_table('com_mensaje')
			->set_subject('Pensamiento del día')
			->columns(
				'mensaje',
				'autor',
				'fecha'
			)
			->display_as('mensaje','Mensaje')
			->display_as('autor','Autor');

		$crud->fields(
						'mensaje',
						'autor'
					);
		$crud->required_fields(
								'mensaje',
								'autor'
							);
		$crud->change_field_type('mensaje','text');
		if($this->session->userdata('ver') == 'no'):
			$crud->unset_read();
		endif;
		if($this->session->userdata('editar') == 'no'):
			$crud->unset_edit();
		endif;
		if($this->session->userdata('borrar') == 'no'):
			$crud->unset_delete();
		endif;
		if($this->session->userdata('crear') == 'no'):
			$crud->unset_add();
		endif;


		$_POST['tabla']     = 'com_mensaje';
		$_POST['categoria_'] ='Administrar/mensaje';

		$crud->callback_after_insert(array($this, 'log_after_insert'));
		$crud->callback_after_update(array($this, 'log_after_update'));
		$crud->callback_before_delete(array($this, 'log_before_delete'));

		$output = $crud->render();
		$data['output'] = $output;
		$data['plantilla'] = 'funcionario';
		$this->load->view('admin/administrar', $data);
	}
	public function usuario()
	{
		$data['title']      ="Usuario";
		$data['title_page'] ="Administracion de Usuarios";
		$menu               = $this->menu->getPrivilegios($this->session->userdata('id_cargo'));
		$data['menu']       = $menu;
		$crud = new grocery_CRUD();
		$crud->set_table('com_usuario')
			->set_subject('Usuarios de la Comunidad')
			->columns(
				'id_funcionario',
				'usuario',
				'fecha_registro',
				'fecha_ultima_modificacion',
				'fecha_expiracion',
				'estado',
				'login_local',
				'id_cargo'
			)
			->display_as('id_funcionario','Funcionario')
			->display_as('usuario','Login')
			->display_as('password','Password')
			->display_as('fecha_registro','Registro')
			->display_as('fecha_ultima_modificacion','Última Modificación')
			->display_as('fecha_expiracion','Expiración')
			->display_as('estado','Estado')
			->display_as('login_local','Tipo Login')
			->display_as('id_cargo','Rol');

		$crud->fields(
						'id_funcionario',
						'usuario',
						'password',
						'fecha_registro',
						'fecha_ultima_modificacion',
						'fecha_expiracion',
						'estado',
						'login_local',
						'id_cargo'
					);

		$crud->required_fields(
								'usuario',
								'password',
								'fecha_registro',
								'estado',
								'login_local',
								'id_cargo'
							);

		$crud->set_relation('id_cargo','com_cargo','{cargo}');
		$crud->set_relation('id_funcionario','com_funcionario','{nombres} {apellido_pat} {apellido_mat}');


		$_POST['tabla']     = 'com_usuario';
		$_POST['categoria_'] ='Administrar/usuario';
		$crud->callback_after_insert(array($this, 'log_after_insert'));
		$crud->callback_after_update(array($this, 'log_after_update'));
		$crud->callback_before_delete(array($this, 'log_before_delete'));

		if($this->session->userdata('ver') == 'no'):
			$crud->unset_read();
		endif;
		if($this->session->userdata('editar') == 'no'):
			$crud->unset_edit();
		endif;
		if($this->session->userdata('borrar') == 'no'):
			$crud->unset_delete();
		endif;
		if($this->session->userdata('crear') == 'no'):
			$crud->unset_add();
		endif;

		/* SI SE DESEA BORRAR EL PASS AL ENTRAR A EDITAR */
		// $crud->callback_edit_field('password',array($this,'set_password_input_to_empty'));
  		//$crud->callback_add_field('password',array($this,'set_password_input_to_empty'));

		$crud->callback_before_insert(array($this,'encrypt_password_callback'));
		$crud->callback_before_update(array($this,'encrypt_password_callback'));

		$output = $crud->render();
		$data['output'] = $output;
		$data['plantilla'] = 'funcionario';
		$this->load->view('admin/administrar', $data);
	}
	public function roles()
	{
		$data['title']      ="Roles";
		$data['title_page'] ="Administracion de Roles";
		$menu               = $this->menu->getPrivilegios($this->session->userdata('id_cargo'));
		$data['menu']       = $menu;
		$crud = new grocery_CRUD();
		$crud->set_table('com_cargo');
		$crud->set_relation_n_n('privilegios', 'privilegio_cargo', 'com_privilegio', 'id_cargo', 'id_privilegio', 'privilegio');
		$crud->fields(
	    				'cargo',
	    				'descripcion',
	    				'privilegios',
	    				'crear',
	    				'ver',
	    				'borrar',
	    				'editar'
    				);


		$_POST['tabla']     = 'com_cargo';
		$_POST['categoria_'] ='Administrar/roles';
		$crud->callback_after_insert(array($this, 'log_after_insert'));
		$crud->callback_after_update(array($this, 'log_after_update'));
		$crud->callback_before_delete(array($this, 'log_before_delete'));

		if($this->session->userdata('ver') == 'no'):
			$crud->unset_read();
		endif;
		if($this->session->userdata('editar') == 'no'):
			$crud->unset_edit();
		endif;
		if($this->session->userdata('borrar') == 'no'):
			$crud->unset_delete();
		endif;
		if($this->session->userdata('crear') == 'no'):
			$crud->unset_add();
		endif;

		$output = $crud->render();
		$data['output'] = $output;
		$data['plantilla'] = 'rol';
		$this->load->view('admin/administrar', $data);
	}
	public function privilegios()
	{
		//revisar si es admin
		$data['title']      ="Privilegios";
		$data['title_page'] ="Administracion de Privilegios";
		$menu               = $this->menu->getPrivilegios($this->session->userdata('id_cargo'));
		$data['menu']       = $menu;
		$crud = new grocery_CRUD();
		$crud->set_table('com_privilegio')
			->set_subject('Privilegio')
			->columns(
				'privilegio',
				'acceso',
				'icono_class'
			)
			->display_as('privilegio','Privilegio')
			->display_as('acceso','Acceso')
			->display_as('icono_class','Icono');

		$crud->fields(
						'privilegio',
						'acceso',
						'icono_class'
					);

		$crud->required_fields(
							'privilegio',
							'acceso',
							'icono_class'
						);


		$_POST['tabla']     = 'com_privilegio';
		$_POST['categoria_'] ='Administrar/privilegios';
		$crud->callback_after_insert(array($this, 'log_after_insert'));
		$crud->callback_after_update(array($this, 'log_after_update'));
		$crud->callback_before_delete(array($this, 'log_before_delete'));

		if($this->session->userdata('ver') == 'no'):
			$crud->unset_read();
		endif;
		if($this->session->userdata('editar') == 'no'):
			$crud->unset_edit();
		endif;
		if($this->session->userdata('borrar') == 'no'):
			$crud->unset_delete();
		endif;
		if($this->session->userdata('crear') == 'no'):
			$crud->unset_add();
		endif;

		$output = $crud->render();
		$data['output'] = $output;
		$data['plantilla'] = 'privilegios';
		$this->load->view('admin/administrar', $data);
	}
	public function album()
	{
		$data['title']      = "Albúm de Fotografias";
		$data['title_page'] = "Administración Albumes";
		$menu               = $this->menu->getPrivilegios($this->session->userdata('id_cargo'));
		$data['menu']       = $menu;
		$crud               = new grocery_CRUD();
		if($this->session->userdata('id_cargo') != 1)
		{
			$crud->where('com_album.id_usuario',$this->session->userdata('id_usuario'));
		}

		$crud->set_table('com_album')
			->set_subject('Albumes')
			->columns(
				'path_imagen',
				'album',
				'id_usuario',
				'descripcion'
			)
			->display_as('path_imagen','Carátula')
			->display_as('album','Album')
			->display_as('id_usuario','Autor')
			->display_as('descripcion','Descripcion');
		$crud->fields(
						'path_imagen',
						'album',
						'descripcion',
						'id_usuario'
					);
		$crud->required_fields(
							'path_imagen',
							'album',
							'descripcion',
							'id_usuario'
						);
		$crud->edit_fields(
							'path_imagen',
							'album',
							'descripcion'
						);
		$crud->set_relation('id_usuario','com_usuario','usuario',array('id_usuario'=>$this->session->userdata('id_usuario')));
		$crud->set_field_upload('path_imagen',PATH_ALBUMES_PREVIEW);

		/* LOG */
		$_POST['tabla']     = 'com_album';
		$_POST['categoria_'] ='Administrar/album';
		$crud->callback_after_insert(array($this, 'log_after_insert'));
		$crud->callback_after_update(array($this, 'log_after_update'));
		$crud->callback_before_delete(array($this, 'log_before_delete'));

		$nombre_insercion = $this->session->userdata('nombres').' '.$this->session->userdata('apellido_pat').' '.$this->session->userdata('apellido_mat');

		if($this->session->userdata('ver') == 'no'):
			$crud->unset_read();
		endif;
		if($this->session->userdata('editar') == 'no'):
			$crud->unset_edit();
		endif;
		if($this->session->userdata('borrar') == 'no'):
			$crud->unset_delete();
		endif;
		if($this->session->userdata('crear') == 'no'):
			$crud->unset_add();
		endif;

		$crud->add_action('Agregar', '', 'Administrar/imagenes','fa fa-file-photo-o');

		$output = $crud->render();
		$data['output'] = $output;
		$data['plantilla'] = 'album';
		$this->load->view('admin/administrar', $data);
	}
	public function imagenes($id)
	{
		$data['title']      ="Imagenes";
		$data['title_page'] ="Administracion de imagenes";
		$menu               = $this->menu->getPrivilegios($this->session->userdata('id_cargo'));
		$data['menu']       = $menu;
		$image_crud = new image_CRUD();
		$image_crud->set_primary_key_field('id_archivo');
		$image_crud->set_url_field('path_archivo');
		// if($id == 0)
		// {
		// 	$image_crud->set_table('com_archivo')
		// 	->set_relation_field('id_album')
		// 	->set_ordering_field('id_archivo')
		// 	->set_image_path(PATH_FILE_RRHH);
		// }
		// else
		// {
			$image_crud->set_table('com_archivo')
			->set_relation_field('id_album')
			->set_ordering_field('id_archivo')
			->set_image_path(PATH_ALBUMES);
		// }


		$output = $image_crud->render();

		/* LOG */
		$_POST['tabla']     = 'com_archivo';
		$_POST['categoria_'] ='Administrar/imagenes/'.$id;

		$data['album_back'] = '<a href="'.base_url().'Administrar/album" class="btn blue-ende"><i class="fa fa-long-arrow-left"></i> Atrás</a>';
		$data['album_save'] = '<a href="'.base_url().'Administrar/album" class="btn blue-ende"><i class="fa fa-save"></i> Guardar</a>';
		$data['output'] = $output;
		$data['plantilla'] = 'imagenes';
		$this->load->view('admin/administrar', $data);
	}
	public function eventos()
	{
		$data['title']      = "Eventos";
		$data['title_page'] = "Administración Eventos";
		$menu               = $this->menu->getPrivilegios($this->session->userdata('id_cargo'));
		$data['menu']       = $menu;
		$crud               = new grocery_CRUD();

		$crud->set_table('com_evento')
			->set_subject('Eventos')
			->columns(
				'start',
				'end',
				'title',
				'description',
				'color'
			)
			->display_as('start','Inicio')
			->display_as('end','Fin')
			->display_as('title','Título')
			->display_as('description','Descripción')
			->display_as('color','Color');
		$crud->fields(
						'start',
						'end',
						'title',
						'description',
						'color'
					);
		$crud->required_fields(
						'start',
						'title',
						'description'
						);
		$crud->edit_fields(
						'start',
						'end',
						'title',
						'description',
						'color'
						);
		$crud->field_type('color','dropdown',
            				array(
            						'#0099e5' => 'Azul',
            						'#ff3322' => 'Rojo',
            						'#34bf49' => 'Verde' ,
            						'#00bce4' => 'Celeste',
            						'#f0e000' => 'Amarillo',
            						'#a5a9ab' => 'Gris'
            					)
            				);
		/* LOG */
		$_POST['tabla']     = 'com_evento';
		$_POST['categoria_'] ='Administrar/evento';
		$crud->callback_after_insert(array($this, 'log_after_insert'));
		$crud->callback_after_update(array($this, 'log_after_update'));
		$crud->callback_before_delete(array($this, 'log_before_delete'));

		if($this->session->userdata('ver') == 'no'):
			$crud->unset_read();
		endif;
		if($this->session->userdata('editar') == 'no'):
			$crud->unset_edit();
		endif;
		if($this->session->userdata('borrar') == 'no'):
			$crud->unset_delete();
		endif;
		if($this->session->userdata('crear') == 'no'):
			$crud->unset_add();
		endif;

		$output = $crud->render();
		$data['output'] = $output;
		$data['plantilla'] = 'evento';
		$this->load->view('admin/administrar', $data);
	}
	public function encuestas()
	{
		$data['title']      = "Encuestas";
		$data['title_page'] = "Administración Encuestas";
		$menu               = $this->menu->getPrivilegios($this->session->userdata('id_cargo'));
		$data['menu']       = $menu;
		$crud               = new grocery_CRUD();

		$crud->set_table('com_encuesta')
			->set_subject('Encuestas')
			->columns(
				'titulo',
				'descripcion',
				'fecha',
				'estado'
			)
			->display_as('titulo','Título')
			->display_as('descripcion','Descripción')
			->display_as('fecha','Publicación el')
			->display_as('estado','Estado');
		$crud->fields(
						'titulo',
						'descripcion',
						'fecha',
						'estado'
					);
		$crud->required_fields(
							'titulo',
							'descripcion',
							'fecha',
							'estado'
						);
		$crud->edit_fields(
							'titulo',
							'descripcion',
							'estado'
						);

		/* LOG */
		$_POST['tabla']     = 'com_encuesta';
		$_POST['categoria_'] ='Administrar/encuesta';
		$crud->callback_after_insert(array($this, 'log_after_insert'));
		$crud->callback_after_update(array($this, 'log_after_update'));
		$crud->callback_before_delete(array($this, 'log_before_delete'));

		if($this->session->userdata('ver') == 'no'):
			$crud->unset_read();
		endif;
		if($this->session->userdata('editar') == 'no'):
			$crud->unset_edit();
		endif;
		if($this->session->userdata('borrar') == 'no'):
			$crud->unset_delete();
		endif;
		if($this->session->userdata('crear') == 'no'):
			$crud->unset_add();
		endif;
		/*
			- OPCIONES: Agrega mas opciones a una encuesta
			- RESULTADOS: Muestra los gráficos(tipo torta) para una encuesta
		*/
		$crud->add_action('Opciones', '', 'Administrar/opciones','fa fa-check-square');
		//$crud->add_action('Resultados', '', 'Administrar/resultados','fa fa-pie-chart results');

		$output = $crud->render();
		$data['output'] = $output;
		$data['plantilla'] = 'encuestas';
		$this->load->view('admin/administrar', $data);
	}
	public function opciones($id)
	{
		$encuesta_actual = $this->encuesta->getEncuestaById($id);
		$data['album_back'] = '<a href="'.base_url().'Administrar/encuestas" class="btn blue-ende" style="background-image:none!important"><i class="fa fa-long-arrow-left"></i> Encuestas</a>';
		$data['album_save'] = '<a href="'.base_url().'Administrar/encuestas" class="btn blue-ende" style="background-image:none!important"><i class="fa fa-long-arrow-left"></i> Encuestas</a>';
		$data['title']      = "Encuesta";
		$data['title_page'] = "Encuesta: ".$encuesta_actual->titulo." > Opciones";
		$menu               = $this->menu->getPrivilegios($this->session->userdata('id_cargo'));
		$data['menu']       = $menu;
		$crud               = new grocery_CRUD();

		$crud->where('com_encuesta_opciones.id_encuesta',$id);
		$crud->set_table('com_encuesta_opciones')
			->set_subject('Opciones de Votación')
			->columns(
				'titulo',
				'valor'
			)
			->display_as('titulo','Título')
			->display_as('valor','Valor(unicamente para diferenciación)');
		$crud->fields(
						'id_encuesta',
						'titulo',
						'valor'
					);
		$crud->required_fields(
						'id_encuesta',
						'titulo',
						'valor'
						);
		$crud->edit_fields(
						'titulo',
						'valor'
						);
		$crud->field_type('id_encuesta', 'hidden', $id);
		/* LOG */
		$_POST['tabla']     = 'com_encuesta_opciones';
		$_POST['categoria_'] ='Administrar/opciones';
		$crud->callback_after_insert(array($this, 'log_after_insert'));
		$crud->callback_after_update(array($this, 'log_after_update'));
		$crud->callback_before_delete(array($this, 'log_before_delete'));

		// if($this->session->userdata('ver') == 'no'):
		// 	$crud->unset_read();
		// endif;
		// if($this->session->userdata('editar') == 'no'):
		// 	$crud->unset_edit();
		// endif;
		// if($this->session->userdata('borrar') == 'no'):
		// 	$crud->unset_delete();
		// endif;
		// if($this->session->userdata('crear') == 'no'):
		// 	$crud->unset_add();
		// endif;

		/*   CARGAMOS LA VSITA DE LOS GRAFICOS   */
		$data['resultados'] = $this->getResultados($id);

		/* FIN CARGAMOS LA VSITA DE LOS GRAFICOS */

		$output = $crud->render();
		$data['output'] = $output;
		$data['plantilla'] = 'opciones';
		$this->load->view('admin/administrar', $data);
	}
	/********************************************************************/
	/**************************** CALLBACKS *****************************/
	/********************************************************************/
	function encrypt_password_callback($post_array, $primary_key)
	{
	    $this->load->library('encrypt');
	    if(!empty($post_array['password']))
	    {
	        if($this->usuario->getUsuarioByPass($post_array['password'])->num_rows() == 0)
	        	$post_array['password'] = md5($post_array['password']);
	    }
	    else
	    {
	        unset($post_array['password']);
	    }

	  return $post_array;
	}
	function set_password_input_to_empty()
	{
    	return "<input type='password' name='password' value='' />";
	}
	function setButtonsGrid($id_cargo)
	{
		$this->load->model('Menu_model','menu');
		return $this->menu->getCargo($id_cargo);
	}
	function change_name_image($post_array)
	{
		if (!empty($post_array['path_archivo']))
		{
			$img_name = $_POST['ruta'].$post_array['path_archivo'];
			$post_array['path_archivo'] = $img_name;
		}
		return $post_array;
	}
	function log_after_insert($post_array,$primary_key)
	{
		$data = array(
					'id_usuario'     => $this->session->userdata('id_usuario'),
					'nombre_usuario' => $this->session->userdata('usuario'),
					'categoria'      => $_POST['categoria_'],
					'accion'         => 'Insert',
					'detalle_accion' => 'Inserción en tabla '.$_POST['tabla'],
					'fecha_accion'   => date("Y-m-d"),
					'hora_accion'    => date("H:i:s")
					);
		$this->bitacora->insert($data);
	}
	function log_after_update($post_array,$primary_key)
	{
		$cadena='';
		foreach ($post_array as $key=>$value) {
			$cadena .= $key.'=>'.$value.'##';
		}
		$data = array(
					'id_usuario'     => $this->session->userdata('id_usuario'),
					'nombre_usuario' => $this->session->userdata('usuario'),
					'categoria'      => $_POST['categoria_'],
					'accion'         => 'Update',
					'detalle_accion' => 'Update del registro con ID: '.$primary_key.', en la tabla '.$_POST['tabla'].', datos antes del: '.$cadena,
					'fecha_accion'   => date("Y-m-d"),
					'hora_accion'    => date("H:i:s")
				);
		$this->bitacora->insert($data);
	}
	function log_before_delete($primary_key)
	{
		$data = array(
					'id_usuario'     => $this->session->userdata('id_usuario'),
					'nombre_usuario' => $this->session->userdata('usuario'),
					'categoria'      => $_POST['categoria_'],
					'accion'         => 'Delete',
					'detalle_accion' => 'Eliminación del registro con ID: '.$primary_key.' en la tabla '.$_POST['tabla'],
					'fecha_accion'   => date("Y-m-d"),
					'hora_accion'    => date("H:i:s")
				);
		$this->bitacora->insert($data);
	}
	/********************************************************************/
	/*************************** RESULTADOS *****************************/
	/********************************************************************/
	public function getResultados($id)
	{
		$encuesta_votos = $this->encuesta->getResults($id);
		$encuesta = $this->encuesta->getEncuestaById($id);
		$chart = array();
		$data = array();
					/*
					"subCaption"  => "$encuesta->descripcion",
					"xAxisName"   => "Opciones",
					"yAxisName"   => "Personas",
					"numberSufix" => " Personas",
					"theme"       => "fint"*/
		$titulo = strip_tags($encuesta->titulo);
		$descripcion =strip_tags($encuesta->descripcion);
		$chart[] = array(
					"caption"                   => "$titulo",
					"subCaption"                => "$descripcion",
					"startingAngle"             => "60",
					"showLabels"                => "0",
					"showLegend"                => "1",
					"enableMultiSlicing"        => "0",
					"slicingDistance"           => "45",
					"showHoverEffect"           => "1",
					"showLegend"                => "1",
					"useDataPlotColorForLabels" => "1",
					"legendBgColor"             => "#ffffff",
					"legendBorderAlpha"         => "1",
					"legendShadow"              => "1",
					"bgColor"					=> "#f5f5f5",

					//To show the values in percentage
					"showPercentValues"         => "1",
					"showPercentInTooltip"      => "0",
					"plotTooltext"              => "",

					"showBorder"                => "0",
					"borderColor"               => "#666666",
					"borderThickness"           => "4",
					"borderAlpha"               => "80",
					"numberSuffix"              => " Personas",
					"toolTipColor"              => "#ffffff",
					"toolTipBorderThickness"    => "1",
					"toolTipBgColor"            => "#000000",
					"toolTipBgAlpha"            => "80",
					"toolTipBorderRadius"       => "2",
					"toolTipPadding"            => "5",

					"theme"                     =>"fint"

				);
		foreach ($encuesta_votos as $total)
		{
			$titulo = $this->encuesta->getOpcionById($total->id_encuesta_opcion,$total->id_encuesta);
			$data[] = array(
							'label'	=> $titulo->titulo,
							'value'	=> $total->total
						);
		}
		return '"chart":'.trim(json_encode($chart),"[]").', "data":'.json_encode($data);
	}
}