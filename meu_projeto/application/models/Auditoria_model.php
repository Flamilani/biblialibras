<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auditoria_model extends CI_Model
{
    var $table = 'auditoria';

    public function __construct()
    {
        parent::__construct();
    }

    public function exibir_auditoria() {
        $this->db->order_by('id_auditoria', 'ASC');
        $this->db->select('*, aud.data_auditoria');
        $this->db->from('auditoria aud');
        $this->db->join('users u', 'u.id = aud.id_user', 'inner');
        return $this->db->get()->result();
    }

    public function exibir_auditoriaPerfil($id) {
        $this->db->where("aud.id_user", $id);  
        $this->db->order_by('id_auditoria', 'ASC');
        $this->db->select('*, aud.data_auditoria');
        $this->db->from('auditoria aud');
        $this->db->join('users u', 'u.id = aud.id_user', 'inner');
        return $this->db->get()->result();
    }
}