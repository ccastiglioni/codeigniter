<?php
 
class Model_conta extends CI_Model {
     
    var $tabela   = 'conta';
    var $tabela_p = 'pessoas';
    var $tabela_m= 'movimentacao';
   
 
    function getConstas(){

        $this->db->select('p.id as pessoa_is ,p.nome, p.cpf , c.numero_conta,c.id');
        $this->db->from($this->tabela .' c ');
        $this->db->join($this->tabela_p . ' p ',' (c.pessoa_id = p.id)','left');
        $result = $this->db->get();

        return $result;
    }

    function getConstasConcat(){
 
        $this->db->select('CONCAT(nome, " - ", cpf) AS pessoa_cat, id');
        $this->db->from($this->tabela_p);
        $pessoa = $this->db->get();
        return $pessoa;
    }
    function getConstasConcatcpf(){
 
        $this->db->select('CONCAT(nome, " - ", cpf) AS pessoa_cat, id');
        $this->db->from($this->tabela_p);
        $pessoa = $this->db->get()->result();

        return $pessoa;
    }

    function getConstaBynum($conta_num){
 
        $this->db->where('numero_conta',$conta_num);
        $conteudos = $this->db->get($this->tabela)->result();
        return $conteudos;
    }

    function getConstaByid($id){
 
        $this->db->where('id', $id);
        $conteudos = $this->db->get($this->tabela)->result();
        return $conteudos;
    }

    function updateConta($id,$data){

        $this->db->where('id', $id);
        $this->db->update($this->tabela, $data);
    }

    function getConstajoin($id){

        $this->db->select("*");
        $this->db->from($this->tabela .' c');
        $this->db->join($this->tabela_m . ' m ',' (c.id = m.conta_id)','left');
        $this->db->where('c.id', $id);
        $conteudos = $this->db->get()->result();

        return $conteudos;
    }

    function deleteConsta($id){

        $this->db->where('id', $id);
        $this->db->delete($this->tabela);   
    }
       

}

?>
