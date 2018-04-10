<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Relato extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('funciona_model');
        $this->load->model('users_model');
        $this->load->model('livros_model');
        $this->load->model('pedidos_model');
        $this->load->model('plano_model');
        $this->load->model('relato_model');

        if(!$this->session->userdata('logadmin')) {
            redirect(base_url('admin/login'));
        }
    }

    public function index() {
        $user = (isset($this->session->userdata('admin')->id) ? $this->session->userdata('admin')->id : '');
        $data['perfil'] = $this->users_model->exibir_Perfil($user);
        $data['relatos'] = $this->relato_model->admin_Relato();
        $data['count_livros'] = $this->livros_model->countAdminLivros();
        $data['count_users'] = $this->users_model->countUsers();
        $data['count_ativos'] = $this->users_model->countUsersAtivos();
        $data['count_pedidos'] = $this->pedidos_model->countAdminPedidos();
        $data['count_assinaturas'] = $this->plano_model->countAdminAssinaturas();
        $data['count_pagos'] = $this->plano_model->countAdminPagos();
        $data['count_planos'] = $this->plano_model->countAdminPlanos();
        $data['count_relatos'] = $this->relato_model->countAdminRelatos();
        $data['count_dependentes'] = $this->relato_model->dependentes();
        $data['count_resolvidos'] = $this->relato_model->resolvidos();
        $this->load->view('admin/inc/html-header');
        $this->load->view('admin/inc/header', $data);
        $this->load->view('admin/relato', $data);
        $this->load->view('admin/inc/footer');
        $this->load->view('admin/inc/html-footer');

    }

    public function alterar_imagem($id) {
        $user = (isset($this->session->userdata('admin')->id) ? $this->session->userdata('admin')->id : '');
        $data['perfil'] = $this->users_model->exibir_Perfil($user);
        $data['relato'] = $this->relato_model->detalheRelato($id);
        $data['count_livros'] = $this->livros_model->countAdminLivros();
        $data['count_users'] = $this->users_model->countUsers();
        $data['count_ativos'] = $this->users_model->countUsersAtivos();
        $data['count_pedidos'] = $this->pedidos_model->countAdminPedidos();
        $data['count_assinaturas'] = $this->plano_model->countAdminAssinaturas();
        $data['count_pagos'] = $this->plano_model->countAdminPagos();
        $data['count_planos'] = $this->plano_model->countAdminPlanos();
        $data['count_relatos'] = $this->relato_model->countAdminRelatos();
        $this->load->view('admin/inc/html-header');
        $this->load->view('admin/inc/header', $data);
        $this->load->view('admin/alterar_imagem_relato', $data);
        $this->load->view('admin/inc/footer');
        $this->load->view('admin/inc/html-footer');

    }

    public function alterar($id) {
        $user = (isset($this->session->userdata('admin')->id) ? $this->session->userdata('admin')->id : '');
        $data['perfil'] = $this->users_model->exibir_Perfil($user);
        $data['relato'] = $this->relato_model->detalheRelato($id);
        $data['count_livros'] = $this->livros_model->countAdminLivros();
        $data['count_users'] = $this->users_model->countUsers();
        $data['count_ativos'] = $this->users_model->countUsersAtivos();
        $data['count_pedidos'] = $this->pedidos_model->countAdminPedidos();
        $data['count_assinaturas'] = $this->plano_model->countAdminAssinaturas();
        $data['count_pagos'] = $this->plano_model->countAdminPagos();
        $data['count_planos'] = $this->plano_model->countAdminPlanos();
        $data['count_relatos'] = $this->relato_model->countAdminRelatos();
        $this->load->view('admin/inc/html-header');
        $this->load->view('admin/inc/header', $data);
        $this->load->view('admin/alterar_relato', $data);
        $this->load->view('admin/inc/footer');
        $this->load->view('admin/inc/html-footer');

    }

    public function gravarRelato() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('titulo', 'Título', 'required|min_length[3]');

        $path = "assets/relatos";

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

            $imagem = $data['upload_data']['file_name'];

            $conteudo = $this->input->post('editor1');

            $tipo = $this->input->post('tipo');

            $nivel = $this->input->post('nivel');

            $link = $this->input->post('link');

            $status = $this->input->post('status');

            if ($this->relato_model->adicionarRelato($titulo, $conteudo, $imagem, $tipo, $nivel, $link, $status)) {
                $this->session->set_flashdata("success", "Relato foi inserido com sucesso.");
                redirect(base_url('admin/relato'));
            } else {
                echo "Erro ao cadastrar";
            }
        }
    }

    public function gravar_alteracoes() {
        //$this->output->enable_profiler(TRUE);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('titulo', 'Título', 'required|min_length[3]');

        $path = "assets/relatos";

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

            $id = $this->input->post('id_relato');

            $titulo = $this->input->post('titulo');

            $data = array('upload_data' => $this->upload->data());

            $imagem = clear($data['upload_data']['file_name']);

            $conteudo = $this->input->post('editor1');

            $tipo = $this->input->post('tipo');

            $nivel = $this->input->post('nivel');

            $link = $this->input->post('link');

            if ($this->relato_model->gravar_alteracoes($id, $titulo, $conteudo, $tipo, $nivel, $link)) {
                $this->session->set_flashdata("atualizar", "Relato foi atualizado com sucesso.");
                redirect(base_url('admin/relato'));
            } else {
                echo "Erro ao atualizar";
            }
        }
    }

    public function alterar_status() {
        $status = $this->input->post('status');
        $id = $this->input->post('id_relato');
        return $this->relato_model->alterar_relato_status($id, $status);
    }

    public function deletar($id) {
        $data = $this->relato_model->detalheRelato($id);
        if ($this->relato_model->deletar($id)) {
            if (file_exists('assets/relatos/' . $data[0]->imagem) && $data[0]->imagem) {
                unlink('assets/relatos/' . $data[0]->imagem);
            }
            $this->session->set_flashdata("deletar", "O relato foi deletado com sucesso.");
            redirect(base_url('admin/relato'));
        } else {
            echo "Erro ao excluir";
        }
    }

    public function gravar_imagem() {
        // $this->output->enable_profiler(TRUE);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('titulo', 'Título', 'required|min_length[3]');

        $path = "assets/relatos";

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
            $id = $this->input->post('id_relato');

            $data = array('upload_data' => $this->upload->data());

            $imagem = $data['upload_data']['file_name'];

            $d = $this->relato_model->detalheRelato($id);
            if (file_exists(base_url('assets/relatos/' . $d[0]->imagem) && $d[0]->imagem)) {
                unlink(base_url('assets/relatos/' . $d[0]->imagem));
            }

            if ($this->relato_model->gravar_imagem($id, $imagem)) {
                $this->session->set_flashdata("success", "A imagem foi atualizada com sucesso.");
                redirect(base_url('admin/relato/alterar_imagem/' . $id));
            } else {
                echo "Erro ao cadastrar a imagem";
            }
        }
    }



}
