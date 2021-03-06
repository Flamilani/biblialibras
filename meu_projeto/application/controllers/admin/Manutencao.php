<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manutencao extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('funciona_model');
        $this->load->model('users_model');
        $this->load->model('livros_model');
        $this->load->model('pedidos_model');
        $this->load->model('plano_model');
        $this->load->model('privacidade_model');
        $this->load->model('manutencao_model');

        if(!$this->session->userdata('logadmin')) {
            redirect(base_url('admin/login'));
        }
    }

    public function index() {
        $user = (isset($this->session->userdata('admin')->id) ? $this->session->userdata('admin')->id : '');
        $data['perfil'] = $this->users_model->exibir_Perfil($user);
        $data['manutencao'] = $this->manutencao_model->admin_Manutencao();
        $data['count_livros'] = $this->livros_model->countAdminLivros();
        $data['count_users'] = $this->users_model->countUsers();
        $data['count_ativos'] = $this->users_model->countUsersAtivos();
        $data['count_pedidos'] = $this->pedidos_model->countAdminPedidos();
        $data['count_assinaturas'] = $this->plano_model->countAdminAssinaturas();
        $data['count_pagos'] = $this->plano_model->countAdminPagos();
        $data['count_planos'] = $this->plano_model->countAdminPlanos();
        $this->load->view('admin/inc/html-header');
        $this->load->view('admin/inc/header', $data);
        $this->load->view('admin/manutencao', $data);
        $this->load->view('admin/inc/footer');
        $this->load->view('admin/inc/html-footer');

    }

    public function gravarManutencao() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('titulo', 'Título', 'required|min_length[3]');


        if ($this->form_validation->run() == false) {
            $this->index();
        } elseif ($this->form_validation->run() == true) {

            $titulo = $this->input->post('titulo');
            $conteudo = $this->input->post('editor1');           

            if ($this->input->post('btn_publicar') == true) {
                $status = 1;
            } else {
                $status = 0;
            }

            if ($this->manutencao_model->adicionarmanutencao($titulo, $conteudo, $status)) {
                $this->session->set_flashdata("success", "A manutenção foi atualizada com sucesso.");
                redirect(base_url('admin/manutencao'));
            } else {
                echo "Erro ao cadastrar";
            }
        }
    }

    public function gravar_alteracoes() {
        //$this->output->enable_profiler(TRUE);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('titulo', 'Título', 'required|min_length[3]');

        if ($this->form_validation->run() == false) {
            $this->index();
        } elseif ($this->form_validation->run() == true) {

            $id = $this->input->post('id_manutencao');

            $titulo = $this->input->post('titulo');
            $conteudo = $this->input->post('editor1');           

            if ($this->input->post('btn_publicar') == true) {
                $status = 1;
            } else {
                $status = 0;
            }

            if ($this->manutencao_model->gravar_alteracoes($id, $titulo, $conteudo, $status)) {
                $this->session->set_flashdata("success", "A manutenção foi atualizada com sucesso.");
                redirect(base_url('admin/manutencao'));
            } else {
                echo "Erro ao alterar";
            }
        }
    }



}
