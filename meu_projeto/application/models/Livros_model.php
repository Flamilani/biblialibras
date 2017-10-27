<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Livros_model extends CI_Model {

    var $table = 'livros';    

    public function __construct() {
        parent::__construct();
    } 
    
    public function lista_Livros() {
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0):
            return $query->result();
        else:
            return null;
        endif;
    }

    

}
