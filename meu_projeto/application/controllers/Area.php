<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Area extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
		$this->load->view('area/inc/html-header');
        $this->load->view('area/area');
        $this->load->view('area/inc/html-footer');

    }



}
