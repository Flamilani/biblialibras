<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Area extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("livros_model");
        $this->load->model("videos_model");
        $this->load->model("pedidos_model");

       if(!$this->session->userdata('logado')) {
            redirect(base_url('home'));
        }
    }

    public function index() {    	
      
    	$user = $this->session->userdata('user')->id;
        $data['lista_livros'] = $this->videos_model->livros_user($user);
    	$data['count_livros'] = $this->videos_model->countLivrosUser($user);
       //  if (count($data['lista_livros']) > 0) { 
	    $this->load->view('area/inc/html-header');
	    $this->load->view('area/inc/header');
        $this->load->view('area/home', $data);
        $this->load->view('area/inc/html-footer');
       // } else {
    //    $this->session->set_flashdata("error", "Ainda não liberou por falta de pagamento.");
       // redirect(base_url('area'));
    //}

    }

    public function livro($id, $cap = null, $visto = null)	{
       
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

    public function pedidos() {
            $data['count_pedidos'] = $this->pedidos_model->countAdminPedidos();   
            $this->load->view('area/inc/html-header');
            $this->load->view('area/inc/header');
            $this->load->view('area/pedidos', $data);
            $this->load->view('area/inc/html-footer');
    }

   public function marcarConcluido() {
   		$user = (isset($this->session->userdata('user')->id) ? $this->session->userdata('user')->id : '');
        $id_livro = $this->input->post('id_livro');
        $id_video = $this->input->post('id_video');
        $id_user = $user;
        $visto = 1;

        if ($this->videos_model->marcar_concluido($id_livro, $id_video, $id_user, $visto)) {
              $this->session->set_flashdata("concluido", "Marcado como concluído.");
              redirect(base_url('area/livro/' . $id_livro . '/' . $id_video));
            } else {
                echo "Erro ao marcar como concluído.";
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

}
