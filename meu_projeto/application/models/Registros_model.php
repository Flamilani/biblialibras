<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registros_model extends CI_Model
{
    var $table = 'historico_livro';

    public function __construct()
    {
        parent::__construct();
    }

    public function exibir_registros() {
        $this->db->order_by('id_hist', 'ASC');
        $this->db->select('*, hl.data_visto as data_v, v.titulo as titulo_v');
        $this->db->from('historico_livro hl');
        $this->db->join('users u', 'u.id = hl.id_user', 'inner');
        $this->db->join('videos v', 'v.id_video = hl.id_video', 'inner');
        $this->db->join('livros l', 'l.id_livro = hl.id_livro', 'inner');
        return $this->db->get()->result();
    }

     public function exibir_registrosPerfil($id) {
        $this->db->where("hl.id_user", $id);  
        $this->db->order_by('id_hist', 'ASC');
        $this->db->select('*, hl.data_visto as data_v, v.titulo as titulo_v');
        $this->db->from('historico_livro hl');
        $this->db->join('users u', 'u.id = hl.id_user', 'inner');
        $this->db->join('videos v', 'v.id_video = hl.id_video', 'inner');
        $this->db->join('livros l', 'l.id_livro = hl.id_livro', 'inner');
        return $this->db->get()->result();
    }
}
