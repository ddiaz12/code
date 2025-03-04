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
        // Se preparan las variables a pasar a la vista
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
            'tipos_inspeccion' => $this->InspeccionesModel->get_tipos_inspeccion(), // Obtener tipos de inspección del catálogo
            'inspeccion' => null,
            'tipoSeleccionado' => null
        ];
    
        // Si recibes un ID, carga la inspección
        if ($id_inspeccion) {
            $inspeccionData = $this->InspeccionesModel->get_inspeccion_by_id($id_inspeccion);
            $data['inspeccion'] = (object)$inspeccionData;
            $data['tipoSeleccionado'] = isset($data['inspeccion']->Tipo_Inspeccion)
                                        ? $data['inspeccion']->Tipo_Inspeccion
                                        : null;
        }
    
        // Carga de sujetos obligados, destinatarios, caracteres de inspección, lugares de realización, periodicidades, motivos de inspección y tipos de ordenamiento
        $data['sujetos_obligados'] = $this->InspeccionesModel->get_sujetos_obligados();
        $data['destinatarios'] = $this->InspeccionesModel->get_destinatarios(); // Nuevo
        $data['caracteres_inspeccion'] = $this->InspeccionesModel->get_caracteres_inspeccion(); // Nuevo
        $data['lugares_realizacion'] = $this->InspeccionesModel->get_lugares_realizacion(); // Nuevo
        $data['periodicidades'] = $this->InspeccionesModel->get_periodicidades(); // Nuevo
        $data['motivos_inspeccion'] = $this->InspeccionesModel->get_motivos_inspeccion(); // Nuevo
        $data['cat_tipo_ord_jur'] = $this->InspeccionesModel->get_tipo_ord_jur(); // Nuevo
        $data['tipos_ordenamiento'] = $this->InspeccionesModel->get_tipo_ord_jur(); // Nuevo
    
        // Notificaciones y otros datos
        $user = $this->ion_auth->user()->row();
        $group = $this->ion_auth->get_users_groups($user->id)->row();
        $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsgroups($group->name);
    
        // Finalmente, renderiza la vista UNA sola vez, ya con todo en $data
        $this->blade->render('inspecciones/main_agre_inspecciones', $data);
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

            // Guardar fundamentos jurídicos si existen
            if (isset($data['Fundamentos_Juridicos'])) {
                $this->InspeccionesModel->guardar_fundamentos_juridicos($data['id_inspeccion'], $data['Fundamentos_Juridicos']);
            }

            // Guardar oficinas seleccionadas si existen
            if (isset($data['Oficinas_Seleccionadas'])) {
                $this->InspeccionesModel->guardar_oficinas($data['id_inspeccion'], $data['Oficinas_Seleccionadas']);
            }

            // Guardar sujetos obligados seleccionados si existen
            if (isset($data['Sujetos_Obligados_Seleccionados'])) {
                $this->InspeccionesModel->guardar_sujetos_obligados($data['id_inspeccion'], $data['Sujetos_Obligados_Seleccionados']);
            }

            // Guardar derechos del sujeto regulado si existen
            if (isset($data['Derechos_Sujeto_Regulado'])) {
                $this->InspeccionesModel->guardar_derechos($data['id_inspeccion'], $data['Derechos_Sujeto_Regulado']);
            }

            // Guardar obligaciones del sujeto regulado si existen
            if (isset($data['Obligaciones_Sujeto_Regulado'])) {
                $this->InspeccionesModel->guardar_obligaciones($data['id_inspeccion'], $data['Obligaciones_Sujeto_Regulado']);
            }

            // Guardar facultades del sujeto obligado si existen
            if (isset($data['Facultades_Sujeto_Obligado'])) {
                $this->InspeccionesModel->guardar_facultades($data['id_inspeccion'], $data['Facultades_Sujeto_Obligado']);
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