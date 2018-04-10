<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acessos extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("livros_model");
        $this->load->model("users_model");
        $this->load->model("plano_model");
        $this->load->model("pedidos_model");
        $this->load->model("acessos_model");

        if (!$this->session->userdata('logadmin')) {
            redirect(base_url('admin/login'));
        }
    }

    public function index()  {
       // $this->output->enable_profiler(TRUE);
        $user = (isset($this->session->userdata('admin')->id) ? $this->session->userdata('admin')->id : '');
        $data['perfil'] = $this->users_model->exibir_Perfil($user);
        $data['count_livros'] = $this->livros_model->countAdminLivros();
        $data['count_users'] = $this->users_model->countUsers();
        $data['users_ativos'] = $this->users_model->usersAtivos();
        $data['count_pedidos'] = $this->pedidos_model->countAdminPedidos();
        $data['count_ativos'] = $this->users_model->countUsersAtivos();
        $data['count_pagos'] = $this->plano_model->countAdminPagos();
        $data['count_assinaturas'] = $this->plano_model->countAdminAssinaturas();
        $data['count_planos'] = $this->plano_model->countAdminPlanos();
        $data['assinaturas'] = $this->plano_model->admin_Assinaturas();
        $data['acessos'] = $this->acessos_model->exibir_acessos();
        $this->load->view('admin/inc/html-header');
        $this->load->view('admin/inc/header', $data);
        $this->load->view('admin/acessos', $data);
        $this->load->view('admin/inc/footer');
        $this->load->view('admin/inc/html-footer');
    }
}