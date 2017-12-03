<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Livros_model extends CI_Model {

    var $table = 'livros';    
    var $id = 'id_livro';   

    public function __construct() {
        parent::__construct();
    }  
    
    public function admin_Livros() {
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0):
            return $query->result();
        else:
            return null;
        endif;
    }

    public function home_Livros() {
        $query = $this->db->order_by('ordem', 'ASC');
        $query = $this->db->where('status', 1);
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0):
            return $query->result();
        else:
            return null;
        endif;
    }

    public function lista_Livros() {
        $this->db->order_by('ordem', 'DESC');
        $this->db->select('*');
        $this->db->from('livros l');
        $this->db->join('capitulos c', 'l.id_livro = c.id_livro', 'inner');
        return $this->db->get()->result();
    }


     public function countLivros() {  
        $query = $this->db->where('status', 1);     
        $query = $this->db->get($this->table);
        $rows = $query->num_rows();
        if ($rows > 0):
            return $rows;
        else:
            return 0;
        endif;
    }   

     public function countAdminLivros() {            
        $query = $this->db->get($this->table);
        $rows = $query->num_rows();
        if ($rows > 0):
            return $rows;
        else:
            return 0;
        endif;
    }   

    public function detalheLivro($id) {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->result();
    }

     public function adicionarLivros($titulo, $conteudo, $imagem, $valor, $status, $ordem) {      
        $data['titulo'] = $titulo;     
        $data['conteudo'] = $conteudo;      
        $data['imagem'] = $imagem;      
        $data['valor'] = $valor;      
        $data['ordem'] = $ordem;      
        $data['status'] = $status;      
        return $this->db->insert($this->table, $data);
    }

        public function alterar_livro_status($id, $status) {
        $data['status'] = $status;
        $this->db->where($this->id, $id);
        return $this->db->update($this->table, $data);
    }

     public function gravar_alteracoes($id, $titulo, $conteudo, $valor, $status, $ordem) {
        $data['titulo'] = $titulo;
        $data['conteudo'] = $conteudo;
        $data['valor'] = $valor;
        $data['status'] = $status;
        $data['ordem'] = $ordem;
        $this->db->where($this->id, $id);
        return $this->db->update($this->table, $data);
    }
 
     public function gravar_imagem($id, $imagem) {
        $data['imagem'] = $imagem;        
        $this->db->where($this->id, $id);
        return $this->db->update($this->table, $data);
    }

     public function deletar($id) {
        $this->db->where($this->id, $id);
        return $this->db->delete($this->table);
    }
 
    

}
