<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class erro404 extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }
    
    public function index()
    {
        $this->load->view('erros/cli/error_general');
    }
}

/* End of file erro404.php */
/* Location: ./application/controllers/erro404.php */