<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("inicial_model");
        $this->load->model("livros_model");
        $this->load->model("videos_model");
        $this->load->model("users_model");
        $this->load->model("sobre_model");
        $this->load->model("privacidade_model");
        $this->load->model("termos_model");
        $this->load->model("funciona_model");
        $this->load->model("plano_model");
        $this->load->model("suspensao_model");
        $this->load->model("manutencao_model");
        $this->load->model("sociais_model");
        $this->load->library('cart');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('encrypt');
        
    }

    public function index()
    {
        // $this->output->enable_profiler(TRUE);
        $data_home['manutencao'] = $this->manutencao_model->home_Manutencao();
        $data_home['inicial'] = $this->inicial_model->home_Inicial();
        $data_livros['lista_livros'] = $this->livros_model->home_Livros();
        $data_livros['count_livros'] = $this->livros_model->countLivros();  
        $data_livros['planos'] = $this->plano_model->home_Plano();    
        $data_sobre['sobre'] = $this->sobre_model->home_Sobre();    
        $data_funciona['funciona'] = $this->funciona_model->home_Funciona();
        $data_footer['sociais'] = $this->sociais_model->home_Sociais();
        $user = isset($this->session->userdata('user')->id) && $this->session->userdata('user')->id;
        $data['assinatura'] = $this->plano_model->assinaturaLista($user);
        $this->load->view('inc/html-header');
        $this->load->view('inc/header', $data);
        $this->load->view('modals/modals');
        $this->load->view('home', $data_home);
       // $this->load->view('banner');
        $this->load->view('planos', $data_livros);
        $this->load->view('sobre', $data_sobre);
        $this->load->view('funciona', $data_funciona);    
       // $this->load->view('contato');
        $this->load->view('inc/footer', $data_footer);
        $this->load->view('inc/html-footer');
    }

    public function livro($id) {
        $data['capitulos_livros_id'] = $this->livros_model->capitulos_livros_id($id);       
        $data['lista_videos'] = $this->videos_model->video_livros_id($id); 
        $data['lista_livros'] = $this->livros_model->home_Livros();
        $data['livros_rand'] = $this->livros_model->livros_rand();
        $data['livro'] = $this->livros_model->livro_id($id);
        $data['titulo_capitulo'] = $this->videos_model->titulo_capitulo_home($id);
    if (count($data['lista_videos']) > 0) {
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

    public function planos() {
       // $this->output->enable_profiler(TRUE);
        $data_livros['capitulos_livros'] = $this->livros_model->capitulos_livros();    
        $data_livros['lista_livros'] = $this->livros_model->home_Livros();
        $data_livros['count_livros'] = $this->livros_model->countLivros();   
        $data_livros['planos'] = $this->plano_model->home_Plano();   
        $data['plano_livroSel'] = $this->plano_model->plano_livroSel();    
        $this->load->view('inc/html-header');
        $this->load->view('inc/header');
        $this->load->view('planos', $data_livros);
        $this->load->view('inc/footer');
        $this->load->view('inc/html-footer');
    }

    public function outros_planos() {
       // $this->output->enable_profiler(TRUE);
        $user = isset($this->session->userdata('user')->id) && $this->session->userdata('user')->id;
        $data_livros['capitulos_livros'] = $this->livros_model->capitulos_livros();
        $data_livros['lista_livros'] = $this->livros_model->home_Livros();
        $data_livros['count_livros'] = $this->livros_model->countLivros();
        $data_livros['planos'] = $this->plano_model->home_Plano();
        $data_livros['plano_livroSel'] = $this->plano_model->plano_livroSel();
        $data_livros['planoAlternativo'] = $this->plano_model->assinaturaListaUserAlternativa($user);
        $this->load->view('inc/html-header');
        $this->load->view('inc/header');
        $this->load->view('outros_planos', $data_livros);
        $this->load->view('inc/footer');
        $this->load->view('inc/html-footer');
    }


    public function cadastro() {
        $this->load->view('inc/html-header');
        $this->load->view('inc/header');
        $this->load->view('cadastro');
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

    public function recuperar_senha() {
        $this->load->view('inc/html-header');
        $this->load->view('inc/header');
        $this->load->view('recuperar_senha');
        $this->load->view('inc/footer');
        $this->load->view('inc/html-footer');
    }

    public function nova_senha($id) {
        $data['user'] = $this->users_model->senhaNova($id);
        $this->load->view('inc/html-header');
        $this->load->view('inc/header');
        $this->load->view('nova_senha', $data);
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

    public function assinar($id) {
       // $this->output->enable_profiler(TRUE);
         if(!$this->session->userdata('logado')) {
            redirect(base_url('home'));
        }
       // $user = isset($this->session->userdata('user')->id) && $this->session->userdata('user')->id;
        $data['assinatura'] = $this->plano_model->assinaturaLista($id);
        $data['verificarAssinatura'] = $this->plano_model->assinaturaVerificar($id);
        $data['dados'] = $this->livros_model->dadosBancarios();
        $data['suspensao'] = $this->suspensao_model->home_Suspensao();
        $this->load->view('inc/html-header');
        $this->load->view('inc/header');
        $this->load->view('assinar',$data);
        $this->load->view('inc/footer');
        $this->load->view('inc/html-footer');
    }


    public function assinatura_realizada() {  
        $this->load->view('inc/html-header');
        $this->load->view('inc/header');
        $this->load->view('assinatura_realizada');
        $this->load->view('inc/footer');
        $this->load->view('inc/html-footer');
    }


    public function plano_existe() {
        $this->load->view('inc/html-header');
        $this->load->view('inc/header');
        $this->load->view('plano_existe');
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

    public function termos()
    {
        $data['termos'] = $this->termos_model->home_Termos();
        $this->load->view('inc/html-header');
        $this->load->view('inc/header');
        $this->load->view('termos', $data);
        $this->load->view('inc/footer');
        $this->load->view('inc/html-footer');
    }


    public function privacidade()
    {
        $data['privacidade'] = $this->privacidade_model->home_Privacidade();
        $this->load->view('inc/html-header');
        $this->load->view('inc/header');
        $this->load->view('privacidade', $data);
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

        public function __finalizar_compra() {
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
                $this->cart->destroy();
            } else {
                redirect(base_url('pagamento_realizado'));
            }
        } else {
            redirect(base_url('home/login'));
        }
    }

    public function recuperar_login()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
        $this->form_validation->set_rules('cpf', 'CPF', 'required|min_length[5]');
        if ($this->form_validation->run() == FALSE) {
            $this->recuperar_senha();
        } else {
            $this->db->where('email', $this->input->post('email'));
            $this->db->where('cpf', $this->input->post('cpf'));
            $this->db->where('status', 1);
            $this->db->where('perfil', 2);
            $user = $this->db->get('users')->result();
            if (count($user) == 1) {
                $dados = $user[0];
                $codigo = trim(mt_rand(100000, 999999));
                $this->plano_model->mudar_senha_user($user[0]->id, md5($codigo));
              //  $mensagem = $this->load->view('emails/recuperando_senha.php', $dados, TRUE);
                $this->load->library('email');
                $this->email->from("contato@abibliaemlibras.com.br", "A Bíblia em Libras");
                $this->email->to($dados->email);
                $this->email->subject('Recuperação da senha - A Bíblia em Libras');

                $body = '<h3>Recuperação da senha - A Bíblia em Libras</h3>' .
                    '<p>Olá, ' . $dados->nome . ' ' . $dados->sobrenome . '!</p>' .
                    '<p>Você solicitou a senha para recuperar e acessar na área do usuário.</p>' .
                    '<p>Sua senha é ' . $codigo . ' </p>' .
                    '<p>Seja bem-vindo de volta!</p>' .
                    '<p>Para fazer nova senha, <a href="' . base_url('home/nova_senha/' . md5($user[0]->email)) . '">Clique aqui.</a></p>';

                $this->email->message($body);

                if ($this->email->send()) {
                    $this->load->view('inc/html-header');
                    $this->load->view('inc/header');
                    $this->load->view('senha_enviada');
                    $this->load->view('inc/footer');
                    $this->load->view('inc/html-footer');
                }
            } else {
                $this->session->set_flashdata('recuperar', 'Erro ao logar');
                redirect(base_url('home/login'));
            }
        }
    }

    public function finalizar_compra() {
        if(null != $this->session->userdata('logado')) {
            if($this->input->post('tipo_pagamento') == 'deposito') {
                $dados['id_user'] = $this->session->userdata('user')->id;               
                $dados['status'] = 0;             

           
            } else {
                redirect(base_url('pagamento_realizado'));
            }
        } else {
            redirect(base_url('home/login'));
        }
    }


     public function finalizar_plano() {
        $this->load->library('form_validation');       

            $id_user = $this->input->post('id_user');    
            $id_plano = $this->input->post('id_plano');         
            $status = 0;      

            $id_forma_pago = $this->input->post('id_forma_pago');
            $status_pago = 0;

            $codigo = trim(mt_rand(100000, 999999));

            $now = date('Y-m-d H:i:s');
            //$this->envio_plano();
            if ($this->plano_model->gravarPlanoEscolhido($id_user, $id_plano, $status, $now, $codigo)) {
                $this->plano_model->gravarPagamento($id_user, $id_forma_pago, $status_pago, $id_plano, $now, $codigo);
               ?>
                <script type="text/javascript">
                    $(document).ready(function(){

                        $("#btn_realizar").mouseup(function (){
                            $('#btn_realizar').attr('disabled', 'disabled');
                        });
                    });
                        </script>
               <?php $this->session->set_flashdata("success", "A assinatura foi efetuada com sucesso.");
                $this->envio_plano();
                redirect(base_url('home/assinatura_realizada'));
            } else {
                echo "Erro ao registrar";
            }
       
    }

    public function envio_plano() {
        $this->load->library('email');

        // Storing submitted values
        $email_principal = 'contato@abibliaemlibras.com.br';

        $nome = $this->input->post('nome');
        $sobrenome = $this->input->post('sobrenome');
        $plano = $this->input->post('plano');
        $duracao = $this->input->post('duracao');
        $periodo = $this->input->post('periodo');
        $valor = $this->input->post('valor');
        $receiver = $this->input->post('email');
        $forma_pago = $this->input->post('id_forma_pago');
        $status_pago = 0;

        $favorecido = $this->input->post('favorecido');
        $nome_banco = $this->input->post('nome_banco');
        $agencia = $this->input->post('agencia');
        $conta = $this->input->post('conta');
        $digito = $this->input->post('digito');
        $tipo_conta = $this->input->post('tipo_conta');

        if(isset($forma_pago) && $forma_pago == 1):
             echo $forma_pg = 'Depósito Bancário';
             endif;

        if(isset($tipo_conta) && $tipo_conta == 1):
            echo $tipo = 'Corrente';
        else:
            echo $tipo = 'Poupança';
        endif;

        if(isset($status_pago) && $status_pago == 3):
             echo $status_pg = '<span style="font-size: 15px; color: red;">Cancelado</span>';
         elseif(isset($status_pago) && $status_pago == 2):
             echo $status_pg = '<span style="font-size: 15px; color: green;">Pago</span>';
         elseif(isset($status_pago) && $status_pago == 1):
             echo $status_pg = '<span style="font-size: 15px; color: orangered;">Enviado</span>';
         else:
            echo $status_pg = '<span style="font-size: 15px; color: blue;">Aguardando</span>';
         endif;

        $assunto = 'Plano Escolhido';
      //  $mensagem = $this->input->post('mensagem');

        $receiver_email = $email_principal;
        $sender_email = $email_principal;

        // Load email library and passing configured values to email library

        $this->email->set_newline("\r\n");

        // Sender email address
        $this->email->from($email_principal, $nome);
        // Receiver email address
        $this->email->to($receiver);
        $this->email->to('gilmarmanhaes@hotmail.com');
        $this->email->to($email_principal);
        // Subject of email
        $this->email->subject($assunto);
        // Message in email

        $body = '<h3>' . $assunto . '</h3>' .
            '<p><b>Nome:</b> ' . $nome . ' ' . $sobrenome . '</p>' .
            '<p><b>E-mail:</b> ' . $receiver . '</p>' .
            '<p><b>Plano:</b> ' . $plano . ' ( ' . $duracao . ' ' . $periodo . ' ) </p>' .
            '<p><b>Valor:</b> ' . $valor . '</p>' .
            '<p><b>Status de Pagamento:</b> ' . $status_pg . '</p>' .
            '<br /><h3> ' . $forma_pg . '</h3>' .
            '<p><b>Favorecido:</b> ' . $favorecido . '</p>' .
            '<p><b>Banco:</b> ' . $nome_banco . '</p>' .
            '<p><b>Agência:</b> ' . $agencia . '</p>' .
            '<p><b>Conta ' . $tipo . ':</b> ' . $conta . ' ' . $digito . '</p><br />' .
            '<p><b>Como Pagar:</b><br />
            Vá até uma agência do Banco Bradesco<br />
            Deposite o valor do seu plano<br />
            Tire uma foto do Comprovante de Depósito<br />
            Faça login na página de A Biblia em Libras (<a href="' . base_url('home/login') . '">Acessa aqui.</a>)<br />
            Escolha: Área de Usuário<br />
            Escolha: Inserir Comprovante<br />
            Selecione o a foto do seu Comprovante de Depósito<br />
            Click em Inserir<br />
            Ou envie a foto por WhatsApp 21 97549-2390<br /><br />   
            
            Aguarde a liberação do seu acesso.
            Obrigado!</p>';

        $this->email->message($body);

        if ($this->email->send()) {
            $this->session->set_flashdata("success", "Sua mensagem foi enviada com sucesso.");
        } else {
            //$data["message"] = "ocorreu um erro durante o envio: " . $mail->ErrorInfo;
            $this->session->set_flashdata("erro_envio", "Erro ao enviar.");
            print_r($this->email->print_debugger());

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
            $email_principal = 'contato@abibliaemlibras.com.br';



            $nome = $this->input->post('nome');
            $receiver = $this->input->post('email');
            $celular = $this->input->post('celular');
            $assunto = $this->input->post('assunto');

 if(isset($tipo_assunto) && $tipo_assunto == 1): ?>
     <?php echo $assunto = 'Dúvida'; ?>
        <?php elseif(isset($tipo_assunto) && $tipo_assunto == 2): ?>
            <?php echo $assunto = 'Crítica'; ?>
        <?php else: ?>
            <?php echo $assunto = 'Sugestão'; ?>
        <?php endif;
        
            $mensagem = $this->input->post('mensagem');
            
            $receiver_email = $email_principal;
            $sender_email = $email_principal;
           
            // Load email library and passing configured values to email library 

            $this->email->set_newline("\r\n");

            // Sender email address
            $this->email->from('contato@abibliaemlibras.com.br', $nome);
            // Receiver email address
            $this->email->to($receiver);
            $this->email->to('gilmarmanhaes@hotmail.com');
            $this->email->to($email_principal);
            // Subject of email
            $titulo = $assunto . ' de ' . $nome;
            $this->email->subject($titulo);
            // Message in email            

            $body = '<h2>Recebemos sua mensagem, logo retornaremos com a resposta.</h2>' .
                    '<h3>' . $assunto . ' </h3>' .
                    '<p><b>Nome:</b> ' . $nome . '</p>' .
                    '<p><b>E-mail:</b> ' . $receiver . '</p>' .
                    '<p><b>Celular:</b> ' . $celular . '</p>' .
                    '<p><b>Mensagem:</b> ' . $mensagem . '</p>';

            $this->email->message($body);

            if ($this->email->send()) {                
                $this->session->set_flashdata("success", "Sua mensagem foi enviada com sucesso.");
            } else {
                //$data["message"] = "ocorreu um erro durante o envio: " . $mail->ErrorInfo;              
                $this->session->set_flashdata("erro_envio", "Erro ao enviar.");
                print_r($this->email->print_debugger());

            }
           redirect(base_url('home/contato'));
        }
    }  

    public function loginSubmit() {
        $emailId = $this->input->post('user_email');

        if($this->session->userdata('logado') == true) {
            $sessionData = $this->session->all_userdata();
            $userId = $sessionData['id'];
            redirect('area');
        } else {
                 $this->load->library('form_validation');
                $this->form_validation->set_rules('user_email', 'Email', 'required|min_length[5]');
                $this->form_validation->set_rules('user_senha', 'Senha', 'required|min_length[6]');
            if ($this->form_validation->run()) {
                $userId = $this->input->post('user_email');
                $u_data = array(
                    'id' => $userId,
                    'user' => true
                );
                $this->session->set_userdata($u_data);

                $sessionId = session_id();
                $this->users_model->setSession($userId, $sessionId);
                redirect('area');
            } else {
               $this->session->set_flashdata('message', 'Erro ao logar');
                $sessao['user'] = NULL;
                $sessao['logado'] = FALSE;
                $this->session->set_userdata($sessao);
                redirect(base_url('home/login'));
            }
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
            $ip = $_SERVER['REMOTE_ADDR'];
            $now = date('Y-m-d H:i:s');
            if (count($user) == 1) {
                $this->session->set_flashdata("success", "Logado com sucesso");
                $sessao['user'] = $user[0];
                $sessao['logado'] = TRUE;
                $this->session->set_userdata($sessao);
                $this->users_model->gravarAuditoria($now, $ip, $user[0]->id, $this->input->post('user_email'), "Acessou na área do Usuário");
                $this->db->where('id_user', $user[0]->id);
                $assinatura = $this->db->get('assinaturas')->result();
              //  redirect(base_url('area/assinatura' . '/' . $assinatura[0]->id_assinatura));
               /* $login = $this->input->post('user_email');

                if(isset($login) && !isset($_SESSION['login'])) {
                    $_SESSION['login'] = $login;
                    $_SESSION['token'] = uniqid();
                    $this->users_model->deletar_login($_SESSION['login']);
                    $this->users_model->gravar_login($_SESSION['login'], $_SESSION['token']);

                }
                $check = $this->users_model->pegar_login($_SESSION['login'], $_SESSION['token']);

                if(count($check) == 1) {
                    redirect(base_url('area'));
                } else {
                    echo "Você vai ser deslogado, pois tem login simultâneo!";
                    $sessao['user'] = NULL;
                    $sessao['logado'] = FALSE;
                    $this->session->set_userdata($sessao);
                    redirect(base_url('home/login'));
                    session_destroy();
                }*/
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
        $ip = $_SERVER['REMOTE_ADDR'];
        $this->users_model->gravarAuditoria($ip, $this->session->userdata('user')->id, $this->session->userdata('user')->email, "Fez logout e saiu da área do Usuário");
        $sessao['user'] = NULL;
        $sessao['logado'] = FALSE;
        $this->session->set_userdata($sessao);
        $this->session->sess_destroy();
        $this->cart->destroy();
        redirect(base_url('home'));
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


    public function dados_livros(){
        
        $id_planos = $this->input->post("id_planos");        
        $consulta = $this->livros_model->dados_livros($id_planos);
        
        if ($consulta->num_rows() == 0) {
            die("Livro não encontrado");
        }
        
        $array_livros = array(        
            "id_planos" => $consulta->row()->id_planos,
            "id_livro" => $consulta->row()->id_livro            
        );        
    
        echo json_encode($array_livros);
        
    }

}