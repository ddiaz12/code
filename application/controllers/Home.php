<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller { 
    public function __construct() { 
        parent::__construct();        
        if(!$this->ion_auth->logged_in()){
            redirect('auth/login', 'refresh');
        }    
    }
    
    public function index(){
        $this->home();
    }

    public function home(){
        $this->load->model('NotificacionesModel');
        $user = $this->ion_auth->user()->row();
        $group = $this->ion_auth->get_users_groups($user->id)->row();
        $userId = $user->id;
        $rol = $group->name;

        $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsgroups($rol);
        if ($this->ion_auth->in_group('sujeto_obligado')) {
            $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsId($userId);
            $this->blade->render('home/home-sujeto', $data);
        } elseif ($this->ion_auth->in_group('admin') || $this->ion_auth->in_group('sedeco')) {
            $this->blade->render('home/home-admin', $data);
        } elseif ($this->ion_auth->in_group('consejeria')) {
            $this->blade->render('home/home-consejeria', $data);
        } else {
            redirect('auth/login', 'refresh');
        }
    }

}