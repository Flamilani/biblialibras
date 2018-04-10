<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assinaturas extends CI_Controller {

   public function __construct() {
        parent::__construct();
        $this->load->model("livros_model");
        $this->load->model("users_model");
        $this->load->model("plano_model");
        $this->load->model("pedidos_model");

      if(!$this->session->userdata('logadmin')) {
            redirect(base_url('admin/login'));
        }
    }

     public function index()  { 
      // $this->output->enable_profiler(TRUE);
            $user = (isset($this->session->userdata('admin')->id) ? $this->session->userdata('admin')->id : '');    
            $data['perfil'] = $this->users_model->exibir_Perfil($user);    
            $data['count_livros'] = $this->livros_model->countAdminLivros();   
            $data['count_users'] = $this->users_model->countUsers();   
            $data['users_ativos'] = $this->users_model->usersAtivos();   
            $data['count_pedidos'] = $this->pedidos_model->countAdminPedidos();   
            $data['count_ativos'] = $this->users_model->countUsersAtivos();   
            $data['count_pagos'] = $this->plano_model->countAdminPagos();  
            $data['count_planos'] = $this->plano_model->countAdminPlanos();   
            $data['count_assinaturas'] = $this->plano_model->countAdminAssinaturas();   
            $data['assinaturas'] = $this->plano_model->admin_Assinaturas();    
            $data['valor'] = $this->plano_model->valorFatura();    
            $data['planos'] = $this->plano_model->admin_Planos();    
            $this->load->view('admin/inc/html-header');
            $this->load->view('admin/inc/header', $data);
            $this->load->view('admin/assinaturas', $data);
            $this->load->view('admin/inc/footer');
            $this->load->view('admin/inc/html-footer');
    }

         public function pagamento($id)  { 
        //$this->output->enable_profiler(TRUE);
            $user = (isset($this->session->userdata('admin')->id) ? $this->session->userdata('admin')->id : '');    
            $data['perfil'] = $this->users_model->exibir_Perfil($user);    
            $data['count_livros'] = $this->livros_model->countAdminLivros();   
            $data['count_users'] = $this->users_model->countUsers();   
            $data['users_ativos'] = $this->users_model->usersAtivos();   
            $data['count_pedidos'] = $this->pedidos_model->countAdminPedidos();   
            $data['count_ativos'] = $this->users_model->countUsersAtivos();   
            $data['count_assinaturas'] = $this->plano_model->countAdminAssinaturas();   
            $data['count_pago'] = $this->plano_model->countAdminPagosId($id);   
            $data['count_pagos'] = $this->plano_model->countAdminPagos();  
            $data['count_planos'] = $this->plano_model->countAdminPlanos();   
            $data['assinaturas'] = $this->plano_model->admin_Assinaturas();    
            $data['valor'] = $this->plano_model->valorFatura();    
            $data['pagos'] = $this->plano_model->lista_Pagam($id);    
            $this->load->view('admin/inc/html-header');
            $this->load->view('admin/inc/header', $data);
            $this->load->view('admin/pagamento', $data);
            $this->load->view('admin/inc/footer');
            $this->load->view('admin/inc/html-footer');
    }


    public function alterar_pagamento($id)  {
        //$this->output->enable_profiler(TRUE);
        $user = (isset($this->session->userdata('admin')->id) ? $this->session->userdata('admin')->id : '');
        $data['perfil'] = $this->users_model->exibir_Perfil($user);
        $data['count_livros'] = $this->livros_model->countAdminLivros();
        $data['count_users'] = $this->users_model->countUsers();
        $data['users_ativos'] = $this->users_model->usersAtivos();
        $data['count_pedidos'] = $this->pedidos_model->countAdminPedidos();
        $data['count_ativos'] = $this->users_model->countUsersAtivos();
        $data['count_assinaturas'] = $this->plano_model->countAdminAssinaturas();
        $data['count_pago'] = $this->plano_model->countAdminPagosId($id);
        $data['count_pagos'] = $this->plano_model->countAdminPagos();
        $data['count_planos'] = $this->plano_model->countAdminPlanos();
        $data['assinaturas'] = $this->plano_model->admin_Assinaturas();
        $data['valor'] = $this->plano_model->valorFatura();
        $data['pagos'] = $this->plano_model->alterar_lista_Pagamento($id);
        $this->load->view('admin/inc/html-header');
        $this->load->view('admin/inc/header', $data);
        $this->load->view('admin/alterar_pagamento', $data);
        $this->load->view('admin/inc/footer');
        $this->load->view('admin/inc/html-footer');
    }

       public function alterar_status() {
        $status = $this->input->post('status');
        $id = $this->input->post('id_assinatura');
        return $this->plano_model->alterar_assina_status($id, $status);
    }

      public function dados_assinatura(){
        
        $id_assinatura = $this->input->post("id_assinatura");        
        $consulta = $this->plano_model->dados_assinatura($id_assinatura);
        
        if ($consulta->num_rows() == 0) {
            die("Assinatura não encontrada");
        }
        
        $array_assinatura = array(        
            "id_assinatura" => $consulta->row()->id_assinatura
        );        
    
        echo json_encode($array_assinatura);
        
    }

    public function dados_pagamento(){

        $id_pago = $this->input->post("id_pago");
        $consulta = $this->plano_model->dados_pagamento($id_pago);

        if ($consulta->num_rows() == 0) {
            die("Pagamento não encontrado");
        }

        $array = array(
            "id_pago" => $consulta->row()->id_pago
        );

        echo json_encode($array);

    }

    public function gravarAssinatura() {
        $this->load->library('form_validation');

        $id_user = $this->input->post('id_user');
        $id_plano = $this->input->post('id_plano');
        $status = 0;

        $id_forma_pago = 1;
        $status_pago = 0;

        $codigo = trim(mt_rand(100000, 999999));

        $now = date('Y-m-d H:i:s');

        if ($this->plano_model->gravarPlanoEscolhido($id_user, $id_plano, $status, $now, $codigo)) {
            $this->plano_model->gravarPagamento($id_user, $id_forma_pago, $status_pago, $id_plano, $now, $codigo);
            $this->session->set_flashdata("success", "A assinatura foi efetuada com sucesso.");
            redirect(base_url('admin/assinaturas'));
        } else {
            echo "Erro ao registrar";
        }

    }


    public function salvar() {

        $id_assinatura = $this->input->post("id_assinatura");
        $data_inicial = $this->input->post("data_inicial");
        
        $dados = array(        
            "id_assinatura" => $id_assinatura,
            "data_inicial" => $data_inicial
        );
        
      
        if ($this->plano_model->salvar($id_assinatura, $dados)) {
            $this->session->set_flashdata("assina_sucesso", "A assinatura foi atualizada com sucesso.");
            echo 1;
        } else { 
            echo 0;
        }
    }

    public function salvar_pago() {
        $this->load->library('form_validation');

        $id_pago = $this->input->post("id_pago");
        $status_pago = $this->input->post("status_pago");

        $dados = array(
            "id_pago" => $id_pago,
            "status_pago" => $status_pago
        );

        $codigo = $this->input->post('codigo');


        if ($this->plano_model->salvar_pago($id_pago, $dados)) {
            $this->session->set_flashdata("success", "O pagamento foi atualizado com sucesso.");
            $this->envio();
            redirect(base_url('admin/assinaturas/pagamento/' . $codigo));

        } else {
            echo "Erro ao registrar";
        }

        $this->load->library('form_validation');

        $id_user = $this->input->post('id_user');
        $id_plano = $this->input->post('id_plano');
        $status = 0;

        $id_forma_pago = 1;
        $status_pago = 0;

        $codigo = trim(mt_rand(100000, 999999));

        if ($this->plano_model->gravarPlanoEscolhido($id_user, $id_plano, $status, $codigo)) {
            $this->session->set_flashdata("success", "A assinatura foi efetuada com sucesso.");
            redirect(base_url('admin/assinaturas'));
        } else {
            echo "Erro ao registrar";
        }
    }

    public function __salvar_pago() {

        $id_pago = $this->input->post("id_pago");
        $status_pago = $this->input->post("status_pago");

        $dados = array(
            "id_pago" => $id_pago,
            "status_pago" => $status_pago
        );


        if ($this->plano_model->salvar_pago($id_pago, $dados)) {
            $this->session->set_flashdata("pago_sucesso", "O pagamento foi atualizado com sucesso.");
            $this->envio();

            echo 1;
        } else {
            echo 0;
        }
    }

    public function envio() {
        $this->load->library('email');

            // Storing submitted values
            $email_principal = 'contato@abibliaemlibras.com.br';

            $nome = $this->input->post('nome');
            $plano = $this->input->post('plano');
            $receiver = $this->input->post('email');
            $status_pago = $this->input->post("status_pago");

if(isset($status_pago) && $status_pago == 3): ?>
   <?php echo $status_pg = 'Cancelado'; ?>
<?php elseif(isset($status_pago) && $status_pago == 2): ?>
    <?php echo $status_pg = 'Pago'; ?>
<?php elseif(isset($status_pago) && $status_pago == 1): ?>
    <?php echo $status_pg = 'Enviado'; ?>
<?php else: ?>
    <?php echo $status_pg = 'Aguardando'; ?>
<?php endif;

            $assunto = 'Novo Status de Pagamento';
            $mensagem = $this->input->post('mensagem');

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
 if(isset($status_pago) && $status_pago != 2):
            $body = '<h3>' . $assunto . '</h3>' .
                '<p><b>Nome:</b> ' . $nome . '</p>' .
                '<p><b>E-mail:</b> ' . $receiver . '</p>' .
                '<p><b>Plano:</b> ' . $plano . '</p>' .
                '<p><b>Status de Pagamento:</b> ' . $status_pg . '</p>' .
                '<p><b>Comentário:</b> ' . $mensagem . '</p>';
else:
    $body = '<h3>' . $assunto . '</h3>' .
        '<p><b>Nome:</b> ' . $nome . '</p>' .
        '<p><b>E-mail:</b> ' . $receiver . '</p>' .
        '<p><b>Plano:</b> ' . $plano . '</p>' .
        '<p><b>Status de Pagamento:</b> ' . $status_pg . '</p>' .
        '<p><b>Acesso Liberado</b><br />
Faça login na página de A Biblia em Libras (https://abibliaemlibras.com.br/home/login)<br /><br />
Escolha: Área de Usuário - Acessar<br />
Pronto você ja pode assistir os Livros da sua Assinatura<br />
Obrigado!</p>';
    endif;
            $this->email->message($body);

            if ($this->email->send()) {
                $this->session->set_flashdata("success", "Sua mensagem foi enviada com sucesso.");
                redirect(base_url('admin/assinaturas'));
            } else {
                //$data["message"] = "ocorreu um erro durante o envio: " . $mail->ErrorInfo;
                $this->session->set_flashdata("erro_envio", "Erro ao enviar.");
                print_r($this->email->print_debugger());

            }

    }

    public function deletar_assinatura($id) {
       // $data = $this->plano_model->detalhePlanos($id);
        if ($this->plano_model->deletar_assinatura($id)) {
            $this->plano_model->deletar_pagamento($id);
            $this->session->set_flashdata("deletar_assinatura", "O assinatura foi deletada com sucesso.");
            redirect(base_url('admin/assinaturas'));
        } else {
            echo "Erro ao excluir a assinatura";
        }
    }

}