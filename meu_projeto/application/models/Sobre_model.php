<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sobre_model extends CI_Model {

    var $table = 'sobre';    

	public function __construct() {
        parent::__construct();
    } 
    

    public function admin_Sobre() {
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
        $data['midia'] = $this->input->post('midia');   
        $data['imagem'] = $this->input->post('imagem');   
        $data['video'] = $this->input->post('video');   
        $data['status'] = $this->input->post('status');    
        return $this->db->insert($this->table, $data);
    }



}