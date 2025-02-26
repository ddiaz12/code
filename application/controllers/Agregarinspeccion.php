<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agregarinspeccion extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            print_r($this->ion_auth->logged_in());
            redirect('auth/login', 'refresh');
        }
        $this->load->model('AgregarInspeccionModel');
        $this->load->helper(['form', 'url']);
        $this->load->library(['form_validation', 'session', 'upload']);
        $this->load->model('NotificacionesModel');
        // Cargar el modelo correcto con el nombre "visitas_model"
        $this->load->model('visitas_model');
    }

    public function regulaciones()
    {
        // Verifica el grupo del usuario y redirige a la vista correspondiente
        if ($this->ion_auth->in_group('sujeto_obligado')) {
            $this->blade->render('sujeto/regulaciones');
        } elseif ($this->ion_auth->in_group('sedeco') || $this->ion_auth->in_group('admin')) {
            $this->blade->render('admin/regulaciones');
        } elseif ($this->ion_auth->in_group('consejeria')) {
            $this->blade->render('consejeria/regulaciones');
        } else {
            // Si el usuario no pertenece a ninguno de los grupos anteriores, redirige a la página de inicio de sesión
            redirect('auth/login', 'refresh');
        }
    }

    // Muestra la vista Blade con el formulario completo
    public function agregarinspeccion($id_inspeccion = null)
    {
        $data = [];
        if ($id_inspeccion) {
            $data['inspeccion'] = $this->visitas_model->get_inspeccion_by_id($id_inspeccion);
        }
                //Correo y timer
                $user = $this->ion_auth->user()->row();
                $group = $this->ion_auth->get_users_groups($user->id)->row();
                $groupName = $group->name;
                $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsgroups($groupName);

                $data['meses'] = [
                    'Enero','Febrero','Marzo','Abril','Mayo','Junio',
                    'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'
                ];
        
        $data['activeSection'] = $this->input->get('section') ?? 'Datos de identificación';
        // Obtener sujetos obligados para el dropdown
        $data['sujetos_obligados'] = $this->AgregarInspeccionModel->getSujetosObligados();

        $data['success'] = $this->session->flashdata('success');
        $data['error']   = $this->session->flashdata('error');

        // Renderiza la vista Blade "agregarInspeccion"
        $this->blade->render('agregarInspeccion/agregarinspeccion', $data);
    }

    // Procesa el formulario al hacer submit
    public function guardar()
    {
        $id = $this->input->post('id_inspeccion'); // Campo oculto en el formulario
        // (1) Validación básica de ejemplo
        $this->form_validation->set_rules('Nombre_Inspeccion', 'Nombre de la Inspección', 'required');
        $this->form_validation->set_rules('Sujeto_Obligado_ID', 'Sujeto Obligado', 'required');
        $this->form_validation->set_rules('Objetivo', 'Objetivo de la inspección', 'required');

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(['success' => false, 'message' => validation_errors()]);
        } else {
            // (2) Configurar SUBIDA DE ARCHIVOS (si procede)
            // Por ejemplo, subiremos "Archivo_Formato" y "Documento_No_Publicidad", 
            // y "Archivo_Declaracion_Emergencia". Haz esto para cada archivo que subas.

            $upload_path = FCPATH . 'uploads/'; // Ajusta la ruta según tu proyecto
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, TRUE);
            }

            // --- Subir Archivo_Formato (si existe) ---
            $archivo_formato_name = NULL;
            if (!empty($_FILES['Archivo_Formato']['name'])) {
                $config['upload_path'] = $upload_path;
                $config['allowed_types'] = 'jpg|png|pdf';
                $config['max_size'] = 2048; // 2MB
                $config['file_name'] = 'formato_' . time();
                $this->upload->initialize($config);
                
                if ($this->upload->do_upload('Archivo_Formato')) {
                    $archivo_formato_name = $this->upload->data('file_name');
                }
            }

            // --- Subir Documento_No_Publicidad (si existe) ---
            $documento_no_publicidad_name = NULL;
            if (!empty($_FILES['Documento_No_Publicidad']['name'])) {
                $config['file_name'] = 'nopublicidad_' . time();
                $this->upload->initialize($config);
                if ($this->upload->do_upload('Documento_No_Publicidad')) {
                    $documento_no_publicidad_name = $this->upload->data('file_name');
                }
            }

            // --- Subir Archivo_Declaracion_Emergencia (si existe) ---
            $archivo_declaracion_emergencia_name = NULL;
            if (!empty($_FILES['Archivo_Declaracion_Emergencia']['name'])) {
                $config['file_name'] = 'emergencia_' . time();
                $this->upload->initialize($config);
                if ($this->upload->do_upload('Archivo_Declaracion_Emergencia')) {
                    $archivo_declaracion_emergencia_name = $this->upload->data('file_name');
                }
            }

            // (3) Recopilar TODOS los campos del formulario
            // Aquí obtienes los campos name="..." que pusiste en la vista
            $data = [
                // Paso 1
                'Homoclave'                     => $this->input->post('Homoclave'),
                'Nombre_Inspeccion'             => $this->input->post('Nombre_Inspeccion'),
                'Modalidad'                     => $this->input->post('Modalidad'),
                'Sujeto_Obligado_ID'            => $this->input->post('Sujeto_Obligado_ID'),
                'Tipo_Inspeccion'               => $this->input->post('Tipo_Inspeccion'),
                'Dirigida_A'                    => $this->input->post('Dirigida_A'),
                'Caracter_Inspeccion'           => $this->input->post('Caracter_Inspeccion'),
                'Realizada_En'                  => $this->input->post('Realizada_En'),
                'Objetivo'                      => $this->input->post('Objetivo'),
                'Palabras_Clave'                => $this->input->post('Palabras_Clave'),
                'Periodicidad'                  => $this->input->post('Periodicidad'),
                'Motivo_Inspeccion'             => $this->input->post('Motivo_Inspeccion'),
                'Tramites_Servicios'            => $this->input->post('Tramites_Servicios'),
                'Tamano_Empresa'                => $this->input->post('Tamano_Empresa'),
                'Existe_Criterio'               => $this->input->post('Existe_Criterio'),
                'Criterio_Descripcion'          => $this->input->post('Criterio_Descripcion'),
                'Inspecciona_Sujetos_Resolucion'=> $this->input->post('Inspecciona_Sujetos_Resolucion'),
                'Nombre_Tramite_Servicio_Resol' => $this->input->post('Nombre_Tramite_Servicio_Resol'),
                'Enlace_Tramite_Servicio_Resol' => $this->input->post('Enlace_Tramite_Servicio_Resol'),
                'Fundamento_Juridico'           => $this->input->post('Fundamento_Juridico'),
                'Nombre_Tramite_Fundamento'     => $this->input->post('Nombre_Tramite_Fundamento'),
                'Enlace_Fundamento'             => $this->input->post('Enlace_Fundamento'),

                // Paso 2
                'Unidades_Administrativas'      => $this->input->post('Unidades_Administrativas'),

                // Paso 3
                'Bien_Elemento'                 => $this->input->post('Bien_Elemento'),
                'Otros_Sujetos_Participan'      => $this->input->post('Otros_Sujetos_Participan'),
                'Sujeto_Obligado_Adicional'     => $this->input->post('Sujeto_Obligado_Adicional'),
                'Derechos_Sujeto_Regulado'      => $this->input->post('Derechos_Sujeto_Regulado'),
                'Obligaciones_Sujeto_Regulado'  => $this->input->post('Obligaciones_Sujeto_Regulado'),
                'Requisitos_Inspeccion'         => $this->input->post('Requisitos_Inspeccion'),
                'Firmar_Formato'                => $this->input->post('Firmar_Formato'),
                'Archivo_Formato'               => $archivo_formato_name, // nombre de archivo subido
                'Formato_Fundamento'            => $this->input->post('Formato_Fundamento'),
                'Tiene_Costo'                   => $this->input->post('Tiene_Costo'),
                'Detalle_Costo'                 => $this->input->post('Detalle_Costo'),
                // Pasos: si en la vista lo envías como JSON o un array, conviértelo aquí:
                'Pasos'                         => $this->input->post('Pasos'),

                // Paso 4
                'Materia_Inspeccion'            => $this->input->post('Materia_Inspeccion'),
                'Sector'                        => $this->input->post('Sector'),
                'Subsector'                     => $this->input->post('Subsector'),
                'Rama'                          => $this->input->post('Rama'),
                'Subrama'                       => $this->input->post('Subrama'),
                'Clase'                         => $this->input->post('Clase'),
                'Aviso_Previo'                  => $this->input->post('Aviso_Previo'),
                'Valor_Plazo'                   => $this->input->post('Valor_Plazo'),
                'Unidad_Medida_Plazo'           => $this->input->post('Unidad_Medida_Plazo'),
                'Tipo_Sancion'                  => $this->input->post('Tipo_Sancion'),
                'Sanciones_Fundamento'          => $this->input->post('Sanciones_Fundamento'),

                // Paso 5
                'Facultades_Inspector'          => $this->input->post('Facultades_Inspector'),
                'Metodo_Inspecciones'           => $this->input->post('Metodo_Inspecciones'),
                'Contacto_Quejas'               => $this->input->post('Contacto_Quejas'),
                'Contacto_Quejas_Datos'         => $this->input->post('Contacto_Quejas_Datos'),

                // Paso 6
                'Enero_Inspecciones'            => $this->input->post('Enero_Inspecciones'),
                'Febrero_Inspecciones'          => $this->input->post('Febrero_Inspecciones'),
                'Marzo_Inspecciones'            => $this->input->post('Marzo_Inspecciones'),
                'Abril_Inspecciones'            => $this->input->post('Abril_Inspecciones'),
                'Mayo_Inspecciones'             => $this->input->post('Mayo_Inspecciones'),
                'Junio_Inspecciones'            => $this->input->post('Junio_Inspecciones'),
                'Julio_Inspecciones'            => $this->input->post('Julio_Inspecciones'),
                'Agosto_Inspecciones'           => $this->input->post('Agosto_Inspecciones'),
                'Septiembre_Inspecciones'       => $this->input->post('Septiembre_Inspecciones'),
                'Octubre_Inspecciones'          => $this->input->post('Octubre_Inspecciones'),
                'Noviembre_Inspecciones'        => $this->input->post('Noviembre_Inspecciones'),
                'Diciembre_Inspecciones'        => $this->input->post('Diciembre_Inspecciones'),
                'Inspecciones_Sancionadas'      => $this->input->post('Inspecciones_Sancionadas'),

                // Paso 7
                'Info_Adicional'                => $this->input->post('Info_Adicional'),

                // Paso 8 (No publicidad)
                'Permitir_Publicidad'           => $this->input->post('Permitir_Publicidad'),
                'Documento_No_Publicidad'       => $documento_no_publicidad_name,
                'No_Publicar_Datos_Identificacion' => $this->input->post('No_Publicar_Datos_Identificacion'),
                'No_Publicar_Contacto_Autoridad'=> $this->input->post('No_Publicar_Contacto_Autoridad'),
                'No_Publicar_Info_Inspeccion'   => $this->input->post('No_Publicar_Info_Inspeccion'),
                'No_Publicar_Info_Autoridad'    => $this->input->post('No_Publicar_Info_Autoridad'),
                'No_Publicar_Estadisticas'      => $this->input->post('No_Publicar_Estadisticas'),

                // Paso 9 (Emergencias)
                'Es_Emergencia'                 => $this->input->post('Es_Emergencia'),
                'Justificacion_Emergencia'      => $this->input->post('Justificacion_Emergencia'),
                'Archivo_Declaracion_Emergencia'=> $archivo_declaracion_emergencia_name
            ];

            // Verificar si es una edición o una nueva inserción
            if ($id) {
                // Actualizar inspección existente
                $actualizado = $this->AgregarInspeccionModel->update_inspeccion($id, $data);
                if ($actualizado) {
                    echo json_encode(['success' => true]);
                } else {
                    http_response_code(500);
                    echo json_encode(['success' => false]);
                }
            } else {
                // Insertar nueva inspección
                $insertado = $this->AgregarInspeccionModel->guardarInspeccion($data);
                if ($insertado) {
                    echo json_encode(['success' => true]);
                } else {
                    http_response_code(500);
                    echo json_encode(['success' => false]);
                }
            }
        }
    }

    public function editar($id) {
        // Obtener datos de la inspección usando el modelo visitas_model
        $data['inspeccion'] = $this->visitas_model->obtenerInspeccionPorId($id);

        //Correo y timer
        $user = $this->ion_auth->user()->row();
        $group = $this->ion_auth->get_users_groups($user->id)->row();
        $groupName = $group->name;
        $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsgroups($groupName);

        $data['meses'] = [
            'Enero','Febrero','Marzo','Abril','Mayo','Junio',
            'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'
        ];

        $data['activeSection'] = $this->input->get('section') ?? 'Datos de identificación';
        // Obtener sujetos obligados para el dropdown
        $data['sujetos_obligados'] = $this->AgregarInspeccionModel->getSujetosObligados();

        // Renderizar la misma vista de agregar inspección con datos precargados
        $this->blade->render('agregarInspeccion/agregarinspeccion', $data);
    }
}