<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Livros extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("livros_model");
        $this->load->model("capitulos_model");

         if(!$this->session->userdata('logadmin')) {
            redirect(base_url('admin/login'));
        }
    }

   public function index()	{ 
         $this->output->enable_profiler(TRUE);

            $data['count_livros'] = $this->livros_model->countAdminLivros();   
            $data['livros'] = $this->livros_model->admin_Livros();    
            $this->load->view('admin/inc/html-header');
            $this->load->view('admin/inc/header');
            $this->load->view('admin/livros', $data);
            $this->load->view('admin/inc/footer');
            $this->load->view('admin/inc/html-footer');
	}

     public function capitulos($id)    { 
           // $this->output->enable_profiler(TRUE);
            $data['count_capitulos'] = $this->capitulos_model->countAdminCapitulos($id);
            $data['capitulos'] = $this->capitulos_model->admin_Capitulos($id);    
            $data['titulo_livro'] = $this->capitulos_model->titulo_livro_id($id);    
            $this->load->view('admin/inc/html-header');
            $this->load->view('admin/inc/header');
            $this->load->view('admin/capitulos', $data);
            $this->load->view('admin/inc/footer');
            $this->load->view('admin/inc/html-footer');
    }

     public function alterar($id) {
        $data['livro'] = $this->livros_model->detalheLivro($id);
        $this->load->view('admin/inc/html-header');
        $this->load->view('admin/inc/header');
        $this->load->view('admin/alterar_livro', $data);
        $this->load->view('admin/inc/footer');
        $this->load->view('admin/inc/html-footer');
    }

    public function alterar_imagem($id) {
        $data['livro'] = $this->livros_model->detalheLivro($id);
        $this->load->view('admin/inc/html-header');
        $this->load->view('admin/inc/header');
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
            $imagem = $data['upload_data']['file_name'];         
            $conteudo = $this->input->post('editor1');
            $ordem = $this->input->post('ordem');

            if ($this->input->post('btn_publicar') == true) {
                $status = 1;
            } else {
                $status = 0;
            }
           
            if ($this->livros_model->adicionarLivros($titulo, $conteudo, $imagem, $valor, $status, $ordem)) {  
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

    public function adicionarCapitulo() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('titulo', 'Capítulo', 'required');
        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
               $capitulo = $this->input->post('titulo');    
                $conteudo = $this->input->post('editor1');
                $video = $this->input->post('video');       
                $id_livro = $this->input->post('id_livro');
                $ordem = $this->input->post('ordem');

                if ($this->input->post('btn_publicar') == true) {
                    $status = 1;
                } else {
                    $status = 0;
                }

                if($this->capitulos_model->adicionar_capitulo($capitulo, $conteudo, $video, $id_livro, $status, $ordem)) {
                    $this->session->set_flashdata("success", "O capítulo foi adicionado com sucesso.");
                    $dados['user_nome'] = $this->input->post('user_nome');
                    $dados['user_email'] = $this->input->post('user_email');
                redirect(base_url('admin/livros/capitulos/' . $id_livro));
                    // $this->enviar_email_confirmacao($dados);
                    // $this->envio();
                }

             else {
                $this->session->set_flashdata("error", "Erro ao adicionar.");
            }
        }
    }


     public function alterar_status() {
        $status = $this->input->post('status');
        $id = $this->input->post('id_livro');
        return $this->livros_model->alterar_livro_status($id, $status);
    }

    public function alterar_status_cap() {
        $status = $this->input->post('status');
        $id = $this->input->post('id_capitulo');
        return $this->capitulos_model->alterar_capitulo_status($id, $status);
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

            if ($this->livros_model->gravar_alteracoes($id, $titulo, $conteudo, $valor, $status, $ordem)) {
                $this->session->set_flashdata("success", "O livro foi alterado com sucesso.");
                redirect(base_url('admin/livros/alterar/' . $id));
            } else {
                echo "Erro ao alterar o livro";
            }
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

}