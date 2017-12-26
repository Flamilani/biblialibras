<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Inicial_model extends CI_Model {

    var $table = 'inicial';    

	public function __construct() {
        parent::__construct();
    } 

    public function home_Inicial() {
        $query = $this->db->where('status', 1);
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0):
            return $query->result();
        else:
            return null;
        endif;
    }
    

    public function admin_Inicial() {
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0):
            return $query->result();
        else:
            return null;
        endif;
    }

      public function adicionarInicial($titulo, $conteudo, $midia, $imagem, $video, $status) {      
        $data['titulo'] = $titulo;     
        $data['conteudo'] = $conteudo;      
        $data['midia'] = $midia;      
        $data['imagem'] = $imagem;      
        $data['video'] = $video;      
        $data['status'] = $status;      
        return $this->db->insert($this->table, $data);
    }

        public function gravar_alteracoes($id, $titulo, $conteudo, $midia, $imagem, $video, $status) {
       $data['titulo'] = $titulo;     
        $data['conteudo'] = $conteudo;      
        $data['midia'] = $midia;      
        $data['imagem'] = $imagem;      
        $data['video'] = $video;      
        $data['status'] = $status;     
        $this->db->where('id_inicial', $id);
        return $this->db->update($this->table, $data);
    }



}