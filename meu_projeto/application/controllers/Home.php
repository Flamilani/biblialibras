<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('inc/html-header');
        $this->load->view('inc/header');        
        $this->load->view('modals/modals');
        $this->load->view('home');
       // $this->load->view('banner');
        $this->load->view('livros');
        $this->load->view('sobre');
        $this->load->view('funciona');
        $this->load->view('contato');
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

}