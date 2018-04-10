<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Planos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("plano_model");
        $this->load->model("pedidos_model");
        $this->load->model("videos_model");
        $this->load->model("users_model");
        $this->load->model("livros_model");
        $this->load->helper('array');

         if(!$this->session->userdata('logadmin')) {
            redirect(base_url('admin/login'));
        }
    }

       public function index()  { 
       //  $this->output->enable_profiler(TRUE);
            $user = (isset($this->session->userdata('admin')->id) ? $this->session->userdata('admin')->id : '');    
            $data['perfil'] = $this->users_model->exibir_Perfil($user);    
            $data['count_livros'] = $this->livros_model->countAdminLivros();   
            $data['count_users'] = $this->users_model->countUsers();   
            $data['count_pedidos'] = $this->pedidos_model->countAdminPedidos();   
            $data['count_ativos'] = $this->users_model->countUsersAtivos();   
            $data['count_planos'] = $this->plano_model->countAdminPlanos();        
            $data['count_pagos'] = $this->plano_model->countAdminPagos();  
            $data['count_assinaturas'] = $this->plano_model->countAdminAssinaturas();   
            $data['planos'] = $this->plano_model->admin_Planos();    
            $this->load->view('admin/inc/html-header');
            $this->load->view('admin/inc/header', $data);
            $this->load->view('admin/planos', $data);
            $this->load->view('admin/inc/footer');
            $this->load->view('admin/inc/html-footer');
    }

           public function periodos($id)  { 
          //  $this->output->enable_profiler(TRUE);
            $user = (isset($this->session->userdata('admin')->id) ? $this->session->userdata('admin')->id : '');    
            $data['perfil'] = $this->users_model->exibir_Perfil($user);    
            $data['count_livros'] = $this->livros_model->countAdminLivros();   
            $data['count_users'] = $this->users_model->countUsers();   
            $data['count_pedidos'] = $this->pedidos_model->countAdminPedidos();   
            $data['count_ativos'] = $this->users_model->countUsersAtivos();   
            $data['count_periodo'] = $this->plano_model->countAdminPlano();    
            $data['count_periodo_p'] = $this->plano_model->countPlanoP($id); 
            $data['count_plano'] = $this->plano_model->countAdminPlano(); 
            $data['count_planos'] = $this->plano_model->countAdminPlanos(); 
            $data['count_pagos'] = $this->plano_model->countAdminPagos();  
            $data['count_assinaturas'] = $this->plano_model->countAdminAssinaturas();      
            $data['nome_plano'] = $this->plano_model->nome_plano($id);    
            $data['periodos'] = $this->plano_model->detalhePlano($id);    
            $data['periodos_plano'] = $this->plano_model->detalhePeriodo($id);    
            $this->load->view('admin/inc/html-header');
            $this->load->view('admin/inc/header', $data);
            $this->load->view('admin/periodos', $data);
            $this->load->view('admin/inc/footer');
            $this->load->view('admin/inc/html-footer');
    }

       public function plano_livro($id)  { 
         //  $this->output->enable_profiler(TRUE);
            $user = (isset($this->session->userdata('admin')->id) ? $this->session->userdata('admin')->id : '');    
            $data['perfil'] = $this->users_model->exibir_Perfil($user);    
            $data['count_livros'] = $this->livros_model->countAdminLivros();   
            $data['count_users'] = $this->users_model->countUsers();   
            $data['count_pedidos'] = $this->pedidos_model->countAdminPedidos();   
            $data['count_ativos'] = $this->users_model->countUsersAtivos();   
            $data['count_plano'] = $this->plano_model->countAdminPlano(); 
            $data['count_planos'] = $this->plano_model->countAdminPlanos(); 
            $data['count_assinaturas'] = $this->plano_model->countAdminAssinaturas();   
            $data['count_plano_livros'] = $this->plano_model->countAdminPlanoLivro($id); 
            $data['count_pagos'] = $this->plano_model->countAdminPagos();    
            $data['nome_plano'] = $this->plano_model->nome_plano($id);    
            $data['plano_livro'] = $this->plano_model->plano_livro($id);    
            $data['plano_livroSel'] = $this->plano_model->plano_livroSel();    
            $data['param_livros'] = $this->plano_model->paramPlanoLivro($id);    
            $data['detalhe_plivros'] = $this->plano_model->detalhePlanoLivro($id);    
            $this->load->view('admin/inc/html-header');
            $this->load->view('admin/inc/header', $data);
            $this->load->view('admin/plano_livro', $data);
            $this->load->view('admin/inc/footer');
            $this->load->view('admin/inc/html-footer');
    }

    public function novo_plano_livro($id)  {
       // $this->output->enable_profiler(TRUE);
        $user = (isset($this->session->userdata('admin')->id) ? $this->session->userdata('admin')->id : '');
        $data['perfil'] = $this->users_model->exibir_Perfil($user);
        $data['count_livros'] = $this->livros_model->countAdminLivros();
        $data['count_users'] = $this->users_model->countUsers();
        $data['count_pedidos'] = $this->pedidos_model->countAdminPedidos();
        $data['count_ativos'] = $this->users_model->countUsersAtivos();
        $data['count_plano'] = $this->plano_model->countAdminPlano();
        $data['count_planos'] = $this->plano_model->countAdminPlanos();
        $data['count_assinaturas'] = $this->plano_model->countAdminAssinaturas();
        $data['count_plano_livros'] = $this->plano_model->countAdminPlanoLivro($id);
        $data['count_pagos'] = $this->plano_model->countAdminPagos();
        $data['nome_plano'] = $this->plano_model->nome_plano($id);
        $data['plano_livro'] = $this->plano_model->plano_livro($id);
        $data['plano_livroSel'] = $this->plano_model->plano_livroSel();
        $data['param_livros'] = $this->plano_model->paramPlanoLivro($id);
        $data['detalhe_plivros'] = $this->plano_model->detalhePlanoLivro($id);
        $this->load->view('admin/inc/html-header');
        $this->load->view('admin/inc/header', $data);
        $this->load->view('admin/novo_plano_livro', $data);
        $this->load->view('admin/inc/footer');
        $this->load->view('admin/inc/html-footer');
    }

         public function alterar_periodo($id) {
        $user = (isset($this->session->userdata('admin')->id) ? $this->session->userdata('admin')->id : '');    
        $data['perfil'] = $this->users_model->exibir_Perfil($user);    
        $data['livro'] = $this->livros_model->detalheLivro($id);
        $data['count_livros'] = $this->livros_model->countAdminLivros();   
        $data['count_users'] = $this->users_model->countUsers();   
        $data['count_ativos'] = $this->users_model->countUsersAtivos();   
        $data['count_pedidos'] = $this->pedidos_model->countAdminPedidos();  
        $data['count_plano'] = $this->plano_model->countAdminPlano(); 
        $data['count_planos'] = $this->plano_model->countAdminPlanos(); 
        $data['count_assinaturas'] = $this->plano_model->countAdminAssinaturas(); 
        $data['count_pagos'] = $this->plano_model->countAdminPagos();    
        $data['nome_plano'] = $this->plano_model->nome_plano($id);      
        $data['plano'] = $this->plano_model->detalhePeriodo($id);       
        $this->load->view('admin/inc/html-header');
        $this->load->view('admin/inc/header', $data);
        $this->load->view('admin/alterar_periodo', $data);
        $this->load->view('admin/inc/footer');
        $this->load->view('admin/inc/html-footer');
    }

    public function alterar_planos($id) {
        $user = (isset($this->session->userdata('admin')->id) ? $this->session->userdata('admin')->id : '');    
        $data['perfil'] = $this->users_model->exibir_Perfil($user);    
        $data['livro'] = $this->livros_model->detalheLivro($id);
        $data['count_livros'] = $this->livros_model->countAdminLivros();   
        $data['count_users'] = $this->users_model->countUsers();   
        $data['count_ativos'] = $this->users_model->countUsersAtivos();   
        $data['count_pedidos'] = $this->pedidos_model->countAdminPedidos();  
        $data['count_planos'] = $this->plano_model->countAdminPlanos();   
        $data['count_pagos'] = $this->plano_model->countAdminPagos(); 
        $data['count_assinaturas'] = $this->plano_model->countAdminAssinaturas();   
        $data['planos'] = $this->plano_model->detalhePlanos($id);    
        $this->load->view('admin/inc/html-header');
        $this->load->view('admin/inc/header', $data);
        $this->load->view('admin/alterar_planos', $data);
        $this->load->view('admin/inc/footer');
        $this->load->view('admin/inc/html-footer');
    }

        public function alterar_plano_livro($id) {
        $user = (isset($this->session->userdata('admin')->id) ? $this->session->userdata('admin')->id : '');    
        $data['perfil'] = $this->users_model->exibir_Perfil($user);    
        $data['livro'] = $this->livros_model->detalheLivro($id);
        $data['count_livros'] = $this->livros_model->countAdminLivros();   
        $data['count_users'] = $this->users_model->countUsers();   
        $data['count_ativos'] = $this->users_model->countUsersAtivos();   
        $data['count_pedidos'] = $this->pedidos_model->countAdminPedidos();  
        $data['count_planos'] = $this->plano_model->countAdminPlanos();   
        $data['count_pagos'] = $this->plano_model->countAdminPagos();  
        $data['planos'] = $this->plano_model->detalhePlanos($id);    
        $data['count_assinaturas'] = $this->plano_model->countAdminAssinaturas();   
        $data['plano_livro'] = $this->plano_model->detalhePlanoLivro($id);
        $data['plano_livroSel'] = $this->livros_model->plano_livroSel();        
        $this->load->view('admin/inc/html-header');
        $this->load->view('admin/inc/header', $data);
        $this->load->view('admin/alterar_plano_livro', $data);
        $this->load->view('admin/inc/footer');
        $this->load->view('admin/inc/html-footer');
    }


     public function alterar_imagem($id) {
        $user = (isset($this->session->userdata('admin')->id) ? $this->session->userdata('admin')->id : '');    
        $data['perfil'] = $this->users_model->exibir_Perfil($user);    
        $data['livro'] = $this->livros_model->detalheLivro($id);
        $data['count_livros'] = $this->livros_model->countAdminLivros();   
        $data['count_users'] = $this->users_model->countUsers();   
        $data['count_ativos'] = $this->users_model->countUsersAtivos();   
        $data['count_pedidos'] = $this->pedidos_model->countAdminPedidos();  
        $data['count_plano'] = $this->plano_model->countAdminPlano();   
        $data['count_pagos'] = $this->plano_model->countAdminPagos();  
        $data['count_planos'] = $this->plano_model->countAdminPlanos();
        $data['plano'] = $this->plano_model->detalhePlano($id);    
        $this->load->view('admin/inc/html-header');
        $this->load->view('admin/inc/header', $data);
        $this->load->view('admin/alterar_imagem_plano', $data);
        $this->load->view('admin/inc/footer');
        $this->load->view('admin/inc/html-footer');
    }

     public function gravarPlanos() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nome_plano', 'Nome de Plano', 'required|min_length[3]');  

     
    if ($this->form_validation->run() == false) {
            $this->index();
        } elseif ($this->form_validation->run() == true) {


            $nome_plano = $this->input->post('nome_plano');    
            $ordem = $this->input->post('ordem');
            $home = $this->input->post('home');

            if ($this->input->post('btn_publicar') == true) {
                $status = 1;
            } else {
                $status = 0;
            }
           
            if ($this->plano_model->adicionarPlanos($nome_plano, $status, $ordem, $home)) {
                $this->session->set_flashdata("success", "O plano foi adicionado com sucesso.");
                redirect(base_url('admin/planos'));
            } else {
                echo "Erro ao cadastrar o plano";
            }
        }
    }

      public function gravarPlano() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('titulo', 'Título', 'required|min_length[3]');  
        $this->form_validation->set_rules('valor', 'Valor', 'required');  

        $path = "assets/uploads";

        if (!is_dir($path)) {
            mkdir($path, 0755, TRUE);
        }

        $config_imagem = array(
            'upload_path' => $path,
            'allowed_types' => 'jpg|jpeg|png|gif',
            'max_size' => '1024',
            'file_name' => trim(str_replace(" ","",date('dmYHis'))) . rand()
        );

        $this->load->library('upload', $config_imagem);
        $this->load->library('image_lib', $config_imagem);
        $this->upload->initialize($config_imagem);

    if ($this->form_validation->run() == false) {
            $this->index();
        } elseif ($this->form_validation->run() == true) {
            if (!$this->upload->do_upload()) {
                print_r($this->upload->display_errors());
            } else {
                $this->image_lib->resize();
            }
            $data = array('upload_data' => $this->upload->data());

            $titulo = $this->input->post('titulo');    
            $valor = str_replace(',' , '.' , $this->input->post('valor'));  
            $imagem = $data['upload_data']['file_name'];         
            $ordem = $this->input->post('ordem');
            $duracao = $this->input->post('duracao');
            $periodo = $this->input->post('periodo');

            if ($this->input->post('btn_publicar') == true) {
                $status = 1;
            } else {
                $status = 0;
            }
           
            if ($this->plano_model->adicionarPlano($titulo, $imagem, $valor, $status, $ordem, $duracao, $periodo)) {
                $this->session->set_flashdata("success", "O plano foi adicionado com sucesso.");
                redirect(base_url('admin/plano'));
            } else {
                echo "Erro ao cadastrar o plano";
            }
        }
    }



    public function gravar_alteracoes() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nome_plano', 'Nome de Plano', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $id = $this->input->post('id_planos');
            $titulo = $this->input->post('nome_plano');
            $ordem = $this->input->post('ordem');

            if ($this->input->post('btn_publicar') == true) {
                $status = 1;
            } else {
                $status = 0;
            }          

            if ($this->plano_model->gravar_alteracoes($id, $titulo, $status, $ordem)) {
                $this->session->set_flashdata("success", "O plano foi alterado com sucesso.");
                redirect(base_url('admin/planos/alterar_planos/' . $id));
            } else {
                echo "Erro ao alterar o plano";
            }
        }
    }

         public function adicionar_periodos() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('titulo', 'Título', 'trim|required');
        $this->form_validation->set_rules('valor', 'Valor', 'required');  
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $id_planos = $this->input->post('id_planos');
            $titulo = $this->input->post('titulo');
            $valor = str_replace(',' , '.' , $this->input->post('valor'));        
            $ordem = $this->input->post('ordem');
            $duracao = $this->input->post('duracao');
            $periodo = $this->input->post('periodo');

            if ($this->input->post('btn_publicar') == true) {
                $status = 1;
            } else {
                $status = 0;
            }          

            if ($this->plano_model->adicionarPlanoP($titulo, $valor, $status, $ordem, $duracao, $periodo, $id_planos)) {
                $this->session->set_flashdata("success", "O período foi adicionado com sucesso.");
                redirect(base_url('admin/planos/periodos/' . $id_planos));
            } else {
                echo "Erro ao alterar";
            }
        }
    }


       public function gravar_periodos() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('titulo', 'Título', 'trim|required');
        $this->form_validation->set_rules('valor', 'Valor', 'required');  
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $id = $this->input->post('id_plano');
            $titulo = $this->input->post('titulo');
            $valor = str_replace(',' , '.' , $this->input->post('valor'));        
            $ordem = $this->input->post('ordem');
            $duracao = $this->input->post('duracao');
            $periodo = $this->input->post('periodo');
            $id_planos = $this->input->post('id_planos');

            if ($this->input->post('btn_publicar') == true) {
                $status = 1;
            } else {
                $status = 0;
            }          

            if ($this->plano_model->gravar_alteracoesP($id, $titulo, $valor, $status, $ordem, $duracao, $periodo, $id_planos)) {
                $this->session->set_flashdata("success", "O período foi alterado com sucesso.");
                redirect(base_url('admin/planos/alterar_periodo/' . $id));
            } else {
                echo "Erro ao alterar";
            }
        }
    }

    public function gravar_imagem() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('titulo', 'Título', 'required|min_length[3]');  

        $path = "assets/uploads";

        if (!is_dir($path)) {
            mkdir($path, 0755, TRUE);
        }

        $config_imagem = array(
            'upload_path' => $path,
            'allowed_types' => 'jpg|jpeg|png|gif',
            'max_size' => '1024',
            'file_name' => trim(str_replace(" ","",date('dmYHis'))) . rand()
        );

        $this->load->library('upload', $config_imagem);
        $this->load->library('image_lib', $config_imagem);
        $this->upload->initialize($config_imagem);

    if ($this->form_validation->run() == false) {
            $this->index();
        } elseif ($this->form_validation->run() == true) {
            if (!$this->upload->do_upload()) {
                print_r($this->upload->display_errors());
            } else {
                $this->image_lib->resize();
            }
            $id = $this->input->post('id_plano');

            $data = array('upload_data' => $this->upload->data());            
            
            $imagem = $data['upload_data']['file_name'];  

            $d = $this->plano_model->detalhePlano($id);
            if (file_exists(base_url('assets/uploads/' . $d[0]->imagem) && $d[0]->imagem)) {
                unlink(base_url('assets/uploads/' . $d[0]->imagem));
            }  

            if ($this->plano_model->gravar_imagem($id, $imagem)) {
                $this->session->set_flashdata("success", "A imagem foi atualizada com sucesso.");
                redirect(base_url('admin/plano/alterar_imagem/' . $id));
            } else {
                echo "Erro ao cadastrar a imagem";
            }
        }
    }

    public function alterar_periodo_status() {
        $status = $this->input->post('status');
        $id = $this->input->post('id_plano');
     return $this->plano_model->alterar_plano_statusP($id, $status);
    }

    public function alterar_planos_status() {
        $status = $this->input->post('status');
        $id = $this->input->post('id_planos');
     return $this->plano_model->alterar_plano_status($id, $status);
    }

    public function alterar_tipo_status() {
        $status = $this->input->post('tipo_plano');
        $id = $this->input->post('id_planos');
        return $this->plano_model->alterar_tipo_status($id, $status);
    }


    public function alterar_home_status() {
        $home = $this->input->post('home');
        $id = $this->input->post('id_planos');
        return $this->plano_model->alterar_home_status($id, $home);
    }

    public function alterar_plano_livro_status() {
        $status = $this->input->post('status');
        $id = $this->input->post('id_plano_livro');
     return $this->plano_model->alterar_plano_livro_status($id, $status);
    }

     public function deletarP($id) {
        $data = $this->plano_model->detalhePlano($id);
        if ($this->plano_model->deletar($id)) {
            if (file_exists('assets/uploads/' . $data[0]->imagem) && $data[0]->imagem) {
                unlink('assets/uploads/' . $data[0]->imagem);
            }
            $this->session->set_flashdata("deletar", "O plano foi deletado com sucesso.");
            redirect(base_url('admin/plano'));
        } else {
            echo "Erro ao excluir o plano";
        }
    }

        public function deletar($id) {
        $data = $this->plano_model->detalhePlanos($id);
        if ($this->plano_model->deletar($id)) {
            if (file_exists('assets/uploads/' . $data[0]->imagem) && $data[0]->imagem) {
                unlink('assets/uploads/' . $data[0]->imagem);
            }
            $this->session->set_flashdata("deletar", "O plano foi deletado com sucesso.");
            redirect(base_url('admin/planos'));
        } else {
            echo "Erro ao excluir o plano";
        }
    }

    public function deletar_plano_livro($id, $id_planos) {
        if ($this->plano_model->deletar_plano_livro($id)) {                    
            $this->session->set_flashdata("deletar", "O livro do plano foi deletado com sucesso.");
            redirect(base_url('admin/planos/plano_livro/' . $id_planos));
        } else {
            echo "Erro ao excluir";
        }
    }

   public function gravarPlanoLivro() {
        $this->load->library('form_validation');

    if(!empty($_POST['livros'])) {

        foreach($_POST['livros'] as $value){
         $value = $this->input->post('livros');
        }
    }  
            $id_planos = $this->input->post('id_planos');            
        
            if ($this->plano_model->adicionarPlanoLivro($id_planos, $value)) {  
                $this->session->set_flashdata("success", "O livro foi adicionado com sucesso.");
                redirect(base_url('admin/planos/plano_livro/' . $id_planos));
            } else {
                echo "Erro ao cadastrar o livro";
            }
      
    }


  
   public function alterarPlanoLivro() {
        $this->load->library('form_validation');
       
    if(!empty($_POST['livros'])) {

        foreach($_POST['livros'] as $value){
         $value = $this->input->post('livros');
        }
    }  
            $id_planos = $this->input->post('id_planos');  
            $id = $this->input->post('id_plano_livro');    

        
            if ($this->plano_model->gravar_plavo_livros($id, $value)) {  
                $this->session->set_flashdata("alterar", "O livro foi adicionado com sucesso.");
                redirect(base_url('admin/planos/plano_livro/' . $id_planos));
            } else {
                echo "Erro ao alterar o livro";
            }
        
    }

}