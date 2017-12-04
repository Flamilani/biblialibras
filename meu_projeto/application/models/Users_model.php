<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {

    var $table = 'users';    

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

    public function lista_Perfil($id) {
        $this->db->where("perfil_id", $id);
        $perfil = $this->db->get('perfil')->result();
        return $perfil;
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
        $dados['nome'] = $this->input->post('nome', TRUE);
        $dados['sobrenome'] = $this->input->post('sobrenome', TRUE);
        $dados['cpf'] = $this->input->post('sobrenome', TRUE);
        $dados['email'] = $this->input->post('email', TRUE);
        $dados['telefone'] = $this->input->post('telefone', TRUE);
        $dados['celular'] = $this->input->post('celular', TRUE);
        $dados['data_nasc'] = $this->input->post('data_nasc', TRUE);
        $dados['senha'] = md5($this->input->post('senha', TRUE)); 
        $dados['cep'] = $this->input->post('cep', TRUE);       
        $dados['status'] = 0;        
        $dados['perfil'] = 2;        
        return $this->db->insert($this->table, $dados);
    }

}
