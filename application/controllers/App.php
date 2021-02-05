<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class App extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->faker = Faker\Factory::create();
        $this->load->model('funcionario_model','funcionario');
        $this->load->model('publicacion_model','publicacion');
        $this->load->model('mensaje_model','mensaje');
        $this->load->model('archivo_model','archivo');
    }
    /*
    MENSAJES
     */
    public function seedMensaje()
    {
        $this->_truncate_mensaje();
        $this->_seed_mensaje(50);
    }
    function _seed_mensaje($limit)
    {
        echo "generando $limit mensajes";
        for ($i = 0; $i < $limit; $i++) {
            $data = array(
                'mensaje' => $this->faker->sentence($nbWords = 120),
                'autor' => $this->faker->name($gender = null|'male'|'female') ,
                'fecha' => $this->faker->dateTime($max = 'now')->format('Y-m-d H:i:s'),
            );
            $this->mensaje->insert($data);
        }
        echo PHP_EOL;
    }
    private function _truncate_mensaje()
    {
        $this->mensaje->truncate();
    }
    /*
    PUBLICACIONES
     */
    public function seedPublicacion()
    {
        $this->_truncate_publicacion();
        $this->_seed_publicacion(50);
    }
    function _seed_publicacion($limit)
    {
        echo "generando $limit publicaciones";
        for ($i = 0; $i < $limit; $i++) {
            $data = array(
                'titulo' => $this->faker->sentence($nbWords = 4),
                'descripcion' => $this->faker->text($maxNbChars = 2000),
                'destacada' => $this->faker->randomElements($array = array ('si','no'), $count = 1)[0],
                'fecha' => $this->faker->dateTime($max = 'now')->format('Y-m-d H:i:s'),
                'path_file' => $this->faker->url,
                'path_image' =>  $this->faker->url,
                'id_tipo_publicacion' =>  $this->faker->randomElements($array = array ('1','2'), $count = 1)[0],
                'id_categoria' =>  $this->faker->randomElements($array = array ('1','2','3','4','5','6'), $count = 1)[0]
            );
            $this->publicacion->insert($data);
        }
        echo PHP_EOL;
    }
    private function _truncate_publicacion()
    {
        $this->publicacion->truncate();
    }
    /*
    FUNCIONARIO
     */
    function seed()
    {
        $this->_truncate_db();
        $this->_seed_users(100);
    }
    function _seed_users($limit)
    {
        echo "generando $limit funcionarios";
        for ($i = 0; $i < $limit; $i++) {
            echo ".";

            $data = array(
                'nombres'               => $this->faker->firstName,
                'apellido_pat'          => $this->faker->lastName,
                'apellido_mat'          => $this->faker->lastName,
                'cumpleanio'            => $this->faker->date($format = 'Y-m-d', $max = 'now'),
                'telefono_fijo'         => $this->faker->phoneNumber,
                'celular'               => $this->faker->phoneNumber,
                'unidad_organizacional' => $this->faker->company,
                'cargo'                 => $this->faker->city,
                'lugar_trabajo'         => $this->faker->city,
                'interno'               => $this->faker->buildingNumber,
                'email_ende'            => $this->faker->email,
                'jefe_inmediato'        => $this->faker->randomElements($array = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20),$count = 1)[0],
                'estado'                => $this->faker->randomElements($array = array ('activo','inactivo'), $count = 1)[0],
            );
            $this->funcionario->insert($data);
        }
        echo PHP_EOL;
    }
    private function _truncate_db()
    {
        $this->funcionario->truncate();
    }
    /*
        ARCHIVO
     */
    public function seedArchivo()
    {
        $this->_truncate_archivo();
        $this->_seed_archivo(50);
    }
    function _seed_archivo($limit)
    {
        echo "generando $limit archivos";
        for ($i = 0; $i < $limit; $i++) {
            $data = array(
                'archivo'        => $this->faker->company,
                'path_archivo'   => $this->faker->url ,
                'path_imagen'    => $this->faker->url,
                'id_publicacion' => $this->faker->randomElements($array = array ('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15'), $count = 1)[0],
                'id_categoria'   => $this->faker->randomElements($array = array ('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25'), $count = 1)[0]
            );
            $this->archivo->insert($data);
        }
        echo PHP_EOL;
    }
    private function _truncate_archivo()
    {
        $this->archivo->truncate();
    }

    /* HELPER DE FUNCIONARIOS */
    public function funcionarios_antiguos()
    {
        $tests = $this->funcionario->getFuncionarioTest();
        echo '<style> body{font-size:12px; font-family:sans-serif; } </style> ';

        foreach ($tests as $f) {
            $id                    = trim($f->ID_FUNCIONARIO);
            $nombres               = trim($f->PRIMER_NOMBRE.' '.$f->SEGUNDO_NOMBRE);
            $apellido_pat          = trim($f->PRIMER_APELLIDO);
            $apellido_mat          = trim($f->SEGUNDO_APELLIDO);
            $cumpleanio            = trim('2000-'.$f->MES_CUMPLEANIO.'-'.$f->DIA_CUMPLEANIO);
            $telefono_fijo         = trim($f->TELEFONO_DOMICILIO);
            $celular               = trim($f->CELULAR);
            $interno               = trim($f->TELEFONO_INTERNO);
            $email_ende            = trim($f->CORREO_ELECTRONICO_ENDE);
            $email_personal        = trim($f->CORREO_PERSONAL);
            $email_personal_opc    = trim($f->CORREO_PERSONAL2);
            $profesion             = trim($f->PROFESION);
            $cargo                 = trim($f->CARGO_TRABAJO);
            $unidad_organizacional = trim($f->UNIDAD_ORGANIZACIONAL);
            $jefe_inmediato        = trim($f->JEFE_INMEDIATO);
            $lugar_trabajo         = trim($f->UBICACION_LUGAR_TRABAJO);
            $path_foto             = trim('primera/'.$f->RUTA_FOTO);
            $tipo_sangre           = trim($f->TIPO_SANGRE);
            $estado                = trim($f->ESTADO);
            echo "INSERT INTO com_funcionario VALUES ('$id', '$nombres', '$apellido_pat', '$apellido_mat', '$cumpleanio', '$telefono_fijo', '$celular', '$interno', '$email_ende', '$email_personal', '$email_personal_opc', '$profesion', '$cargo', '$unidad_organizacional', '$jefe_inmediato', '$lugar_trabajo', '$path_foto', '$tipo_sangre', '$estado' );".'<br>';
        }
    }
    /* HELPER DE FUNCIONARIOS */
    public function usuarios_antiguo()
    {
        $tests = $this->funcionario->getUsuarioTest();
        echo '<style> body{font-size:12px; font-family:sans-serif; } </style> ';
        $cont = 0;$i = 0;
        $usuarios = array();
        foreach ($tests as $u) {
            if(!in_array($u->USUARIO, $usuarios)):
                array_push($usuarios, $u->USUARIO);
                $data = $this->funcionario->getId($u->USUARIO);
                if($data->num_rows() > 0)
                {
                    $data = $data->row();
                    $id_funcionario            = $data->id_funcionario;
                    $i++;
                }
                else
                {
                    $id_funcionario            = '';
                    $cont++;
                }
                $id                        = $u->ID_USUARIO;
                $usuario                   = $u->USUARIO;
                $password                  = $u->CONTRASENIA;
                $fecha_registro            = $u->FECHA_REGISTRO;
                $fecha_ultima_modificacion = $u->FECHA_ULTIMA_MODIFICACION;
                $fecha_expiracion          = $u->FECHA_EXPIRACION;
                $estado                    = strtolower($u->ESTADO);
                $login_local               = $u->LOGIN_LOCAL;
                $id_cargo                  = $u->ID_ROL;
                echo "INSERT INTO com_usuario VALUES ('$id','$usuario','$password','$fecha_registro','$fecha_ultima_modificacion','$fecha_expiracion','$estado','$login_local','$id_cargo','$id_funcionario');".'<br>';
            endif;
        }
        echo '<h1 style="margin-top:50px">$cont SIN ID, $i con ID</h1>';
    }
    public function usuarios_endesis()
    {
        $tests = $this->funcionario->getEndeSIS();
        echo '<style> body{font-size:12px; font-family:sans-serif; } </style> ';
        $cont = 0;$i = 0;
        $usuarios = array();
        foreach ($tests as $u) {
            $ya_estan = $this->funcionario->getFuncionarioTest();
            $band = false;
            foreach ($ya_estan as $y) {
                if($u->correo_electronico_ende == $y->email_ende)
                    $band = true;
            }
            if($band)
            {
                $data_persona = explode(" ",trim($u->desc_persona));
                $clean        = array();
                $existe       = 0;
                $ok           = 0;
                for ($i=0; $i < count($data_persona); $i++)
                {
                    if($data_persona[$existe]!='')
                    {
                        $clean[$ok] = trim($data_persona[$existe]);
                        $ok++;
                    }
                    $existe++;
                }
                $tamano = count($clean);
                $apellido_pat = ucfirst(strtolower(trim($clean[0])));
                $apellido_mat = ucfirst(strtolower(trim($clean[1])));
                $nombres = '';
                for ($i=2; $i < $tamano; $i++) {
                    $nombres .= ucfirst(strtolower($clean[$i])).' ';
                }
                echo "<pre>";
                echo $u->desc_persona.'------->';
                echo $nombres.' '.$apellido_pat.' '.$apellido_mat.'<br>';
                echo "</pre>";
            }
        }
    }

    /* FIX ROUTES FILES */
    public function RRHH($id)
    {
        $data = $this->categoriaPublicaciones($this->categoria->getCategoria($id));
        foreach ($data[0][1] as $d) {
            //UPDATE `neo_bdcomende`.`com_archivo` SET `path_archivo` = 'public/rrhh/files/home/EduardoPazPresidentedeENDE1.pdf' WHERE `com_archivo`.`id_archivo` = 693;
            echo 'UPDATE com_archivo SET path_archivo = "public/rrhh/files/'.$d->path_archivo.'" WHERE id_archivo= "'.$d->id_archivo.'"; <br>';
        }
    }
    public function Funcionario()
    {
        $data = $this->funcionario->getAll();
        foreach ($data as $d) {
            //UPDATE `neo_bdcomende`.`com_archivo` SET `path_archivo` = 'public/rrhh/files/home/EduardoPazPresidentedeENDE1.pdf' WHERE `com_archivo`.`id_archivo` = 693;
            echo 'UPDATE com_funcionario SET path_foto = "public/funcionario/'.$d->path_foto.'" WHERE id_funcionario= "'.$d->id_funcionario.'"; <br>';
        }
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