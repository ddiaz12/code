<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visitas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('NotificacionesModel');// Cargar modelo de notificaciones
        // Load necessary models, libraries, etc.
        $this->load->model('Visitas_Model');
        
    }

    public function index() {

        //Correo y timer
        $user = $this->ion_auth->user()->row();
        $group = $this->ion_auth->get_users_groups($user->id)->row();
        $groupName = $group->name;
        $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsgroups($groupName);

        // Fetch data from the model
        $data['inspecciones'] = $this->Visitas_Model->get_inspecciones();

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
            // Obtener el número máximo actual y generar la nueva Homoclave
            $query = $this->db->query("SELECT IFNULL(MAX(CAST(SUBSTRING(Homoclave, LENGTH('I-IPR-CTIH-0-IPR-')+1) AS UNSIGNED)), 0) as max_val FROM inspeccion_detallada");
            $max = (int) $query->row()->max_val;
            $newNumber = $max + 1;
            $homoclaveNuevo = "I-IPR-CTIH-0-IPR-" . str_pad($newNumber, 4, "0", STR_PAD_LEFT);
            $data['homoclaveNuevo'] = $homoclaveNuevo;
            // Renderizar la vista de agregar inspección
            $this->blade->render('inspeccion/agregar_inspeccion', $data);
        }
    }
}
?>