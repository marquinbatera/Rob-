<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ci_bloco_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->tb = "tb_edicao_layout";
		$this->tb_config = "tb_config";
		
	}

	public function montaBloco($bloco)
	{
			
		switch ($bloco[0]['bloco']) {
			case 'blocojumbotron':
				$html = '<div id="blocojumbotron" class="modif content">'.
						'<button type="button" class="btn btn-danger btn-sm pull-right animated fadeInLeft btnEdicao" onclick="abroMenu(\'.jumbotron\')"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button>'.
						'<a href="javascript:" class="btn btn-danger btn-sm pull-right animated fadeInLeft fecharConteudo" id="edicao1">X</a>'.
						'<div id="jumboedit" class="modif jumbotron editavel  resize-bloco" id="drag5">'.
						'<button type="button" class="btn btn-danger btn-sm pull-right animated fadeInLeft btnEdicao" onclick="abroMenu(\'.h1jumbo\')"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button>'.
						'<h1 id="h1jumboedit" class="modif h1jumbo editavel">Jumbotron</h1>'.
						'<button type="button" class="btn btn-danger btn-sm pull-right animated fadeInLeft btnEdicao" onclick="abroMenu(\'.txtjumbo\')"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button>'.
						'<p id="textojumboedit" class="modif txtjumbo editavel">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>'.
						'<p class="editavel">'.
						'<button type="button" class="btn btn-danger btn-sm pull-right animated fadeInLeft btnEdicao" onclick="abroMenu(\'.btnjumbo\')"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button>'.
						'<a id="btnjumboedit" class="modif btnjumbo editavel btn btn-primary btn-lg">Learn more</a>'.
						'</p>'.
						'</div>'.
						'</div>';
				return $html;		
				break;
			case 'produtos':
				# code...
				break;
			case 'blocopansim':
				# code...
				break;
			
			default:
				# code...
				break;
		}
	}

	
}
