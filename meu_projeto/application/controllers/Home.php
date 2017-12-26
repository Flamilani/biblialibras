<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("inicial_model");
        $this->load->model("livros_model");
        $this->load->model("videos_model");
        $this->load->model("sobre_model");
        $this->load->model("funciona_model");
        $this->load->library('cart');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('encrypt');
        
    }

    public function index()
    {
        $data_home['inicial'] = $this->inicial_model->home_Inicial();
        $data_livros['lista_livros'] = $this->livros_model->home_Livros();
        $data_livros['count_livros'] = $this->livros_model->countLivros();  
        $data_sobre['sobre'] = $this->sobre_model->home_Sobre();    
        $data_funciona['funciona'] = $this->funciona_model->home_Funciona();    
        $this->load->view('inc/html-header');
        $this->load->view('inc/header');        
        $this->load->view('modals/modals');
        $this->load->view('home', $data_home);
       // $this->load->view('banner');
        $this->load->view('livros', $data_livros);
        $this->load->view('sobre', $data_sobre);
        $this->load->view('funciona', $data_funciona);    
       // $this->load->view('contato');
        $this->load->view('inc/footer');
        $this->load->view('inc/html-footer');
    }

    public function livro($id) {
        $data['capitulos_livros_id'] = $this->livros_model->capitulos_livros_id($id);       
       // $data['lista_videos'] = $this->videos_model->video_livros_id($id); 
        $data['lista_livros'] = $this->livros_model->home_Livros();
        $data['livros_rand'] = $this->livros_model->livros_rand();
        $data['livro'] = $this->livros_model->livro_id($id);
        $data['titulo_capitulo'] = $this->videos_model->titulo_capitulo_home($id);
    if (count($data['livro']) > 0) {
        $this->load->view('inc/html-header');
        $this->load->view('inc/header');
        $this->load->view('livro', $data);
        $this->load->view('inc/footer');
        $this->load->view('inc/html-footer');
    } else {
        $this->session->set_flashdata("error", "Este livro ainda não está completo. Em breve...");
        redirect(base_url('home/livros'));
    }
    }

    public function livros() {
        $data_livros['capitulos_livros'] = $this->livros_model->capitulos_livros();    
        $data_livros['lista_livros'] = $this->livros_model->home_Livros();
        $data_livros['count_livros'] = $this->livros_model->countLivros();   
        $this->load->view('inc/html-header');
        $this->load->view('inc/header');
        $this->load->view('livros', $data_livros);
        $this->load->view('inc/footer');
        $this->load->view('inc/html-footer');
    }


    public function assinatura() {
        $this->load->view('inc/html-header');
        $this->load->view('inc/header');
        $this->load->view('assinatura');
        $this->load->view('inc/footer');
        $this->load->view('inc/html-footer');
    }

    public function sobre() {
        $data_sobre['sobre'] = $this->sobre_model->home_Sobre();    
        $this->load->view('inc/html-header');
        $this->load->view('inc/header');
        $this->load->view('sobre', $data_sobre);
        $this->load->view('inc/footer');
        $this->load->view('inc/html-footer');
    }

    public function funciona() {
        $data_funciona['funciona'] = $this->funciona_model->home_Funciona();    
        $this->load->view('inc/html-header');
        $this->load->view('inc/header');
        $this->load->view('funciona', $data_funciona);
        $this->load->view('inc/footer');
        $this->load->view('inc/html-footer');
    }

    public function contato() {
        $this->load->view('inc/html-header');
        $this->load->view('inc/header');
        $this->load->view('contato');
        $this->load->view('inc/footer');
        $this->load->view('inc/html-footer');
    }

    public function meu_carrinho() {
        $this->load->view('inc/html-header');
        $this->load->view('inc/header');
        $this->load->view('meu_carrinho');
        $this->load->view('inc/footer');
        $this->load->view('inc/html-footer');
    }

    public function finalizar() {
      /*   if(!$this->session->userdata('logado')) {
            redirect(base_url('home'));
        }*/
        $data['dados'] = $this->livros_model->dadosBancarios();    
        $this->load->view('inc/html-header');
        $this->load->view('inc/header');
        $this->load->view('finalizar',$data);
        $this->load->view('inc/footer');
        $this->load->view('inc/html-footer');
    }


    public function pagamento_realizado() {
         if(!$this->session->userdata('logado')) {
            redirect(base_url('home'));
        }
        $this->cart->destroy();
        $this->load->view('inc/html-header');
        $this->load->view('inc/header');
        $this->load->view('pagamento_realizado');
        $this->load->view('inc/footer');
        $this->load->view('inc/html-footer');
    }


    
    public function login() {
        $this->load->view('inc/html-header');
        $this->load->view('inc/header');
        $this->load->view('login');
        $this->load->view('inc/footer');
        $this->load->view('inc/html-footer');
    }

    public function construcao()
    {
        $this->load->view('inc/html-header');
        $this->load->view('inc/header');    
        $this->load->view('construcao');       
        $this->load->view('inc/footer');
        $this->load->view('inc/html-footer');
    }

    public function users()
    {
        $this->load->view('inc/html-header');
        $this->load->view('inc/header');
        $this->load->view('users');
        $this->load->view('inc/footer');
        $this->load->view('inc/html-footer');
    }

    public function error404()
    {
        $this->load->view('inc/html-header');
        $this->load->view('inc/header');
        $this->load->view('errors/error404');
        $this->load->view('inc/footer');
        $this->load->view('inc/html-footer');

    }

    public function finalizar_compra() {
        if(null != $this->session->userdata('logado')) {
            if($this->input->post('tipo_pagamento') == 'deposito') {
                $dados['id_user'] = $this->session->userdata('user')->id;
                $dados['produtos'] = $this->cart->total();
                $dados['status'] = 0;
                $this->db->insert('pedidos', $dados);
                $pedido = $this->db->insert_id();

                foreach ($this->cart->contents() as $item) {
                    $dados_item['id_pedido'] = $pedido;
                    $dados_item['id_livro'] = $item['id'];
                    $dados_item['quantidade'] = $item['qty'];
                    $dados_item['preco'] = $item['price'];
                    $this->db->insert('itens_pedidos', $dados_item);
                }
            } else {
                redirect(base_url('pagar_finalizar_compra'));
            }
        } else {
            redirect(base_url('home/login'));
        }
    }

    public function envio() {
        $this->load->library('email');

        // Check for validation
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('celular', 'Celular', 'trim|required');
        $this->form_validation->set_rules('assunto', 'Assunto', 'trim|required');
        $this->form_validation->set_rules('mensagem', 'mensagem', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('inc/html-header');
            $this->load->view('inc/header');
            $this->load->view('contato');
            $this->load->view('inc/footer');
            $this->load->view('inc/html-footer');
        } else {

            // Storing submitted values

            $nome = $this->input->post('nome');
            $receiver_email = $this->input->post('email');
            $celular = $this->input->post('celular');
            $assunto = $this->input->post('assunto');
            $mensagem = $this->input->post('mensagem');

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

            $body = '<h3>' . $assunto . '</h3>' .
                    '<p>' . $nome . '</p>' .
                    '<p>' . $receiver_email . '</p>' .
                    '<p>' . $celular . '</p>' .
                    '<p>' . $mensagem . '</p>';

            $this->email->message($body);

            if ($this->email->send()) {                
                $this->session->set_flashdata("success", "Sua mensagem foi enviada com sucesso.");
            } else {                
                $this->session->set_flashdata("error", "Erro ao enviar.");
                print_r($this->email->print_debugger());
            }
            redirect(base_url('home/contato'));
        }
    }  

    public function logar() {        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('user_email', 'Email', 'required|min_length[5]');
        $this->form_validation->set_rules('user_senha', 'Senha', 'required|min_length[6]');
        if ($this->form_validation->run() == FALSE) {           
            $this->session->set_flashdata('message', 'Erro ao logar');
            $this->load->view('inc/html-header');
            $this->load->view('inc/header');
            $this->load->view('home');
            $this->load->view('inc/footer');
            $this->load->view('inc/html-footer');
        } else {           
            $this->db->where('email', $this->input->post('user_email'));
            $this->db->where('senha', md5($this->input->post('user_senha')));
            $this->db->where('status', 1);
          //  $this->db->or_where('perfil', 2);
            $this->db->where('perfil', 2);            
            $user = $this->db->get('users')->result();            
            if (count($user) == 1) {
                $this->session->set_flashdata("success", "Logado com sucesso");
                $sessao['user'] = $user[0];
                $sessao['logado'] = TRUE;
                $this->session->set_userdata($sessao);
                redirect(base_url('area'));
            } else {
                $this->session->set_flashdata('message', 'Erro ao logar');
                $sessao['user'] = NULL;
                $sessao['logado'] = FALSE;
                $this->session->set_userdata($sessao);
                redirect(base_url('home/login'));
            }
        }
    }

    public function logout() {
        $this->session->set_flashdata('logout', 'Fez logout com sucesso.');
        $sessao['user'] = NULL;
        $sessao['logado'] = FALSE;
        $this->session->set_userdata($sessao);
        redirect(base_url('home'));
        $this->session->sess_destroy();
    }


    function atualizar() {
        foreach ($this->input->post() as $item) {
            if(isset($item['rowid'])) {
                $data = array('rowid' => $item['rowid'], 'qty' => $item['qty']);     
                $this->cart->update($data);           
            }
        }
        redirect(base_url('home/meu_carrinho'));
    }

    public function atualizar_carrinho(){
            
            //recebo todo o conteúdo postado do formulário e no loop abaixo recupero o que preciso
            $conteudo_postado = $this->input->post();
            var_dump($conteudo_postado);
          //  exit;
            
            foreach($conteudo_postado as $conteudo) {
                
                $dados[] = array(
                
                    "rowid" => $conteudo['rowid'],
                    "qty" => $conteudo['qty']
                
                );
                    
            }
            //com os dados já preparados, basta dar um update no carrinho
            $this->cart->update($dados);
            
            redirect(base_url('home/meu_carrinho'));
            
        }

    public function add_carrinho() {

        $this->cart->product_name_rules = '[:print:]'; 

        $id = $this->input->post("id");
        $nome = $this->input->post("nome");
        $quantidade = $this->input->post("quantidade");
        $preco = $this->input->post("preco");
        $url = $this->input->post("url");
        $foto = $this->input->post("foto");

        if (empty($quantidade)) 
                $quantidade = 1;

        $data = array(
            'id' => $id,
            'name' => $nome,
            'qty' => $quantidade,
            'price' => $preco,
            'url' => $url,
            'foto' => $foto
        );

        if($this->cart->insert($data)) {
        redirect(base_url('home/meu_carrinho'));
        } else {
            echo "Não foi possível inserir. <pre>";
            print_r($data);
            echo "</pre>";      
        }
    }

    function remover_carrinho($rowid) {
        $data = array('rowid' => $rowid, 'qty' => 0);
        $this->cart->update($data);
        redirect(base_url('home/meu_carrinho'));
    }

     function limpar_carrinho() {
        $this->cart->destroy();
        redirect(base_url('home/meu_carrinho'));
    }

}