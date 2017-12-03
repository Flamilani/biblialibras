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

    

}
