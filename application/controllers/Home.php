<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller { 
    public function __construct() { 
        parent::__construct();       
    }
    
    public function index(){
        $this->load->view('inicio');
    }

    public function home_sujeto(){
        $this->blade->render('home/home-sujeto');
    }

    public function home_revisor(){    
    }
    
    public function home_admin(){
    }

    public function inicio($page = "inicio") {
        if(!file_exists("application/views/" . $page. ".php")){
            show_404();
        }
        $this -> load -> view($page);
    }

}