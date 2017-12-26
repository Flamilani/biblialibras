<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Funciona extends CI_Controller {

    public function __construct() {
        parent::__construct();   
        $this->load->model('funciona_model');
        $this->load->model('users_model');

      if(!$this->session->userdata('logadmin')) {
            redirect(base_url('admin/login'));
        }
    }

    public function index() {    
        $user = (isset($this->session->userdata('admin')->id) ? $this->session->userdata('admin')->id : '');     
        $data_perfil['perfil'] = $this->users_model->exibir_Perfil($user);    
        $data['funciona'] = $this->funciona_model->admin_Funciona();
        $this->load->view('admin/inc/html-header');
        $this->load->view('admin/inc/header', $data_perfil);
        $this->load->view('admin/funciona', $data);
        $this->load->view('admin/inc/footer');
        $this->load->view('admin/inc/html-footer');

    }

      public function gravarFunciona() {
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

            $data = array('upload_data' => $this->upload->data());         
             
            $midia = $this->input->post('midia');

            if ($midia == 'imagem') {
                $imagem = clear($data['upload_data']['file_name']);    
            } else {
                $video = $this->input->post('video');
            }     

            $conteudo = $this->input->post('editor1');

            if ($this->input->post('btn_publicar') == true) {
                $status = 1;
            } else {
                $status = 0;
             }
           
            if ($this->funciona_model->adicionarFunciona($titulo, $conteudo, $midia, $imagem, $video, $status)) {
                $this->session->set_flashdata("success", "A página Funciona foi atualizada com sucesso.");
                redirect(base_url('admin/funciona'));
            } else {
                echo "Erro ao cadastrar a página";
            }
        }
    }

   public function gravar_alteracoes() {
        //$this->output->enable_profiler(TRUE);
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

            $id = $this->input->post('id_funciona');

            $titulo = $this->input->post('titulo');    

            $data = array('upload_data' => $this->upload->data());         
             
            $midia = $this->input->post('midia');

            if ($midia == 'imagem') {
                $imagem = clear($data['upload_data']['file_name']);    
            } else {
                $video = $this->input->post('video');
            }     

            $conteudo = $this->input->post('editor1');

            if ($this->input->post('btn_publicar') == true) {
                $status = 1;
            } else {
                $status = 0;
             }
           
            if ($this->funciona_model->gravar_alteracoes($id, $titulo, $conteudo, $midia, $imagem, $video, $status)) {
                $this->session->set_flashdata("success", "A página Funciona foi atualizada com sucesso.");
                redirect(base_url('admin/funciona'));
            } else {
                echo "Erro ao cadastrar a página";
            }
        }
    }
   


}
