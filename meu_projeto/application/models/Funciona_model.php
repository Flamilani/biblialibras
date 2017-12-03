<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Funciona_model extends CI_Model {

    var $table = 'funciona';    

	public function __construct() {
        parent::__construct();
    } 

    public function home_Funciona() {
        $query = $this->db->where('status', 1);
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0):
            return $query->result();
        else:
            return null;
        endif;
    }
    

    public function admin_Funciona() {
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0):
            return $query->result();
        else:
            return null;
        endif;
    }

     public function adicionar($data) {      
        $data['titulo'] = $this->input->post('titulo');     
        $data['conteudo'] = $this->input->post('conteudo');     
        $data['status'] = $this->input->post('status');    
        return $this->db->insert($this->table, $data);
    }

     public function adicionarFunciona($titulo, $conteudo, $status) {      
        $data['titulo'] = $titulo;     
        $data['conteudo'] = $conteudo;      
        $data['status'] = $status;      
        return $this->db->insert($this->table, $data);
    }

     public function gravar_alteracoes($id, $titulo, $conteudo, $status) {
       $data['titulo'] = $titulo;     
        $data['conteudo'] = $conteudo;      
        $data['status'] = $status;     
        $this->db->where('id_funciona', $id);
        return $this->db->update($this->table, $data);
    }


}