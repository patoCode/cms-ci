<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Calendario extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('calendario_model','calendario');
    }
    public function getJSONEventos()
    {
    	echo json_encode($this->calendario->getEventos());
    }
}