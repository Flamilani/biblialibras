<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Plano_model extends CI_Model {

    var $table = 'planos';    
    var $id = 'id_planos';   

    var $tableP = 'plano';    
    var $idP = 'id_plano';   

	public function __construct() {
        parent::__construct();
    } 

/* NOMES DE PLANOS */

    public function admin_Planos() {
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0):
            return $query->result();
        else:
            return null;
        endif;
    }     

    public function countPlanos() {  
        $query = $this->db->where('status', 1);     
        $query = $this->db->get($this->table);
        $rows = $query->num_rows();
        if ($rows > 0):
            return $rows;
        else:
            return 0;
        endif;
    }   

     public function countAdminPlanos() {            
        $query = $this->db->get($this->table);
        $rows = $query->num_rows();
        if ($rows > 0):
            return $rows;
        else:
            return 0;
        endif;
    }  

    public function detalhePlanos($id) {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->result();
    } 

     public function periodo_plano($id) {
        $this->db->where('p.id_planos', $id);
        $this->db->select('*');
        $this->db->from('plano p');
        $this->db->join('planos ps', 'p.id_planos = ps.id_planos', 'inner');
        return $this->db->get()->result();
    }    

    public function nome_plano($id) {
        $this->db->where('id_planos', $id);
        $this->db->select('*');
        $this->db->from('planos');       
        return $this->db->get()->result();
    }    

        public function adicionarPlanos($nome_plano, $status, $ordem, $home) {
            $data['nome_plano'] = $nome_plano;     
            $data['status'] = $status;      
            $data['ordem'] = $ordem;      
            $data['home'] = $home;
        return $this->db->insert($this->table, $data);
    }

        public function gravar_alteracoes($id, $titulo, $status, $ordem) {
            $data['nome_plano'] = $titulo;     
            $data['status'] = $status;      
            $data['ordem'] = $ordem;      
        $this->db->where($this->id, $id);
        return $this->db->update($this->table, $data);
    }

    public function alterar_plano_status($id, $status) {
        $data['status'] = $status;
        $this->db->where($this->id, $id);
        return $this->db->update($this->table, $data);
    }

    public function alterar_home_status($id, $home) {
        $data['home'] = $home;
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

/* PLANO */

    public function home_Plano() {
        $query = $this->db->where('status', 1);
        $query = $this->db->get($this->tableP);
        if ($query->num_rows() > 0):
            return $query->result();
        else:
            return null;
        endif;
    }
    

    public function admin_Plano() {
        $query = $this->db->get($this->tableP);
        if ($query->num_rows() > 0):
            return $query->result();
        else:
            return null;
        endif;
    }     

        public function countPlano() {  
        $query = $this->db->where('status', 1);     
        $query = $this->db->get($this->tableP);
        $rows = $query->num_rows();
        if ($rows > 0):
            return $rows;
        else:
            return 0;
        endif;
    }   

    public function countPlanoP($id) {  
        $query = $this->db->where('id_planos', $id);     
        $query = $this->db->get($this->tableP);
        $rows = $query->num_rows();
        if ($rows > 0):
            return $rows;
        else:
            return 0;
        endif;
    }   

     public function countAdminPlano() {            
        $query = $this->db->get($this->tableP);
        $rows = $query->num_rows();
        if ($rows > 0):
            return $rows;
        else:
            return 0;
        endif;
    }   

    public function detalhePeriodo($id) {
        $this->db->where('id_plano', $id);
        return $this->db->get($this->tableP)->result();
    } 

    public function detalhePlano($id) {
        $this->db->where('id_planos', $id);
        return $this->db->get($this->tableP)->result();
    } 


      public function adicionarPlanoP($titulo, $valor, $status, $ordem, $duracao, $periodo, $id_planos) {      
            $data['titulo'] = $titulo;     
            $data['valor'] = $valor;      
            $data['status'] = $status;      
            $data['ordem'] = $ordem;      
            $data['duracao'] = $duracao;      
            $data['periodo'] = $periodo;      
            $data['id_planos'] = $id_planos;      
        return $this->db->insert($this->tableP, $data);
    }

        public function gravar_alteracoesP($id, $titulo, $valor,  $status, $ordem, $duracao, $periodo) {
            $data['titulo'] = $titulo;     
            $data['valor'] = $valor;      
            $data['status'] = $status;      
            $data['ordem'] = $ordem;      
            $data['duracao'] = $duracao;      
            $data['periodo'] = $periodo;       
        $this->db->where($this->idP, $id);
        return $this->db->update($this->tableP, $data);
    }

    public function alterar_plano_statusP($id, $status) {
        $data['status'] = $status;
        $this->db->where($this->idP, $id);
        return $this->db->update($this->tableP, $data);
    }

     public function gravar_imagemP($id, $imagem) {
        $data['imagem'] = $imagem;        
        $this->db->where($this->idP, $id);
        return $this->db->update($this->tableP, $data);
    }

     public function deletarP($id) {
        $this->db->where($this->idP, $id);
        return $this->db->delete($this->tableP);
    }

    /* PLANO LIVROS */

    public function adminPlanoLivro() {
        $query = $this->db->get('plano_livro');
        if ($query->num_rows() > 0):
            return $query->result();
        else:
            return null;
        endif;
    }     

    public function countAdminPlanoLivro() {            
        $query = $this->db->get('plano_livro');
        $rows = $query->num_rows();
        if ($rows > 0):
            return $rows;
        else:
            return 0;
        endif;
    }   

    public function detalhePlanoLivro($id) {
        $this->db->where('id_planos', $id);
        return $this->db->get('plano_livro')->result();
    } 

    public function paramPlanoLivro($id) {
        $sql = "SELECT * FROM plano_livro WHERE params in ($id)"; 
        $this->db->query($sql);
        return $this->db->get('plano_livro')->result();
    } 

    
     public function plano_livroSel() {
        $this->db->order_by('ordem', 'ASC');
        $this->db->select('*');
        $this->db->from('livros');
        return $this->db->get()->result();
    }


     public function plano_livro($id) {
        $this->db->where("id_planos", $id);        
        $this->db->from('plano_livro');       
        return $this->db->get()->result();
    }




    public function adicionarPlanoLivro($id_planos, $id_livro) {   
            $params = implode(',', $id_livro);   
            $data['id_planos'] = $id_planos;     
            $data['params'] = $params;     
        return $this->db->insert('plano_livro', $data);
    }

    public function gravar_plavo_livros($id, $id_livro) {
        $params = implode(',', $id_livro);   
        $data['params'] = $params;       
        $this->db->where('id_plano_livro', $id);
        return $this->db->update('plano_livro', $data);
    }

    public function alterar_plano_livro_status($id, $status) {
        $data['status'] = $status;
        $this->db->where('id_plano_livro', $id);
    return $this->db->update('plano_livro', $data);
    }

    public function deletar_plano_livro($id) {
        $this->db->where('id_plano_livro', $id);
        return $this->db->delete('plano_livro');
    }

    public function mudar_senha_user($id, $senha) {
        $data['senha'] = $senha;
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }


/* ASSINATURAS  */

      public function assinaturaLista($id) {
          $this->db->order_by('id_assinatura', 'DESC');
        $this->db->where('a.id_assinatura', $id);
        $this->db->select('*, a.status as status_assina');
        $this->db->join('plano p', 'p.id_plano = a.id_plano', 'inner');
        $this->db->join('pagamentos pg', 'pg.codigo = a.codigo', 'inner');
        $this->db->join('planos ps', 'ps.id_planos = p.id_planos', 'inner');
        return $this->db->get('assinaturas a')->result();
    }


    public function assinaturaVerificar($id) {
        $this->db->where('id_plano', $id);
        $query = $this->db->get('assinaturas');
        $rows = $query->num_rows();
        if ($rows > 0):
            return $rows;
        else:
            return 0;
        endif;
    }

    public function assinaturaListaUser($id = null) {
        $this->db->LIMIT(1);
        $this->db->order_by('id_assinatura', 'DESC');
        $this->db->where('a.id_user', $id);
        $this->db->where('ps.tipo_plano', 1);
        $this->db->select('*, a.status as status_assina');
        $this->db->join('plano p', 'p.id_plano = a.id_plano', 'inner');
        $this->db->join('pagamentos pg', 'pg.codigo = a.codigo', 'inner');
        $this->db->join('planos ps', 'ps.id_planos = p.id_planos', 'inner');
        return $this->db->get('assinaturas a')->result();
    }

    public function assinaturaListaUserAlternativa($id = null) {
        $this->db->order_by('id_assinatura', 'DESC');
        $this->db->where('a.id_user', $id);
        $this->db->where('ps.tipo_plano', 0);
        $this->db->select('*, a.status as status_assina');
        $this->db->join('plano p', 'p.id_plano = a.id_plano', 'inner');
        $this->db->join('pagamentos pg', 'pg.codigo = a.codigo', 'inner');
        $this->db->join('planos ps', 'ps.id_planos = p.id_planos', 'inner');
        return $this->db->get('assinaturas a')->result();
    }

    public function assinaturaListaUserAlternativaUser($id = null, $plano = null) {
        $this->db->order_by('id_assinatura', 'DESC');
        $this->db->where('a.id_user', $id);
        $this->db->where('a.id_plano', $plano);
        $this->db->where('ps.tipo_plano', 0);
        $this->db->select('*, a.status as status_assina');
        $this->db->join('plano p', 'p.id_plano = a.id_plano', 'inner');
        $this->db->join('pagamentos pg', 'pg.codigo = a.codigo', 'inner');
        $this->db->join('planos ps', 'ps.id_planos = p.id_planos', 'inner');
        return $this->db->get('assinaturas a')->result();
    }

     public function assinaturaUser($id, $user) {
        $this->db->where('a.id_user', $user);
        $this->db->where('a.id_assinatura', $id);
         $this->db->select('*, a.status as status_assina');
         $this->db->join('pagamentos pg', 'pg.codigo = a.codigo', 'inner');
        $this->db->join('plano p', 'p.id_plano = a.id_plano', 'inner');
        $this->db->join('planos ps', 'ps.id_planos = p.id_planos', 'inner');
        return $this->db->get('assinaturas a')->result();
    }

     public function admin_Assinaturas() {
        $this->db->select('*, a.status as status_assina');
        $this->db->join('plano p', 'p.id_plano = a.id_plano', 'inner');
        $this->db->join('pagamentos pg', 'pg.codigo = a.codigo', 'inner');
        $this->db->join('planos ps', 'ps.id_planos = p.id_planos', 'inner');
       // $this->db->join('users u', 'u.id = a.id_user', 'inner');
        return $this->db->get('assinaturas a')->result();
    }

    public function countAssinaturas() {  
        $query = $this->db->where('status', 1);     
        $query = $this->db->get('assinaturas');
        $rows = $query->num_rows();
        if ($rows > 0):
            return $rows;
        else:
            return 0;
        endif;
    }   

     public function countAdminAssinaturas() {            
        $query = $this->db->get('assinaturas');
        $rows = $query->num_rows();
        if ($rows > 0):
            return $rows;
        else:
            return 0;
        endif;
    }  

    public function alterar_assina_status($id, $status) {
        $data['status'] = $status;
        $this->db->where('id_assinatura', $id);
    return $this->db->update('assinaturas', $data);
    }

    public function alterar_tipo_status($id, $status) {
        $data['tipo_plano'] = $status;
        $this->db->where('id_planos', $id);
        return $this->db->update('planos', $data);
    }

    public function valorFatura() {      
        $this->db->where("pg.status_pago", "2");  
        $this->db->select('*, SUM(valor) as total');
        $this->db->join('assinaturas a', 'a.id_plano = p.id_plano', 'inner');
        $this->db->join('pagamentos pg', 'a.codigo = pg.codigo', 'inner');
        $query = $this->db->get('plano p');
        if ($query->num_rows() > 0):
            return $query->result();
        else:
            return 0;
        endif;
    }

    public function dados_assinatura($id) {
         $this->db->where("id_assinatura", $id);
         return $this->db->get("assinaturas");
    }

    public function salvar($id = null, $dados = null) {      
      return $this->db->where("id_assinatura", $id)->update("assinaturas", $dados);              
    }

     public function gravarPlanoEscolhido($id_user, $id_plano, $status, $now, $codigo) {
            $data['id_user'] = $id_user;     
            $data['id_plano'] = $id_plano;
            $data['status'] = $status;
            $data['data_registro'] = $now;
            $data['codigo'] = $codigo;
        return $this->db->insert('assinaturas', $data);
    }

    public function deletar_assinatura($id) {
        $this->db->where('codigo', $id);
        return $this->db->delete('assinaturas');
    }

    /*   PAGAMENTOS */

    public function deletar_pagamento($id) {
        $this->db->where('codigo', $id);
        return $this->db->delete('pagamentos');
    }

    public function dados_pagamento($id) {
        $this->db->where("id_pago", $id);
        return $this->db->get("pagamentos");
    }

    public function salvar_pago($id = null, $dados = null) {
        return $this->db->where("id_pago", $id)->update("pagamentos", $dados);
    }

        public function detalhePagamento($id) {
        $this->db->where('id_pago', $id);
        return $this->db->get('pagamentos')->result();
    } 

    public function gravarPagamento($id_user, $id_forma_pago, $status_pago, $id_plano, $now, $codigo) {
            $data['id_user'] = $id_user;     
            $data['id_forma_pago'] = $id_forma_pago;    
            $data['status_pago'] = $status_pago;    
            $data['id_plano'] = $id_plano;
            $data['data_pago'] = $now;
            $data['codigo'] = $codigo;
        return $this->db->insert('pagamentos', $data);
    }

     public function lista_Pagam($id) {
        $this->db->where('pg.codigo', $id);
        $this->db->select('*');    
         $this->db->join('plano p', 'p.id_plano = pg.id_plano', 'inner');
        $this->db->join('assinaturas a', 'a.codigo = pg.codigo', 'inner');
         $this->db->join('planos ps', 'ps.id_planos = p.id_planos', 'inner');
        $this->db->join('users u', 'u.id = pg.id_user', 'inner');
        return $this->db->get('pagamentos pg')->result();
    }

    public function lista_PagamUseLimit($id) {
        $this->db->limit(1);
        $this->db->order_by('pg.id_pago', 'DESC');
        $this->db->where('a.id_user', $id);
        $this->db->select('*');
        $this->db->join('plano p', 'p.id_plano = pg.id_plano', 'inner');
        $this->db->join('assinaturas a', 'a.codigo = pg.codigo', 'inner');
        $this->db->join('planos ps', 'p.id_planos = ps.id_planos', 'inner');
        $this->db->join('users u', 'u.id = pg.id_user', 'inner');
        return $this->db->get('pagamentos pg')->result();
    }

     public function lista_PagamUser($id) {
         $this->db->order_by('pg.id_pago', 'DESC');
         $this->db->limit(5);
        $this->db->where('a.id_user', $id);
        $this->db->select('*');  
        $this->db->join('plano p', 'p.id_plano = pg.id_plano', 'inner');
        $this->db->join('assinaturas a', 'a.codigo = pg.codigo', 'inner');
         $this->db->join('planos ps', 'p.id_planos = ps.id_planos', 'inner');
        $this->db->join('users u', 'u.id = pg.id_user', 'inner');
        return $this->db->get('pagamentos pg')->result();
    }

    public function lista_PagamTodos($id) {
        $this->db->order_by('pg.id_pago', 'DESC');
        $this->db->where('a.id_user', $id);
        $this->db->select('*');
        $this->db->join('plano p', 'p.id_plano = pg.id_plano', 'inner');
        $this->db->join('assinaturas a', 'a.codigo = pg.codigo', 'inner');
        $this->db->join('planos ps', 'p.id_planos = ps.id_planos', 'inner');
        $this->db->join('users u', 'u.id = pg.id_user', 'inner');
        return $this->db->get('pagamentos pg')->result();
    }

    public function lista_Pagamento() {
        $this->db->select('*');    
       $this->db->join('plano p', 'p.id_plano = pg.id_plano', 'inner');
         $this->db->join('planos ps', 'ps.id_planos = p.id_planos', 'inner');
      //  $this->db->join('users u', 'u.id = pg.id_user', 'inner');
        return $this->db->get('pagamentos pg')->result();
    }

    public function alterar_lista_Pagamento($id) {
        $this->db->where('pg.id_pago', $id);
        $this->db->select('*');
        $this->db->join('plano p', 'p.id_plano = pg.id_plano', 'inner');
        $this->db->join('planos ps', 'ps.id_planos = p.id_planos', 'inner');
        $this->db->join('users u', 'u.id = pg.id_user', 'inner');
        return $this->db->get('pagamentos pg')->result();
    }

     public function exibir_comprovante($id, $user) {
        $this->db->select('*'); 
        $this->db->where('p.id_plano', $id);   
        $this->db->where('pg.id_user', $user);   
        $this->db->join('plano p', 'p.id_plano = pg.id_plano', 'inner');
        $this->db->join('assinaturas a', 'a.id_plano = p.id_plano', 'inner');
         $this->db->join('planos ps', 'ps.id_planos = p.id_planos', 'inner');
        $this->db->join('users u', 'u.id = pg.id_user', 'inner');
        return $this->db->get('pagamentos pg')->result();
    }

    public function ver_comprovante($id) {
        $this->db->select('*'); 
        $this->db->where('pg.id_pago', $id);
        $this->db->join('plano p', 'p.id_plano = pg.id_plano', 'inner');
       // $this->db->join('assinaturas a', 'a.id_plano = p.id_plano', 'inner');
         $this->db->join('planos ps', 'ps.id_planos = p.id_planos', 'inner');
        $this->db->join('users u', 'u.id = pg.id_user', 'inner');
        return $this->db->get('pagamentos pg')->result();
    }

     public function countAdminPagos() {            
        $query = $this->db->get('pagamentos');
        $rows = $query->num_rows();
        if ($rows > 0):
            return $rows;
        else:
            return 0;
        endif;
    }  

         public function countAdminPagosId($id) {   
         $this->db->where('codigo', $id);
        $query = $this->db->get('pagamentos');
        $rows = $query->num_rows();
        if ($rows > 0):
            return $rows;
        else:
            return 0;
        endif;
    }  


     public function gravar_comprovante($id_pago, $comprovante) {
            $data['status_pago'] = 1;
            $data['comprovante'] = $comprovante;
            $this->db->where('id_pago', $id_pago);
        return $this->db->update('pagamentos', $data);
    }


    public function alterar_pago_status($id, $status) {
        $data['status_pago'] = $status;
        $this->db->where('id_pago', $id);
    return $this->db->update('pagamentos', $data);
    }

       public function suspensao() {
        $query = $this->db->get('suspensao');
        if ($query->num_rows() > 0):
            return $query->result();
        else:
            return null;
        endif;
    }     

}