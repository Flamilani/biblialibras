<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sobre extends CI_Controller {

    public function __construct() {
        parent::__construct();   
        $this->load->model('sobre_model');

      if(!$this->session->userdata('logadmin')) {
            redirect(base_url('admin/login'));
        }
    }

    public function index() {    
        $data['sobre'] = $this->sobre_model->admin_Sobre();
        $this->load->view('admin/inc/html-header');
        $this->load->view('admin/inc/header');
        $this->load->view('admin/sobre', $data);
        $this->load->view('admin/inc/footer');
        $this->load->view('admin/inc/html-footer');

    }

        public function gravarSobre() {
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
            'max_size' => '1024'
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

            $dados['titulo'] = $this->input->post('titulo');    

            $data = array('upload_data' => $this->upload->data());         
             
            $midia = $this->input->post('midia');

            if ($midia == 'imagem') {
                $dados['imagem'] = clear($data['upload_data']['file_name']);    
            } else {
                $dados['video'] = $this->input->post('video');
            }     

            $dados['conteudo'] = $this->input->post('editor1');

            if ($this->input->post('btn_publicar') == true) {
                $dados['status'] = 1;
            } else {
                $dados['status'] = 0;
            }
           
            if ($this->sobre_model->adicionar($dados)) {
                $this->session->set_flashdata("success", "A página Sobre foi atualizada com sucesso.");
                redirect(base_url('admin/sobre'));
            } else {
                echo "Erro ao cadastrar a página";
            }
        }
    }



}
