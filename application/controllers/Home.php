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
        $this->home();
    }

    public function home(){
        $user = $this->ion_auth->user()->row();
        $group = $this->ion_auth->get_users_groups($user->id)->row();
    
        $data['group'] = $group->name;
        if ($this->ion_auth->in_group('sujeto_obligado')) {
            $this->blade->render('home/home-sujeto');
        } elseif ($this->ion_auth->in_group('admin') || $this->ion_auth->in_group('sedeco')) {
            $this->blade->render('home/home-admin', $data);
        } elseif ($this->ion_auth->in_group('consejeria')) {
            $this->blade->render('home/home-consejeria');
        } else {
            redirect('auth/login', 'refresh');
        }
    }

}