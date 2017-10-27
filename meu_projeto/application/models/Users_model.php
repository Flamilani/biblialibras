<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {

    var $table = 'users';    

    public function __construct() {
        parent::__construct();
    }
    
    public function efetuar_login($login, $senha) {
        $this->db->where('email', $login);
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

    

}
