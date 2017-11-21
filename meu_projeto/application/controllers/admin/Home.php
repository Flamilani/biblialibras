<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("livros_model");
        $this->load->model("users_model");

      if(!$this->session->userdata('logadmin')) {
            redirect(base_url('admin/login'));
        }
    }

    public function index() {
        $data['count_livros'] = $this->livros_model->countAdminLivros();   
        $data['count_users'] = $this->users_model->countUsers();   
        $this->load->view('admin/inc/html-header');
        $this->load->view('admin/inc/header');
        $this->load->view('admin/home', $data);
        $this->load->view('admin/inc/footer');
        $this->load->view('admin/inc/html-footer');

    }

     public function error404()
    {
        $this->load->view('inc/html-header');            
        $this->load->view('admin/errors/error404');     
        $this->load->view('inc/html-footer');

    }



}
