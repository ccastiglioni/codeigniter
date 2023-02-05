<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inicio extends CI_Controller {
	
	var $tabela_p	= 'pessoas';
	var $tabela_c	= 'conta';
	var $tabela_m  	= 'movimentacao';
      
	var $pagina	= 'inicio';
	var $pasta	= '';
	var $titulo	= 'Control panel';
	
	public function __construct()
	{
		parent::__construct();
	   
		$this->load->model('model_inicio'); 
	}

	
	public function index() {	

		$conta    =  $this->model_inicio->getContas();
		$conteudos = $this->model_inicio->getConstasZero();

		$data	= array(
			'titulo'    => $this->titulo,
			'conteudos' => $conteudos,
			'conta'     => $conta,
		);
		$this->load->view( $this->pagina .'/inicio', $data);
	}
}

/* End of file inicio.php */
/* Location: ./application/controllers/painel/inicio.php */
