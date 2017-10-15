<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("users_model");
    }

    public function logar() {
        redirect('area/area');
        ?> <script>
            alert("Teste");
        </script> <?php
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('home');
    }

}
