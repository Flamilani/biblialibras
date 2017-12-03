<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Livro extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("livros_model");
        $this->load->model("capitulos_model");

    }

   public function index()	{
          // $this->output->enable_profiler(TRUE);
            $data['lista_capitulos'] = $this->capitulos_model->capitulo_livros();                
            $this->load->view('area/inc/html-header');
            $this->load->view('area/inc/header');
            $this->load->view('area/livro', $data);
            $this->load->view('area/inc/html-footer');
	}

}