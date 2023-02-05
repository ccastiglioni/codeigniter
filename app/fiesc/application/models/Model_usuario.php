<?php

class Model_usuario extends CI_Model
{
    var $tabela = 'pessoas';


   function getUsuarios($de = 0, $quantidade = 8 , $idUsuario=0)
    {
       $this->db->select('*');
        $this->db->from($this->tabela);
        $this->db->order_by('id','desc');
        $conteudos = $this->db->get();
         
        return $conteudos; 
    }

    function addUsuario($data)
    {
        $this->db->insert($this->tabela, $data);

        return true;
    }

    function getUsuariobyid($id)
    { 
        $this->db->select('*');
        $this->db->from($this->tabela);
        $this->db->where('id', $id);
        $conteudos = $this->db->get()->result();

        return $conteudos;
    }

    function updateUsuario($id,$data)
    { 
        $this->db->where('id', $id);
        $this->db->update($this->tabela, $data );
        //die ('query '.$this->db->last_query() );

        return true;
    }

    function deleteUsuario($id)
    { 
        $this->db->where('id', $id);
        $this->db->delete($this->tabela);

        return true;
    }
    
       
}
