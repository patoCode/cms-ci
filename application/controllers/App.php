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
    
}