<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("users_model");
    }

   public function logar() {
        $email = $this->input->post('email');
        $senha = md5($this->input->post('senha'));
        $status = 1;
        $perfil = 2;
        $usuario = $this->users_model->verificar($email, $senha, $status, $perfil);
        if ($usuario) {
            $this->session->set_userdata("logado", $usuario);
            $this->session->set_flashdata("success", "Logado com sucesso");
            redirect('area/home');
        } else {
            $this->session->set_flashdata("danger", "Usuário ou senha incorreta");
            $this->session->sess_destroy();
            redirect('home');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('home');
    }

}
