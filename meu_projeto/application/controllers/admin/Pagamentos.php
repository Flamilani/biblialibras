<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagamentos extends CI_Controller {

   public function __construct() {
        parent::__construct();
        $this->load->model("livros_model");
        $this->load->model("users_model");
        $this->load->model("plano_model");
        $this->load->model("pedidos_model");

      if(!$this->session->userdata('logadmin')) {
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
            $data['count_assinaturas'] = $this->plano_model->countAdminAssinaturas();   
            $data['count_pagam'] = $this->plano_model->countAdminPagos();   
            $data['count_pagos'] = $this->plano_model->countAdminPagos();  
            $data['count_planos'] = $this->plano_model->countAdminPlanos();
            $data['assinaturas'] = $this->plano_model->admin_Assinaturas();    
            $data['valor'] = $this->plano_model->valorFatura();    
            $data['pagos'] = $this->plano_model->lista_Pagamento();    
            $this->load->view('admin/inc/html-header');
            $this->load->view('admin/inc/header', $data);
            $this->load->view('admin/pagamentos', $data);
            $this->load->view('admin/inc/footer');
            $this->load->view('admin/inc/html-footer');
    }


    public function alterar_pagamento($id)  {
        //$this->output->enable_profiler(TRUE);
        $user = (isset($this->session->userdata('admin')->id) ? $this->session->userdata('admin')->id : '');
        $data['perfil'] = $this->users_model->exibir_Perfil($user);
        $data['count_livros'] = $this->livros_model->countAdminLivros();
        $data['count_users'] = $this->users_model->countUsers();
        $data['users_ativos'] = $this->users_model->usersAtivos();
        $data['count_pedidos'] = $this->pedidos_model->countAdminPedidos();
        $data['count_ativos'] = $this->users_model->countUsersAtivos();
        $data['count_assinaturas'] = $this->plano_model->countAdminAssinaturas();
        $data['count_pago'] = $this->plano_model->countAdminPagosId($id);
        $data['count_pagos'] = $this->plano_model->countAdminPagos();
        $data['count_planos'] = $this->plano_model->countAdminPlanos();
        $data['assinaturas'] = $this->plano_model->admin_Assinaturas();
        $data['valor'] = $this->plano_model->valorFatura();
        $data['pagos'] = $this->plano_model->lista_Pagam($id);
        $this->load->view('admin/inc/html-header');
        $this->load->view('admin/inc/header', $data);
        $this->load->view('admin/pagamento', $data);
        $this->load->view('admin/inc/footer');
        $this->load->view('admin/inc/html-footer');
    }

        public function comprovante($id) {  
        // $this->output->enable_profiler(TRUE);
            $user = (isset($this->session->userdata('admin')->id) ? $this->session->userdata('admin')->id : '');   
            $data['perfil'] = $this->users_model->exibir_Perfil($user);    
            $data['count_livros'] = $this->livros_model->countAdminLivros();   
            $data['count_users'] = $this->users_model->countUsers();   
            $data['users_ativos'] = $this->users_model->usersAtivos();   
            $data['count_pedidos'] = $this->pedidos_model->countAdminPedidos();   
            $data['count_ativos'] = $this->users_model->countUsersAtivos();   
            $data['count_assinaturas'] = $this->plano_model->countAdminAssinaturas(); 
            $data['count_pagos'] = $this->plano_model->countAdminPagos();  
            $data['count_planos'] = $this->plano_model->countAdminPlanos();  
            $data['count_pagam'] = $this->plano_model->countAdminPagos();   
            $data['lista_livros'] = $this->livros_model->home_Livros();       
            $data['comprovante'] = $this->plano_model->ver_comprovante($id);           
            $this->load->view('admin/inc/html-header');
            $this->load->view('admin/inc/header', $data);
            $this->load->view('admin/comprovante', $data);
            $this->load->view('admin/inc/html-footer');              
         
    }

      public function gravar_comprovante() {
       
        $this->load->library('form_validation');
 

        $path = "assets/comprovantes";

        if (!is_dir($path)) {
            mkdir($path, 0755, TRUE);
        }

        $nome_comprovante = $this->input->post('nome_comprovante');


        $config_imagem = array(
            'upload_path' => $path,
            'allowed_types' => 'jpg|jpeg|png|gif',
            'max_size' => '0',
            'file_name' => clear($nome_comprovante) . trim(str_replace(" ","",date('d-m-Y-H-i-s'))) . rand()
        );

        $this->load->library('upload', $config_imagem);
        $this->load->library('image_lib', $config_imagem);
        $this->upload->initialize($config_imagem);


            if (!$this->upload->do_upload()) {
                print_r($this->upload->display_errors());
            } else {
                $this->image_lib->resize();
            }
            $id = $this->input->post('id_pago');
            $id_plano = $this->input->post('id_plano');

            $data = array('upload_data' => $this->upload->data());            
            
            $comprovante = $data['upload_data']['file_name'];  

            $d = $this->plano_model->detalhePagamento($id);
            if (file_exists(base_url('assets/comprovantes/' . $d[0]->comprovante) && $d[0]->comprovante)) {
                unlink(base_url('assets/comprovantes/' . $d[0]->comprovante));
            }  

            if ($this->plano_model->gravar_comprovante($id, $comprovante)) {
                $this->session->set_flashdata("success", "O comprovante foi atualizado com sucesso.");
                redirect(base_url('admin/pagamentos/comprovante/' . $id_plano));
            } else {
                echo "Erro ao cadastrar a imagem";
            }
       
    }

        public function alterar_status() {
        $status = $this->input->post('status_pago');
        $id = $this->input->post('id_pago');
     return $this->plano_model->alterar_pago_status($id, $status);
    }


}