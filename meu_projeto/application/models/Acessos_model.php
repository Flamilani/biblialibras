<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acessos_model extends CI_Model
{
    var $table = 'acesso_livro';

    public function __construct()
    {
        parent::__construct();
    }

    public function exibir_acessos() {
        $this->db->order_by('id_acesso', 'ASC');
        $this->db->select('*, al.data_inicial as data_i');
        $this->db->from('acesso_livro al');
        $this->db->join('users u', 'u.id = al.id_user', 'inner');
        $this->db->join('assinaturas a', 'a.id_assinatura = al.id_assinatura', 'inner');
        $this->db->join('plano p', 'p.id_plano = a.id_plano', 'inner');
        $this->db->join('planos pl', 'pl.id_planos = p.id_planos', 'inner');
        $this->db->join('livros l', 'l.id_livro = al.id_livro', 'inner');
        return $this->db->get()->result();
    }

     public function exibir_acessosPerfil($id) {
        $this->db->where("al.id_user", $id);  
        $this->db->order_by('id_acesso', 'ASC');
        $this->db->select('*, al.data_inicial as data_i');
        $this->db->from('acesso_livro al');
        $this->db->join('assinaturas a', 'a.id_assinatura = al.id_assinatura', 'inner');
        $this->db->join('plano p', 'p.id_plano = a.id_plano', 'inner');
        $this->db->join('planos pl', 'pl.id_planos = p.id_planos', 'inner');
        $this->db->join('livros l', 'l.id_livro = al.id_livro', 'inner');
        return $this->db->get()->result();
    }
}