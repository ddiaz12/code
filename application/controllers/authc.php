<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class authc extends CI_Controller { 
    public function __construct() { 
        parent::__construct();
$this->load->helper('form');
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