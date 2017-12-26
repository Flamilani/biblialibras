<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("livros_model");
        $this->load->model("users_model");
        $this->load->model("pedidos_model");

      if(!$this->session->userdata('logadmin')) {
            redirect(base_url('admin/login'));
        }
    }

    public function index() {
        // $this->output->enable_profiler(TRUE);
        $user = (isset($this->session->userdata('admin')->id) ? $this->session->userdata('admin')->id : '');     
        $data_perfil['perfil'] = $this->users_model->exibir_Perfil($user);    
        $data['count_livros'] = $this->livros_model->countAdminLivros();   
        $data['count_users'] = $this->users_model->countUsers();   
        $data['count_ativos'] = $this->users_model->countUsersAtivos();   
        $data['count_pedidos'] = $this->pedidos_model->countAdminPedidos();   
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
        $this->load->view('admin/inc/html-header');
        $this->load->view('admin/inc/header', $data_perfil);
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
