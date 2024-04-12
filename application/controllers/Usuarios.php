<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller { 
    public function __construct() { 
        parent::__construct();       
    }
    
    public function index(){
        $this->load->view('inicio');
    }

    public function usuario()
    {
        $this->blade->render('sujeto/usuarios');
    }

    public function agregar_usuario()
    {
        $this->blade->render('sujeto/agregar-usuario');
    }


}