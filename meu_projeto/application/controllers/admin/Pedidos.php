<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pedidos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("pedidos_model");
        $this->load->model("videos_model");
        $this->load->model("users_model");
        $this->load->model("livros_model");

         if(!$this->session->userdata('logadmin')) {
            redirect(base_url('admin/login'));
        }
    }

   public function index()	{ 
            $user = (isset($this->session->userdata('admin')->id) ? $this->session->userdata('admin')->id : '');    
            $data['perfil'] = $this->users_model->exibir_Perfil($user);    
            $data['pedidos'] = $this->pedidos_model->lista_Pedidos();    
            $data['count_livros'] = $this->livros_model->countAdminLivros();   
            $data['count_users'] = $this->users_model->countUsers();   
            $data['count_ativos'] = $this->users_model->countUsersAtivos();   
            $data['count_pedidos'] = $this->pedidos_model->countAdminPedidos();   
            $this->load->view('admin/inc/html-header');
            $this->load->view('admin/inc/header', $data);
            $this->load->view('admin/pedidos', $data);
            $this->load->view('admin/inc/footer');
            $this->load->view('admin/inc/html-footer');
	}

       public function itens($id)  { 
            $user = (isset($this->session->userdata('admin')->id) ? $this->session->userdata('admin')->id : '');    
            $data['perfil'] = $this->users_model->exibir_Perfil($user);    
            $data['count_itens'] = $this->pedidos_model->countAdminItens();   
            $data['itens'] = $this->pedidos_model->lista_itens($id);    
            $data['count_livros'] = $this->livros_model->countAdminLivros();   
            $data['count_users'] = $this->users_model->countUsers();   
            $data['count_ativos'] = $this->users_model->countUsersAtivos();   
            $data['count_pedidos'] = $this->pedidos_model->countAdminPedidos();   
            $this->load->view('admin/inc/html-header');
            $this->load->view('admin/inc/header', $data);
            $this->load->view('admin/itens', $data);
            $this->load->view('admin/inc/footer');
            $this->load->view('admin/inc/html-footer');
    }

        public function alterar_pedido_status() {
        $status = $this->input->post('status');
        $id = $this->input->post('id_pedido');
        return $this->pedidos_model->alterar_pedido_status($id, $status);
    }


       public function deletar($id) {
        if ($this->pedidos_model->deletarPedido($id)) { 
            $this->session->set_flashdata("deletar", "O pedido foi deletado com sucesso.");
            redirect(base_url('admin/pedidos'));
        } else {
            echo "Erro ao excluir";
        }
    }

}
