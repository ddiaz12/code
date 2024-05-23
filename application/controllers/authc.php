<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class authc extends CI_Controller { 
    public function __construct() { 
        parent::__construct();
<<<<<<< HEAD
$this->load->helper('form');
=======
>>>>>>> a05148f4a1a5309f08fb84c081ec88949192bc96
    }

    public function login(){
        $this->blade->render('login/login');
    }

    public function forgot(){
        $this->blade->render('login/forgot');
    }

    public function register(){
        $this->blade->render('login/register');
    }

}