<?php

class Encuestas extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Menu_model','menu');
		$this->load->model('Encuesta_model','encuesta');
	}
	public function index()
	{
		$data['sistemas']          = $this->sistema->getSistemas();
		$data['cumpleanieros_dia'] = $this->funcionario->getCumpleaneros(0);
		$data['cumpleanieros_mes'] = $this->funcionario->getCumpleaneros(1);
		/* OBTENEMOS LAS ENCUESTAS */
		$data['elementos'] = $this->getOpciones($this->encuesta->getAll());
		$data['resultados'] = $this->getResultados($this->encuesta->getAll());
		/* FIN OBTENCION ENCUESTAS */
		$participaciones = $this->encuesta->getParticipaciones($this->session->userdata('id_usuario'));
		$res = array();
		foreach ($participaciones as $p) {
			array_push($res,$p->id_encuesta);
		}
		$data['participaciones'] = $res;

		$data['lista'] = 'encuestas';
		$menu = $this->menu->getPrivilegios($this->session->userdata('id_cargo'));
		$data['menu'] = $menu;

		$this->load->view('lista', $data);
	}
	private function getOpciones($encuestas)
	{
		$encuestas_opc = array();
		$i = 0;
		foreach ($encuestas as $encuesta)
		{
			$opciones = $this->encuesta->getOpciones($encuesta->id_encuesta);
			if($opciones != 0)
			{
				$encuestas_opc[$i] = array($encuesta,$opciones);
				$i++;
			}
		}
		return $encuestas_opc;
	}
	private function getResultados($encuestas)
	{
		$resultados = array();
		$i = 0;
		foreach ($encuestas as $encuesta)
		{
			$res = $this->getJSONResults($encuesta->id_encuesta);			
			$opciones = $this->encuesta->getOpciones($encuesta->id_encuesta);
			if($opciones != 0)
			{
				if($res != 0)
				{
					$resultados[$i] = array($encuesta,$res);
					$i++;
				}
			}
		}
		return $resultados;
	}
	public function getJSONResults($id)
	{
		$encuesta_votos = $this->encuesta->getResults($id);
		$encuesta = $this->encuesta->getEncuestaById($id);
		$chart = array();
		$data = array();
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
		if($encuesta_votos != 0){
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
		else{
			return 0;
		}
		
	}
	public function votar()
	{
		$id_encuesta = $this->input->post('id_encuesta');
		$opcion      = $this->input->post('opcion');
		$usuario     = $this->session->userdata('id_usuario');
		$voto        = $this->encuesta->votar($id_encuesta,$opcion,$usuario);
		if($voto)
			echo 1;
		else
			echo 0;
	}
}