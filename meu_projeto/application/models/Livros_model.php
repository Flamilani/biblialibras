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

    public function livros_rand() {
        $query = $this->db->limit(3);
        $query = $this->db->order_by('rand()');
        $query = $this->db->where('status', 1);
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0):
            return $query->result();
        else:
            return null;
        endif;
    }

          public function capitulos_livros_id($id) {
        $query = $this->db->where('id_livro', $id);
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0):
            return $query->result();
        else:
            return null;
        endif;
    }

     public function capitulos_livros() {
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
        $this->db->join('videos c', 'l.id_livro = c.id_livro', 'inner');
        return $this->db->get()->result();
    }

    public function plano_Livros() {
        $this->db->order_by('ordem', 'DESC');
        $this->db->select('*');
        $this->db->from('livros l');
        $this->db->join('videos c', 'l.id_livro = c.id_livro', 'inner');
        return $this->db->get()->result();
    }

    public function livro_id($id) {
        $this->db->where('l.id_livro', $id);
        $this->db->select('*, l.titulo as tema');
        $this->db->from('livros l');
       // $this->db->join('videos c', 'l.id_livro = c.id_livro', 'inner');
        return $this->db->get()->result();
    }

    public function livro_escolher($id) {
        $this->db->where('id_livro', $id);
        $this->db->from('livros');
        return $this->db->get()->result();
    }


     public function home_Livros_limit() {
        $this->db->limit(6);
        $query = $this->db->where('status', 1);
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0):
            return $query->result();
        else:
            return null;
        endif;
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


    public function dadosBancarios() {
        $query = $this->db->get('dados_bancarios');
        if ($query->num_rows() > 0):
            return $query->result();
        else:
            return null;
        endif;
    }

        public function dados_capitulos($id) {
         $this->db->where("id_capitulo", $id);
         return $this->db->get("capitulo");
    }

        public function dados_livros($id) {
         $this->db->where("id_planos", $id);
         return $this->db->get("plano_livro");
    }


     public function adicionarLivros($titulo, $sigla, $imagem, $valor, $status, $ordem) {      
        $data['titulo'] = $titulo;     
        $data['sigla'] = $sigla;     
        $data['imagem'] = $imagem;      
        $data['valor'] = $valor;      
        $data['ordem'] = $ordem;      
        $data['status'] = $status;      
        return $this->db->insert($this->table, $data);
    }

    public function adicionarCapitulo($capitulo, $livro) {      
        $data['capitulo'] = $capitulo;     
        $data['id_livro'] = $livro;      
        $data['status'] = 1;      
        return $this->db->insert('capitulo', $data);
    }

    public function salvar($id = null, $dados = null) {      
      return $this->db->where("id_video", $id)->update("videos", $dados);              
    }

    public function gravar_video_id($id, $id_capitulo) {
        $data['capitulo'] = $id_capitulo;
        $this->db->where('id_capitulo', $id);
        return $this->db->update('capitulo', $data);
    }

        public function remover_video_capitulo($id) {
        $data['id_capitulo'] = 0;
        $this->db->where('id_video', $id);
        return $this->db->update('videos', $data);
    }

    public function alterar_capitulo_video($id, $capitulo) {
        $data['id_capitulo'] = $capitulo;
        $this->db->where('id_video', $id);
        return $this->db->update('videos', $data);
    }

    public function alterar_livro_status($id, $status) {
        $data['status'] = $status;
        $this->db->where($this->id, $id);
        return $this->db->update($this->table, $data);
    }

     public function gravar_alteracoes($id, $titulo, $sigla, $valor, $status, $ordem) {
        $data['titulo'] = $titulo;
        $data['sigla'] = $sigla;
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
