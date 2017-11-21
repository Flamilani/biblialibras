<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("livros_model");
    }

    public function index()
    {
        // $this->output->enable_profiler(TRUE);
        $data['lista_livros'] = $this->livros_model->home_Livros();
        $data['count_livros'] = $this->livros_model->countLivros();       
        $this->load->view('inc/html-header');
        $this->load->view('inc/header');        
        $this->load->view('modals/modals');
        $this->load->view('home');
       // $this->load->view('banner');
        $this->load->view('livros', $data);
        $this->load->view('sobre');
        $this->load->view('funciona');
        $this->load->view('contato');
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

    public function logar() {        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('user_email', 'Email', 'required|min_length[5]');
        $this->form_validation->set_rules('user_email', 'Senha', 'required|min_length[6]');
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
            $this->db->or_where('perfil', 2);
            $this->db->where('perfil', 1);            
            $user = $this->db->get('users')->result();            
            if (count($user) == 1) {
                $this->session->set_flashdata("success", "Logado com sucesso");
                $sessao['user'] = $user[0];
                $sessao['logado'] = TRUE;
                $this->session->set_userdata($sessao);
                redirect(base_url('areacliente'));
            } else {
                $this->session->set_flashdata('message', 'Erro ao logar');
                $sessao['user'] = NULL;
                $sessao['logado'] = FALSE;
                $this->session->set_userdata($sessao);
                redirect(base_url('home'));
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


}