<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller {
	
	var $tabela	= 'pessoas';
	var $pagina	= 'usuarios';
	var $pasta	= 'usuarios';
	var $titulo	= 'Pessoa';
	  
	public function __construct()
	{
		parent::__construct();
	   
		$this->load->model('model_usuario'); 
	}

	public function index()
	{
		$this->listar();
	}
	
	public function listar()
	{
		$conteudos = $this->model_usuario->getUsuarios();
		 
		$data	= array(
				'titulo'	=> $this->titulo,
				'conteudos' => $conteudos,
		);

		$this->load->view( $this->pagina .'/list', $data);
	}
	
	public function adicionar()
	{		
		$data	= array(
				'titulo' 		=> $this->titulo,
				'acaoControl'	=> 'salvar',
		);
		$this->load->view( $this->pagina .'/form', $data);
	}
	
	public function salvar()
	{
		$nome = $this->input->post('nome');
		$int  = (int) filter_var($nome, FILTER_SANITIZE_NUMBER_INT);

		$url  = base_url( $this->pagina .'/listar/'. $this->session->flashdata('pagina'));
		if ( $int ==0) {
		  	
			$cpf =str_replace( [".","-"], "", $this->input->post('cpf') ); 
			$data	= array(
					'nome' 	    => $this->input->post('nome'),
					'cpf'	    => $cpf ,
					'endereco'	=> $this->input->post('endereco')
			);	
			 $this->model_usuario->addUsuario($data);
			 
		}else{
			$session = array(
				'msg'    => utf8_encode('Olá!.. Seu nome Não pode ter Número!' ),
				'status' => 'error'
			);
			$this->session->set_userdata($session);
			$url = $this->pagina .'/adicionar/';
		}  
		redirect($url);
	}
	
	public function editar($id)
	{   
		$conteudos = $this->model_usuario->getUsuariobyid($id);

		$data	= array(
				'titulo' 		=> $this->titulo,
				'acaoControl'	=> 'alterar',
				'conteudos'		=> $conteudos
		);
		
		$this->load->view( $this->pagina .'/form', $data);
	}
	
	public function alterar()
	{
		 
		$id   	  = $this->input->post('id');
		 
		if (!empty($id)) {
			 
			$id   	     = $this->input->post('id');
			$dsNome      = $this->input->post('nome');
			$cpf         = $this->input->post('cpf');
			$title 	     = $this->input->post('title');
			$endereco    = $this->input->post('endereco');
	         
			$data	= array(
					'nome' 	     => $dsNome,
					'cpf'	     =>$cpf,
					'endereco'	 => $endereco
			);
	 	  	
	 	  	$this->model_usuario->updateUsuario($id,$data);
			 
	         $session = array(
	                'msg'   => 'Pessoa Editada com Sucesso! Click em voltar para ir para Home..',
	                'status' => 'success',
	            );
	         $this->session->set_userdata($session);
	    
	        redirect( base_url( $this->pagina .'/editar/'.$id) );
		}
		        
	}
	
	public function excluir()
	{
		 
		if ($id = $this->input->post('id')) {
 
	 	  	$this->model_usuario->deleteUsuario($id);

			redirect(base_url( $this->pagina .'/listar/'. $this->session->flashdata('pagina')));
		}
	}
	
 
	 
}

/* End of file usuarios.php */
/* Location: ./application/controllersuarios.php */
