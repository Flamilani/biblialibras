<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Termos_model extends CI_Model {

    var $table = 'termos';

    public function __construct() {
        parent::__construct();
    }

    public function home_Termos() {
        $query = $this->db->where('status', 1);
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0):
            return $query->result();
        else:
            return null;
        endif;
    }


    public function admin_Termos() {
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

    public function adicionarTermos($titulo, $conteudo, $status) {
        $data['titulo'] = $titulo;
        $data['conteudo'] = $conteudo;
        $data['status'] = $status;
        return $this->db->insert($this->table, $data);
    }

    public function gravar_alteracoes($id, $titulo, $conteudo, $status) {
        $data['titulo'] = $titulo;
        $data['conteudo'] = $conteudo;
        $data['status'] = $status;
        $this->db->where('id_termo', $id);
        return $this->db->update($this->table, $data);
    }



}