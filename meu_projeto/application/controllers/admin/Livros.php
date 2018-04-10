<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Livros extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("livros_model");
        $this->load->model("videos_model");
        $this->load->model("users_model");
        $this->load->model("pedidos_model");
        $this->load->model("plano_model");
        $this->load->helper('text');

         if(!$this->session->userdata('logadmin')) {
            redirect(base_url('admin/login'));
        }
    }

   public function index()	{ 
    $user = (isset($this->session->userdata('admin')->id) ? $this->session->userdata('admin')->id : '');    
            $data['perfil'] = $this->users_model->exibir_Perfil($user);    
       //  $this->output->enable_profiler(TRUE);
            $data['livros'] = $this->livros_model->admin_Livros();    
            $data['count_livros'] = $this->livros_model->countAdminLivros();   
            $data['count_users'] = $this->users_model->countUsers();   
            $data['count_ativos'] = $this->users_model->countUsersAtivos();   
            $data['count_pedidos'] = $this->pedidos_model->countAdminPedidos();  
            $data['count_assinaturas'] = $this->plano_model->countAdminAssinaturas();   
            $data['count_pagos'] = $this->plano_model->countAdminPagos();   
            $data['count_planos'] = $this->plano_model->countAdminPlanos();   
            $this->load->view('admin/inc/html-header');
            $this->load->view('admin/inc/header', $data);
            $this->load->view('admin/livros', $data);
            $this->load->view('admin/inc/footer');
            $this->load->view('admin/inc/html-footer');
	}

     public function videos($id)    { 
        $user = (isset($this->session->userdata('admin')->id) ? $this->session->userdata('admin')->id : '');  
            $data['perfil'] = $this->users_model->exibir_Perfil($user);    
            $data['count_capitulos'] = $this->videos_model->countAdminVideos($id);
            $data['count_videos'] = $this->videos_model->countAdminVideos_admin($id);
            $data['videos'] = $this->videos_model->admin_Videos($id);    
            $data['titulo_livro'] = $this->videos_model->titulo_livro_id($id);    
            $data['titulo_cap'] = $this->videos_model->titulo_capitulo_admin($id);    
            $data['count_livros'] = $this->livros_model->countAdminLivros();   
            $data['count_users'] = $this->users_model->countUsers();   
            $data['count_ativos'] = $this->users_model->countUsersAtivos();   
            $data['count_pedidos'] = $this->pedidos_model->countAdminPedidos();
            $data['count_assinaturas'] = $this->plano_model->countAdminAssinaturas();   
            $data['count_pagos'] = $this->plano_model->countAdminPagos();   
            $data['count_planos'] = $this->plano_model->countAdminPlanos();     
            $this->load->view('admin/inc/html-header');
            $this->load->view('admin/inc/header', $data);
            $this->load->view('admin/videos', $data);
            $this->load->view('admin/inc/footer');
            $this->load->view('admin/inc/html-footer');
    }

    public function capitulos($id) {
       // $this->output->enable_profiler(TRUE);
        $user = (isset($this->session->userdata('admin')->id) ? $this->session->userdata('admin')->id : '');  
        $data['perfil'] = $this->users_model->exibir_Perfil($user);    
        $data['capitulos'] = $this->videos_model->titulo_capitulo_home($id);
        $data['livro'] = $this->livros_model->detalheLivro($id);
        $data['count_videos'] = $this->videos_model->countAdminVideos_admin($id);
        $data['videos'] = $this->videos_model->video_capitulo($id);
        $data['count_livros'] = $this->livros_model->countAdminLivros();   
        $data['count_users'] = $this->users_model->countUsers();   
        $data['count_ativos'] = $this->users_model->countUsersAtivos();   
        $data['count_pedidos'] = $this->pedidos_model->countAdminPedidos();
        $data['count_assinaturas'] = $this->plano_model->countAdminAssinaturas();   
        $data['count_pagos'] = $this->plano_model->countAdminPagos();   
        $data['count_planos'] = $this->plano_model->countAdminPlanos();    
        $this->load->view('admin/inc/html-header');
        $this->load->view('admin/inc/header', $data);
        $this->load->view('admin/capitulos', $data);
        $this->load->view('admin/inc/footer');
        $this->load->view('admin/inc/html-footer');
    }

     public function alterar($id) {
        $user = (isset($this->session->userdata('admin')->id) ? $this->session->userdata('admin')->id : '');    
        $data['perfil'] = $this->users_model->exibir_Perfil($user);    
        $data['livro'] = $this->livros_model->detalheLivro($id);
        $data['count_livros'] = $this->livros_model->countAdminLivros();   
        $data['count_users'] = $this->users_model->countUsers();   
        $data['count_ativos'] = $this->users_model->countUsersAtivos();   
        $data['count_pedidos'] = $this->pedidos_model->countAdminPedidos();
        $data['count_assinaturas'] = $this->plano_model->countAdminAssinaturas();   
        $data['count_pagos'] = $this->plano_model->countAdminPagos();   
        $data['count_planos'] = $this->plano_model->countAdminPlanos();    
        $this->load->view('admin/inc/html-header');
        $this->load->view('admin/inc/header', $data);
        $this->load->view('admin/alterar_livro', $data);
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
        $data['count_assinaturas'] = $this->plano_model->countAdminAssinaturas();   
        $data['count_pagos'] = $this->plano_model->countAdminPagos();   
        $data['count_planos'] = $this->plano_model->countAdminPlanos();   
        $this->load->view('admin/inc/html-header');
        $this->load->view('admin/inc/header', $data);
        $this->load->view('admin/alterar_imagem_livro', $data);
        $this->load->view('admin/inc/footer');
        $this->load->view('admin/inc/html-footer');
    }  

    public function alterar_video($id) {
        $user = (isset($this->session->userdata('admin')->id) ? $this->session->userdata('admin')->id : '');     
        $data['perfil'] = $this->users_model->exibir_Perfil($user);    
        $data['video'] = $this->videos_model->detalheVideo($id);
        $data['count_livros'] = $this->livros_model->countAdminLivros();   
        $data['count_users'] = $this->users_model->countUsers();   
        $data['count_ativos'] = $this->users_model->countUsersAtivos();   
        $data['count_pedidos'] = $this->pedidos_model->countAdminPedidos(); 
        $data['count_assinaturas'] = $this->plano_model->countAdminAssinaturas();   
        $data['count_pagos'] = $this->plano_model->countAdminPagos();   
        $data['count_planos'] = $this->plano_model->countAdminPlanos();  
        $this->load->view('admin/inc/html-header');
        $this->load->view('admin/inc/header', $data);
        $this->load->view('admin/alterar_video', $data);
        $this->load->view('admin/inc/footer');
        $this->load->view('admin/inc/html-footer');
    }  

    public function alterar_video_id($id) {
        $user = (isset($this->session->userdata('admin')->id) ? $this->session->userdata('admin')->id : '');     
        $data['perfil'] = $this->users_model->exibir_Perfil($user);    
        $data['video'] = $this->videos_model->detalheVideo($id);
        $data['count_capitulos'] = $this->videos_model->countAdminVideos($id);
        $data['count_videos'] = $this->videos_model->video_livros_porID($id);
        $data['videos'] = $this->videos_model->admin_Videos($id);    
        $data['titulo_livro'] = $this->videos_model->titulo_livro_id($id);    
        $data['titulo_cap'] = $this->videos_model->titulo_capitulo_admin($id);  
        $data['count_livros'] = $this->livros_model->countAdminLivros();   
        $data['count_users'] = $this->users_model->countUsers();   
        $data['count_ativos'] = $this->users_model->countUsersAtivos();   
        $data['count_pedidos'] = $this->pedidos_model->countAdminPedidos();   
        $data['count_assinaturas'] = $this->plano_model->countAdminAssinaturas();   
        $data['count_pagos'] = $this->plano_model->countAdminPagos();   
        $data['count_planos'] = $this->plano_model->countAdminPlanos();  
        $this->load->view('admin/inc/html-header');
        $this->load->view('admin/inc/header', $data);
        $this->load->view('admin/alterar_video_id', $data);
        $this->load->view('admin/inc/footer');
        $this->load->view('admin/inc/html-footer');
    }  

    public function gravarLivros() {
       // $this->output->enable_profiler(TRUE);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('titulo', 'Título', 'required|min_length[3]');  
        $this->form_validation->set_rules('valor', 'Valor', 'required');  
        $this->form_validation->set_rules('ordem', 'Ordem', 'required|min_length[3]');  
        //$this->form_validation->set_rules('capitulos', 'Capítulos', 'required');  

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
            $sigla = $this->input->post('sigla');    
            $valor = str_replace(',' , '.' , $this->input->post('valor'));  
            $imagem = $data['upload_data']['file_name'];         
            $ordem = $this->input->post('ordem');
         //   $conteudo = $this->input->post('editor1');
          //  $capitulos = $this->input->post('capitulos');

            if ($this->input->post('btn_publicar') == true) {
                $status = 1;
            } else {
                $status = 0;
            }
           
            if ($this->livros_model->adicionarLivros($titulo, $sigla, $imagem, $valor, $status, $ordem)) {  
                $this->session->set_flashdata("success", "O livro foi adicionado com sucesso.");
                redirect(base_url('admin/livros'));
            } else {
                echo "Erro ao cadastrar o livro";
            }
        }
    }

        public function gravar_imagem() {
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
            $id = $this->input->post('id_livro');

            $data = array('upload_data' => $this->upload->data());            
            
            $imagem = $data['upload_data']['file_name'];  

            $d = $this->livros_model->detalheLivro($id);
            if (file_exists(base_url('assets/uploads/' . $d[0]->imagem) && $d[0]->imagem)) {
                unlink(base_url('assets/uploads/' . $d[0]->imagem));
            }  

            if ($this->livros_model->gravar_imagem($id, $imagem)) {
                $this->session->set_flashdata("success", "A imagem foi atualizada com sucesso.");
                redirect(base_url('admin/livros/alterar_imagem/' . $id));
            } else {
                echo "Erro ao cadastrar a imagem";
            }
        }
    }



     public function alterar_status() {
        $status = $this->input->post('status');
        $id = $this->input->post('id_livro');
        return $this->livros_model->alterar_livro_status($id, $status);
    }

    public function alterar_video_status() {
        $status = $this->input->post('status');
        $id = $this->input->post('id_video');
        return $this->videos_model->alterar_video_status($id, $status);
    }


    public function gravar_alteracoes() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('titulo', 'Título', 'trim|required');
        $this->form_validation->set_rules('valor', 'Valor', 'required');  
        $this->form_validation->set_rules('ordem', 'Ordem', 'required');  
       // $this->form_validation->set_rules('capitulos', 'Capítulos', 'required');  
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $id = $this->input->post('id_livro');
            $titulo = $this->input->post('titulo');
            $sigla = $this->input->post('sigla');
          //  $conteudo = $this->input->post('editor1');
            $valor = str_replace(',' , '.' , $this->input->post('valor'));        
            $ordem = $this->input->post('ordem');
         //   $capitulos = $this->input->post('capitulos');

            if ($this->input->post('btn_publicar') == true) {
                $status = 1;
            } else {
                $status = 0;
            }

          

            if ($this->livros_model->gravar_alteracoes($id, $titulo, $sigla, $valor, $status, $ordem)) {
                $this->session->set_flashdata("success", "O livro foi alterado com sucesso.");
                redirect(base_url('admin/livros/alterar/' . $id));
            } else {
                echo "Erro ao alterar o livro";
            }
        }
    }

     public function gravar_alteracoes_video() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('titulo', 'Título', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $id = $this->input->post('id_video');
            $titulo = $this->input->post('titulo');
            $id_capitulo = $this->input->post('id_capitulo');

            if ($this->input->post('btn_publicar') == true) {
                $status = 1;
            } else {
                $status = 0;
            }

            $ordem = $this->input->post('ordem');

            if ($this->videos_model->gravar_alteracoes_video($id, $titulo, $status, $ordem, $id_capitulo)) {
                $this->session->set_flashdata("success", "O vídeo foi alterado com sucesso.");
                redirect(base_url('admin/livros/alterar_video_id/' . $id));
            } else {
                echo "Erro ao alterar o vídeo";
            }
        }
    }

     public function gravar_video() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('video', 'Vídeo', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $id = $this->input->post('id_video');
            $video = $this->input->post('video');

            if ($this->videos_model->gravar_video($id, $video)) {
                $this->session->set_flashdata("success", "O vídeo foi alterado com sucesso.");
                redirect(base_url('admin/livros/alterar_video/' . $id));
            } else {
                echo "Erro ao alterar o vídeo";
            }
        }
    }

   public function add_capitulo() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('capitulo', 'Capítulo', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $capitulo = $this->input->post('capitulo');
            $livro = $this->input->post('livro'); 

            if ($this->livros_model->adicionarCapitulo($capitulo, $livro)) {
                $this->session->set_flashdata("success", "O capítulo foi adicionado com sucesso.");
                redirect(base_url('admin/livros/capitulos/' . $livro));
            } else {
                echo "Erro ao adicionar";
            }
        }
    }

       public function gravar_capitulo() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('id_video', 'id_video', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $id_capitulo = $this->input->post('id_capitulo'); 
            $livro = $this->input->post('id_livro'); 
            $video = $this->input->post('id_video');

            if ($this->videos_model->gravar_video_livro($id_video, $id_capitulo)) {          
                $this->session->set_flashdata("success", "O capítulo foi atualizado com sucesso.");
                redirect(base_url('admin/livros/capitulos/' . $livro));
            } else {
                echo "Erro ao gravar";
            }
        }
    }


    public function dados_capitulos(){
        
        $id_capitulo = $this->input->post("id_capitulo");        
        $consulta = $this->livros_model->dados_capitulos($id_capitulo);
        
        if ($consulta->num_rows() == 0) {
            die("Capítulo não encontrado");
        }
        
        $array_capitulos = array(        
            "id_capitulo" => $consulta->row()->id_capitulo,
            "id_livro" => $consulta->row()->id_livro            
        );        
    
        echo json_encode($array_capitulos);
        
    }   


    public function salvar() {

        $id_video = $this->input->post("id_video");
        $id_capitulo = $this->input->post("id_capitulo");
        
        $dados = array(        
            "id_capitulo" => $id_capitulo
        );
        
      
        if ($this->livros_model->salvar($id_video, $dados)) {
            $this->session->set_flashdata("video_sucesso", "O vídeo foi atualizado com sucesso.");
            echo 1;
        } else { 
            echo 0;
        }
    }

    public function deletar($id) {
        $data = $this->livros_model->detalheLivro($id);
        if ($this->livros_model->deletar($id)) {
            if (file_exists('assets/uploads/' . $data[0]->imagem) && $data[0]->imagem) {
                unlink('assets/uploads/' . $data[0]->imagem);
            }
            $this->session->set_flashdata("deletar", "O livro foi deletado com sucesso.");
            redirect(base_url('admin/livros'));
        } else {
            echo "Erro ao excluir o livro";
        }
    }

     public function deletar_video($id, $livro) {
        if ($this->livros_model->remover_video_capitulo($id)) {                    
            $this->session->set_flashdata("deletar_video", "O vídeo foi deletado com sucesso.");
            redirect(base_url('admin/livros/capitulos/' . $livro));
        } else {
            echo "Erro ao excluir o vídeo";
        }
    }

         public function deletar_capitulo($id, $livro) {
        if ($this->videos_model->deletarCapitulo($id)) { 
            $this->session->set_flashdata("deletar_capitulo", "O capitulo foi deletado com sucesso.");
            redirect(base_url('admin/livros/capitulos/' . $livro));
        } else {
            echo "Erro ao excluir o capítulo";
        }
    }


}