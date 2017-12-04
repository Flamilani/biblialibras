<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("users_model");        
    }

    public function alterar($id) {
        $data['livro'] = $this->users_model->detalheUser($id);
        $this->load->view('admin/inc/html-header');
        $this->load->view('admin/inc/header');
        $this->load->view('admin/alterar_usuario', $data);
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

    public function gravarUsers() {
       // $this->output->enable_profiler(TRUE);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nome', 'Nome', 'required|min_length[3]');  

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

     public function registrar() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nome', 'Nome', 'required|min_length[2]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $dados['nome'] = $this->input->post('nome');
            $dados['email'] = $this->input->post('email');
            $dados['senha'] = $this->input->post('senha');
            $dados['celular'] = $this->input->post('celular');
            if ($this->users_model->registrar($dados)) {
                $this->enviar_email_confirmacao($dados);
                $this->envio();
            } else {
               $this->session->set_flashdata("error", "Erro ao assinar.");
            }
        }
    }

     public function envio() {
        $this->load->library('email');

        // Check for validation
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|xss_clean');
        $this->form_validation->set_rules('sobrenome', 'Sobrenome', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('celular', 'Celular', 'trim|required|xss_clean');
        $this->form_validation->set_rules('senha', 'Senha', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('inc/html-header');
            $this->load->view('inc/header');
            $this->load->view('home');
            $this->load->view('inc/footer');
            $this->load->view('inc/html-footer');
        } else {

            // Storing submitted values

            $nome = $this->input->post('nome');
            $sobrenome = $this->input->post('sobrenome');            
            $receiver_email = $this->input->post('email');
            $celular = $this->input->post('celular');
            
            $assunto = 'Assinatura da Bíblia em Libras';

            $sender_email = 'flaviomilani83@gmail.com';

            // Load email library and passing configured values to email library 
            $this->email->set_newline("\r\n");

            // Sender email address
            $this->email->from($sender_email, $nome);
            // Receiver email address
            $this->email->to($receiver_email);
            // Subject of email
            $this->email->subject($assunto);
            // Message in email
            // $this->email->message($mensagem);

            $body = '<table style="padding: 5px; border: 1px solid #000;" cellspacing="0">' .
                    '<caption>' . $assunto . '</caption>' .
                    '<tr><td><b>Nome</b></td><td>' . $nome . ' ' . $sobrenome . '</td></tr>' .                  
                    '<tr><td><b>Celular</b></td><td>' . $celular . '</td></tr>' .                   
                    '<tr><td><b>E-mail</b></td><td>' . $receiver_email . '</td></tr>' .                  
                    '</table>';

            $this->email->message($body);

            if ($this->email->send()) {
                $data['message_display'] = 'Assinatura foi efetuada com sucesso.';
            } else {
                $data['message_display'] = '<p class="error_msg">Erro ao enviar</p>';
                print_r($this->email->print_debugger());
            }
//            $this->load->view('inc/html-header');
//            $this->load->view('inc/header');
//            $this->load->view('registro_enviado', $data);
//            $this->load->view('inc/footer');
//            $this->load->view('inc/html-footer');
        }
    }   

    public function enviar_email_confirmacao($dados) {
        $mensagem = $this->load->view('emails/confirmar_assinatura', $dados, TRUE);
        $this->load->library('email');
        $this->email->from("flaviomilani83@gmail.com", $dados['nome']);
        $this->email->to($dados['email']);
        $this->email->subject(utf8_decode("Confirme seu registro - RSB"));
        $this->email->message($mensagem);
        if ($this->email->send()) {
            $this->load->view('inc/html-header');
            $this->load->view('inc/header');
            $this->load->view('registro_enviado');
            $this->load->view('inc/footer');
            $this->load->view('inc/html-footer');
        } else {
            print_r($this->email->print_debugger());
        }
    }

    public function confirmar($hashEmail) {
        $dados['status'] = 1;
        $this->db->where('md5(email)', $hashEmail);
        if ($this->db->update('users', $dados)) {
            $this->load->view('inc/html-header');
            $this->load->view('inc/header');
            $this->load->view('registro_liberado');
            $this->load->view('inc/footer');
            $this->load->view('inc/html-footer');
        } else {
            echo "Houve um erro ao cofirmar seu registro";
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
        return $this->videos_model->alterar_capitulo_status($id, $status);
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