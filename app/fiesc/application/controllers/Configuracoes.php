<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Configuracoes extends CI_Controller {
	
	var $tabela	= 'config';
	var $pagina	= 'configuracoes';
	var $pasta	= '';
	var $titulo	= 'Configura&ccedil;&otilde;es';
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->helper('painel');
		$this->load->helper('date');
		
		if ( ! $this->session->userdata('painel_logado'))
		{
			redirect(base_url('painel/login'));
			exit();
		}
	}

	public function index()
	{
		$this->listar();
	}
	
	public function listar()
	{
		$this->db->select('idConfig, sqOrdem, dsTitulo, dsConteudo, tpConfig, dsConfig, snCodigo, dsObservacao');
		$this->db->order_by('sqOrdem', 'ASC');
		$conteudos = $this->db->get($this->tabela);
		 
		$data	= array(
				'titulo'	=> $this->titulo,
				'conteudos' => $conteudos,
		);

		$this->load->view('painel/'. $this->pagina .'/list', $data);
	}
	
	public function alterar($id)
	{
		if ($this->input->post('idConfig') != false) {
			$id = $this->input->post('idConfig');
		}

		$data	= array(
				'dsConteudo' 	=> str_replace("&lt;script&gt;", "<script>", str_replace("&lt;/script&gt;", "</script>", str_replace("&lt;iframe", "<iframe", str_replace("&lt;/iframe&gt;", "</iframe>", $this->input->post('value'))))),
		);

		$this->db->where('idConfig', $id);
		$this->db->update($this->tabela, $data);
	}
}

/* End of file configuracoes.php */
/* Location: ./application/controllers/painel/configuracoes.php */