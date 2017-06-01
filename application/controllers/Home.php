<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('ci_home_model');
		$this->load->library('form_validation');
		$this->load->library('ion_auth');
		$this->load->library('session');
		$this->load->library('easy_parser');
	}

	public function index()
	{
		if ($this->ion_auth->logged_in())
		{

			$id        = $this->ion_auth->get_user_id();
			$user_id   = $this->ci_home_model->getAllWhere($id, 'id', 'users');
			
			$userdata  = array(
				'nome' => $user_id[0]['username'],
				'id_user'  => $user_id[0]['id']
			);	
		
			$this->session->set_userdata($userdata);
			redirect(base_url('cliente/lista'), 'refresh');

			$this->parser->parse('layoutPrincipal', $data);
				
		}else{
			$data = array(
				'view'   => 'login/signin',
				'title' => 'BTraders',
				'additional' => null,
				);

			$this->easy_parser->parse('layoutDelivery', $data);
		}

	}

	public function esqueciSenha()
	{
		$data = array(
			'view'   => 'login/reset-password',
			'title' => 'OTL Software',
			'message' => null,
			'additional' => null,
			);

		$this->easy_parser->parse('layoutDelivery', $data);
	}

	public function recuperaConta()
	{
		
			
		$data = array(
			'view'   => 'login/reset-password',
			'title' => 'BTraders',
			'message' => "olá mundo!!",
			'additional' => null,
			);

		$this->easy_parser->parse('layoutDelivery', $data);
		
	}
}
