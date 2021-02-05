<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mail extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}
	public function hola()
	{
		print_r($_POST);
	}
	public function felicitacion()
	{
		$this->email->initialize(array(
			'protocol'  => 'smtp',
			'smtp_host' => COMPANY_SMTP,
			'smtp_user' => '',
			'smtp_pass' => '',
			'smtp_port' => COMPANY_SMTP_PORT,
			'crlf'      => "\r\n",
			'newline'   => "\r\n",
			'charset'   => 'utf-8',
		));
		$this->email->clear();
		$this->email->set_mailtype("html");
		$this->email->to($_POST['mail_cumpleanero']);
		$this->email->from($_POST['mail_amigo']);
		$subject             = 'Felicidades!!!, '.$_POST['cumpleanero'];
		$this->email->subject($subject);
		$body                = '';
		$data['amigo']       = $_POST['amigo'];
		$data['cumpleanero'] = $_POST['cumpleanero'].'!!!';
		/* PLANTILLAS DE CORREO */
		$r = rand(0,4);
		$plantillas = array(
							'0' => 'mails/cumpleanios/plantilla01',
							'1' => 'mails/cumpleanios/plantilla02',
							'2' => 'mails/cumpleanios/plantilla03',
							'3' => 'mails/cumpleanios/plantilla04',
							'4' => 'mails/cumpleanios/plantilla05',
						);
		$body                .= $this->load->view($plantillas[$r], $data, true);
		$this->email->message($body);
	    if(!$this->email->send())
	    	echo 0;
	    echo 1;
	}
}