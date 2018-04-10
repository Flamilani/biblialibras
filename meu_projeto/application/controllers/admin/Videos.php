<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Videos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("videos_model");
        $this->load->model("users_model");
        $this->load->helper('text');

         if(!$this->session->userdata('logadmin')) {
            redirect(base_url('admin/login'));
        }
    }

   public function index($id)	{ 
    $user = (isset($this->session->userdata('admin')->id) ? $this->session->userdata('admin')->id : '');    
        $data['perfil'] = $this->users_model->exibir_Perfil($user);    
           // $this->output->enable_profiler(TRUE);
           //$data['count_capitulos'] = $this->capitulos_model->countAdminCapitulos();   
            $data['videos'] = $this->videos_model->admin_Videos($id);    
            $data['count_livros'] = $this->livros_model->countAdminLivros();   
            $data['count_users'] = $this->users_model->countUsers();   
            $data['count_ativos'] = $this->users_model->countUsersAtivos();   
            $data['count_pedidos'] = $this->pedidos_model->countAdminPedidos();   
            $this->load->view('admin/inc/html-header');
            $this->load->view('admin/inc/header', $data);
            $this->load->view('admin/videos', $data);
            $this->load->view('admin/inc/footer');
            $this->load->view('admin/inc/html-footer');
	}

     public function alterar($id) {
        $user = (isset($this->session->userdata('admin')->id) ? $this->session->userdata('admin')->id : '');
        $data['perfil'] = $this->users_model->exibir_Perfil($user);    
        $data['livro'] = $this->capitulos_model->detalheVideo($id);
        $data['count_livros'] = $this->livros_model->countAdminLivros();   
        $data['count_users'] = $this->users_model->countUsers();   
        $data['count_ativos'] = $this->users_model->countUsersAtivos();   
        $data['count_pedidos'] = $this->pedidos_model->countAdminPedidos();   
        $this->load->view('admin/inc/html-header');
        $this->load->view('admin/inc/header', $data);
        $this->load->view('admin/alterar_video', $data);
        $this->load->view('admin/inc/footer');
        $this->load->view('admin/inc/html-footer');
    }

    public function alterar_imagem($id) {
        $user = (isset($this->session->userdata('admin')->id) ? $this->session->userdata('admin')->id : '');
        $data['perfil'] = $this->users_model->exibir_Perfil($user);    
        $data['livro'] = $this->capitulos_model->detalheLivro($id);
        $data['count_livros'] = $this->livros_model->countAdminLivros();   
        $data['count_users'] = $this->users_model->countUsers();   
        $data['count_ativos'] = $this->users_model->countUsersAtivos();   
        $data['count_pedidos'] = $this->pedidos_model->countAdminPedidos();   
        $this->load->view('admin/inc/html-header');
        $this->load->view('admin/inc/header', $data);
        $this->load->view('admin/alterar_imagem_livro', $data);
        $this->load->view('admin/inc/footer');
        $this->load->view('admin/inc/html-footer');
    }  

    public function gravarLivros() {
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
            $data = array('upload_data' => $this->upload->data());

            $titulo = $this->input->post('titulo');    

            $valor = $this->input->post('valor');         
            
            $imagem = clear($data['upload_data']['file_name']);          

            $conteudo = $this->input->post('editor1');

            $ordem = $this->input->post('ordem');

            if ($this->input->post('btn_publicar') == true) {
                $status = 1;
            } else {
                $status = 0;
            }
           
            if ($this->videos_model->adicionarVideo($titulo, $conteudo, $imagem, $valor, $status, $ordem)) {
                $this->session->set_flashdata("success", "O vídeo foi adicionado com sucesso.");
                redirect(base_url('admin/livros'));
            } else {
                echo "Erro ao cadastrar o vídeo";
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
            
            $imagem = clear($data['upload_data']['file_name']);  

            if (file_exists('assets/uploads/' . $data[0]->imagem) && $data[0]->imagem) {
                unlink('assets/uploads/' . $data[0]->imagem);
            }  

            if ($this->videos_model->gravar_imagem($id, $imagem)) {
                $this->session->set_flashdata("success", "A imagem foi atualizada com sucesso.");
                redirect(base_url('admin/livros/alterar_imagem/' . $id));
            } else {
                echo "Erro ao cadastrar a imagem";
            }
        }
    }

    public function adicionarVideo() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('titulo', 'Título', 'required');
        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
               $titulo = $this->input->post('titulo');    
                $conteudo = $this->input->post('editor1');
                $video = $this->input->post('video');       
                $id_livro = $this->input->post('id_livro');
                $ordem = $this->input->post('ordem');              

                if ($this->input->post('btn_publicar') == true) {
                    $status = 1;
                } else {
                    $status = 0;
                }

                if($this->videos_model->adicionar_video($titulo, $conteudo, $video, $id_livro, $status, $ordem)) {
                    $this->videos_model->adicionar_video_capitulo($id_capitulo, $id_livro, $status);
                    $this->session->set_flashdata("success", "O vídeo foi adicionado com sucesso.");
                redirect(base_url('admin/livros/videos/' . $id_livro));
                }

             else {
                $this->session->set_flashdata("error", "Erro ao adicionar.");
            }
        }
    }

 
        public function gravar_alteracoes() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('titulo', 'Título', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $id = $this->input->post('id_livro');
            $titulo = $this->input->post('titulo');
            $conteudo = $this->input->post('editor1');
            $valor = $this->input->post('valor');

            if ($this->input->post('btn_publicar') == true) {
                $status = 1;
            } else {
                $status = 0;
            }

            $ordem = $this->input->post('ordem');

            if ($this->videos_model->gravar_alteracoes($id, $titulo, $conteudo, $valor, $status, $ordem)) {
                $this->session->set_flashdata("success", "O livro foi alterado com sucesso.");
                redirect(base_url('admin/livros/alterar/' . $id));
            } else {
                echo "Erro ao alterar o livro";
            }
        }
    }

   
}