<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Relato_model extends CI_Model {

    var $table = 'relato_erros';

    public function __construct() {
        parent::__construct();
    }

    public function home_Relato() {
        $query = $this->db->where('status', 1);
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0):
            return $query->result();
        else:
            return null;
        endif;
    }


    public function admin_Relato() {
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
        $data['imagem'] = $this->input->post('imagem');
        $data['tipo'] = $this->input->post('tipo');
        $data['nivel'] = $this->input->post('nivel');
        $data['link'] = $this->input->post('link');
        $data['status'] = $this->input->post('status');
        return $this->db->insert($this->table, $data);
    }

    public function adicionarRelato($titulo, $conteudo, $imagem, $tipo, $nivel, $link, $status) {
        $data['titulo'] = $titulo;
        $data['conteudo'] = $conteudo;
        $data['imagem'] = $imagem;
        $data['tipo'] = $tipo;
        $data['nivel'] = $nivel;
        $data['link'] = $link;
        $data['status'] = $status;
        return $this->db->insert($this->table, $data);
    }

    public function gravar_alteracoes($id, $titulo, $conteudo, $tipo, $nivel, $link) {
        $data['titulo'] = $titulo;
        $data['conteudo'] = $conteudo;
        $data['tipo'] = $tipo;
        $data['nivel'] = $nivel;
        $data['link'] = $link;
        $this->db->where('id_relato', $id);
        return $this->db->update($this->table, $data);
    }

    public function countAdminRelatos() {
        $query = $this->db->get($this->table);
        $rows = $query->num_rows();
        if ($rows > 0):
            return $rows;
        else:
            return 0;
        endif;
    }

    public function dependentes() {
        $this->db->where('status', 0);
        $query = $this->db->get($this->table);
        $rows = $query->num_rows();
        if ($rows > 0):
            return $rows;
        else:
            return 0;
        endif;
    }

    public function resolvidos() {
        $this->db->where('status', 1);
        $query = $this->db->get($this->table);
        $rows = $query->num_rows();
        if ($rows > 0):
            return $rows;
        else:
            return 0;
        endif;
    }

    public function alterar_relato_status($id, $status) {
        $data['status'] = $status;
        $this->db->where('id_relato', $id);
        return $this->db->update($this->table, $data);
    }

    public function deletar($id) {
        $this->db->where('id_relato', $id);
        return $this->db->delete($this->table);
    }

    public function detalheRelato($id) {
        $this->db->where('id_relato', $id);
        return $this->db->get($this->table)->result();
    }

    public function gravar_imagem($id, $imagem) {
        $data['imagem'] = $imagem;
        $this->db->where('id_relato', $id);
        return $this->db->update($this->table, $data);
    }

}