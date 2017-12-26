<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Videos_model extends CI_Model {

    var $table = 'videos';  
    var $id = 'id_video';  

    public function __construct() {
        parent::__construct();
    } 
    
    public function admin_Videos($id) {
        $query = $this->db->join('capitulo cp', 'videos.id_capitulo = cp.id_capitulo', 'inner');
        $query = $this->db->select('*, cp.capitulo as cap, videos.status as status_video');
        $query = $this->db->where('videos.id_livro', $id);
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0):
            return $query->result();
        else:
            return null;
        endif;
    }

    public function home_Videos() {
        $query = $this->db->where('status', 1);
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0):
            return $query->result();
        else:
            return null;
        endif;
    }
  

     public function countVideos() {  
        $query = $this->db->where('status', 1);     
        $query = $this->db->get($this->table);
        $rows = $query->num_rows();
        if ($rows > 0):
            return $rows;
        else:
            return 0;
        endif;
    }   


     public function countLivrosUser($user) {  
        $query = $this->db->where('id_user', $user);     
        $query = $this->db->where('status', 1);     
        $query = $this->db->get('pedidos');
        $rows = $query->num_rows();
        if ($rows > 0):
            return $rows;
        else:
            return 0;
        endif;
    }  

     public function countAdminVideos($id) {   
        $query = $this->db->where('id_livro', $id);         
        $query = $this->db->get($this->table);
        $rows = $query->num_rows();
        if ($rows > 0):
            return $rows;
        else:
            return 0;
        endif;
    }   
    
      public function video_livros($id, $user) {
        $this->db->where('p.id_livro', $id);
        $this->db->where('p.id_user', $user);
        $this->db->where('p.status', 1);
        $this->db->select('*');
        $this->db->from('livros l');
        $this->db->join('videos c', 'l.id_livro = c.id_livro', 'inner');
        $this->db->join('pedidos p', 'l.id_livro = p.id_livro', 'inner');
        return $this->db->get()->result();
    }    

      public function video_livros_id($id) {
        $this->db->where('l.id_livro', $id);
        $this->db->select('*');
        $this->db->from('livros l');
        $this->db->join('videos c', 'l.id_livro = c.id_livro', 'inner');
        return $this->db->get()->result();
    }    

       public function video_livros_porID($id) {
        $this->db->where('c.id_video', $id);
        $this->db->select('*');
        $this->db->from('livros l');
        $this->db->join('videos c', 'l.id_livro = c.id_livro', 'inner');
        return $this->db->get()->result();
    }    

    public function video_capitulo($id) {
        $this->db->where('id_livro', $id);
        $this->db->select('*');
        $this->db->from('videos');
        return $this->db->get()->result();
    }    

     public function video_livrosMD($id, $user) {
        $this->db->where('p.id_livro', $id);
        $this->db->where('p.id_user', $user);
        $this->db->where('p.status', 1);
        $this->db->where('c.status', 1);
        $this->db->select('*');
        $this->db->from('livros l');
        $this->db->join('videos c', 'l.id_livro = c.id_livro', 'inner');
        $this->db->join('pedidos p', 'l.id_livro = p.id_livro', 'inner');
        return $this->db->get()->result();
    }    


     public function titulo_video($id, $cap) {
        $this->db->where('c.id_livro', $id);
        $this->db->where('cp.status', 1);
        $this->db->where('c.id_capitulo', $cap);
        $this->db->select('cp.capitulo');
        $this->db->from('capitulo cp');
        $this->db->join('videos c', 'cp.capitulo = c.id_capitulo', 'inner');
        return $this->db->get()->result();
    }    

      public function titulo_capitulo_admin($id) {
        $query = $this->db->where('id_livro', $id);
        $query = $this->db->get('capitulo');
        if ($query->num_rows() > 0):
            return $query->result();
        else:
            return null;
        endif;
    }

     public function countAdminVideos_admin($id) {   
        $query = $this->db->where('id_livro', $id);         
        $query = $this->db->get('livros');
        if ($query->num_rows() > 0):
            return $query->result();
        else:
            return null;
        endif;
    }   
    

      public function titulo_capitulo($id) {
       // $this->db->join('videos c', 'cp.id_capitulo = c.id_capitulo', 'inner');
        $query = $this->db->where('id_livro', $id);
        $query = $this->db->get('capitulo');
        if ($query->num_rows() > 0):
            return $query->result();
        else:
            return null;
        endif;
    }

    public function titulo_capitulo_home($id) {
        $query = $this->db->where('id_livro', $id);
        $query = $this->db->get('capitulo');
        if ($query->num_rows() > 0):
            return $query->result();
        else:
            return null;
        endif;
    }

     public function livros_user($user) {
        $this->output->enable_profiler(TRUE);
        $this->db->where('p.id_user', $user);
        $this->db->where('p.status', 1);
        $this->db->where('l.status', 1);
        $this->db->select('*');
        $this->db->from('livros l');
       // $this->db->join('capitulos c', 'l.id_livro = c.id_livro', 'inner');
       // $this->db->join('itens_pedidos ip', 'l.id_livro = ip.id_livro', 'inner');
        $this->db->join('pedidos p', 'ip.id_pedido = p.id_pedido', 'inner');
        return $this->db->get()->result();
    }    


      public function visto_status($id, $cap, $visto) {
         $this->db->where('id_livro', $id);
         $this->db->where('id_video', $cap);
         $this->db->where('visto_status', $visto);
         return $this->db->get('historico_livro')->result();
    }


      public function titulo_livro_id($id) {
       $this->db->where('id_livro', $id);
        return $this->db->get('livros')->result();
    }   

    public function detalheVideo($id) {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->result();
    }


      public function adicionar_video($titulo, $conteudo, $video, $id_livro, $status, $ordem, $id_capitulo) {     
        $data['titulo'] = $titulo;     
        $data['conteudo'] = $conteudo;      
        $data['video'] = $video;      
        $data['id_livro'] = $id_livro;      
        $data['status'] = $status;      
        $data['ordem'] = $ordem;      
        $data['id_capitulo'] = $id_capitulo;      
        return $this->db->insert($this->table, $data);
    }

     public function adicionar_video_capitulo($capitulo, $id_livro, $status) {     
        $data['capitulo'] = $capitulo;      
        $data['id_livro'] = $id_livro;      
        $data['status'] = $status;      
        return $this->db->insert('capitulo', $data);
    }


    public function alterar_video_status($id, $status) {
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

    public function gravar_alteracoes_video($id, $titulo, $status, $ordem, $id_capitulo) {
        $data['titulo'] = $titulo;
        $data['status'] = $status;
        $data['ordem'] = $ordem;
        $data['id_capitulo'] = $id_capitulo;
        $this->db->where($this->id, $id);
        return $this->db->update($this->table, $data);
    }
 
 
     public function gravar_imagem($id, $imagem) {
        $data['imagem'] = $imagem;        
        $this->db->where($this->id, $id);
        return $this->db->update($this->table, $data);
    }

    public function gravar_video($id, $video) {
        $data['video'] = $video;        
        $this->db->where($this->id, $id);
        return $this->db->update($this->table, $data);
    }

     public function deletar($id) {
        $this->db->where($this->id, $id);
        return $this->db->delete($this->table);
    }

    public function deletarCapitulo($id) {
        $this->db->where('id_capitulo', $id);
        return $this->db->delete('capitulo');
    }

      public function marcar_concluido($livro, $capitulo, $user, $visto) {      
        $data['id_livro'] = $livro;     
        $data['id_video'] = $capitulo;      
        $data['id_user'] = $user;      
        $data['visto_status'] = $visto;
        return $this->db->insert('historico_livro', $data);
    }

    

}
