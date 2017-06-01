<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Banner extends CI_Controller {
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
		$this->load->model('ci_banner_model');
		//use library easy parse
		$this->load->library('easy_parser');
		$this->load->library('session');
		
	}

	public function index()
	{ 
		$data['title'] = "Welcome to CodeIgniter";
		$data['head']  = "Welcome to CodeIgniter!";
		$data['content']  = "The page you are looking at is being generated dynamically by CodeIgniter and template engine Twig.";
		// $this->twig->display('welcome', $data);
		$this->load->view('inicio/welcome');
		// $this->load->view('inicio/tipo_loja');
	}

	public function layouts()
	{
		$this->load->view('inicio/tipo_loja');
	}
	// public function elegant() 
	// {
		
	// 	$user = User::find(1);

	// 	foreach($user->phones() as $phone)
	// 	{
	// 		echo $phone->number . "<br>";
	// 	}
		
	// 	exit;
		

	// 	$users = User::all();
	// 	foreach($users as $user)
	// 	{
 //  			echo $user->name;
	// 	}
	// }
	
	public function uploadFile() 
	{
		
		if($this->input->post())
		{
			// $ds          = DIRECTORY_SEPARATOR;  //1
	 
			$storeFolder = './uploads/15/5/banner/';  //2
			 
			if (!empty($_FILES)) {

			    $tempFile = $_FILES['file']['tmp_name'];          //3             
			      
			    $targetPath = $storeFolder;  //4
			     
			    $targetFile =  $targetPath. $_FILES['file']['name'];  //5
			 
			    move_uploaded_file($tempFile,$targetFile); //6

			    $dados = array(
			    	'banner' => $_FILES['file']['name'],
			    	'ativo' => 1
			    );
			    $id_banner = $this->ci_banner_model->setBanner($dados);

			    echo $id_banner;
			     
			}
		}
		$data = array(
				'view' => "banner/banner",
				'title' => "Turbosite | Banner",
				'head'  => "e-commerce Creator"
		);
		//this use easy parse
		$this->easy_parser->parse('layout_principal', $data);
	}

	// método para resgatar os banners do usuário
	public function getBanners()
	{
		$banners = $this->ci_banner_model->getAll();
		$data['aaData'] = $banners;
		echo json_encode($data);
	}



	public function escolha_layout($tipo){
		$session_tipo = array('tipo_ecommerce' => $tipo);
		$this->session->set_userdata($session_tipo);
		$this->load->view('inicio/escolha_layout');
	}

	public function upload($destino, $nome, $largura, $pasta, $tipo)
	{
		if ($this->ion_auth->logged_in()) {
			if($tipo == 'image/jpg' || $tipo == 'image/jpeg' || $tipo =='image/pjpeg'){
				$img = imagecreatefromjpeg($destino);
				$x = imagesx($img);
				$y = imagesy($img);
				$altura = ($largura * $y) / $x;

				$novaImagem = imagecreatetruecolor($largura, $altura);
				imagecopyresampled($novaImagem, $img, 0, 0, 0, 0, $largura, $altura, $x, $y);
				imagejpeg($novaImagem, "$pasta/$nome");

				imagedestroy($img);
				imagedestroy($novaImagem);
			}else{
				$img = imagecreatefrompng($destino);
				$x = imagesx($img);
				$y = imagesy($img);
				$altura = ($largura * $y) / $x;

				$novaImagem = imagecreatetruecolor($largura, $altura);
				imagecopyresampled($novaImagem, $img, 0, 0, 0, 0, $largura, $altura, $x, $y);
				imagepng($novaImagem, "$pasta/$nome");

				imagedestroy($img);
				imagedestroy($novaImagem);
			}
		} else {
			$this->session->set_flashdata('mensagem', 'Session timed out!');
			$this->session->set_flashdata('alert', 'warning');
			redirect(base_url('home/index'), 'refresh');
		}
	}
}