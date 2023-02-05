<?php

class Model_inicio extends CI_Model
{
    var $tabela_p   = 'pessoas';
    var $tabela_c   = 'conta';
    var $tabela_m   = 'movimentacao';

    function getContas()
    {   
        $this->db->query('SET SESSION sql_mode = ""');
        $this->db->query('SET SESSION sql_mode =REPLACE(REPLACE(REPLACE(@@sql_mode,"ONLY_FULL_GROUP_BY,", ""),",ONLY_FULL_GROUP_BY", ""),"ONLY_FULL_GROUP_BY", "")');

        $this->db->select("m.id, p.nome,p.id as id_user ,c.numero_conta, sum(m.valor) as valor, m.tipo_transacao, m.data_transacao  ");
        $this->db->from($this->tabela_m .' m');
        $this->db->join($this->tabela_p . ' p ',' (m.pessoa_id = p.id)','left');
        $this->db->join($this->tabela_c . ' c ',' (m.conta_id  = c.id)','left');    
        $this->db->group_by('c.numero_conta');
        $result = $this->db->get();
         
        return $result->result();; 
        //return $this->db->count_all_results($this->tabela);
    }

    function getConstasZero()
    {
        $this->db->select('*');
        $this->db->from($this->tabela_p );
        $conteudos = $this->db->get();
         
        return $conteudos->result();
    }

    
    
  
}
