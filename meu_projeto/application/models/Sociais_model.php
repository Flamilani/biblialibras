<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sociais_model extends CI_Model {

    var $table = 'sociais';    

    public function __construct() {
        parent::__construct();
    } 

    public function home_Sociais() {
        $query = $this->db->where('status', 1);
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0):
            return $query->result();
        else:
            return null;
        endif;
    }
    

    public function admin_Sociais() {
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0):
            return $query->result();
        else:
            return null;
        endif;
    }

    public function countAdminSociais() {            
        $query = $this->db->get($this->table);
        $rows = $query->num_rows();
        if ($rows > 0):
            return $rows;
        else:
            return 0;
        endif;
    }  

    public function detalheSocial($id) {
        $this->db->where('id_social', $id);
        return $this->db->get($this->table)->result();
    }

     public function adicionarSociais($titulo, $link, $icone, $status) {      
        $data['titulo'] = $titulo;     
        $data['link'] = $link;      
        $data['icone'] = $icone;      
        $data['status'] = $status;    
        return $this->db->insert($this->table, $data);
    }

      public function gravar_alteracoes($id, $titulo, $link, $icone, $status) {
       $data['titulo'] = $titulo;     
        $data['link'] = $link;      
        $data['icone'] = $icone;      
        $data['status'] = $status;     
        $this->db->where('id_social', $id);
        return $this->db->update($this->table, $data);
    }

    public function alterar_social_status($id, $status) {
        $data['status'] = $status;
        $this->db->where('id_social', $id);
        return $this->db->update($this->table, $data);
    }

    public function gravar_icone($id, $icone) {
        $data['icone'] = $icone;        
        $this->db->where('id_social', $id);
        return $this->db->update($this->table, $data);
    }

    public function deletar($id) {
        $this->db->where('id_social', $id);
        return $this->db->delete($this->table);
    }


}