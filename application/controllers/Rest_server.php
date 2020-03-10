<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Rest_server extends CI_Controller {

    public function index() //method index
    {
        $this->load->helper('url'); //load data helper

        $this->load->view('rest_server'); //tampilkan view rest server
    }
}
