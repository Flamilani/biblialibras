<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("users_model");

         if(!$this->session->userdata('logadmin')) {
            redirect(base_url('admin/login'));
        }
    }

   public function index()	{ 
    $user = (isset($this->session->userdata('admin')->id) ? $this->session->userdata('admin')->id : '');    
        $data_perfil['perfil'] = $this->users_model->exibir_Perfil($user);    
        // $this->output->enable_profiler(TRUE);
            $data['count_users'] = $this->users_model->countUsers();   
            $data['users'] = $this->users_model->lista_Users();    
            $this->load->view('admin/inc/html-header');
            $this->load->view('admin/inc/header', $data_perfil);
            $this->load->view('admin/usuarios', $data);
            $this->load->view('admin/inc/footer');
            $this->load->view('admin/inc/html-footer');
	}

     public function perfil($id)    { 
        $user = (isset($this->session->userdata('admin')->id) ? $this->session->userdata('admin')->id : '');    
        $data_perfil['perfil'] = $this->users_model->exibir_Perfil($user);    
           // $this->output->enable_profiler(TRUE);
            $data['perfil'] = $this->users_model->exibir_Perfil($id);    
            $this->load->view('admin/inc/html-header');
            $this->load->view('admin/inc/header', $data_perfil);
            $this->load->view('admin/perfil', $data);
            $this->load->view('admin/inc/footer');
            $this->load->view('admin/inc/html-footer');
    }

     public function alterar_senha($id) {
        $user = (isset($this->session->userdata('admin')->id) ? $this->session->userdata('admin')->id : '');    
        $data_perfil['perfil'] = $this->users_model->exibir_Perfil($user);    
        $data['perfil'] = $this->users_model->exibir_Perfil($id);
        $this->load->view('admin/inc/html-header');
        $this->load->view('admin/inc/header', $data_perfil);
        $this->load->view('admin/alterar_senha', $data);
        $this->load->view('admin/inc/footer');
        $this->load->view('admin/inc/html-footer');
    }

    public function alterar_imagem($id) {
        $user = (isset($this->session->userdata('admin')->id) ? $this->session->userdata('admin')->id : '');    
        $data_perfil['perfil'] = $this->users_model->exibir_Perfil($user);    
        $data['livro'] = $this->livros_model->detalheLivro($id);
        $this->load->view('admin/inc/html-header');
        $this->load->view('admin/inc/header', $data_perfil);
        $this->load->view('admin/alterar_imagem_livro', $data);
        $this->load->view('admin/inc/footer');
        $this->load->view('admin/inc/html-footer');
    }  

       public function adicionarUsuario() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nome', 'Nome', 'required|min_length[2]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('cpf', 'CPF', 'required|is_unique[users.cpf]');  
        if ($this->form_validation->run() == FALSE) {
             $this->index();
        } else {
            $dados['nome'] = $this->input->post('nome');
            $dados['sobrenome'] = $this->input->post('sobrenome');
            $dados['email'] = $this->input->post('email');
            $dados['senha'] = $this->input->post('senha');
            $dados['telefone'] = $this->input->post('telefone');
            $dados['celular'] = $this->input->post('celular');
            $dados['data_nasc'] = $this->input->post('data_nasc');
            $dados['cpf'] = $this->input->post('cpf');
            $dados['tipo'] = $this->input->post('tipo');
            $dados['endereco'] = $this->input->post('endereco');
            $dados['numero'] = $this->input->post('numero');
            $dados['compl'] = $this->input->post('compl');
            $dados['bairro'] = $this->input->post('bairro');
            $dados['cidade'] = $this->input->post('cidade');
            $dados['estado'] = $this->input->post('estado');
            $dados['cep'] = $this->input->post('cep');
            $dados['perfil_so'] = $this->input->post('perfil_so');
            $dados['escolaridade'] = $this->input->post('escolaridade');
            $dados['igreja'] = $this->input->post('igreja');
            $dados['funcao'] = $this->input->post('funcao');
            $dados['saber'] = $this->input->post('saber');

             if ($this->input->post('btn_publicar') == true) {
                    $dados['status'] = 1;
                } else {
                    $dados['status'] = 0;
                }

            if ($this->users_model->registrar($dados)) {
                $this->session->set_flashdata("success", "O usuário foi adicionado com sucesso.");
                redirect(base_url('admin/usuarios'));
            } else {
                echo "Erro ao cadastrar";
            }
        }
    }

    public function assinar() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nome', 'Nome', 'required');
        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
               $nome = $this->input->post('nome');    
                $email = $this->input->post('email');
                $senha = md5($this->input->post('senha'));       
                $telefone = $this->input->post('telefone');
                $celular = $this->input->post('celular');
                $data_nasc = $this->input->post('data_nasc');
                $cpf = $this->input->post('cpf');

                if ($this->input->post('btn_publicar') == true) {
                    $status = 1;
                } else {
                    $status = 0;
                }

            if($this->users_model->adicionarUsers($nome, $email, $senha, $telefone, $celular, $data_nasc)) {
                    $this->session->set_flashdata("success", "O capítulo foi adicionado com sucesso.");
                    $dados['user_nome'] = $this->input->post('user_nome');
                    $dados['user_email'] = $this->input->post('user_email');
                redirect(base_url('admin/home/capitulos/' . $id_livro));
                    // $this->enviar_email_confirmacao($dados);
                    // $this->envio();
                }

                if ($this->registro_model->registrar($dados)) {
                $this->enviar_email_confirmacao($dados);
                $this->envio();
            }  else {
                $this->session->set_flashdata("error", "Erro ao adicionar.");
            }
        }
    }

     public function alterar_user_status() {
        $status = $this->input->post('status');
        $id = $this->input->post('id');
        return $this->users_model->alterar_user_status($id, $status);
    }

    public function alterar_senha_user() {
        $senha = $this->input->post('confsenha');
        $id = $this->input->post('id');

        if ($this->users_model->alterar_senha($id, $senha)) {
                $this->session->set_flashdata("senha_alterada", "A senha foi alterada com sucesso.");
                redirect(base_url('admin/usuarios/perfil/' . $id));
            } else {
                echo "Erro ao alterar";
            }
    }


    public function gravar_alteracoes() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $id = $this->input->post('id');
            $dados['nome'] = $this->input->post('nome');
            $dados['sobrenome'] = $this->input->post('sobrenome');
            $dados['email'] = $this->input->post('email');
            $dados['senha'] = $this->input->post('senha');
            $dados['telefone'] = $this->input->post('telefone');
            $dados['celular'] = $this->input->post('celular');
            $dados['data_nasc'] = $this->input->post('data_nasc');
            $dados['cpf'] = $this->input->post('cpf');
            $dados['tipo'] = $this->input->post('tipo');
            $dados['endereco'] = $this->input->post('endereco');
            $dados['numero'] = $this->input->post('numero');
            $dados['compl'] = $this->input->post('compl');
            $dados['bairro'] = $this->input->post('bairro');
            $dados['cidade'] = $this->input->post('cidade');
            $dados['estado'] = $this->input->post('estado');
            $dados['cep'] = $this->input->post('cep');
            $dados['perfil_so'] = $this->input->post('perfil_so');
            $dados['escolaridade'] = $this->input->post('escolaridade');
            $dados['igreja'] = $this->input->post('igreja');
            $dados['funcao'] = $this->input->post('funcao');
            $dados['saber'] = $this->input->post('saber');

             if ($this->input->post('btn_publicar') == true) {
                    $dados['status'] = 1;
                } else {
                    $dados['status'] = 0;
                }

            if ($this->users_model->gravar_alteracoes($id, $dados)) {
                $this->session->set_flashdata("success", "O usuário foi alterado com sucesso.");
                redirect(base_url('admin/usuarios/perfil/' . $id));
            } else {
                echo "Erro ao alterar";
            }
        }
    }

    public function deletar($id) {
     
        if ($this->users_model->deletar($id)) {
            $this->session->set_flashdata("deletar", "O usuário foi deletado com sucesso.");
            redirect(base_url('admin/usuarios'));
        } else {
            echo "Erro ao excluir o usuário";
        }
    }

}