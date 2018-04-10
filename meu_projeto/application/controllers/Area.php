<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Area extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("livros_model");
        $this->load->model("videos_model");
        $this->load->model("pedidos_model");
        $this->load->model("plano_model");
        $this->load->model("users_model");

        $this->load->library('pagination');
        $this->load->helper('url');

       if(!$this->session->userdata('logado')) {
            redirect(base_url('home'));
        }
    }

    public function index() {    	
     //  $this->output->enable_profiler(TRUE);
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
    	$user = $this->session->userdata('user')->id;
        $data['lista_livros'] = $this->pedidos_model->user_pedido($user);
        $data['count_livros'] = $this->videos_model->countLivrosUser($user);
    	$data['planoAlternativo'] = $this->plano_model->assinaturaListaUserAlternativa($user);
    	$data['planoCompleto'] = $this->plano_model->assinaturaListaUser($user);
        $data['pagosLimit'] = $this->plano_model->lista_PagamUseLimit($user);
        $data['pagos'] = $this->plano_model->lista_PagamUser($user);
	    $this->load->view('area/inc/html-header');
	    $this->load->view('area/inc/header', $data);
        $this->load->view('area/home', $data);
        $this->load->view('area/inc/html-footer');
    }

    public function livro($id, $cap = null, $visto = null)	{


       // $this->output->enable_profiler(TRUE);
            $user = (isset($this->session->userdata('user')->user_id) ? $this->session->userdata('user')->user_id : '');            
            $data['lista_capitulos'] = $this->videos_model->video_livrosMD($id, $user);                
            $data['titulo_video'] = $this->videos_model->titulo_video($id, $cap);                
            $data['titulo_capitulo'] = $this->videos_model->titulo_capitulo($id);                
            $data['visto'] = $this->videos_model->visto_status($id, $cap, $visto);   
          //  if (count($data['lista_capitulos']) > 0) {             
            $this->load->view('area/inc/html-header');
            $this->load->view('area/inc/header');
            $this->load->view('area/livro', $data);
            $this->load->view('area/inc/html-footer');
      /*  } else {
        $this->session->set_flashdata("error", "Ainda não liberou por falta de pagamento.");
        redirect(base_url('area'));
    } */
	}

    public function alterar_senha($id) {
       // $this->output->enable_profiler(TRUE);
            $user = $this->session->userdata('user')->id;  
            $data['count_livros'] = $this->livros_model->countAdminLivros();   
            $data['count_pedidos'] = $this->pedidos_model->countAdminPedidos();
            $user = (isset($this->session->userdata('admin')->id) ? $this->session->userdata('admin')->id : '');
            $data['perfil'] = $this->users_model->exibir_Perfil($user);
            $data['perfil'] = $this->users_model->exibir_Perfil($id);
            $this->load->view('area/inc/html-header');
            $this->load->view('area/inc/header');
            $this->load->view('area/alterar_senha', $data);
            $this->load->view('area/inc/html-footer');       
    }


    public function pagamentos() {
        // $this->output->enable_profiler(TRUE);
        $user = $this->session->userdata('user')->id;
        $data['count_livros'] = $this->livros_model->countAdminLivros();
        $data['count_pedidos'] = $this->pedidos_model->countAdminPedidos();
        $data['pagos'] = $this->plano_model->lista_PagamTodos($user);
        $this->load->view('area/inc/html-header');
        $this->load->view('area/inc/header');
        $this->load->view('area/pagamentos', $data);
        $this->load->view('area/inc/html-footer');
    }

    public function livros() {
        // $this->output->enable_profiler(TRUE);
        $user = $this->session->userdata('user')->id;
        $data['count_livros'] = $this->livros_model->countAdminLivros();
        $data['count_pedidos'] = $this->pedidos_model->countAdminPedidos();
        $this->load->view('area/inc/html-header');
        $this->load->view('area/inc/header');
        $this->load->view('area/livros', $data);
        $this->load->view('area/inc/html-footer');
    }

    public function assinatura($id) {  
       // $this->output->enable_profiler(TRUE);
            $user = $this->session->userdata('user')->id;  
            $email = $this->session->userdata('user')->email;
            $data['count_livros'] = $this->livros_model->countAdminLivros();
            $data['lista_livros'] = $this->livros_model->home_Livros();       
            $data['count_pedidos'] = $this->pedidos_model->countAdminPedidos();   
            $data['assinatura'] = $this->plano_model->assinaturaUser($id, $user);
            $ip = $_SERVER['REMOTE_ADDR'];
            $now = date('Y-m-d H:i:s');
            $this->users_model->gravarAuditoria($now, $ip, $user, $email, "Retornou para área do Usuário");
            $this->load->view('area/inc/html-header');
            $this->load->view('area/inc/header', $data);
            $this->load->view('area/assinatura', $data);
            $this->load->view('area/inc/html-footer');              
         
    }

    public function comprovante($id) {  
       // $this->output->enable_profiler(TRUE);
            $user = $this->session->userdata('user')->id;  
            $data['count_livros'] = $this->livros_model->countAdminLivros();   
            $data['lista_livros'] = $this->livros_model->home_Livros();       
            $data['count_pedidos'] = $this->pedidos_model->countAdminPedidos();   
            $data['comprovante'] = $this->plano_model->exibir_comprovante($id, $user);           
            $this->load->view('area/inc/html-header');
            $this->load->view('area/inc/header');
            $this->load->view('area/comprovante', $data);
            $this->load->view('area/inc/html-footer');              
         
    }

      public function meu_perfil($id) {  
            $user = $this->session->userdata('user')->id;  
            $data['count_livros'] = $this->livros_model->countAdminLivros();   
            $data['lista_livros'] = $this->livros_model->home_Livros();       
            $data['count_pedidos'] = $this->pedidos_model->countAdminPedidos();   
            $data['perfil'] = $this->users_model->exibir_Perfil($id);           
            $this->load->view('area/inc/html-header');
            $this->load->view('area/inc/header', $data);
            $this->load->view('area/meu_perfil', $data);
            $this->load->view('area/inc/html-footer');              
         
    }

     public function pedidos() {
        if(null != $this->session->userdata('logado')) {
            $this->load->helper('text');
            $this->db->where('id_user', $this->session->userdata('user')->id);
            $this->db->order_by('id_user', 'desc');
            $pedidos = $this->db->get('pedidos')->result();
            $data['pedidos'] = array();
            foreach ($pedidos as $pedido) {
                    $data['pedidos'][$pedido->id_pedido]['pedido'] = $pedido;
                    $this->db->select('itens_pedidos.*, livros.titulo, livros.conteudo');
                    $this->db->from('itens_pedidos');
                    $this->db->join('livros', 'itens_pedidos.id_livro = livros.id_livro');
                    $this->db->where('itens_pedidos.id_pedido', $pedido->id_pedido);
                    $data['pedidos'][$pedido->id_pedido]['itens'] = $this->db->get()->result();
            }
            $data['count_pedidos'] = $this->pedidos_model->countAdminPedidos();   
            $this->load->view('area/inc/html-header');
            $this->load->view('area/inc/header');
            $this->load->view('area/pedidos', $data);
            $this->load->view('area/inc/html-footer');
        } else {
            redirect(base_url('home'));
        }
    }


   public function marcarConcluido() {
   		$user = (isset($this->session->userdata('user')->id) ? $this->session->userdata('user')->id : '');
        $id_livro = $this->input->post('id_livro');
        $id_video = $this->input->post('id_video');
        $id_user = $user;
        $visto = 1;
        $data_visto = date('Y-m-d H:i:s');

        if ($this->videos_model->marcar_concluido($id_livro, $id_video, $id_user, $visto, $data_visto)) {
              $this->session->set_flashdata("concluido", "Marcado como concluído.");
              redirect(base_url('area/livro/' . $id_livro . '/' . $id_video));
            } else {
                echo "Erro ao marcar como concluído.";
            }
    }

       public function desmarcar() {
        $user = (isset($this->session->userdata('user')->id) ? $this->session->userdata('user')->id : '');
        $id_hist = $this->input->post('id_hist');
        $id_livro = $this->input->post('id_livro');
        $id_video = $this->input->post('id_video');

        if ($this->videos_model->desmarcar($id_hist)) {
              $this->session->set_flashdata("desmarcar", "Desmarcado.");
              redirect(base_url('area/livro/' . $id_livro . '/' . $id_video));
            } else {
                echo "Erro ao marcar como concluído.";
            }
    }

       public function iniciar() {
        $user = (isset($this->session->userdata('user')->id) ? $this->session->userdata('user')->id : '');
        $id_livro = $this->input->post('id_livro');
        $id_assinatura = $this->input->post('id_assinatura');
        $id_video = $this->input->post('id_video');
        $titulo = url_amigavel($this->input->post('titulo'));
        $id_user = $user;
        $status = 1;
        $data_inicial = date('Y-m-d H:i:s');

        $date = date('Y-m-d');
        $date = strtotime($date);
        $new_date = strtotime('+ 372 day', $date);
        $data_final = date('Y-m-d', $new_date);
        

        if ($this->videos_model->iniciar($id_user, $id_livro, $id_assinatura, $status, $data_inicial)) {
             // redirect(base_url('area/livro/' . $id_livro . '/' . $id_video . '/' . $titulo));
              redirect(base_url('area/livro/' . $id_livro . '/' . $id_video));
            } else {
                echo "Erro ao iniciar.";
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


    public function gravar_comprovante() {
       
        $this->load->library('form_validation');
 

        $path = "assets/comprovantes";

        if (!is_dir($path)) {
            mkdir($path, 0755, TRUE);
        }

        $config_imagem = array(
            'upload_path' => $path,
            'allowed_types' => 'jpg|jpeg|png|gif',
            'max_size' => '0',
            'file_name' => clear($this->session->userdata('user')->nome) . trim(str_replace(" ","",date('d-m-Y-H-i-s'))) . rand()
        );

        $this->load->library('upload', $config_imagem);
        $this->load->library('image_lib', $config_imagem);
        $this->upload->initialize($config_imagem);


            if (!$this->upload->do_upload()) {
                print_r($this->upload->display_errors());
            } else {
                $this->image_lib->resize();
            }
            $id = $this->input->post('id_pago');
            $id_plano = $this->input->post('id_plano');

            $data = array('upload_data' => $this->upload->data());            
            
            $comprovante = $data['upload_data']['file_name'];  

            $d = $this->plano_model->detalhePagamento($id);
            if (file_exists(base_url('assets/comprovantes/' . $d[0]->comprovante) && $d[0]->comprovante)) {
                unlink(base_url('assets/comprovantes/' . $d[0]->comprovante));
            }  

            if ($this->plano_model->gravar_comprovante($id, $comprovante)) {
                $this->session->set_flashdata("success", "O comprovante foi atualizado com sucesso.");
                redirect(base_url('area/comprovante/' . $id_plano));
            } else {
                echo "Erro ao cadastrar a imagem";
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
            $dados['endereco'] = $this->input->post('endereco');
            $dados['numero'] = $this->input->post('numero');
            $dados['compl'] = $this->input->post('compl');
            $dados['bairro'] = $this->input->post('bairro');
            $dados['cidade'] = $this->input->post('cidade');
            $dados['estado'] = $this->input->post('estado');
            $dados['cep'] = $this->input->post('cep');


            if ($this->users_model->gravar_alteracoes($id, $dados)) {
                $this->session->set_flashdata("success", "O usuário foi alterado com sucesso.");
                redirect(base_url('area/meu_perfil/' . $id));
            } else {
                echo "Erro ao alterar";
            }
        }
    }

    public function alterar_senha_user() {
        $senha = $this->input->post('confsenha');
        $id = $this->input->post('id');

        if ($this->users_model->alterar_senha($id, $senha)) {
            $this->session->set_flashdata("senha_alterada", "A senha foi alterada com sucesso.");
            redirect(base_url('area/meu_perfil/' . $id));
        } else {
            echo "Erro ao alterar";
        }
    }

}
