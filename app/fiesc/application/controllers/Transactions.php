<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transactions extends CI_Controller {
	
	var $tabela	= 'movimentacao';
	var $tabela_p	= 'pessoas';
	var $tabela_c	= 'conta';
	var $pagina	= 'transactions';
	var $pasta	= 'transactions';
	var $titulo	= 'Cadastro de Movimentação';
	var $tipo_tran = array('D'=> 'Depositar','R'=>"Retirar");
 
 	public function __construct()
	{
		parent::__construct();
	   
		$this->load->model('model_transactions'); 
	}

	public function index()
	{
		$this->listar();
	}
	
	public function listar()
	{
		
		$conteudos = $this->model_transactions->getMovimentos();
 
        $debug  = $this->db->last_query();
 
		$data	= array(
				'titulo'	=> utf8_encode($this->titulo ) ,
				'conteudos' => $conteudos,
		);

		$this->load->view( $this->pagina .'/list', $data);
	}
	
	public function adicionar()
	{			

		$pessoa = $this->model_transactions->getMovimentosConcat();
		$data	= array(
				'titulo'	  => utf8_encode($this->titulo ) ,
				'tipo_tran'	  => $this->tipo_tran,
				'pessoa_cpf'  => $pessoa->result(),
				'acaoControl' => 'salvar',

		);
		$this->load->view( $this->pagina .'/form', $data);
	}
	
	public function ajaxget_options()
	{
		$html_opt ='<select name="conta_id" id="conta_id" class="form-control">';
		$contas   = [];

		if ( $pessoa_id = $this->input->post('pessoa_id')) {
		 
	        $conta_saldo = $this->model_transactions->getMovimentosconta_saldo($pessoa_id);

			if (!empty($conta_saldo)) {
				foreach ($conta_saldo as $key => $c) {
					$conta_extrato = is_null($c->conta_extrato) ? 0 : $c->conta_extrato;
					$html_opt .= "<option value='{$c->id}' > {$c->numero_conta} - Saldo: {$conta_extrato} </option>";
				}
			}else{
					$html_opt .= "<option value='0' > Essa pessoa não tem Conta Ainda.. </option>";
			}
			 $html_opt .= "</select>";
			 ms(array(
				"status"   => "success",
				"options"  => utf8_encode($html_opt),
				 
			 ));
			exit;
		}
	}

	public function salvar()
	{			

		 if($this->valida_exist_saldo($this->input->post()) ){

		 	$url = base_url( $this->pagina .'/listar/'. $this->session->flashdata('pagina'));

			if ( $this->input->post('conta_id') !="" &&  $this->input->post('pessoa_id') !="" )
			{

				$valoReal= $this->input->post('tipo_trans') =='D' ? $this->input->post('valor') : $this->input->post('valor')*-1;
				$data	 = array(
					'conta_id'   => $this->input->post('conta_id'),
					'pessoa_id'  => $this->input->post('pessoa_id'),
					'valor'      => $valoReal,
					'tipo_transacao' => $this->input->post('tipo_trans'),
					'data_transacao' => date('Y-m-d H:i:s'),
				);
				$this->model_transactions->addMovimento($data);
			   
			}else{
			     $session = array(
		            'msg'   => utf8_encode('É Necessario informar os dados para cadastrar!'),
		            'status' => 'error',
		        );
		        $this->session->set_userdata($session);
		        $url = $this->pagina .'/adicionar/';
			}

		}else{
			$session = array(
				'msg'    => utf8_encode('Alerta!.. Você não possui saldo suficiente para essa retirada!' ),
				'status' => 'error'
			);
			$this->session->set_userdata($session);
			$url = $this->pagina .'/adicionar/';
		}

		redirect($url);
	}
	//array(4) { ["pessoa_id"]=> string(1) "7" ["conta_id"]=> string(1) "6" ["valor"]=> string(3) "100" ["tipo_trans"]=> string(1) "R" }
	public function valida_exist_saldo($post)
	{
	 	if ( $post['tipo_trans']=='R' ) {

			$conteudos = $this->model_transactions->getMovimentosgroup($post);
			 
			$conta_extrato = is_null($conteudos[0]->conta_extrato) ? 0 : $conteudos[0]->conta_extrato;
			
			$valoReal = $conta_extrato - $post['valor'];
			  
			if ($valoReal < 0) {
				$return =false;
			}else{
				$return =true;
			}
			//die ('query '.$this->db->last_query() );	
	 	}else{
				$return =true;
	 	}

		return $return;
	}

	public function listar_extrato()
	{
		$conteudos = $this->model_transactions->getExtrato();
 
		$data	= array(
				'titulo'	=> utf8_encode('Listagem dos Extratos por conta' ) ,
				'conteudos' => $conteudos,
		);

		$this->load->view('extrato/list', $data);
	}

	function downloadFile(){
	
		$this->load->helper('download');  
		$dt =  date("d-m-Y") ;
		$dataFile       = "Extrato_{$dt}";        
		$dataContent    = array();
		$dataContent= array(
		"\n",
		"\t\t Sistema Fiesc \n",
		"\t\tDepartamento Programação \n",
		"\n",
		"\t 02955/2022 - Desenvolvedor Full Stack PHP - Júnior\n",
		"\n",
		"\t\t\tDate :".$dt."\n",
		"\n",
		);

		foreach ( $this->model_transactions->getExtrato()->result() as $key => $value) {
		 	$dataContent[] = '#'. $value->id .' - '.$value->nome .' - Conta ' . $value->numero_conta .' - R$' . $value->valor;
		 	$dataContent[] ="\n";		  
		}

		force_download($dataFile,implode($dataContent));
     }
 
	 
}

/* End of file Transaction.php */
 
