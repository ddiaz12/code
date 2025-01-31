<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AgregarInspector extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('AgregarInspectorModel');
        $this->load->helper(['form', 'url']);
        $this->load->library(['form_validation', 'session']);
        $this->load->model('NotificacionesModel');
    }

    // Método para mostrar la vista "agregarInspector.blade.php"
    public function agregarInspector()
    {
        $user = $this->ion_auth->user()->row();
        $group = $this->ion_auth->get_users_groups($user->id)->row();
        $groupName = $group->name;
        $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsgroups($groupName);

        // Carga la vista Blade con un formulario simple
        $this->blade->render('inspector/agregarInspector', $data);
    }

    // Procesa los datos del formulario
    public function guardar()
    {
        // Validaciones básicas
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('apellidos', 'Apellidos', 'required');
        $this->form_validation->set_rules('email', 'Correo Electrónico', 'valid_email');

        if ($this->form_validation->run() === FALSE) {
            // Si hay errores de validación, recarga la vista
            $this->agregarInspector(); 
            // O si prefieres, redirige a la misma URL: redirect('AgregarInspector/agregarInspector');
        } else {
            // Tomar los datos del POST
            $data = [
                'nombre'   => $this->input->post('nombre'),
                'apellidos'=> $this->input->post('apellidos'),
                'cargo'    => $this->input->post('cargo'),
                'telefono' => $this->input->post('telefono'),
                'email'    => $this->input->post('email'),
                'status'   => 1 // Activo por defecto
            ];

            // Llamamos al modelo para guardar
            if ($this->AgregarInspectorModel->guardarInspector($data)) {
                $this->session->set_flashdata('success', 'Inspector agregado correctamente.');
            } else {
                $this->session->set_flashdata('error', 'Hubo un error al guardar el inspector.');
            }
            // Redirigir a la vista principal de inspectores o a donde quieras
            redirect('AgregarInspector/agregarInspector');
        }
    }
}
