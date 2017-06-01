<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Robo extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('ion_auth', 'ion_auth');
		$this->load->model('ci_robo_model');
		$this->load->library('easy_parser');
	}

	public function index()
	{
		// if ($this->ion_auth->logged_in()) {
		$robos = $this->ci_robo_model->getUserList();
		$data = array(
			'view'   => 'robo/downloads',
			'title' => 'BTraders',
			'message' => null,
			'additional' => null,
			'robos' => $robos
		);

		$this->easy_parser->parse('layoutRobo', $data);
		
		// }else {
		// 	$this->session->set_flashdata('mensagem', 'Sessão expirou!');
		// 	$this->session->set_flashdata('alert', 'warning');
		// 	redirect(base_url('home/index'), 'refresh');
		// }	
		
	}

	public function newRobo()
	{
		if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
			if ($this->input->post()) {

				$storeFolder = './assets/robos/';  //2
			 	// print_r($_FILES['upload']['type']);
			 	// exit;
			 	$dados = array();
				if (!empty($_FILES['upload']['name'])) {

				    if($_FILES['upload']['type'] == 'application/octet-stream'){

					    $tempFile = $_FILES['upload']['tmp_name'];          //3             
					      
					    $targetPath = $storeFolder;  //4
					     
					    $targetFile =  $targetPath. $_FILES['upload']['name'];  //5
					 
					    move_uploaded_file($tempFile,$targetFile); //6

					    $dados['url'] = $_FILES['upload']['name'];
			
				    }else{
				    	$this->session->set_flashdata('mensagem', 'Formato de arquivo não permitido, favor inserir um arquivo tipo ZIP!');
						$this->session->set_flashdata('alert', 'danger');
						redirect(base_url('robo/cadastro'), 'refresh');
				    }
				     
				}
				$nome    = $this->input->post('nome');
				$ativo   = $this->input->post('ativo');
				$valor   = $this->input->post('valor');
				$descricao   = $this->input->post('descricao');
				$nomeclatura   = $this->input->post('nomeclatura');


				
				$dados['nome'] = $nome;
				$dados['ativo'] = $ativo;
				$dados['descricao'] = $descricao;
				$dados['valor'] = $valor;
				$dados['nomeclatura'] = $nomeclatura;
				

				//insere robo e retorna o id
				$robo_id = $this->ci_robo_model->setUser($dados);
				if ($robo_id)
				{

					$this->session->set_flashdata('mensagem', 'Cadastro realizado com Sucesso!');
					$this->session->set_flashdata('alert', 'success');
					redirect(base_url('robo/lista'), 'refresh');
				}else{
					$this->session->set_flashdata('mensagem', 'Falha no cadastro, preencha os campos corretamente!');
					$this->session->set_flashdata('alert', 'warning');
					redirect(base_url('robo/cadastro'), 'refresh');
				}
			}

			$data = array(
				'view'   => 'robo/editRobo',
				'title' => 'BTraders',
				'additional' => null,
				'tipo' => 0
			);
			$this->easy_parser->parse('layoutPrincipal', $data);
		} else {
			$this->session->set_flashdata('mensagem', 'Sessão expirou!');
			$this->session->set_flashdata('alert', 'warning');
			redirect(base_url('login'), 'refresh');
		}
	}

	public function editRobo($id)
	{
		if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
			if ($this->input->post()) {

				$storeFolder = './assets/robos/';  //2
				// print_r($_FILES['upload']['type']);
			 // 	exit;
			 	$dados = array();
				if(!empty($_FILES['upload']['name'])) {

				    if($_FILES['upload']['type'] == 'application/octet-stream'){

					    $tempFile = $_FILES['upload']['tmp_name'];          //3             
					      
					    $targetPath = $storeFolder;  //4
					     
					    $targetFile =  $targetPath. $_FILES['upload']['name'];  //5
					 
					    move_uploaded_file($tempFile,$targetFile); //6

					    $dados['url'] = $_FILES['upload']['name'];
				
				    }else{
				    	$this->session->set_flashdata('mensagem', 'Formato de arquivo não permitido, favor inserir um arquivo tipo ZIP!');
						$this->session->set_flashdata('alert', 'danger');
						redirect(base_url('robo/editar/').$id, 'refresh');
				    }
				     
				}
				$nome    = $this->input->post('nome');
				$ativo   = $this->input->post('ativo');
				$valor   = $this->input->post('valor');
				$descricao   = $this->input->post('descricao');
				$nomeclatura   = $this->input->post('nomeclatura');


				$dados['nome'] = $nome;
				$dados['ativo'] = $ativo;
				$dados['descricao'] = $descricao;
				$dados['valor'] = $valor;
				$dados['nomeclatura'] = $nomeclatura;

				//insere robo e retorna o id
				$robo_id = $this->ci_robo_model->updateAllUser($id, 'id', $dados, 'robo');
				if ($robo_id)
				{

					$this->session->set_flashdata('mensagem', 'Atualização realizado com Sucesso!');
					$this->session->set_flashdata('alert', 'success');
					redirect(base_url('robo/lista'), 'refresh');
				}else{
					$this->session->set_flashdata('mensagem', 'Falha na Atualização, preencha os campos corretamente!');
					$this->session->set_flashdata('alert', 'warning');
					redirect(base_url('robo/editar/').$id, 'refresh');
				}
			}
			$robo = $this->ci_robo_model->getAllWhere($id,'id','robo');
			$data = array(
				'view'   => 'robo/editRobo',
				'title' => 'BTraders',
				'additional' => null,
				'robo' => $robo,
				'tipo' => 1
			);
			$this->easy_parser->parse('layoutPrincipal', $data);
		} else {
			$this->session->set_flashdata('mensagem', 'Sessão expirou!');
			$this->session->set_flashdata('alert', 'warning');
			redirect(base_url('login'), 'refresh');
		}
	}

	public function listRobo()
	{
		if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
			$robo = $this->ci_robo_model->getUserList();
			$data = array(
				'view'   => 'robo/listRobos',
				'title' => 'BTraders',
				'message' => null,
				'additional' => null,
				'filial' => $robo
				);

			$this->easy_parser->parse('layoutPrincipal', $data);
		} else {
			$this->session->set_flashdata('mensagem', 'Sessão expirou!');
			$this->session->set_flashdata('alert', 'warning');
			redirect(base_url('login'), 'refresh');
		}
	}

	public function buscaListaRobo() {
		if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
			$robo = $this->ci_robo_model->getUserList();
			$data['aaData'] = $robo;
			echo json_encode($data);
		} else {
			$this->session->set_flashdata('mensagem', 'Sessão expirou!');
			$this->session->set_flashdata('alert', 'warning');
			redirect(base_url('login'), 'refresh');
		}
	}

	public function removeRobo()
	{
		if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
			$robo = $this->input->post('id');

			$ativa = $this->ci_robo_model->getAllWhere($robo, 'id_robo', 'ativo');
			
			$this->ci_robo_model->excluirFilial($robo);
			$this->ci_robo_model->delete($ativa[0]['id'], 'ativo');

			$data['mensagem'] = 'Exclusão realizada com sucesso!';
			$data['alert']    = 'success';

			echo json_encode($data);
		} else {
			$this->session->set_flashdata('mensagem', 'Sessão expirou!');
			$this->session->set_flashdata('alert', 'warning');
			redirect(base_url('login'), 'refresh');
		}
	}

	public function baixaRobo($id)
	{

		$robo = $this->ci_robo_model->getAllWhere($id,'id','robo');

		$pasta = './assets/robos/'.$robo[0]['url'];
		$name = $robo[0]['url'];
		
		force_download($pasta, null);
		redirect(base_url('login'), 'refresh');
	}

	public function newMensagem()
	{
		if ($this->ion_auth->logged_in()) {
			if ($this->input->post()) {

				$mensagem    = $this->input->post('mensagem');
				$robos = $this->input->post('robos');

				foreach ($robos as $robo) {
					$dados['id_robo'] = $robo;
					$dados['mensagem'] = $mensagem;

					$robo_id = $this->ci_robo_model->setAll($dados, 'mensagens');
					if (!$robo_id)
					{

						$this->session->set_flashdata('mensagem', 'Falha no cadastro, preencha os campos corretamente!');
						$this->session->set_flashdata('alert', 'warning');
						redirect(base_url('robo/mensagem/cadastro'), 'refresh');
					}
				}
				
				$this->session->set_flashdata('mensagem', 'Cadastro realizado com Sucesso!');
				$this->session->set_flashdata('alert', 'success');
				redirect(base_url('robo/mensagem/lista'), 'refresh');
			}

			$robos = $this->ci_robo_model->getUserList();
			$data = array(
				'view'   => 'robo/editMensagem',
				'title' => 'BTraders',
				'additional' => null,
				'tipo' => 0,
				'robos' => $robos
			);
			$this->easy_parser->parse('layoutPrincipal', $data);
		} else {
			$this->session->set_flashdata('mensagem', 'Sessão expirou!');
			$this->session->set_flashdata('alert', 'warning');
			redirect(base_url('login'), 'refresh');
		}
	}

	public function listMensagens()
	{
		if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
			$mensagens = $this->ci_robo_model->getAll('mensagens');
			$data = array(
				'view'   		=> 'robo/listMensagens',
				'title' 		=> 'BTraders',
				'message' 		=> null,
				'additional' 	=> null,
				'mensagens' 	=> $mensagens
				);

			$this->easy_parser->parse('layoutPrincipal', $data);
		} else {
			$this->session->set_flashdata('mensagem', 'Sessão expirou!');
			$this->session->set_flashdata('alert', 'warning');
			redirect(base_url('login'), 'refresh');
		}
	}

	public function buscaListaMensagens() {
		if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
			$mensagem = $this->ci_robo_model->getMensagens();
			$data['aaData'] = $mensagem;
			echo json_encode($data);
		} else {
			$this->session->set_flashdata('mensagem', 'Sessão expirou!');
			$this->session->set_flashdata('alert', 'warning');
			redirect(base_url('login'), 'refresh');
		}
	}

	public function removeMensagem()
	{
		if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
			$mensagem = $this->input->post('id');

			$this->ci_robo_model->delete($mensagem, 'mensagens');

			$data['mensagem'] = 'Exclusão realizada com sucesso!';
			$data['alert']    = 'success';

			echo json_encode($data);
		} else {
			$this->session->set_flashdata('mensagem', 'Sessão expirou!');
			$this->session->set_flashdata('alert', 'warning');
			redirect(base_url('login'), 'refresh');
		}
	}
}
