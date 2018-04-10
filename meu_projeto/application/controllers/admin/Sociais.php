<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sociais extends CI_Controller {

    public function __construct() {
        parent::__construct();   
        $this->load->model('sociais_model');
        $this->load->model('users_model');
        $this->load->model('livros_model');
        $this->load->model('pedidos_model');
        $this->load->model('plano_model');
        $this->load->model('sociais_model');

      if(!$this->session->userdata('logadmin')) {
            redirect(base_url('admin/login'));
        }
    }

    public function index() {    
        $user = (isset($this->session->userdata('admin')->id) ? $this->session->userdata('admin')->id : '');     
        $data['perfil'] = $this->users_model->exibir_Perfil($user);    
        $data['sociais'] = $this->sociais_model->admin_Sociais();
        $data['count_livros'] = $this->livros_model->countAdminLivros();   
        $data['count_users'] = $this->users_model->countUsers();   
        $data['count_ativos'] = $this->users_model->countUsersAtivos();   
        $data['count_pedidos'] = $this->pedidos_model->countAdminPedidos(); 
        $data['count_assinaturas'] = $this->plano_model->countAdminAssinaturas();   
        $data['count_pagos'] = $this->plano_model->countAdminPagos();   
        $data['count_planos'] = $this->plano_model->countAdminPlanos();  
        $data['count_sociais'] = $this->sociais_model->countAdminSociais();  
        $this->load->view('admin/inc/html-header');
        $this->load->view('admin/inc/header', $data);
        $this->load->view('admin/sociais', $data);
        $this->load->view('admin/inc/footer');
        $this->load->view('admin/inc/html-footer');

    }

    public function alterar_icone($id) {
        $user = (isset($this->session->userdata('admin')->id) ? $this->session->userdata('admin')->id : '');    
        $data['perfil'] = $this->users_model->exibir_Perfil($user);  
        $data['social'] = $this->sociais_model->detalheSocial($id);
        $data['count_livros'] = $this->livros_model->countAdminLivros();   
        $data['count_users'] = $this->users_model->countUsers();   
        $data['count_ativos'] = $this->users_model->countUsersAtivos();   
        $data['count_pedidos'] = $this->pedidos_model->countAdminPedidos(); 
        $data['count_assinaturas'] = $this->plano_model->countAdminAssinaturas();   
        $data['count_pagos'] = $this->plano_model->countAdminPagos();   
        $data['count_planos'] = $this->plano_model->countAdminPlanos();   
        $this->load->view('admin/inc/html-header');
        $this->load->view('admin/inc/header', $data);
        $this->load->view('admin/alterar_icone_social', $data);
        $this->load->view('admin/inc/footer');
        $this->load->view('admin/inc/html-footer');
    }  

    public function alterar($id) {
        $user = (isset($this->session->userdata('admin')->id) ? $this->session->userdata('admin')->id : '');    
        $data['perfil'] = $this->users_model->exibir_Perfil($user);    
        $data['social'] = $this->sociais_model->detalheSocial($id);
        $data['count_livros'] = $this->livros_model->countAdminLivros();   
        $data['count_users'] = $this->users_model->countUsers();   
        $data['count_ativos'] = $this->users_model->countUsersAtivos();   
        $data['count_pedidos'] = $this->pedidos_model->countAdminPedidos();
        $data['count_assinaturas'] = $this->plano_model->countAdminAssinaturas();   
        $data['count_pagos'] = $this->plano_model->countAdminPagos();   
        $data['count_planos'] = $this->plano_model->countAdminPlanos();    
        $this->load->view('admin/inc/html-header');
        $this->load->view('admin/inc/header', $data);
        $this->load->view('admin/alterar_social', $data);
        $this->load->view('admin/inc/footer');
        $this->load->view('admin/inc/html-footer');
    }

      public function gravarSociais() {
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

            $titulo = $this->input->post('titulo');  

            $link = $this->input->post('link');    

            $data = array('upload_data' => $this->upload->data());       
           
            $icone = clear($data['upload_data']['file_name']);       

            if ($this->input->post('btn_publicar') == true) {
                $status = 1;
            } else {
                $status = 0;
             }
           
            if ($this->sociais_model->adicionarSociais($titulo, $link, $icone, $status)) {
                $this->session->set_flashdata("success", "A página sociais foi atualizada com sucesso.");
                redirect(base_url('admin/sociais'));
            } else {
                echo "Erro ao cadastrar a página";
            }
        }
    }

   public function gravar_alteracoes() {
        //$this->output->enable_profiler(TRUE);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('titulo', 'Título', 'required|min_length[3]');  

        $path = "assets/img";

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

            $id = $this->input->post('id_social');

            $titulo = $this->input->post('titulo');    

            $link = $this->input->post('link');    

            $data = array('upload_data' => $this->upload->data());         
             
            $icone = clear($data['upload_data']['file_name']);         
        
            if ($this->input->post('btn_publicar') == true) {
                $status = 1;
            } else {
                $status = 0;
             }
           
            if ($this->sociais_model->gravar_alteracoes($id, $titulo, $link, $icone, $status)) {
                $this->session->set_flashdata("alterar", "A página sociais foi atualizada com sucesso.");
                redirect(base_url('admin/sociais'));
            } else {
                echo "Erro ao cadastrar a página";
            }
        }
    }

    public function gravar_icone() {
       // $this->output->enable_profiler(TRUE);
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
            $id = $this->input->post('id_social');

            $data = array('upload_data' => $this->upload->data());            
            
            $icone = $data['upload_data']['file_name'];  

            $d = $this->sociais_model->detalheSocial($id);
            if (file_exists(base_url('assets/uploads/' . $d[0]->icone) && $d[0]->icone)) {
                unlink(base_url('assets/uploads/' . $d[0]->icone));
            }  

            if ($this->sociais_model->gravar_icone($id, $icone)) {
                $this->session->set_flashdata("success", "O ícone foi atualizado com sucesso.");
                redirect(base_url('admin/sociais/alterar_icone/' . $id));
            } else {
                echo "Erro ao cadastrar o ícone";
            }
        }
    }


    public function alterar_status() {
        $status = $this->input->post('status');
        $id = $this->input->post('id_social');
        return $this->sociais_model->alterar_social_status($id, $status);
    }

    public function deletar($id) {
        $data = $this->sociais_model->detalheSocial($id);
        if ($this->sociais_model->deletar($id)) {
            if (file_exists('assets/uploads/' . $data[0]->icone) && $data[0]->icone) {
                unlink('assets/uploads/' . $data[0]->icone);
            }
            $this->session->set_flashdata("deletar", "A rede social foi deletada com sucesso.");
            redirect(base_url('admin/sociais'));
        } else {
            echo "Erro ao excluir";
        }
    }
   


}
