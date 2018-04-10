<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banco extends CI_Controller {

    public function __construct() {
        parent::__construct();   
        $this->load->model('banco_model');
        $this->load->model('users_model');
        $this->load->model('livros_model');
        $this->load->model('pedidos_model');
        $this->load->model('plano_model');

      if(!$this->session->userdata('logadmin')) {
            redirect(base_url('admin/login'));
        }
    }

    public function index() {    
        $user = (isset($this->session->userdata('admin')->id) ? $this->session->userdata('admin')->id : '');     
        $data['perfil'] = $this->users_model->exibir_Perfil($user);    
        $data['banco'] = $this->banco_model->admin_Banco();
        $data['count_livros'] = $this->livros_model->countAdminLivros();   
        $data['count_users'] = $this->users_model->countUsers();   
        $data['count_ativos'] = $this->users_model->countUsersAtivos();   
        $data['count_pedidos'] = $this->pedidos_model->countAdminPedidos(); 
        $data['count_assinaturas'] = $this->plano_model->countAdminAssinaturas();   
        $data['count_pagos'] = $this->plano_model->countAdminPagos();   
        $data['count_planos'] = $this->plano_model->countAdminPlanos();  
        $this->load->view('admin/inc/html-header');
        $this->load->view('admin/inc/header', $data);
        $this->load->view('admin/banco', $data);
        $this->load->view('admin/inc/footer');
        $this->load->view('admin/inc/html-footer');

    }

    public function gravarBanco() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nome_banco', 'Nome do Banco', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $nome_banco = $this->input->post('banco_nome');
            $favorecido = $this->input->post('favorecido');
            $agencia = $this->input->post('agencia');
            $conta = $this->input->post('conta');
            $digito = $this->input->post('digito');
            $operacao = $this->input->post('operacao');
            $tipo = $this->input->post('tipo');

            if ($this->input->post('btn_publicar') == true) {
                $status = 1;
            } else {
                $status = 0;
            }

       
            if ($this->banco_model->adicionar_banco($nome_banco, $favorecido, $agencia, $conta, $digito, $operacao, $tipo, $status)) {
                $this->session->set_flashdata("success", "O banco foi adicionado com sucesso.");
                redirect(base_url('admin/banco'));
            } else {
                echo "Erro ao adicionar o banco";
            }
        }
    }
   
    public function gravar_alteracoes() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('banco_nome', 'Nome do Banco', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $id = $this->input->post('banco_id');
            $banco_nome = $this->input->post('banco_nome');
            $favorecido = $this->input->post('favorecido');
            $agencia = $this->input->post('agencia');
            $conta = $this->input->post('conta');
            $digito = $this->input->post('digito');
            $operacao = $this->input->post('operacao');
            $tipo = $this->input->post('tipo');

            if ($this->input->post('btn_publicar') == true) {
                $status = 1;
            } else {
                $status = 0;
            }
       
            if ($this->banco_model->gravar_alteracoes($id, $banco_nome, $favorecido, $agencia, $conta, $digito, $operacao, $tipo, $status)) {
                $this->session->set_flashdata("success", "O banco foi alterado com sucesso.");
                redirect(base_url('admin/banco'));
            } else {
                echo "Erro ao alterar o banco";
            }
        }
    }
   


}
