<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Regulaciones extends CI_Controller { 
    public function __construct() { 
        parent::__construct();        
        if(!$this->ion_auth->logged_in()){
            print_r($this->ion_auth->logged_in());
            redirect('auth/login', 'refresh');
        }    
    }
    
    public function index(){
        $this->regulaciones();
    }
   
    public function regulaciones(){
        $this->blade->render('home/regulaciones2');
    }

    public function caracteristicas_reg(){
        $this->blade->render('home/caracteristicas-regulaciones');
    }
    public function mat_exentas(){
        $this->blade->render('home/materias-exentas');
    }
    public function nat_regulaciones(){
        $this->blade->render('home/nat-regulacioes');
    }

}