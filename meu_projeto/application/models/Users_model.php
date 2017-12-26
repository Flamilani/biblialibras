<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {

    var $table = 'users';    
    var $id = 'id';  

    public function __construct() {
        parent::__construct();
    }
    
    public function efetuar_login($email, $senha) {
        $this->db->where('email', $email);
        $this->db->where('senha', $senha);
        return $this->db->get($this->table)->result();
    }

    public function lista_Users() {
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0):
            return $query->result();
        else:
            return null;
        endif;
    }

    public function exibir_Perfil($id) {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->result();
    }

    public function countUsersAtivos() { 
        $this->db->where("status", 1);      
        $query = $this->db->get($this->table);
        $rows = $query->num_rows();
        if ($rows > 0):
            return $rows;
        else:
            return 0;
        endif;
    }   

    public function countUsers() {       
        $query = $this->db->get($this->table);
        $rows = $query->num_rows();
        if ($rows > 0):
            return $rows;
        else:
            return 0;
        endif;
    }   

    public function grupoPerfil() {
        $this->db->select('perfil_so, count(perfil_so) as qtd');
        $this->db->group_by("perfil_so");
        $this->db->order_by("qtd desc");
        return $this->db->get($this->table)->result();
    }

     public function totalPerfil() {
        $this->db->select('perfil_so, count(perfil_so) as total');
        return $this->db->get($this->table)->result();
    }

      public function grupoEscolar() {
        $this->db->select('escolaridade, count(escolaridade) as qtd');
        $this->db->group_by("escolaridade");
        $this->db->order_by("qtd desc");
        return $this->db->get($this->table)->result();
    }

     public function totalEscolar() {
        $this->db->select('escolaridade, count(escolaridade) as total');
        return $this->db->get($this->table)->result();
    }

        public function grupoIgreja() {
        $this->db->select('igreja, count(igreja) as qtd');
        $this->db->group_by("igreja");
        $this->db->order_by("qtd desc");
        return $this->db->get($this->table)->result();
    }

     public function totalIgreja() {
        $this->db->select('igreja, count(igreja) as total');
        return $this->db->get($this->table)->result();
    }

    public function grupoFuncao() {
        $this->db->select('funcao, count(funcao) as qtd');
        $this->db->group_by("funcao");
        $this->db->order_by("qtd desc");
        return $this->db->get($this->table)->result();
    }

     public function totalFuncao() {
        $this->db->select('funcao, count(funcao) as total');
        return $this->db->get($this->table)->result();
    }

     public function grupoSaber() {
        $this->db->select('saber, count(saber) as qtd');
        $this->db->group_by("saber");
        $this->db->order_by("qtd desc");
        return $this->db->get($this->table)->result();
    }

     public function totalSaber() {
        $this->db->select('saber, count(saber) as total');
        return $this->db->get($this->table)->result();
    }

    public function verificar($email, $senha, $status, $perfil) {
        $this->db->where("email", $email);
        $this->db->where("senha", $senha);
        $this->db->where("status", $status);
        $this->db->where("perfil", $perfil);
        $usuario = $this->db->get($this->table)->row_array();
        return $usuario;
    }

    public function assinar($dados) {
        $dados['nome'] = $this->input->post('nome', TRUE);
        $dados['email'] = $this->input->post('email', TRUE);
        $dados['senha'] = md5($this->input->post('senha', TRUE));        
        $dados['celular'] = $this->input->post('celular', TRUE);
        $dados['data_nasc'] = $this->input->post('data_nasc', TRUE);
        $dados['status'] = 0;        
        $dados['perfil'] = 1;        
        return $this->db->insert($this->table, $dados);
    }

    function adicionarUsers($nome, $email, $senha, $telefone, $celular, $data_nasc) {      
        $data['nome'] = $nome;     
        $data['email'] = $email;      
        $data['senha'] = $senha;      
        $data['telefone'] = $telefone;      
        $data['celular'] = $celular;      
        $data['data_nasc'] = $data_nasc;      
        $data['status'] = 0;      
        return $this->db->insert($this->table, $data);
    }

     public function registrar($dados) { 
        $dados['senha'] = md5($this->input->post('senha', TRUE));     
        $dados['perfil'] = 2;        
        $dados['perfil_so'] = $this->input->post('perfil_so', TRUE);       
        $dados['escolaridade'] = $this->input->post('escolaridade', TRUE);       
        $dados['igreja'] = $this->input->post('igreja', TRUE);       
        $dados['funcao'] = $this->input->post('funcao', TRUE);       
        $dados['saber'] = $this->input->post('saber', TRUE);       
        return $this->db->insert($this->table, $dados);
    }

      public function gravar_alteracoes($id, $dados) {
        $dados['senha'] = md5($this->input->post('senha', TRUE));    
        $dados['perfil'] = $this->input->post('perfil', TRUE);             
        $dados['perfil_so'] = $this->input->post('perfil_so', TRUE);       
        $dados['escolaridade'] = $this->input->post('escolaridade', TRUE);       
        $dados['igreja'] = $this->input->post('igreja', TRUE);       
        $dados['funcao'] = $this->input->post('funcao', TRUE);       
        $dados['saber'] = $this->input->post('saber', TRUE);   
        $this->db->where($this->id, $id);
        return $this->db->update($this->table, $dados);
    }

    public function alterar_user_status($id, $status) {
        $data['status'] = $status;
        $this->db->where($this->id, $id);
        return $this->db->update($this->table, $data);
    }

      public function alterar_senha($id, $senha) {
        $data['senha'] = md5($this->input->post('senha', TRUE)); 
        $this->db->where($this->id, $id);
        return $this->db->update($this->table, $data);
    }

    public function deletar($id) {
        $this->db->where($this->id, $id);
        return $this->db->delete($this->table);
    }


}
