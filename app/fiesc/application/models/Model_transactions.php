<?php
 
class Model_transactions extends CI_Model {
     
    var $tabela = 'movimentacao';
    var $tabela_p   = 'pessoas';
    var $tabela_c   = 'conta';
   
 
    function getMovimentos(){

        $this->db->select("m.id, p.nome,p.id as id_user ,c.numero_conta, m.valor , m.tipo_transacao, m.data_transacao  ");
        $this->db->from($this->tabela .' m');
        $this->db->join($this->tabela_p . ' p ',' (m.pessoa_id = p.id)','left');
        $this->db->join($this->tabela_c . ' c ',' (m.conta_id  = c.id)','left');    
        $this->db->order_by('c.numero_conta');
        $conteudos = $this->db->get();

        return $conteudos;
    }

    function getMovimentosConcat(){
        $this->db->select("CONCAT(nome, ' - ',  CONCAT(SUBSTR(cpf,1,3),'.',SUBSTR(cpf,4,3),'.',SUBSTR(cpf,7,3),'-',SUBSTR(cpf,10,2))   ) AS pessoa_cat, id");
        $this->db->from($this->tabela_p);
        $pessoa = $this->db->get();
        return $pessoa;
    }


    function getMovimentosconta_saldo($pessoa_id){
 
        $this->db->query('SET SESSION sql_mode = ""');
        $this->db->query('SET SESSION sql_mode =REPLACE(REPLACE(REPLACE(@@sql_mode,"ONLY_FULL_GROUP_BY,", ""),",ONLY_FULL_GROUP_BY", ""),"ONLY_FULL_GROUP_BY", "")');

        $this->db->select("c.numero_conta,CONCAT(CAST(SUM(m.valor) AS char(20))) as conta_extrato,c.id");
        $this->db->from($this->tabela_c .' c');
        $this->db->join($this->tabela . ' m ',' (c.id = m.conta_id)','left');
        $this->db->where('c.pessoa_id',$pessoa_id); 
        $this->db->group_by('numero_conta');
        $conta_saldo = $this->db->get()->result(); 

    return $conta_saldo;
    }

    function getMovimentosgroup($post){
 
        $this->db->query('SET SESSION sql_mode = ""');
        $this->db->query('SET SESSION sql_mode =REPLACE(REPLACE(REPLACE(@@sql_mode,"ONLY_FULL_GROUP_BY,", ""),",ONLY_FULL_GROUP_BY", ""),"ONLY_FULL_GROUP_BY", "")');

        $this->db->select("c.numero_conta,CONCAT(CAST(SUM(m.valor) AS char(20))) as conta_extrato,c.id");
        $this->db->from($this->tabela_c .' c');
        $this->db->join($this->tabela . ' m ',' (c.id = m.conta_id)','left');
        $this->db->where('c.pessoa_id',$post['pessoa_id']); 
        $this->db->where('c.id',$post['conta_id']); 
        $this->db->group_by('numero_conta');

        $conteudos = $this->db->get()->result();
        return $conteudos;
    }

    function addMovimento($data)
    {
        $this->db->insert($this->tabela, $data);

        return true;
    }

   function getExtrato()
    { 
        $this->db->query('SET SESSION sql_mode = ""');
        $this->db->query('SET SESSION sql_mode =REPLACE(REPLACE(REPLACE(@@sql_mode,"ONLY_FULL_GROUP_BY,", ""),",ONLY_FULL_GROUP_BY", ""),"ONLY_FULL_GROUP_BY", "")');

        $this->db->select("m.id, p.nome,p.id as id_user ,c.numero_conta, sum(m.valor) as valor, m.tipo_transacao, m.data_transacao  ");
        $this->db->from($this->tabela .' m');
        $this->db->join($this->tabela_p . ' p ',' (m.pessoa_id = p.id)','left');
        $this->db->join($this->tabela_c . ' c ',' (m.conta_id  = c.id)','left');    
        $this->db->group_by('c.numero_conta');
        $conteudos = $this->db->get();

        return $conteudos;
    }
       

}

?>
