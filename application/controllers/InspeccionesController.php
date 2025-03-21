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
        // VALIDAR CAMPOS OBLIGATORIOS (validación extra en el servidor)
        $this->form_validation->set_rules('Nombre_Inspeccion', 'Nombre de la Inspección', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('InspeccionesController/form');
        } else {
            // 1. CAPTURAR TODOS LOS CAMPOS DEL FORMULARIO (todos los steps)
            $postData = $this->input->post();

            // Filtrar datos para la inserción en la tabla principal
            $dataMain = [];
            foreach ($postData as $key => $value) {
                if (!is_array($value)) {
                    $dataMain[$key] = $value;
                } else {
                    // Si el campo se requiere como cadena (por ejemplo, "no_publicidad"), se convierte
                    if ($key === 'no_publicidad') {
                        $dataMain[$key] = implode(',', $value);
                    }
                }
            }

            // Eliminamos el campo 'Periodicidad' ya que no existe en la tabla ma_inspeccion
            if (isset($dataMain['Periodicidad'])) {
                unset($dataMain['Periodicidad']);
            }

            // Asignar el campo Nombre de la inspección (mapeo de Nombre_Inspeccion a Nombre)
            if (isset($dataMain['Nombre_Inspeccion'])) {
                $dataMain['Nombre'] = $dataMain['Nombre_Inspeccion'];
                unset($dataMain['Nombre_Inspeccion']);
            }
            // Renombrar Tipo_Inspeccion a Tipo, ya que la columna en la tabla es "Tipo"
            if (isset($dataMain['Tipo_Inspeccion'])) {
                $dataMain['Tipo'] = $dataMain['Tipo_Inspeccion'];
                unset($dataMain['Tipo_Inspeccion']);
            }
            // Eliminar el campo Caracter_Inspeccion porque la tabla ma_inspeccion no lo tiene
            if (isset($dataMain['Caracter_Inspeccion'])) {
                unset($dataMain['Caracter_Inspeccion']);
            }
            // Eliminar campo inexistente en la tabla: Especificar_Otra
            if (isset($dataMain['Especificar_Otra'])) {
                unset($dataMain['Especificar_Otra']);
            }
            // NUEVO: Eliminar campos "Motivo_Inspeccion" y "Especificar_Motivo_Inspeccion" que no existen en la tabla ma_inspeccion
            if (isset($dataMain['Motivo_Inspeccion'])) {
                unset($dataMain['Motivo_Inspeccion']);
            }
            if (isset($dataMain['Especificar_Motivo_Inspeccion'])) {
                unset($dataMain['Especificar_Motivo_Inspeccion']);
            }
            // Cambio: Renombrar "Sujeto_Obligado_ID" a "ID_sujeto" (nombre correcto en la tabla)
            if (isset($dataMain['Sujeto_Obligado_ID'])) {
                $dataMain['ID_sujeto'] = $dataMain['Sujeto_Obligado_ID'];
                unset($dataMain['Sujeto_Obligado_ID']);
            }
            // Eliminar campos que no existen en la tabla "ma_inspeccion"
            if (isset($dataMain['Ley_Fomento'])) {
                unset($dataMain['Ley_Fomento']);
            }
            if (isset($dataMain['Justificacion_Ley_Fomento'])) {
                unset($dataMain['Justificacion_Ley_Fomento']);
            }
            // NUEVO: Eliminar campos "Dirigida_A" y "Especificar_Dirigida_A" que no existen en la tabla
            if (isset($dataMain['Dirigida_A'])) {
                unset($dataMain['Dirigida_A']);
            }
            if (isset($dataMain['Especificar_Dirigida_A'])) {
                unset($dataMain['Especificar_Dirigida_A']);
            }
            // Eliminar campos que no existen en la tabla ma_inspeccion
            if (isset($dataMain['Realizada_En'])) {
                unset($dataMain['Realizada_En']);
            }
            if (isset($dataMain['Especificar_Realizada_En'])) {
                unset($dataMain['Especificar_Realizada_En']);
            }
            // NUEVO: Remover el campo "Objetivo" ya que la columna no existe en la tabla ma_inspeccion
            if (isset($dataMain['Objetivo'])) {
                unset($dataMain['Objetivo']);
            }
            // Eliminar campos que no existen en la tabla "ma_inspeccion"
            if (isset($dataMain['Palabras_Clave'])) {
                unset($dataMain['Palabras_Clave']);
            }
            // Eliminar campos que no existen en la tabla "ma_inspeccion"
            if (isset($dataMain['Nombre_Tramite_Servicio'])) {
                unset($dataMain['Nombre_Tramite_Servicio']);
            }
            if (isset($dataMain['URL_Tramite_Servicio'])) {
                unset($dataMain['URL_Tramite_Servicio']);
            }
            // Eliminar campos que no existen en la tabla "ma_inspeccion"
            if (isset($dataMain['Fundamento_Juridico'])) {
                unset($dataMain['Fundamento_Juridico']);
            }
            // Eliminar campos que no existen en la tabla "ma_inspeccion"
            if (isset($dataMain['Oficina_Administrativa'])) {
                unset($dataMain['Oficina_Administrativa']);
            }
            // Eliminar campos que no existen en la tabla "ma_inspeccion"
            if (isset($dataMain['Bien_Elemento'])) {
                unset($dataMain['Bien_Elemento']);
            }
            // Eliminar campos inexistentes en la tabla ma_inspeccion
            if (isset($dataMain['Otros_Sujetos_Participan'])) {
                unset($dataMain['Otros_Sujetos_Participan']);
            }
            if (isset($dataMain['Buscar_Sujeto_Obligado'])) {
                unset($dataMain['Buscar_Sujeto_Obligado']);
            }
            if (isset($dataMain['Derecho_Sujeto_Regulado'])) {
                unset($dataMain['Derecho_Sujeto_Regulado']);
            }
            if (isset($dataMain['Obligacion_Sujeto_Regulado'])) {
                unset($dataMain['Obligacion_Sujeto_Regulado']);
            }
            // NUEVO: Eliminar campos de fundamentos y trámite vinculado que no existen en ma_inspeccion
            if (isset($dataMain['Nombre_Fundamento'])) {
                unset($dataMain['Nombre_Fundamento']);
            }
            if (isset($dataMain['Articulo_Fundamento'])) {
                unset($dataMain['Articulo_Fundamento']);
            }
            if (isset($dataMain['Url_Fundamento'])) {
                unset($dataMain['Url_Fundamento']);
            }
            if (isset($dataMain['Firmar_Formato'])) {
                unset($dataMain['Firmar_Formato']);
            }
            if (isset($dataMain['Tiene_Costo'])) {
                unset($dataMain['Tiene_Costo']);
            }
            if (isset($dataMain['Monto_Costo'])) {
                unset($dataMain['Monto_Costo']);
            }
            if (isset($dataMain['Monto_Fundamentado'])) {
                unset($dataMain['Monto_Fundamentado']);
            }
            if (isset($dataMain['Nombre_Fundamento_Costo'])) {
                unset($dataMain['Nombre_Fundamento_Costo']);
            }
            if (isset($dataMain['Url_Fundamento_Costo'])) {
                unset($dataMain['Url_Fundamento_Costo']);
            }
            if (isset($dataMain['Pasos_Inspector'])) {
                unset($dataMain['Pasos_Inspector']);
            }
            if (isset($dataMain['Nombre_Tramite_Vinculado'])) {
                unset($dataMain['Nombre_Tramite_Vinculado']);
            }
            // Eliminamos campos que no existen en la tabla ma_inspeccion (nuevos)
            if (isset($dataMain['Url_Tramite_Vinculado'])) {
                unset($dataMain['Url_Tramite_Vinculado']);
            }
            if (isset($dataMain['Nombre_Regulacion'])) {
                unset($dataMain['Nombre_Regulacion']);
            }
            if (isset($dataMain['Url_Regulacion'])) {
                unset($dataMain['Url_Regulacion']);
            }
            if (isset($dataMain['Otra_Sancion'])) {
                unset($dataMain['Otra_Sancion']);
            }
            if (isset($dataMain['Valor_Plazo'])) {
                unset($dataMain['Valor_Plazo']);
            }
            if (isset($dataMain['Unidad_Medida_Plazo'])) {
                unset($dataMain['Unidad_Medida_Plazo']);
            }
            if (isset($dataMain['Nombre_Formato'])) {
                unset($dataMain['Nombre_Formato']);
            }
            if (isset($dataMain['Facultades_Obligaciones'])) {
                unset($dataMain['Facultades_Obligaciones']);
            }
            if (isset($dataMain['Nombre_Servidor_Publico'])) {
                unset($dataMain['Nombre_Servidor_Publico']);
            }
            if (isset($dataMain['Url_Servidor_Publico'])) {
                unset($dataMain['Url_Servidor_Publico']);
            }
            if (isset($dataMain['Numeros_Telefonicos'])) {
                unset($dataMain['Numeros_Telefonicos']);
            }
            if (isset($dataMain['Direccion_Organos_Control'])) {
                unset($dataMain['Direccion_Organos_Control']);
            }
            if (isset($dataMain['Correo_Organos_Control'])) {
                unset($dataMain['Correo_Organos_Control']);
            }
            if (isset($dataMain['Nombre_Regulacion_Impugnacion'])) {
                unset($dataMain['Nombre_Regulacion_Impugnacion']);
            }
            if (isset($dataMain['Articulo_Regulacion_Impugnacion'])) {
                unset($dataMain['Articulo_Regulacion_Impugnacion']);
            }
            if (isset($dataMain['Parrafo_Regulacion_Impugnacion'])) {
                unset($dataMain['Parrafo_Regulacion_Impugnacion']);
            }
            if (isset($dataMain['Url_Regulacion_Impugnacion'])) {
                unset($dataMain['Url_Regulacion_Impugnacion']);
            }

            // Eliminar campos que no existen en la tabla "ma_inspeccion"
            $camposAEliminar = [
                'Enero_Inspecciones',
                'Febrero_Inspecciones',
                'Marzo_Inspecciones',
                'Abril_Inspecciones',
                'Mayo_Inspecciones',
                'Junio_Inspecciones',
                'Julio_Inspecciones',
                'Agosto_Inspecciones',
                'Septiembre_Inspecciones',
                'Octubre_Inspecciones',
                'Noviembre_Inspecciones',
                'Diciembre_Inspecciones',
                'Inspecciones_Con_Sancion',
                'Info_Adicional',
                'Permitir_Publicidad',
                'Es_Emergencia',
                'Justificacion_Emergencia'
            ];
            foreach ($camposAEliminar as $campo) {
                if (isset($dataMain[$campo])) {
                    unset($dataMain[$campo]);
                }
            }

            // Procesar archivo, si se envió
            if (!empty($_FILES['Documento_No_Publicidad']['name'])) {
                $config['upload_path'] = './uploads/';
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
            $id_inspeccion = isset($dataMain['id_inspeccion']) ? $dataMain['id_inspeccion'] : null;

            // Si es nueva inserción, asegurar no enviar el campo id_inspeccion  
            if (!$id_inspeccion) {
                unset($dataMain['id_inspeccion']);
            }

            // 3. INSERTAR O ACTUALIZAR en la tabla principal (ma_inspeccion)
            if ($id_inspeccion) {
                $this->InspeccionesModel->update_inspeccion($id_inspeccion, $dataMain);
            } else {
                $this->InspeccionesModel->insert_inspeccion($dataMain);
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

            // Guardar datos del Step 3: Información sobre la inspección
            if (isset($postData['informacion']) && is_array($postData['informacion'])) {
                $this->InspeccionesModel->guardar_info_informacion($id_inspeccion, $postData['informacion']);
            }
            if (isset($postData['info_derechos']) && is_array($postData['info_derechos'])) {
                $this->InspeccionesModel->guardar_info_derechos($id_inspeccion, $postData['info_derechos']);
            }
            if (isset($postData['info_fundamento']) && is_array($postData['info_fundamento'])) {
                $this->InspeccionesModel->guardar_info_fundamento($id_inspeccion, $postData['info_fundamento']);
            }
            if (isset($postData['info_obligaciones']) && is_array($postData['info_obligaciones'])) {
                $this->InspeccionesModel->guardar_info_obligaciones($id_inspeccion, $postData['info_obligaciones']);
            }

            // 4. GUARDAR DATOS DEL STEP 4: MÁS DETALLES
            if (
                isset($postData['Costo_Inspeccion']) ||
                isset($postData['ID_Tramite']) ||
                isset($postData['Requisitos_Archivo']) ||
                isset($postData['Tiempo_Valor']) ||
                isset($postData['ID_Tipo_Tiempo']) ||
                isset($postData['Pasos_Inspector']) ||
                isset($postData['Formato_Sujeto_Obligado_Nombre'])
            ) {
                $step4 = [
                    'Costo_Inspeccion'               => isset($postData['Costo_Inspeccion']) ? $postData['Costo_Inspeccion'] : '',
                    'ID_Tramite'                     => (isset($postData['ID_Tramite']) && trim($postData['ID_Tramite']) !== '') ? $postData['ID_Tramite'] : null,
                    'Requisitos_Archivo'             => isset($postData['Requisitos_Archivo']) ? $postData['Requisitos_Archivo'] : '',
                    'Tiempo_Valor'                   => isset($postData['Tiempo_Valor']) ? $postData['Tiempo_Valor'] : '',
                    'ID_Tipo_Tiempo'                 => (isset($postData['ID_Tipo_Tiempo']) && trim($postData['ID_Tipo_Tiempo']) !== '') ? $postData['ID_Tipo_Tiempo'] : null,
                    'Pasos_Inspector'                => isset($postData['Pasos_Inspector']) ? $postData['Pasos_Inspector'] : '',
                    'Formato_Sujeto_Obligado_Nombre' => isset($postData['Formato_Sujeto_Obligado_Nombre']) ? $postData['Formato_Sujeto_Obligado_Nombre'] : ''
                ];
                $this->InspeccionesModel->guardar_mas_detalles($id_inspeccion, $step4);
            }

            // Guardar facultades (si se envían como array, por ejemplo)
            if (isset($postData['facultades']) && is_array($postData['facultades'])) {
                $this->InspeccionesModel->guardar_mas_detalles_facultades($id_inspeccion, $postData['facultades']);
            }
            // Guardar regulaciones (si se envían como array de arreglos)
            if (isset($postData['regulaciones']) && is_array($postData['regulaciones'])) {
                $this->InspeccionesModel->guardar_mas_detalles_regulaciones($id_inspeccion, $postData['regulaciones']);
            }
            // Guardar sanciones
            if (isset($postData['sanciones']) && is_array($postData['sanciones'])) {
                $this->InspeccionesModel->guardar_mas_detalles_sanciones($id_inspeccion, $postData['sanciones']);
            }
            // Guardar servidores
            if (isset($postData['servidores']) && is_array($postData['servidores'])) {
                $this->InspeccionesModel->guardar_mas_detalles_servidores($id_inspeccion, $postData['servidores']);
            }

            // === Guardar datos del Step 5: Información de la Autoridad Pública y Contacto ===
            if (isset($postData['autoridad_contacto']) && is_array($postData['autoridad_contacto'])) {
                $this->InspeccionesModel->guardar_autoridad_contacto($id_inspeccion, $postData['autoridad_contacto']);
            }
            if (isset($postData['autoridad_contacto_impugnacion']) && is_array($postData['autoridad_contacto_impugnacion'])) {
                $this->InspeccionesModel->guardar_autoridad_contacto_impugnacion($id_inspeccion, $postData['autoridad_contacto_impugnacion']);
            }
            if (isset($postData['autoridad_contacto_telefonos']) && is_array($postData['autoridad_contacto_telefonos'])) {
                $this->InspeccionesModel->guardar_autoridad_contacto_telefonos($id_inspeccion, $postData['autoridad_contacto_telefonos']);
            }

            // Guardar estadísticas (Step 6)
            if (isset($postData['estadisticas']) && is_array($postData['estadisticas'])) {
                $this->InspeccionesModel->guardar_estadisticas($id_inspeccion, $postData['estadisticas']);
            }

            // Guardar información adicional (Step 7)
            if (isset($postData['info_adicional'])) {
                $this->InspeccionesModel->guardar_info_adicional($id_inspeccion, $postData['info_adicional']);
            }

            // Guardar datos de no publicidad (Step 8)
            if (isset($postData['no_publicidad']) && is_array($postData['no_publicidad'])) {
                $this->InspeccionesModel->guardar_no_publicidad($id_inspeccion, $postData['no_publicidad']);
            }
            if (isset($postData['no_publicidad_secciones']) && is_array($postData['no_publicidad_secciones'])) {
                $this->InspeccionesModel->guardar_no_publicidad_secciones($id_inspeccion, $postData['no_publicidad_secciones']);
            }

            // Guardar datos del Step 9: Emergencias
            if (isset($postData['emergencias']) && is_array($postData['emergencias'])) {
                $this->InspeccionesModel->guardar_emergencias($id_inspeccion, $postData['emergencias']);
            }

            // 5. MENSAJE DE ÉXITO Y REDIRECCIONAR
            $this->session->set_flashdata('success', 'Inspección guardada correctamente.');
            redirect('InspeccionesController/index');
        }
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