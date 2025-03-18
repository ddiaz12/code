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
    public function guardar() {
        // VALIDAR CAMPOS OBLIGATORIOS (validación extra en el servidor)
        $this->form_validation->set_rules('Nombre_Inspeccion', 'Nombre de la Inspección', 'required');
        
        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('InspeccionesController/form');
        } else {
            // 1. CAPTURAR TODOS LOS CAMPOS DEL FORMULARIO (todos los steps)
            $postData = $this->input->post();
            
            // Procesar archivo, si se envió
            if (!empty($_FILES['Documento_No_Publicidad']['name'])) {
                $config['upload_path']   = './uploads/';
                $config['allowed_types'] = 'pdf|jpg|png';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('Documento_No_Publicidad')) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('InspeccionesController/form');
                } else {
                    $uploadData = $this->upload->data();
                    $postData['Documento_No_Publicidad'] = $uploadData['file_name'];
                }
            }
            
            // 2. PREPARAR LOS DATOS DE LA INSPECCIÓN
            // Asumimos que todos los campos de los 9 steps se integran en $postData.  
            // Puedes filtrar o transformar datos específicos si es necesario.
            $id_inspeccion = isset($postData['id_inspeccion']) ? $postData['id_inspeccion'] : null;
            
            // 3. INSERTAR O ACTUALIZAR en la tabla principal (ma_inspeccion)
            if ($id_inspeccion) {
                $this->InspeccionesModel->update_inspeccion($id_inspeccion, $postData);
            } else {
                $this->InspeccionesModel->insert_inspeccion($postData);
                $id_inspeccion = $this->db->insert_id(); // en caso de necesitarlo para guardar relaciones
            }
            
            // Guardar datos del Step 1 en la tabla rel_ins_datos_identificacion
            if (isset($postData['datos_identificacion']) && is_array($postData['datos_identificacion'])) {
                $datos_step1 = $postData['datos_identificacion'];
                $this->InspeccionesModel->guardar_datos_identificacion($id_inspeccion, $datos_step1);
            }

            // Guardar datos del Step 2: Autoridad Pública
            if (isset($postData['ID_unidad']) && !empty($postData['ID_unidad'])) {
                $this->InspeccionesModel->guardar_autoridad_publica($id_inspeccion, $postData['ID_unidad']);
            }
            
            // 4. GUARDAR DATOS RELACIONADOS (ejemplo: checkboxes de No_Publicar)
            // if(!empty($postData['No_Publicar'])) {
            //     foreach($postData['No_Publicar'] as $seccion_id) {
            //         $this->InspeccionesModel->guardar_no_publicar($id_inspeccion, $seccion_id);
            //     }
            // }
            
            // 5. MENSAJE DE ÉXITO Y REDIRECCIONAR
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

    // Autoridad publica --> Paso 2
    public function crear() {
        // O, en edición, dependiendo de tu lógica...
        $data['tipos_inspeccion'] = $this->InspeccionesModel->getTiposInspeccion();
        $data['destinatarios'] = $this->InspeccionesModel->getDestinatarios();
        // ... otros catálogos que ya usas ...
        $data['unidades_administrativas'] = $this->InspeccionesModel->getUnidadesAdministrativas(); // Obtener unidades administrativas
    
        $this->load->view('Inspecciones/steps/autoridadpublica', $data);
    }
}