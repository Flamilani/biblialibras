<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Suspensao_model extends CI_Model {

    var $table = 'suspensao';    

	public function __construct() {
        parent::__construct();
    } 

    public function home_Suspensao() {        
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0):
            return $query->result();
        else:
            return null;
        endif;
    }
    

    public function admin_Suspensao() {
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

      public function adicionarSuspensao($titulo, $conteudo, $inicial, $final, $status) {      
        $data['titulo'] = $titulo;     
        $data['conteudo'] = $conteudo;      
        $data['data_inicial'] = $inicial;      
        $data['data_final'] = $final;      
        $data['status'] = $status;      
        return $this->db->insert($this->table, $data);
    }

        public function gravar_alteracoes($id, $titulo, $conteudo, $inicial, $final, $status) {
        $data['titulo'] = $titulo;     
        $data['conteudo'] = $conteudo;    
        $data['data_inicial'] = $inicial;      
        $data['data_final'] = $final;     
        $data['status'] = $status;     
        $this->db->where('id_suspensao', $id);
        return $this->db->update($this->table, $data);
    }



}