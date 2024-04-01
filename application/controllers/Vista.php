<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vista extends CI_Controller {

    
    
    public function __construct(){
        parent::__construct();
        $this->load->model('OficinaModel');
    }

    public function oficina(){
        $data["oficinas"] = $this->OficinaModel->getOficinas();
        $this->load->view('header');
        $this->load->view('sujeto/oficinas', $data);
    }
}