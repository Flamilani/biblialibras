<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Livros extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("livros_model");
    }

   public function index()	{            
            $this->load->view('inc/html-header');
            $this->load->view('inc/header');
            $this->load->view('livros');
            $this->load->view('inc/footer');
            $this->load->view('inc/html-footer');
	}

}