<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Funciona extends CI_Controller {

    public function __construct() {
        parent::__construct();   
        $this->load->model('funciona_model');

      if(!$this->session->userdata('logadmin')) {
            redirect(base_url('admin/login'));
        }
    }

    public function index() {    
        $data['funciona'] = $this->funciona_model->admin_Funciona();
        $this->load->view('admin/inc/html-header');
        $this->load->view('admin/inc/header');
        $this->load->view('admin/funciona', $data);
        $this->load->view('admin/inc/footer');
        $this->load->view('admin/inc/html-footer');

    }

     public function gravarFunciona() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('titulo', 'Título', 'required');
        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
               $titulo = $this->input->post('titulo');    
                $conteudo = $this->input->post('conteudo');

                if ($this->input->post('btn_publicar') == true) {
                    $status = 1;
                } else {
                    $status = 0;
                }

                if($this->funciona_model->adicionarFunciona($titulo, $conteudo, $status)) {
                $this->session->set_flashdata("success", "O conteúdo Funciona foi adicionado com sucesso.");
                redirect(base_url('admin/funciona'));
                }

             else {
                $this->session->set_flashdata("error", "Erro ao adicionar.");
            }
        }
    }

     public function gravar_alteracoes() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('titulo', 'Título', 'required');
        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
              $id = $this->input->post('id_funciona');
               $titulo = $this->input->post('titulo');    
                $conteudo = $this->input->post('conteudo');

                if ($this->input->post('btn_publicar') == true) {
                    $status = 1;
                } else {
                    $status = 0;
                }

                if($this->funciona_model->gravar_alteracoes($id, $titulo, $conteudo, $status)) {
                $this->session->set_flashdata("success", "O conteúdo Funciona foi atualizado com sucesso.");
                redirect(base_url('admin/funciona'));
                }

             else {
                $this->session->set_flashdata("error", "Erro ao adicionar.");
            }
        }
    } 
   


}
