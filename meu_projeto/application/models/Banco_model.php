<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Banco_model extends CI_Model {

    var $table = 'dados_bancarios';    

	public function __construct() {
        parent::__construct();
    }  

    public function admin_Banco() {
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0):
            return $query->result();
        else:
            return null;
        endif;
    }

      public function adicionar_banco($banco_nome, $favorecido, $agencia, $conta, $digito, $operacao, $tipo, $status) {
        $data['banco_nome'] = $banco_nome;     
        $data['banco_favorecido'] = $favorecido;      
        $data['banco_agencia'] = $agencia;      
        $data['banco_conta'] = $conta;      
        $data['banco_digito'] = $digito;      
        $data['banco_operacao'] = $operacao;      
        $data['banco_conta_tipo'] = $tipo;
        $data['banco_status'] = $status;
          return $this->db->insert($this->table, $data);
    }

        public function gravar_alteracoes($id, $banco_nome, $favorecido, $agencia, $conta, $digito, $operacao, $tipo, $status) {
        $data['banco_nome'] = $banco_nome;     
        $data['banco_favorecido'] = $favorecido;      
        $data['banco_agencia'] = $agencia;      
        $data['banco_conta'] = $conta;      
        $data['banco_digito'] = $digito;      
        $data['banco_operacao'] = $operacao;      
        $data['banco_conta_tipo'] = $tipo;       
        $data['banco_status'] = $status;
        $this->db->where('banco_id', $id);
        return $this->db->update($this->table, $data);
    }



}