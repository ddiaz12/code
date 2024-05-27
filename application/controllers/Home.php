<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller { 
    public function __construct() { 
        parent::__construct();        
        if(!$this->ion_auth->logged_in()){
            print_r($this->ion_auth->logged_in());
            redirect('auth/login', 'refresh');
        }    
    }
    
    public function index(){
        $this->home_sujeto();
    }
    public function home_admin(){
    }

    public function home_sujeto(){
        if (!$this->ion_auth->in_group('admin') && !$this->ion_auth->in_group('Sujeto_obligado')) {
            redirect('auth/login', 'refresh');
        }
        $this->blade->render('home/home-sujeto');
    }

    public function home_revisor(){  
        $this->blade->render('home/home-revisor'); 
    }

    public function home_consejeria(){
        $this->blade->render('home/home-consejeria');
    }
    

    public function inicio($page = "inicio") {
        if(!file_exists("application/views/" . $page. ".php")){
            show_404();
        }
        $this -> load -> view($page);
    }

}