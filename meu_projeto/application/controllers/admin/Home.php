<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("livros_model");
        $this->load->model("users_model");
        $this->load->model("pedidos_model");
        $this->load->model("plano_model");

      if(!$this->session->userdata('logadmin')) {
            redirect(base_url('admin/login'));
        }
    }

    public function index() {
        // $this->output->enable_profiler(TRUE);
        $user = (isset($this->session->userdata('admin')->id) ? $this->session->userdata('admin')->id : '');     
        $data['perfil'] = $this->users_model->exibir_Perfil($user);    
        $data['count_livros'] = $this->livros_model->countAdminLivros();   
        $data['count_ativos'] = $this->users_model->countUsersAtivos();   
        $data['count_assinaturas'] = $this->plano_model->countAdminAssinaturas();   
        $data['count_pagos'] = $this->plano_model->countAdminPagos();   
        $data['count_planos'] = $this->plano_model->countAdminPlanos();   
        $data['perfils'] = $this->users_model->grupoPerfil();   
        $data['totalPerfil'] = $this->users_model->totalPerfil();   
        $data['escolar'] = $this->users_model->grupoEscolar();   
        $data['totalEscolar'] = $this->users_model->totalEscolar();   
        $data['igreja'] = $this->users_model->grupoIgreja();   
        $data['totalIgreja'] = $this->users_model->totalIgreja();   
        $data['funcao'] = $this->users_model->grupoFuncao();   
        $data['totalFuncao'] = $this->users_model->totalFuncao();   
        $data['saber'] = $this->users_model->grupoSaber();   
        $data['totalSaber'] = $this->users_model->totalSaber();
        $data['acessos'] = $this->users_model->grupoAcesso();
        $data['totalAcessos'] = $this->users_model->totalAcessos();
        $this->load->view('admin/inc/html-header');
        $this->load->view('admin/inc/header', $data);
        $this->load->view('admin/home', $data);
        $this->load->view('admin/inc/footer');
        $this->load->view('admin/inc/html-footer');

    }

     public function error404()
    {
        $this->load->view('inc/html-header');            
        $this->load->view('admin/errors/error404');     
        $this->load->view('inc/html-footer');

    }



}
