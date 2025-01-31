<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visitas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('NotificacionesModel');// Cargar modelo de notificaciones
        // Load necessary models, libraries, etc.
        $this->load->model('Visitas_model');
        
    }

    public function index() {

        //Correo y timer
        $user = $this->ion_auth->user()->row();
        $group = $this->ion_auth->get_users_groups($user->id)->row();
        $groupName = $group->name;
        $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsgroups($groupName);

        // Fetch data from the model
        $data['visitas'] = $this->Visitas_model->get_all_visitas();

        // Load the view and pass the data
        $this->blade->render('visitas/index', $data);
    }

    public function agregar() {
        // Logic for adding a new inspection
        if ($this->input->post()) {
            // Handle form submission
            $this->Visitas_model->add_visita($this->input->post());
            redirect('visitas');
        } else {
            // Load the form view
            $this->blade->render    ('visitas/agregar');
        }
    }
}
?>