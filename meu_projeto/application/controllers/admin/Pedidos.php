<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pedidos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("pedidos_model");
        $this->load->model("videos_model");
        $this->load->model("users_model");

         if(!$this->session->userdata('logadmin')) {
            redirect(base_url('admin/login'));
        }
    }

   public function index()	{ 
            $user = (isset($this->session->userdata('admin')->id) ? $this->session->userdata('admin')->id : '');    
            $data_perfil['perfil'] = $this->users_model->exibir_Perfil($user);    
            $this->output->enable_profiler(TRUE);
            $data['count_pedidos'] = $this->pedidos_model->countAdminPedidos();   
            $data['pedidos'] = $this->pedidos_model->lista_Pedidos();    
            $this->load->view('admin/inc/html-header');
            $this->load->view('admin/inc/header', $data_perfil);
            $this->load->view('admin/pedidos', $data);
            $this->load->view('admin/inc/footer');
            $this->load->view('admin/inc/html-footer');
	}

       public function itens($id)  { 
            $user = (isset($this->session->userdata('admin')->id) ? $this->session->userdata('admin')->id : '');    
            $data_perfil['perfil'] = $this->users_model->exibir_Perfil($user);    
            $this->output->enable_profiler(TRUE);
            $data['count_itens'] = $this->pedidos_model->countAdminItens();   
            $data['itens'] = $this->pedidos_model->lista_itens($id);    
            $this->load->view('admin/inc/html-header');
            $this->load->view('admin/inc/header', $data_perfil);
            $this->load->view('admin/itens', $data);
            $this->load->view('admin/inc/footer');
            $this->load->view('admin/inc/html-footer');
    }

}
