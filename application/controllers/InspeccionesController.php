<?php
defined('BASEPATH') or exit('No direct script access allowed');

class InspeccionesController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->model('InspeccionesModel');
        $this->load->model('NotificacionesModel'); // Asegúrate de cargar el modelo de notificaciones
        $this->load->model('steps_inspecciones_models/step1_Model');
        $this->load->model('steps_inspecciones_models/step2_Model');
        $this->load->model('steps_inspecciones_models/step3_Model');
        $this->load->model('steps_inspecciones_models/step4_Model');
        $this->load->model('steps_inspecciones_models/step5_Model');
        $this->load->model('steps_inspecciones_models/step6_Model');
        $this->load->model('steps_inspecciones_models/step7_Model');
        $this->load->model('steps_inspecciones_models/step8_Model');
        $this->load->model('steps_inspecciones_models/step9_Model');
        $this->load->helper(['form', 'url']);
        $this->load->library(['form_validation', 'session']);
    }

    // Vista principal con listado de inspecciones
    public function index()
    {
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
    public function form($id_inspeccion = null)
    {
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
            $data['inspeccion'] = (object) $inspeccionData;
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
        $data['cat_ins_secciones_no_publicas'] = $this->InspeccionesModel->get_cat_ins_secciones_no_publicas(); // Nuevo
        $data['unidades_administrativas'] = $this->InspeccionesModel->getUnidadesAdministrativas(); // Obtener unidades administrativas
        $data['sanciones'] = $this->InspeccionesModel->get_sanciones(); // Obtener sanciones del catálogo
        $data['tipos_tiempo'] = $this->InspeccionesModel->get_tipos_tiempo(); // Obtener tipos de tiempo del catálogo
        // Notificaciones y otros datos
        $user = $this->ion_auth->user()->row();
        $group = $this->ion_auth->get_users_groups($user->id)->row();
        $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsgroups($group->name);

        // Finalmente, renderiza la vista UNA sola vez, ya con todo en $data
        $this->blade->render('inspecciones/main_agre_inspecciones', $data);
    }

    // Guardar una nueva inspección o actualizar una existente
    public function guardar()
    {
        // Recoger datos enviados de todos los steps, agrupados en subarrays
        $postData = $this->input->post();
        
        // Transformar/filtrar $postData para la tabla principal (ma_inspeccion)
        $dataMain = [];
        if (isset($postData['Homoclave']) && !empty($postData['Homoclave'])) {
            $dataMain['Homoclave'] = $postData['Homoclave'];
        }
        if (isset($postData['Nombre_Inspeccion']) && !empty($postData['Nombre_Inspeccion'])) {
            $dataMain['Nombre'] = $postData['Nombre_Inspeccion'];
        }
        if (isset($postData['Modalidad']) && !empty($postData['Modalidad'])) {
            $dataMain['Modalidad'] = $postData['Modalidad'];
        }
        if (isset($postData['Tipo_Inspeccion']) && !empty($postData['Tipo_Inspeccion'])) {
            $dataMain['Tipo'] = $postData['Tipo_Inspeccion'];
        }
        if (isset($postData['Vigencia']) && !empty($postData['Vigencia'])) {
            $dataMain['Vigencia'] = $postData['Vigencia'];
        }
        
        log_message('debug', 'Datos para update_inspeccion: ' . print_r($dataMain, true));
        
        // Insertar o actualizar la inspección principal
        if (isset($postData['id_inspeccion']) && !empty($postData['id_inspeccion'])) {
            $id_inspeccion = $postData['id_inspeccion'];
            if (!empty($dataMain)) {
                $this->InspeccionesModel->update_inspeccion($id_inspeccion, $dataMain);
            } else {
                log_message('error', 'No se actualizará la inspección ' . $id_inspeccion . ' porque $dataMain está vacío.');
            }
        } else {
            $this->InspeccionesModel->insert_inspeccion($dataMain);
            $id_inspeccion = $this->db->insert_id();
        }
        
        // Llamar a los métodos de cada step (se invocan los modelos, no controladores)
        if (isset($postData['step1'])) {
            $this->step1_Model->guardarDatosIdentificacion($id_inspeccion, $postData['step1']);
            if (!empty($postData['step1']['fundamentos'])) {
                $fundamentos = is_string($postData['step1']['fundamentos']) ? json_decode($postData['step1']['fundamentos'], true) : $postData['step1']['fundamentos'];
                $this->step1_Model->guardarFundamentosJuridicos($id_inspeccion, $fundamentos);
            }
        }
        if (isset($postData['step2'])) {
            $this->step2_Model->guardar($id_inspeccion, $postData['step2']);
        }
        if (isset($postData['step3'])) {
            $this->step3_Model->guardar_informacion($id_inspeccion, $postData['step3']);

            if (!empty($postData['step3']['derechos'])) {
                // Decodificar JSON si es necesario
                $derechos = is_string($postData['step3']['derechos']) ? json_decode($postData['step3']['derechos'], true) : $postData['step3']['derechos'];
                if (is_array($derechos)) {
                    $this->step3_Model->guardar_info_derechos($id_inspeccion, $derechos);
                } else {
                    log_message('error', 'Los datos de derechos no son un array válido.');
                }
            }

            if (!empty($postData['step3']['obligaciones'])) {
                // Decodificar JSON si es necesario
                $obligaciones = is_string($postData['step3']['obligaciones']) ? json_decode($postData['step3']['obligaciones'], true) : $postData['step3']['obligaciones'];
                if (is_array($obligaciones)) {
                    $this->step3_Model->guardar_info_obligaciones($id_inspeccion, $obligaciones);
                } else {
                    log_message('error', 'Los datos de obligaciones no son un array válido.');
                }
            }
        }
        if (isset($postData['step4'])) {
            $this->step4_Model->guardar($id_inspeccion, $postData['step4']);
        }
        if (isset($postData['step5'])) {
            $this->step5_Model->guardar($id_inspeccion, $postData['step5']);
        }
        if (isset($postData['step6'])) {
            // Se asume que step6 incluye 'ID_dependencia'
            $this->step6_Model->actualizar_estadisticas($id_inspeccion, $postData['step6']['ID_dependencia'], $postData['step6']);
        }
        if (isset($postData['step7'])) {
            $this->step7_Model->guardar_info_adicional($id_inspeccion, $postData['step7']['info_adicional']);
        }
        if (isset($postData['step8'])) {
            $this->step8_Model->guardar_no_publicidad($id_inspeccion, $postData['step8']);
            if (isset($postData['step8']['no_publicidad_secciones']) && is_array($postData['step8']['no_publicidad_secciones'])) {
                $this->step8_Model->guardar_no_publicidad_secciones($id_inspeccion, $postData['step8']['no_publicidad_secciones']);
            }
        }
        if (isset($postData['step9'])) {
            $this->step9_Model->guardar_emergencias($id_inspeccion, $postData['step9']);
        }
        
        $this->session->set_flashdata('success', 'Inspección guardada correctamente.');
        redirect('InspeccionesController/index');
    }

    // Eliminar una inspección
    public function eliminar($id)
    {
        log_message('debug', 'InspeccionesController eliminar method called with id: ' . $id);
        $this->InspeccionesModel->delete_inspeccion($id);
        $this->session->set_flashdata('success', 'Inspección eliminada correctamente.');
        redirect('InspeccionesController/index');
    }

    // Autoridad publica --> Paso 2
    public function crear()
    {
        // O, en edición, dependiendo de tu lógica...
        $data['tipos_inspeccion'] = $this->InspeccionesModel->getTiposInspeccion();
        $data['destinatarios'] = $this->InspeccionesModel->getDestinatarios();
        // ... otros catálogos que ya usas ...
        $data['unidades_administrativas'] = $this->InspeccionesModel->getUnidadesAdministrativas(); // Obtener unidades administrativas

        $this->load->view('Inspecciones/steps/autoridadpublica', $data);
    }
}