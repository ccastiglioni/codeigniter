<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Conta extends CI_Controller {
	
	var $tabela	  = 'conta';
	var $tabela_p = 'pessoas';
	var $tabela_m= 'movimentacao';
	var $pagina	  = 'conta';
	var $pasta	  = 'conta';
	var $titulo	  = 'Conta';
	 
	public function __construct()
	{
		parent::__construct();
	   
		$this->load->model('model_conta'); 
	}

	public function index()
	{
		$this->listar();
	}
	
	public function listar()
	{

		$conteudos = $this->model_conta->getConstas();
		 
		$data	= array(
				'titulo'	=> $this->titulo,
				'conteudos' => $conteudos,
		);

		$this->load->view( $this->pagina .'/list', $data);
	}
	
	public function adicionar()
	{		
		
		$pessoa = $this->model_conta->getConstasConcat();
 
		$data	= array(
				'titulo' 		=> $this->titulo,
				'acaoControl'	=> 'salvar',
				'pessoas'	    => $pessoa->result(),
		);
		$this->load->view( $this->pagina .'/form', $data);
	}
	
	public function salvar()
	{
		$nun_conta = $this->input->post('conta');
 		$url       = $this->pagina .'/listar/'. $this->session->flashdata('pagina');

		if ($this->valida_exist_conta($nun_conta) === false) {
			if ( $nun_conta !="" &&  $this->input->post('pessoa_id') !="" )
			{
				$data	= array(
						'numero_conta' => $this->input->post('conta'),
						'pessoa_id'    => $this->input->post('pessoa_id'),
				);
				$this->db->insert($this->tabela, $data);
			     //die ('query '.$this->db->last_query() );
		    }else{
		    	     $session = array(
		                'msg'    => utf8_encode('É Necessario informar os dados para cadastrar!' ),
		                'status' => 'error',
		            );
		            $this->session->set_userdata($session);
		     }
	     }else{
			$session = array(
				'msg'    => utf8_encode('Ops!.. Essa Conta Já Existe para outro Usuário!' ),
				'status' => 'error'
			);
			$this->session->set_userdata($session);
			$url = $this->pagina .'/adicionar/';
	     }

		redirect(base_url( $url ));
	}
	
	public function editar($id)
	{

	 	$pessoa    = $this->model_conta->getConstasConcatcpf();
		$conteudos = $this->model_conta->getConstaByid($id);

		$data	= array(
				'titulo' 		=> $this->titulo,
				'acaoControl'	=> 'alterar',
				'pessoas'	    => $pessoa,
				'conteudos'		=> $conteudos,
		);
		
		$this->load->view( $this->pagina .'/form', $data);
	}
	

	public function alterar()
	{
		 
		$pessoa_id = $this->input->post('pessoa_id');
		$id        = $this->input->post('id');
		$conta     = $this->input->post('conta');
		
		$data	= array(
				'pessoa_id'    => $pessoa_id,
				'numero_conta' => $conta,
		);
		$this->model_conta->updateConta($id,$data);

		redirect(base_url( $this->pagina .'/listar/'. $this->session->flashdata('pagina')));
	}

	public function excluir()
	{	

		$id = $this->input->post('id');	
		$conteudos = $this->model_conta->getConstajoin($id);
	
		$valor = is_null($conteudos[0]->valor) ? 0 : $conteudos[0]->valor;
	 	
		if ($valor <=0) {
			if ( isset($id)){

			    $this->model_conta->deleteConsta($id);
				
				ms(array(
					"status"   => "success",
					"msg"  => utf8_encode('conta exluida com Sucesso!'),
				));
				exit;
				}
			}else{
				ms(array(
					"status"   => "error",
					"msg"  => utf8_encode('Essa conta ja possui saldo! Voce nao pode exluir..'),
				));
				exit;
			}

	}
	 	
	public function valida_exist_conta($conta_num)
	{
	 	$conteudos = $this->model_conta->getConstaBynum($conta_num);
		 
		if (count($conteudos) > 0)
			$return =true;
		else
			$return =false;
		
		return $return;
	}
}

/* End of file banners.php */
/* Location: ./application/controllersnners.php */
