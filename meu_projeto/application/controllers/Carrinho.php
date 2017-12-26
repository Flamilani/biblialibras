<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carrinho extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('cart');     
    }

   /* public function index() {
    	echo "<pre>";
    	print_r($this->cart->contents());
    }

    public function adicionar() {
        $this->output->enable_profiler(TRUE);
        $data = array(
            'id' => $this->input->post('id'),
            'qty' => $this->input->post('quantidade'),
            'price' => $this->input->post('preco'),
            'name' => $this->input->post('nome'),
            'url' => $this->input->post('url'),
            'foto' => $this->input->post('foto')
        );
        $this -> cart -> insert($data);
        redirect(base_url('carrinho'));
    }*/


}