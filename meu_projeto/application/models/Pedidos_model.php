<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pedidos_model extends CI_Model {

    var $table = 'pedidos';    
    var $id = 'id_pedido';   

    public function __construct() {
        parent::__construct();
    }  

      public function admin_Pedidos() {
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0):
            return $query->result();
        else:
            return null;
        endif;
    }

      public function countAdminPedidos() {            
        $query = $this->db->get($this->table);
        $rows = $query->num_rows();
        if ($rows > 0):
            return $rows;
        else:
            return 0;
        endif;
    }   

     public function countAdminItens() {            
        $query = $this->db->get('itens_pedidos');
        $rows = $query->num_rows();
        if ($rows > 0):
            return $rows;
        else:
            return 0;
        endif;
    }   

     public function lista_Pedidos() {
        $this->db->select('*');
        $this->db->from('pedidos p');
        $this->db->join('users u', 'u.id = p.id_user', 'inner');
        return $this->db->get()->result();
    }

      public function lista_itens($id) {
        $this->db->where('ip.id_pedido', $id);
        $this->db->select('*, ip.status as situacao');
        $this->db->from('itens_pedidos ip');
        $this->db->join('livros l', 'l.id_livro = ip.id_livro', 'inner');
        return $this->db->get()->result();
    }

}