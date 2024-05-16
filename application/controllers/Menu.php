<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller { 
    public function __construct() { 
        parent::__construct();       
    }
    
    public function index(){
        $this->load->view('inicio');
    }

    public function menu_enviadas() {
        $this->blade->render('menu/enviadas');
    }


}