<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('users_model');
    }

    public function index() {
		// $this->output->enable_profiler(TRUE);
        $this->load->view('admin/inc/html-header');
        $this->load->view('admin/login'); 
        $this->load->view('admin/inc/html-footer');

    }

    public function logar_admin() { 		
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('senha', 'Senha', 'required|min_length[6]');        
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('alert', 'Erro ao logar');
            $this->index();
        } else {
            $this->db->where('email', $this->input->post('email'));
            $this->db->where('senha', md5($this->input->post('senha')));
            $this->db->where('status', 1);
            $this->db->where('perfil', 1);
            $admin = $this->db->get('users')->result();
            if (count($admin) == 1) {
                $this->session->set_flashdata("success", "Logado com sucesso");
                $sessao['admin'] = $admin[0];
                $sessao['logadmin'] = TRUE;
                $this->session->set_userdata($sessao);
                redirect(base_url('admin/home'));
            } else {
                $this->session->set_flashdata('alert', 'Erro ao logar');
                $sessao['admin'] = NULL;
                $sessao['logadmin'] = FALSE;
                $this->session->set_userdata($sessao);
                redirect(base_url('admin/login'));
            }
        }
    }  

    public function logout() {
        $this->session->set_flashdata('success', 'Saiu da sessão com sucesso.');
        $sessao['admin'] = NULL;
        $sessao['logadmin'] = FALSE;
        $this->session->set_userdata($sessao);
        redirect(base_url('admin/login'));
        $this->session->sess_destroy();        
    }


}
