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
        $data['cat_ins_secciones_no_publicas'] = $this->InspeccionesModel->get_cat_ins_secciones_no_publicas(); // Nuevo
    
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
        // REGLAS BÁSICAS (campos siempre obligatorios)
        $this->form_validation->set_rules('Nombre_Inspeccion', 'Nombre de la Inspección', 'required');
        $this->form_validation->set_rules('Sujeto_Obligado_ID', 'Sujeto Obligado', 'required');
        $this->form_validation->set_rules('Tipo_Inspeccion', 'Tipo de Inspección', 'required');
        $this->form_validation->set_rules('Ley_Fomento', 'Ley de Fomento', 'required');
        $this->form_validation->set_rules('Dirigida_A', 'Dirigida a', 'required');
        $this->form_validation->set_rules('Caracter_Inspeccion', 'Carácter de la inspección', 'required');
        $this->form_validation->set_rules('Realizada_En', 'Realizada en', 'required');
        $this->form_validation->set_rules('Objetivo', 'Objetivo', 'required');
        $this->form_validation->set_rules('Palabras_Clave', 'Palabras Clave', 'required');
        $this->form_validation->set_rules('Periodicidad', 'Periodicidad', 'required');
        $this->form_validation->set_rules('Motivo_Inspeccion', 'Motivo de la inspección', 'required');
        $this->form_validation->set_rules('Nombre_Tramite_Servicio', 'Nombre del trámite o servicio', 'required');
        $this->form_validation->set_rules('URL_Tramite_Servicio', 'URL del trámite o servicio', 'required');
        $this->form_validation->set_rules('Fundamento_Juridico', 'Fundamento Jurídico', 'required');

        // REGLAS CONDICIONALES
        // 1. Si "Tipo_Inspeccion" es "Otra", se requiere "Especificar_Otra"
        if ($this->input->post('Tipo_Inspeccion') === 'Otra') {
            $this->form_validation->set_rules('Especificar_Otra', 'Especificar otra', 'required');
        }

        // 2. Si "Ley_Fomento" es "si", se requiere "Justificacion_Ley_Fomento"
        if ($this->input->post('Ley_Fomento') === 'si') {
            $this->form_validation->set_rules('Justificacion_Ley_Fomento', 'Justificación Ley de Fomento', 'required');
        }

        // 3. Si "Dirigida_A" es "Otras", se requiere "Especificar_Dirigida_A"
        if ($this->input->post('Dirigida_A') === 'Otras') {
            $this->form_validation->set_rules('Especificar_Dirigida_A', 'Especificar a quién va dirigida', 'required');
        }

        // 4. Si "Realizada_En" es "Otro", se requiere "Especificar_Realizada_En"
        if ($this->input->post('Realizada_En') === 'Otro') {
            $this->form_validation->set_rules('Especificar_Realizada_En', 'Especificar dónde se realiza', 'required');
        }

        // 5. Si "Motivo_Inspeccion" es "Otro", se requiere "Especificar_Motivo_Inspeccion"
        if ($this->input->post('Motivo_Inspeccion') === 'Otro') {
            $this->form_validation->set_rules('Especificar_Motivo_Inspeccion', 'Especificar motivo de la inspección', 'required');
        }

        // EJECUTAR VALIDACIÓN
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('InspeccionesController/crear');
        } else {
            // CAPTURAR TODOS LOS CAMPOS DEL FORMULARIO (todos los steps)
            $data_inspeccion = [
                'Nombre_Inspeccion'        => $this->input->post('Nombre_Inspeccion'),
                'Sujeto_Obligado_ID'       => $this->input->post('Sujeto_Obligado_ID'),
                'Tipo_Inspeccion'          => $this->input->post('Tipo_Inspeccion'),
                'Especificar_Otra'         => $this->input->post('Especificar_Otra'),
                'Ley_Fomento'              => $this->input->post('Ley_Fomento'),
                'Justificacion_Ley_Fomento'=> $this->input->post('Justificacion_Ley_Fomento'),
                'Dirigida_A'               => $this->input->post('Dirigida_A'),
                'Especificar_Dirigida_A'   => $this->input->post('Especificar_Dirigida_A'),
                'Caracter_Inspeccion'      => $this->input->post('Caracter_Inspeccion'),
                'Realizada_En'             => $this->input->post('Realizada_En'),
                'Especificar_Realizada_En' => $this->input->post('Especificar_Realizada_En'),
                'Objetivo'                 => $this->input->post('Objetivo'),
                'Palabras_Clave'           => $this->input->post('Palabras_Clave'),
                'Periodicidad'             => $this->input->post('Periodicidad'),
                'Motivo_Inspeccion'        => $this->input->post('Motivo_Inspeccion'),
                'Especificar_Motivo_Inspeccion' => $this->input->post('Especificar_Motivo_Inspeccion'),
                'Nombre_Tramite_Servicio'  => $this->input->post('Nombre_Tramite_Servicio'),
                'URL_Tramite_Servicio'     => $this->input->post('URL_Tramite_Servicio'),
                'Fundamento_Juridico'      => $this->input->post('Fundamento_Juridico'),
                // ... otros campos de los steps si aplica ...
            ];

            // Procesar archivo (si se envió)
            if (!empty($_FILES['Documento_No_Publicidad']['name'])) {
                $config['upload_path']   = './uploads/';
                $config['allowed_types'] = 'pdf|jpg|png';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('Documento_No_Publicidad')) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('InspeccionesController/crear');
                } else {
                    $uploadData = $this->upload->data();
                    $data_inspeccion['Documento_No_Publicidad'] = $uploadData['file_name'];
                }
            }

            // GUARDAR EN LA BASE DE DATOS (insertar nuevo registro)
            $this->InspeccionesModel->insert_inspeccion($data_inspeccion);

            $this->session->set_flashdata('success', 'Inspección guardada correctamente.');
            redirect('InspeccionesController');
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