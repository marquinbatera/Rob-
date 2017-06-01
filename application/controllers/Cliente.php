<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('ion_auth', 'ion_auth');
		// $this->load->model('ci_ion_auth_model');
		$this->load->model('ci_cliente_model');
		$this->load->library('easy_parser');
	}

	public function index()
	{

		if ($this->ion_auth->logged_in())
		{
			$userId = $this->ion_auth->user()->row();
			$data = array(
				'view'   => 'index/index',
				'title' => 'BTraders',
				'message' => "olá mundo!!",
				'userId' => $userId,
				'additional' => null,
				);

			$this->easy_parser->parse('layoutPrincipal', $data);
		}else{
			$data = array(
				'view'   => 'login/signin',
				'title' => 'BTraders',
				'message' => null,
				'additional' => null,
				);

			$this->easy_parser->parse('layoutDelivery', $data);
		}

	}

	public function newCliente()
	{
		if ($this->ion_auth->logged_in()) {
			if ($this->input->post()) {

				$conta       = $this->input->post('conta');
				$nome       = $this->input->post('nome');
				$email   = $this->input->post('email');

				print_r('aqui');
				$dados = array(
					'conta'       => $conta,
					'nome'       => $nome,
					'email'   => $email
				);

				//insere produto e retorna o id
				if ($cliente_id = $this->ci_cliente_model->setUser($dados))
				{

					$this->session->set_flashdata('mensagem', 'Cadastro realizado com Sucesso!');
					$this->session->set_flashdata('alert', 'success');
					redirect(base_url('cliente/listClientes'), 'refresh');
				}else{
					$this->session->set_flashdata('mensagem', 'Falha no cadastro, preencha os campos corretamente!');
					$this->session->set_flashdata('alert', 'warning');
					redirect(base_url('cliente/newCliente'), 'refresh');
				}
			}

			$data = array(
				'view'   => 'clientes/editClientes',
				'title' => 'BTraders',
				'additional' => null,
			);
			$this->easy_parser->parse('layoutPrincipal', $data);
		} else {
			$this->session->set_flashdata('mensagem', 'Sessão expirou!');
			$this->session->set_flashdata('alert', 'warning');
			redirect(base_url('login'), 'refresh');
		}
	}

	public function editCliente($id)
	{
		if ($this->ion_auth->logged_in()) {
			if ($this->input->post()) {

				$conta       = $this->input->post('conta');
				$nome       = $this->input->post('nome');
				$email   = $this->input->post('email');

				print_r('aqui');
				$dados = array(
					'conta'       => $conta,
					'nome'       => $nome,
					'email'   => $email
				);

				//Atualiza cliente e retorna o id
				if ($cliente_id = $this->ci_cliente_model->updateAllUser($id, 'id', $dados, 'bolsa'))
				{

					$this->session->set_flashdata('mensagem', 'Cadastro realizado com Sucesso!');
					$this->session->set_flashdata('alert', 'success');
					redirect(base_url('cliente/listClientes'), 'refresh');
				}else{
					$this->session->set_flashdata('mensagem', 'Falha no cadastro, preencha os campos corretamente!');
					$this->session->set_flashdata('alert', 'warning');
					redirect(base_url('cliente/editCliente/').$id, 'refresh');
				}
			}
			$cliente = $this->ci_cliente_model->getAllWhere($id,'id','bolsa');
			$data = array(
				'view'   => 'clientes/editClientes',
				'title' => 'BTraders',
				'additional' => null,
				'cliente' => $cliente,
				'update' => 1
			);
			$this->easy_parser->parse('layoutPrincipal', $data);
		} else {
			$this->session->set_flashdata('mensagem', 'Sessão expirou!');
			$this->session->set_flashdata('alert', 'warning');
			redirect(base_url('login'), 'refresh');
		}
	}

	public function listClientes()
	{
		if ($this->ion_auth->logged_in()) {
			$clientes = $this->ci_cliente_model->getUserList();
			$data = array(
				'view'   => 'clientes/listClientes',
				'title' => 'BTraders',
				'message' => null,
				'additional' => null,
				'clientes' => $clientes
				);

			$this->easy_parser->parse('layoutPrincipal', $data);
		} else {
			$this->session->set_flashdata('mensagem', 'Sessão expirou!');
			$this->session->set_flashdata('alert', 'warning');
			redirect(base_url('login'), 'refresh');
		}
	}
	public function listUsers()
	{
		if ($this->ion_auth->logged_in()) {
			$users = $this->ci_cliente_model->getAll('users');
			$data = array(
				'view'   => 'clientes/listUsers',
				'title' => 'BTraders',
				'message' => null,
				'additional' => null,
				'clientes' => $users
				);

			$this->easy_parser->parse('layoutPrincipal', $data);
		} else {
			$this->session->set_flashdata('mensagem', 'Sessão expirou!');
			$this->session->set_flashdata('alert', 'warning');
			redirect(base_url('login'), 'refresh');
		}
	}

	public function buscaListaCliente() {
		if ($this->ion_auth->logged_in()) {
			$clientes = $this->ci_cliente_model->getUserList();
			$data['aaData'] = $clientes;
			echo json_encode($data);
		} else {
			$this->session->set_flashdata('mensagem', 'Sessão expirou!');
			$this->session->set_flashdata('alert', 'warning');
			redirect(base_url('login'), 'refresh');
		}
	}

	public function buscaListaUsuario() {
		if ($this->ion_auth->logged_in()) {
			$users = $this->ci_cliente_model->getAll('users');
			$data['aaData'] = $users;
			echo json_encode($data);
		} else {
			$this->session->set_flashdata('mensagem', 'Sessão expirou!');
			$this->session->set_flashdata('alert', 'warning');
			redirect(base_url('login'), 'refresh');
		}
	}

	public function deleteUser()
	{
		if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
			$user_id = $this->input->post('id');

			$this->ion_auth->delete_user($user_id);

			$data['mensagem'] = 'Exclusão realizada com sucesso!';
			$data['alert']    = 'success';

			echo json_encode($data);
		} else {
			$this->session->set_flashdata('mensagem', 'Sessão expirou!');
			$this->session->set_flashdata('alert', 'warning');
			redirect(base_url('login'), 'refresh');
		}
	}
	public function removeCliente()
	{
		if ($this->ion_auth->logged_in()) {
			$user_id = $this->input->post('id');

			$ativa = $this->ci_robo_model->getAllWhere($user_id, 'id_cliente', 'ativo');
			
			$this->ci_cliente_model->excluirCliente($user_id);
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

	// trabalhando com ativação de cliente por robô

	public function newAtiva()
	{
		if($this->ion_auth->logged_in()) {
			if($this->input->post()) {
				$cliente = $this->input->post('cliente');
				$robos = $this->input->post('robos');
				$status = $this->input->post('status');

				foreach ($robos as $robo) {
					$dados = array(
						'id_cliente' => $cliente,
						'id_robo' => $robo,
						'status' => $status
					);
					$verifica = $this->ci_cliente_model->verificaAtivos($cliente, $robo);
					if(!$verifica)
					{
						$id_robo = $this->ci_cliente_model->setAll($dados, 'ativo');
						if(!$id_robo){
							$this->session->set_flashdata('mensagem', 'erro ao ativar robo '.$robo.'!');
							$this->session->set_flashdata('alert', 'warning');
							redirect(base_url('cliente/ativacao/cadastro'), 'refresh');
						}	
					}
				}
				$this->session->set_flashdata('mensagem', 'Robôs ativados com sucesso!');
				$this->session->set_flashdata('alert', 'success');
				redirect(base_url('cliente/ativacao/lista'), 'refresh');

			}else{
				$clientes = $this->ci_cliente_model->getUserList();
				$robos = $this->ci_cliente_model->getAll('robo');
				$data = array(
					'view'   => 'clientes/ativaCliente',
					'title' => 'BTraders',
					'additional' => null,
					'clientes' => $clientes,
					'robos' => $robos
				);
				$this->easy_parser->parse('layoutPrincipal', $data);
			}
		}else{

		}
	}

	public function listAtiva()
	{
		if($this->ion_auth->logged_in()) {
			
			$clientes = $this->ci_cliente_model->getUserList();
			$robos = $this->ci_cliente_model->getAll('robo');
			$data = array(
				'view'   => 'clientes/listAtiva',
				'title' => 'BTraders',
				'additional' => null,
				'clientes' => $clientes,
				'robos' => $robos
			);
			$this->easy_parser->parse('layoutPrincipal', $data);
		}else {
			$this->session->set_flashdata('mensagem', 'Sessão expirou!');
			$this->session->set_flashdata('alert', 'warning');
			redirect(base_url('login'), 'refresh');
		}
	}

	public function buscaListaAtiva()
	{
		if ($this->ion_auth->logged_in()) {
			$cliente = $this->input->post('cliente');
			$robo = $this->input->post('robo');

			$vendas = $this->ci_cliente_model->getListAtiva($cliente, $robo);
			$data['aaData'] = $vendas;
			echo json_encode($data);
		}else {
			$this->session->set_flashdata('mensagem', 'Sessão expirou!');
			$this->session->set_flashdata('alert', 'warning');
			redirect(base_url('login'), 'refresh');
		}
	}

	public function updateStatus()
	{
		if ($this->ion_auth->logged_in()) {
			$id = $this->input->post('id');
			$status = $this->input->post('status');

			$dados['status'] = $status;
			
			$this->ci_cliente_model->updateAllUser($id, 'id', $dados, 'ativo');

			$data['mensagem'] = 'Atualização realizada com sucesso!';
			$data['alert']    = 'success';

			echo json_encode($data);
		} else {
			$this->session->set_flashdata('mensagem', 'Sessão expirou!');
			$this->session->set_flashdata('alert', 'warning');
			redirect(base_url('login'), 'refresh');
		}
	}
}
