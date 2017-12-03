<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Area extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("livros_model");
        $this->load->model("videos_model");

     /*  if(!$this->session->userdata('logado')) {
            redirect(base_url('home'));
        }*/
    }

    public function index() {
    	$user = 1;
    	$this->output->enable_profiler(TRUE);
    	//$user = (isset($this->session->userdata('user')->user_id) ? $this->session->userdata('user')->user_id : '');
        $data['lista_livros'] = $this->videos_model->livros_user($user);
    	$data['count_livros'] = $this->videos_model->countLivrosUser($user);
		$this->load->view('area/inc/html-header');
		$this->load->view('area/inc/header');
        $this->load->view('area/home', $data);
        $this->load->view('area/inc/html-footer');

    }
/*
    public function view($id, $id2 = null) {
        echo 'Area::view(' . $id . ',' . $id2 . ')';
    }*/

    public function livro($id, $cap = null, $visto = null)	{
           $this->output->enable_profiler(TRUE);
            // $user = (isset($this->session->userdata('user')->user_id) ? $this->session->userdata('user')->user_id : '');
            $user = 1;
            $data['lista_capitulos'] = $this->videos_model->video_livrosMD($id, $user);                
            $data['titulo_video'] = $this->videos_model->titulo_video($id, $cap);                
            $data['titulo_capitulo'] = $this->videos_model->titulo_capitulo();                
            $data['visto'] = $this->videos_model->visto_status($id, $cap, $visto);                
            $this->load->view('area/inc/html-header');
            $this->load->view('area/inc/header');
            $this->load->view('area/livro', $data);
            $this->load->view('area/inc/html-footer');
	}

   public function marcarConcluido() {
   		$user = (isset($this->session->userdata('user')->id) ? $this->session->userdata('user')->id : '');
        $id_livro = $this->input->post('id_livro');
        $id_video = $this->input->post('id_video');
        $id_user = 1;
        $visto = 1;

        if ($this->capitulos_model->marcar_concluido($id_livro, $id_video, $id_user, $visto)) {
              $this->session->set_flashdata("concluido", "Marcado como concluído.");
              redirect(base_url('area/livro/' . md5($id_livro) . '/' . md5($id_capitulo)));
            } else {
                echo "Erro ao marcar como concluído.";
            }
    }



}
