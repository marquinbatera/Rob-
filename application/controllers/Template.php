<?php defined('BASEPATH') OR exit('No direct script access allowed');
Class Template extends CI_controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('twig');
		$this->twig->add_function('base_url');
		//use library easy parse
		$this->load->library('easy_parser');
		$this->load->library('session');
		$this->load->model('ci_template_model');
	}

	public function index()
	{

		
	}

	public function salvaOrdem()
	{
		$idpag = $this->input->post('idpag');
		$ordem = $this->input->post('ordem');
		$bloco = $this->input->post('bloco');

		$dados = array(
			'id_pag' => $idpag,
			'ordem' => $ordem,
			'bloco' => $bloco
		);

		$idOrdem = $this->ci_template_model->setAll($dados, 'tb_posicao');
	}
	public function salvaEstilos()
	{
		$idpag = $this->input->post('idpag');
		$idElemento = $this->input->post('idelemento');
		$classeEstilo = $this->input->post('claseestilo');
		$estilos = $this->input->post('estilos');

		$dados = array(
			'id_pag' => $idpag,
			'id_elemento' => $idElemento,
			'classe_estilo' => $classeEstilo,
			'estilos' => $estilos
		);

		$idEstilos = $this->ci_template_model->setAll($dados, 'tb_estilos');
	}

	public function montaTemplate()
	{
		$this->load->model('ci_bloco_model');
		$posicao = $this->ci_template_model->getAllWhereOrder('home', 'id_pag', 'ordem','tb_posicao');
		$estilos = $this->ci_template_model->getAllWhere('home', 'id_pag', 'tb_estilos');

		$css = "<style>";
		foreach ($estilos as $values) {
			$estilosimportant = str_replace(";"," !important;",$values['estilos']);
			$css .= ".".$values['classe_estilo']."{".$estilosimportant."}";
		}
		$css .= "</style>";

		for($i=0;$i<count($posicao);$i++){
			$conte[$posicao[$i]['ordem']] = $posicao[$i]['bloco'];
		}

		
		$data = array(
			'view' => "templates/temp1/teste",
			'title' => "Turbosite",
			'head'  => "e-commerce Creator",
			'conteudo' => $conte,
			'estilos' => $estilos,
			'css' => $css
		);
		//this use easy parse
		$this->easy_parser->parse('layout_principal', $data);
	}
}