<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InspeccionesController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->model('InspeccionesModel');
        $this->load->model('NotificacionesModel'); // Asegúrate de cargar el modelo de notificaciones
        $this->load->helper(['form', 'url']);
        $this->load->library(['form_validation', 'session']);
    }

    // Vista principal con listado de inspecciones
    public function index() {
        log_message('debug', 'InspeccionesController index method called');
        $data['inspecciones'] = $this->InspeccionesModel->get_inspecciones();
        log_message('debug', 'Inspecciones data: ' . print_r($data['inspecciones'], true));

        // Definir la variable unread_notifications
        $user = $this->ion_auth->user()->row();
        $group = $this->ion_auth->get_users_groups($user->id)->row();
        $groupName = $group->name;
        $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsgroups($groupName);

        // Gestiona las vista depende el usuario que este logeado
        $id = $user->id;
        if ($this->ion_auth->in_group('sujeto_obligado')) {
            $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsId($id);
            $this->blade->render('inspecciones/SOindex', $data);
        } elseif ($this->ion_auth->in_group('sedeco') || $this->ion_auth->in_group('admin')) {
            $this->blade->render('inspecciones/index', $data);
        } elseif ($this->ion_auth->in_group('consejeria')) {
            $this->blade->render('inspecciones/index', $data);
        } else {
            // Si el usuario no pertenece a ninguno de los grupos anteriores, redirige a la página de inicio de sesión
            redirect('auth/logout', 'refresh');
        }
    }

    // Cargar formulario para agregar o editar inspección
    public function form($id_inspeccion = null) {
        log_message('debug', 'InspeccionesController form method called with id: ' . $id_inspeccion);
        
        // Definir datos iniciales
        $data = [
            'pasos' => [
                "Datos de identificación",
                "Autoridad Pública",
                "Información sobre la inspección",
                "Más detalles",
                "Información de la Autoridad Pública y Contacto",
                "Estadísticas",
                "Información adicional",
                "No publicidad",
                "Emergencias"
            ],
            'tipos_inspeccion' => ["Asesoria", "Asistencia", "Control", "Corroboración", "Otra", "Promoción", "Supervisión", "Vigilancia"],
            'inspeccion' => null, // Inicializa inspección como null por defecto
            'tipoSeleccionado' => null // Inicializa tipoSeleccionado
        ];
    
        // Si se proporciona un ID, obtener los datos de la inspección
        if ($id_inspeccion) {
            $data['inspeccion'] = $this->InspeccionesModel->get_inspeccion_by_id($id_inspeccion);
            log_message('debug', 'Inspeccion data: ' . print_r($data['inspeccion'], true));
    
            // Si la inspección tiene un tipo, pasarlo a la vista
            $data['tipoSeleccionado'] = isset($data['inspeccion']->Tipo_Inspeccion) ? $data['inspeccion']->Tipo_Inspeccion : null;
        }
    
        // Obtener usuario y grupo para notificaciones
        $user = $this->ion_auth->user()->row();
        $group = $this->ion_auth->get_users_groups($user->id)->row();
        $groupName = $group->name;
        $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsgroups($groupName);
    
        // Renderizar vista con datos
        $this->blade->render('inspecciones/agregarinspeccion', $data);
    }
    // Guardar una nueva inspección o actualizar una existente
    public function guardar() {
        log_message('debug', 'InspeccionesController guardar method called');
        $this->form_validation->set_rules('Nombre_Inspeccion', 'Nombre de la Inspección', 'required');
        
        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('InspeccionesController/form');
        } else {
            $data = $this->input->post();
            log_message('debug', 'Form data: ' . print_r($data, true));
            
            if ($data['id_inspeccion']) {
                $this->InspeccionesModel->update_inspeccion($data['id_inspeccion'], $data);
            } else {
                $this->InspeccionesModel->insert_inspeccion($data);
            }
            $this->session->set_flashdata('success', 'Inspección guardada correctamente.');
            redirect('InspeccionesController/index');
        }
    }

    // Eliminar una inspección
    public function eliminar($id) {
        log_message('debug', 'InspeccionesController eliminar method called with id: ' . $id);
        $this->InspeccionesModel->delete_inspeccion($id);
        $this->session->set_flashdata('success', 'Inspección eliminada correctamente.');
        redirect('InspeccionesController/index');
    }
}
