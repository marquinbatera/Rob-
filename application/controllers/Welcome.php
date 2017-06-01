<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Welcome extends CI_Controller {
	/**
 	* @category Libraries
 	* @package  CodeIgniter 3.0
 	* @author   Yp <purwantoyudi42@gmail.com>
 	* @link     https://timexstudio.com
 	* @license  Protected
 	*/

 	public function __construct()
	{
		parent::__construct();
		$this->load->library('twig');
		$this->twig->add_function('base_url');
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->library('easy_parser');
		$this->load->library('session');
		$this->load->model('ci_template_model');
		
	}

	public function index()
	{ 
		header('Access-Control-Allow-Origin: *');
		
		$login = $_GET['Login'];
		$nomeclatura = $_GET['Nomeclatura'];

		$retorno = $this->ci_template_model->getContaConfig($login, $nomeclatura);
		if($retorno){
			echo $retorno[0]['status'];
		}else{
			echo array(0);
		}
	}

	public function mensagem()
	{
		header('Access-Control-Allow-Origin: *');
		
		$login = $_GET['Login'];
		$nomeclatura = $_GET['Nomeclatura'];

		$retorno = $this->ci_template_model->getContaConfig($login, $nomeclatura);
		if($retorno){
			echo $retorno[0]['mensagem'];
		}else{
			echo array(0);
		}
	}

}