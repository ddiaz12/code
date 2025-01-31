<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inspectores extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load necessary models, libraries, etc.
        $this->load->model('Inspectores_Model');
        $this->load->helper(['form', 'url']);
        $this->load->library(['form_validation', 'session', 'upload']);
        $this->load->model('NotificacionesModel');
    }

    public function index() {


        $user = $this->ion_auth->user()->row();
        $group = $this->ion_auth->get_users_groups($user->id)->row();
        $groupName = $group->name;
        $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsgroups($groupName);
        // Fetch data from the model
        $data['inspectores'] = $this->Inspectores_Model->get_all_inspectores();

        // Load the view and pass the data
        $this->blade->render('inspectores/index', $data);
    }

    public function agregar() {
        // Logic for adding a new inspection
        if ($this->input->post()) {
            // Handle form submission
            $this->Visitas_model->add_visita($this->input->post());
            redirect('inspectores');
        } else {
            // Load the form view
            $this->blade->render    ('inspectores/agregar');
        }
    }
}
?>