<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Statics extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}
	public function manuales()
	{
		$this->load->view('statics/manuales');
	}
	public function politicas()
	{
		$this->load->view('statics/politicas');
	}
	public function reglamentos()
	{
		$this->load->view('statics/reglamentos');
	}
	public function formularios()
	{
		$this->load->view('statics/formularios');
	}
	public function presentaciones()
	{
		$this->load->view('statics/presentaciones');
	}
}