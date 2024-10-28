<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RegulacionController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('RegulacionModel');
        $this->load->model('NotificacionesModel');
        $this->load->config('ftp_config');
        date_default_timezone_set('America/Mexico_City');
    }

    private function connectFTP()
    {
        $config = $this->config->item('ftp');
        $this->ftp->connect($config);
    }

    private function disconnectFTP()
    {
        $this->ftp->close();
    }



    public function index()
    {
        $this->regulaciones();
    }

    public function regulaciones()
    {
        $user = $this->ion_auth->user()->row();
        $group = $this->ion_auth->get_users_groups($user->id)->row();
        $groupName = $group->name;
        $iduser = $user->id;
        $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsgroups($groupName);
        $data['regulaciones'] = $this->RegulacionModel->get_all_regulaciones();
        if ($this->ion_auth->in_group('sujeto_obligado')) {
            $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsId($iduser);
            $data['regulaciones'] = $this->RegulacionModel->get_regulaciones_por_usuario($iduser);
            $this->blade->render('sujeto/regulaciones2', $data);
        } elseif ($this->ion_auth->in_group('admin') || $this->ion_auth->in_group('sedeco')) {
            $this->blade->render('regulaciones/regulaciones2', $data);
        } elseif ($this->ion_auth->in_group('consejeria')) {
            $this->blade->render('consejeria/regulaciones2', $data);
        } else {
            redirect('auth/login', 'refresh');
        }
    }

    public function caracteristicas_reg()
    {
        $user = $this->ion_auth->user()->row();
        $group = $this->ion_auth->get_users_groups($user->id)->row();
        $groupName = $group->name;
        $id = $user->id;
        $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsId($id);
        $data['tipos_ordenamiento'] = $this->RegulacionModel->getTiposOrdenamiento2();
        $data['indices'] = $this->RegulacionModel->getIndices();

        if ($this->ion_auth->in_group('sujeto_obligado')) {
            $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsId($id);
            $this->blade->render('sujeto/caracteristicas-regulaciones', $data);
        } elseif ($this->ion_auth->in_group('admin') || $this->ion_auth->in_group('sedeco')) {
            $this->blade->render('regulaciones/caracteristicas-regulaciones', $data);
        } elseif ($this->ion_auth->in_group('consejeria')) {
            $this->blade->render('consejeria/caracteristicas-regulaciones', $data);
        } else {
            redirect('auth/login', 'refresh');
        }
    }

    public function mat_exentas()
    {
        $user = $this->ion_auth->user()->row();
        $group = $this->ion_auth->get_users_groups($user->id)->row();
        $groupName = $group->name;
        $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsgroups($groupName);
        // Obtener los datos de la regulación
        //$data['regulacion'] = $this->RegulacionModel->get_regulacion_by_id($id_regulacion);
        if ($this->ion_auth->in_group('sujeto_obligado')) {
            $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsgroups($groupName);
            $this->blade->render('sujeto/materias-exentas', $data);
        } elseif ($this->ion_auth->in_group('admin') || $this->ion_auth->in_group('sedeco')) {
            $this->blade->render('regulaciones/materias-exentas', $data);
        } elseif ($this->ion_auth->in_group('consejeria')) {
            $this->blade->render('consejeria/materias-exentas', $data);
        } else {
            redirect('auth/login', 'refresh');
        }
    }

    public function nat_regulaciones()
    {
        $user = $this->ion_auth->user()->row();
        $group = $this->ion_auth->get_users_groups($user->id)->row();
        $groupName = $group->name;
        $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsgroups($groupName);

        if ($this->ion_auth->in_group('sujeto_obligado')) {
            $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsgroups($groupName);
            $this->blade->render('sujeto/nat-regulacioes', $data);
        } elseif ($this->ion_auth->in_group('admin') || $this->ion_auth->in_group('sedeco')) {
            $this->blade->render('regulaciones/nat-regulacioes', $data);
        } elseif ($this->ion_auth->in_group('consejeria')) {
            $this->blade->render('consejeria/nat-regulacioes', $data);
        } else {
            redirect('auth/login', 'refresh');
        }
    }

    public function edit_caract($id_regulacion)
    {
        $user = $this->ion_auth->user()->row();
        $group = $this->ion_auth->get_users_groups($user->id)->row();
        $groupName = $group->name;
        $iduser = $user->id;
        $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsgroups($groupName);
        // Cargar el modelo
        $this->load->model('RegulacionModel');

        $data['tipos_ordenamiento'] = $this->RegulacionModel->getTiposOrdenamiento2();
        $data['indices'] = $this->RegulacionModel->getIndices();

        // Obtener los datos de la regulación
        $data['regulacion'] = $this->RegulacionModel->get_regulacion_by_id($id_regulacion);

        // Obtener las características de la regulación
        $data['caracteristicas'] = $this->RegulacionModel->get_caracteristicas_by_id($id_regulacion);

        // Obtener el tipo de ordenamiento guardado
        $data['tipo_ordenamiento_guardado'] = $this->RegulacionModel->get_tipo_ordenamiento_by_id($data['caracteristicas']['ID_tOrdJur']);

        // Obtener los ID_Emiten y ID_caract
        $data['emiten'] = $this->RegulacionModel->get_emiten_by_caract($data['caracteristicas']['ID_caract']);

        // Extraer los ID_Emiten en un array
        $emiten_ids = array_column($data['emiten'], 'ID_Emiten');

        // Obtener las dependencias basadas en los ID_Emiten
        $data['dependencias'] = $this->RegulacionModel->get_dependencias_by_emiten($emiten_ids);

        // Obtener los ID_Aplican y ID_caract
        $data['aplican'] = $this->RegulacionModel->get_aplican_by_caract($data['caracteristicas']['ID_caract']);

        // Extraer los ID_Aplican en un array
        $aplican_ids = array_column($data['aplican'], 'ID_Aplican');

        // Obtener las dependencias basadas en los ID_Aplican
        $data['dependenciasAp'] = $this->RegulacionModel->get_dependencias_by_aplican($aplican_ids);

        // Obtener los ID_Indice y ID_caract
        $data['indice'] = $this->RegulacionModel->get_indices_by_caract($data['caracteristicas']['ID_caract']);

        // Extraer los ID_Indice en un array
        $indice_ids = array_column($data['indice'], 'ID_Indice');

        // Obtener los indices basados en los ID_Indice
        $data['relindice'] = $this->RegulacionModel->get_rel_by_indice($indice_ids);

        // obtener los datos de la tabla de mat_sec_suj
        $data['mat_sec'] = $this->RegulacionModel->get_mat_sec_by_id_caract($data['caracteristicas']['ID_caract']);

        // obtener los datos de la tabla de mat_sec_suj
        $data['fundamentos'] = $this->RegulacionModel->get_fun_by_id_caract($data['caracteristicas']['ID_caract']);

        // Pasar los datos a la vista
        if ($this->ion_auth->in_group('sujeto_obligado')) {
            $this->blade->render('sujeto/editar_caracteristicas', $data);
        } elseif ($this->ion_auth->in_group('admin') || $this->ion_auth->in_group('sedeco')) {
            $this->blade->render('regulaciones/editar_caracteristicas', $data);
        } elseif ($this->ion_auth->in_group('consejeria')) {
            $this->blade->render('consejeria/editar_caracteristicas', $data);
        } else {
            redirect('auth/login', 'refresh');
        }
    }

    public function edit_mat($id_regulacion)
    {
        $user = $this->ion_auth->user()->row();
        $group = $this->ion_auth->get_users_groups($user->id)->row();
        $groupName = $group->name;
        $iduser = $user->id;
        $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsgroups($groupName);
        // Cargar el modelo
        $this->load->model('RegulacionModel');

        // Obtener los datos de la regulación
        $data['regulacion'] = $this->RegulacionModel->get_regulacion_by_id($id_regulacion);

        // Obtener las materias relacionadas con la regulación
        $materias = $this->RegulacionModel->get_materias_by_regulacion($id_regulacion);

        // Verificar si hay materias relacionadas
        $has_materias = $this->RegulacionModel->has_materias($id_regulacion);

        // Pasar los datos a la vista
        $data['materias'] = $materias;
        $data['has_materias'] = $has_materias;

        if ($this->ion_auth->in_group('sujeto_obligado')) {
            $this->blade->render('sujeto/editar_materias', $data);
        } elseif ($this->ion_auth->in_group('admin') || $this->ion_auth->in_group('sedeco')) {
            $this->blade->render('regulaciones/editar_materias', $data);
        } elseif ($this->ion_auth->in_group('consejeria')) {
            $this->blade->render('consejeria/editar_materias', $data);
        } else {
            redirect('auth/login', 'refresh');
        }
    }

    public function edit_nat($id_regulacion)
    {
        $user = $this->ion_auth->user()->row();
        $group = $this->ion_auth->get_users_groups($user->id)->row();
        $groupName = $group->name;
        $iduser = $user->id;
        $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsgroups($groupName);

        // Obtener los datos de la regulación
        $data['regulacion'] = $this->RegulacionModel->get_regulacion_by_id($id_regulacion);
        // Obtener los datos de la naturaleza de natreg
        $data['natreg'] = $this->RegulacionModel->get_rel_nat_reg_by_id($id_regulacion);
        if ($data['natreg'] == null) {
            $data['id_nat'] = $this->RegulacionModel->get_max_id_nat()+1;
        } else {
            $data['id_nat'] = $data['natreg']['ID_Nat'];
            $data['naturaleza'] = $this->RegulacionModel->get_de_naturaleza_regulacion_by_id($data['natreg']['ID_Nat']);
            $data['vinculadas'] = $this->RegulacionModel->get_derivada_reg_by_id($data['natreg']['ID_Nat']);
            $data['tramites'] = $this->RegulacionModel->get_tramites_by_id_nat($data['natreg']['ID_Nat']);
            $data['enlace_oficial'] = $data['naturaleza']['Enlace_Oficial'];
        }
        $data['natreg2'] = $this->RegulacionModel->get_naturaleza_regulacion_by_regulacion($id_regulacion);
        //Obtener de_naturaleza_regulacion por ID_Nat
        $data['natural'] = $this->RegulacionModel->getNaturalezaRegulacionByRegulacion($id_regulacion);
        $data['regulaciones'] = $this->RegulacionModel->get_regulaciones_by_id($id_regulacion);

        if ($this->ion_auth->in_group('sujeto_obligado')) {
            $this->blade->render('sujeto/editar_naturaleza', $data);
        } elseif ($this->ion_auth->in_group('admin') || $this->ion_auth->in_group('sedeco')) {
            $this->blade->render('regulaciones/editar_naturaleza', $data);
        } elseif ($this->ion_auth->in_group('consejeria')) {
            $this->blade->render('consejeria/editar_naturaleza', $data);
        } else {
            redirect('auth/login', 'refresh');
        }
    }

    public function search()
    {
        $query = $this->input->get('query');
        $results = $this->RegulacionModel->search_tipo_dependencia($query);
        echo json_encode($results);
    }

    public function getMaxValues()
    {
        $this->load->model('RegulacionModel');
        $maxValues = $this->RegulacionModel->getMaxValues();
        echo json_encode($maxValues);
    }

    public function insertarRegulacion()
    {
        $user = $this->ion_auth->user()->row();
        $group = $this->ion_auth->get_users_groups($user->id)->row();
        $groupName = $group->name;
        $id = $user->id;
        $formData = $this->input->post();

        // Verificar que los índices existan en formData
        if (!isset($formData['nombre']) || !isset($formData['campoExtra'])) {
            echo json_encode(array('status' => 'error', 'message' => 'Datos incompletos'));
            return;
        }

        // Determinar el estatus basado en el grupo del usuario
        $Estatus = 0; // Valor por defecto
        if ($groupName == 'admin' || $groupName == 'sedeco') {
            $Estatus = 1;
        } elseif ($groupName == 'sujeto_obligado') {
            $Estatus = 0;
        }

        // Preparar los datos para insertar
        $data = array(
            'ID_tRegulacion' => NULL,
            'id_usuario_creador' => $id,
            'Nombre_Regulacion' => $formData['nombre'],
            'Homoclave' => 'R-IPR-CHH-0-IPR-001',
            'Estatus' => $Estatus,
            'Vigencia' => $formData['campoExtra'],
            'Objetivo_Reg' => $formData['objetivoReg'],
            'Fecha_Cre_Sys' => date('Y-m-d'),// Agregar solo la fecha del sistema
            'Fecha_Act_Sys' => date('Y-m-d')
        );

        // Insertar los datos
        $id_regulacion = $this->RegulacionModel->insertRegulacion($data);

        // Registrar el movimiento en la trazabilidad
        $dataTrazabilidad = [
            'ID_Regulacion' => $id_regulacion,
            'fecha_movimiento' => date('Y-m-d H:i:s'),
            'descripcion_movimiento' => 'Regulación Creada',
            'usuario_responsable' => $user->email,
            'estatus_anterior' => null,
            'estatus_nuevo' => 'Creada'
        ];

        //guardar relacion usuario-regulacion
        $this->RegulacionModel->insertar_rel_usuario_regulacion($id, $id_regulacion);

        $this->RegulacionModel->registrarMovimiento($dataTrazabilidad);

        // Responder a la solicitud AJAX
        echo json_encode(array('status' => 'success'));
    
    }

    public function obtenerMaxIDRegulacion()
    {
        $maxID = $this->RegulacionModel->getMaxID();
        $newID = $maxID;
        echo $newID;
    }

    public function obtenerMaxIDCaract()
    {
        $this->load->database();
        $query = $this->db->query("SELECT MAX(ID_caract) as maxID FROM de_regulacion_caracteristicas");
        $result = $query->row();
        if ($result->maxID == null) {
            $result->maxID = 1;
        }else{
            $result->maxID = $result->maxID;
        }
    }

    public function insertarCaracteristicas()
    {
        $this->load->database();
        $data = array(
            'ID_Regulacion' => $this->input->post('ID_Regulacion'),
            'ID_tOrdJur' => $this->input->post('ID_tOrdJur') !== '' ? $this->input->post('ID_tOrdJur') : NULL,
            'Nombre' => $this->input->post('Nombre'),
            'Ambito_Aplicacion' => $this->input->post('Ambito_Aplicacion'),
            'Fecha_Exp' => $this->input->post('Fecha_Exp'),
            'Fecha_Publi' => $this->input->post('Fecha_Publi'),
            'Fecha_Vigor' => $this->input->post('Fecha_Vigor'),
            'Fecha_Act' => $this->input->post('Fecha_Act'),
            'Vigencia' => $this->input->post('Vigencia'),
            'Orden_Gob' => $this->input->post('Orden_Gob')
        );

        $this->db->insert('de_regulacion_caracteristicas', $data);
        if ($this->db->affected_rows() > 0) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'error'));
        }
    }

    public function insertarRelAutoridadesEmiten()
    {
        // Cargar el modelo
        $this->load->model('RegulacionModel');
        

        // Obtener los datos de la solicitud POST
        $ID_Emiten = $this->input->post('ID_Emiten');
        $ID_Caract = $this->input->post('ID_Caract');
        if (!isset($ID_Caract) || $ID_Caract == null || $ID_Caract == '' || $ID_Caract == 'N/A' || !is_numeric($ID_Caract)) {
            $this->load->database();
            $query = $this->db->query("SELECT MAX(ID_caract) as maxID FROM de_regulacion_caracteristicas");
            $result = $query->row();
            if ($result->maxID == null) {
                $ID_Caract = 1;
            }else{
                $ID_Caract = $result->maxID;
            }
        }
        // print_r('ID_Emiten');
        // print_r($ID_Emiten);
        // print_r('ID_Caract');
        // print_r($ID_Caract);

        // Validar los datos
        if (empty($ID_Emiten) || empty($ID_Caract)) {
            echo json_encode(['status' => 'error', 'message' => 'Datos incompletos']);
            return;
        }

        // Preparar los datos para la inserción
        $data = [
            'ID_Emiten' => $ID_Emiten,
            'ID_Caract' => $ID_Caract
        ];

        // Insertar en la base de datos
        $inserted = $this->RegulacionModel->insertarRelAutoridadesEmiten($data);

        // Devolver una respuesta
        if ($inserted) {
            echo json_encode(['status' => 'success', 'message' => 'Relación insertada correctamente']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al insertar la relación']);
        }
    }

    public function insertarRelAutoridadesAplican()
    {
        // Obtener los datos de la solicitud POST
        $ID_Aplican = $this->input->post('ID_Aplican');
        $ID_Caract = $this->input->post('ID_Caract');
        if (!isset($ID_Caract) || $ID_Caract == null || $ID_Caract == '' || $ID_Caract == 'N/A' || !is_numeric($ID_Caract)) {
            $this->load->database();
            $query = $this->db->query("SELECT MAX(ID_caract) as maxID FROM de_regulacion_caracteristicas");
            $result = $query->row();
            if ($result->maxID == null) {
                $ID_Caract = 1;
            }else{
                $ID_Caract = $result->maxID;
            }
        }

        // Validar los datos
        if (empty($ID_Aplican) || empty($ID_Caract)) {
            echo json_encode(['status' => 'error', 'message' => 'Datos incompletos']);
            return;
        }

        // Preparar los datos para la inserción
        $data = [
            'ID_Aplican' => $ID_Aplican,
            'ID_Caract' => $ID_Caract
        ];

        // Insertar en la base de datos
        $inserted = $this->RegulacionModel->insertarRelAutoridadesAplican($data);

        // Devolver una respuesta
        if ($inserted) {
            echo json_encode(['status' => 'success', 'message' => 'Relación insertada correctamente']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al insertar la relación']);
        }
    }

    public function insertarDatosTabla()
    {
        // Obtener los datos enviados por POST
        $datosTabla = $this->input->post('datosTabla');

        // Verificar que los datos no estén vacíos
        if (!empty($datosTabla)) {
            // Insertar cada fila de datos en la base de datos
            if ($datosTabla[0]['ID_caract'] == null || !is_numeric($datosTabla[0]['ID_caract'])) {
                $this->load->database();
                $query = $this->db->query("SELECT MAX(ID_caract) as maxID FROM de_regulacion_caracteristicas");
                $result = $query->row();
                if ($result->maxID == null) {
                    $ID_Caract = 1;
                }else{
                    $ID_Caract = $result->maxID;
                }
                foreach ($datosTabla as $fila) {
                    $data = array(
                        'ID_Indice' => $fila['ID_Indice'],
                        'ID_caract' => $ID_Caract,
                        'Texto' => $fila['Texto'],
                        'Orden' => $fila['Orden']
                    );
    
                    // Llamar al modelo para insertar los datos
                    $this->RegulacionModel->insertarDatosTabla($data);
                }
            }else{
                foreach ($datosTabla as $fila) {
                    $data = array(
                        'ID_Indice' => $fila['ID_Indice'],
                        'ID_caract' => $fila['ID_caract'],
                        'Texto' => $fila['Texto'],
                        'Orden' => $fila['Orden']
                    );
    
                    // Llamar al modelo para insertar los datos
                    $this->RegulacionModel->insertarDatosTabla($data);
                }
            }
            

            // Responder con éxito
            echo json_encode(array('status' => 'success'));
        } else {
            // Responder con error si los datos están vacíos
            echo json_encode(array('status' => 'error', 'message' => 'No data provided'));
        }
    }

    public function obtenerMaxIDJerarquia()
    {
        $maxIDJerarquia = $this->RegulacionModel->obtenerMaxIDJerarquia();
        echo $maxIDJerarquia;
    }

    public function guardarRelIndice()
    {
        $data = $this->input->post('data');

        if (!empty($data)) {
            foreach ($data as $entry) {
                $this->db->insert('rel_indice', [
                    'ID_Jerarquia' => $entry['ID_Jerarquia'],
                    'ID_Indice' => $entry['ID_Indice'],
                    'ID_Padre' => $entry['ID_Padre']
                ]);
            }
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No data to save']);
        }
    }

    public function verificarIDIndice()
    {
        $ID_Indice = $this->input->post('ID_Indice');
        $this->load->model('RegulacionModel');
        $exists = $this->RegulacionModel->verificarIDIndice($ID_Indice);
        echo json_encode(['exists' => $exists]);
    }

    public function insertarRelIndice()
    {
        // Obtener los datos enviados desde el cliente
        $relIndiceData = $this->input->post('relIndiceData');
        //print_r($relIndiceData);
        //exit($relIndiceData);

        // Verificar que los datos no estén vacíos
        if (!empty($relIndiceData)) {
            // Insertar los datos en la tabla rel_indice
            foreach ($relIndiceData as $data) {
                $insertData = array(
                    'ID_Jerarquia' => $data['ID_Jerarquia'],
                    'ID_Indice' => $data['ID_Indice'],
                    'ID_Padre' => $data['ID_Padre']
                );

                $this->db->insert('rel_indice', $insertData);
            }

            // Enviar una respuesta de éxito
            echo json_encode(array('status' => 'success'));
        } else {
            // Enviar una respuesta de error
            echo json_encode(array('status' => 'error', 'message' => 'No data provided'));
        }
    }

    public function obtenerMateriasYUltimoIDRegulacion()
    {
        // Obtener los labels enviados desde el cliente
        $labels = $this->input->post('labels');

        // Verificar que los labels no estén vacíos
        if (!empty($labels)) {
            // Buscar los ID_materia correspondientes en la tabla cat_regulacion_materias_gub
            $this->db->select('ID_materia');
            $this->db->from('cat_regulacion_materias_gub');
            $this->db->where_in('Nombre_Materia', $labels);
            $query = $this->db->get();
            $idMaterias = $query->result_array();

            // Buscar el último ID_Regulacion en la tabla ma_regulacion
            $this->db->select_max('ID_Regulacion');
            $query = $this->db->get('ma_regulacion');
            $ultimoIDRegulacion = $query->row()->ID_Regulacion;

            // Enviar una respuesta de éxito con los datos
            echo json_encode(array(
                'status' => 'success',
                'idMaterias' => $idMaterias,
                'ultimoIDRegulacion' => $ultimoIDRegulacion
            ));
        } else {
            // Enviar una respuesta de error
            echo json_encode(array('status' => 'error', 'message' => 'No labels provided'));
        }
    }

    public function insertarRelRegulacionesMaterias()
    {
        // Obtener los datos enviados desde el cliente
        $idMaterias = $this->input->post('idMaterias');
        $ultimoIDRegulacion = $this->input->post('ultimoIDRegulacion');

        // Verificar que los datos no estén vacíos
        if (!empty($idMaterias) && !empty($ultimoIDRegulacion)) {
            // Insertar los datos en la tabla rel_regulaciones_materias
            foreach ($idMaterias as $materia) {
                $insertData = array(
                    'ID_Regulacion' => $ultimoIDRegulacion,
                    'ID_Materias' => $materia['ID_materia']
                );

                $this->db->insert('rel_regulaciones_materias', $insertData);
            }

            // Enviar una respuesta de éxito
            echo json_encode(array('status' => 'success'));
        } else {
            // Enviar una respuesta de error
            echo json_encode(array('status' => 'error', 'message' => 'No data provided'));
        }
    }

    public function search_sector()
    {
        $this->load->model('RegulacionModel');
        $search_term = $this->input->post('search_term');
        $results = $this->RegulacionModel->get_sectors($search_term);
        echo json_encode($results);
    }

    public function search_subsector()
    {
        $this->load->model('RegulacionModel');
        $search_term = $this->input->post('search_term');
        $results = $this->RegulacionModel->get_subsectors($search_term);
        echo json_encode($results);
    }

    public function search_rama()
    {
        $this->load->model('RegulacionModel');
        $search_term = $this->input->post('search_term');
        $results = $this->RegulacionModel->get_ramas($search_term);
        echo json_encode($results);
    }

    public function search_subrama()
    {
        $this->load->model('RegulacionModel');
        $search_term = $this->input->post('search_term');
        $results = $this->RegulacionModel->get_subramas($search_term);
        echo json_encode($results);
    }

    public function search_clase()
    {
        $this->load->model('RegulacionModel');
        $search_term = $this->input->post('search_term');
        $results = $this->RegulacionModel->get_clases($search_term);
        echo json_encode($results);
    }

    public function search_regulacion()
    {
        $this->load->model('RegulacionModel');
        $search_term = $this->input->post('search_term');
        $results = $this->RegulacionModel->get_regulaciones2($search_term);
        echo json_encode($results);
    }

    public function save_naturaleza_regulacion()
    {
        $file_path = null;
        if (isset($_FILES['userfile']) && $_FILES['userfile']['error'] != UPLOAD_ERR_NO_FILE) {
            $file = $_FILES['userfile'];
            $user = $this->ion_auth->user()->row();
            $userId = $user->id;
            $upload_result = $this->uploadFile($file, $userId);

            if ($upload_result['status'] == 'success') {
                $file_path = $upload_result['file_path'];
            } else {
                echo json_encode(['status' => 'error', 'message' => $upload_result['file_error']]);
                return;
            }
        }

        // Verificar si es radio "No" seleccionado
        if ($this->input->post('btn_clicked') && $this->input->post('radio_no_selected')) {
            $inputEnlace = $this->input->post('inputEnlace');
            $iNormativo = null;
            $selectedRegulaciones = json_decode($this->input->post('selectedRegulaciones'), true);
            $url = null;
            $tram = $this->input->post('tram');
            $dir = $this->input->post('dir');


            $max_id_nat = $this->RegulacionModel->get_max_id_nat();
            $new_id_nat = $max_id_nat + 1;

            // Insertar en la tabla de_naturaleza_regulacion
            $data = array(
                'Enlace_Oficial' => $inputEnlace,
                'Instrumento_normativo' => $iNormativo,
                'file_path' => !empty($file_path) ? $file_path : null,
                'url' => null
            );

            $id_naturaleza = $this->RegulacionModel->insert_naturaleza_regulacion($data);

            // Guardar en la base de datos derivada_reg
            if (!empty($selectedRegulaciones)) {
                foreach ($selectedRegulaciones as $regulacion) {
                    foreach ($regulacion as $regulacionItem) {
                        $data_derivada = array(
                            'ID_Nat' => $id_naturaleza,
                            'ID_Regulacion' => $regulacionItem
                        );
                        $this->RegulacionModel->insert_derivada_reg($data_derivada);
                    }
                }
            }

            $max_id_rel_nat = $this->RegulacionModel->get_max_id_rel_nat();
            $new_id_rel_nat = $max_id_rel_nat + 1;
            $last_id_regulacion = $this->RegulacionModel->get_last_id_regulacion();

            $data_rel_nat = array(
                'ID_Regulacion' => $last_id_regulacion,
                'ID_Nat' => $id_naturaleza,
                'ID_sector' => null,
                'ID_subsector' => null,
                'ID_rama' => null,
                'ID_subrama' => null,
                'ID_clase' => null
            );
            $this->RegulacionModel->insert_rel_nat_reg($data_rel_nat);

            // Extraer registros de la tabla tramitesTable y guardarlos en la base de datos
        $tramites = json_decode($this->input->post('tramites'), true);

        if (is_array($tramites)) {
            foreach ($tramites as $tramite) {
                $data_tramite = array(
                    'ID_Nat' => $id_naturaleza,
                    'Nombre' => $tramite['Nombre'],
                    'Direccion' => $tramite['Direccion']
                );
                $this->RegulacionModel->insert_tramite($data_tramite);
            }
            echo json_encode(array('status' => 'success'));
            exit();
        } else {
            log_message('error', 'Invalid tramites data: ' . print_r($tramites, true));
        }

        } else if ($this->input->post('btn_clicked') && $this->input->post('radio_si_selected')) {
            // Verificación si el radio "sí" está seleccionado
            $inputEnlace = $this->input->post('inputEnlace');
            $iNormativo = null;
            $selectedRegulaciones = json_decode($this->input->post('selectedRegulaciones'), true);
            $selectedSectors = json_decode($this->input->post('selectedSectors'), true);
            $selectedSubsectors = json_decode($this->input->post('selectedSubsectors'), true);
            $selectedRamas = json_decode($this->input->post('selectedRamas'), true);
            $selectedSubramas = json_decode($this->input->post('selectedSubramas'), true);
            $selectedClases = json_decode($this->input->post('selectedClases'), true);
            $tram = $this->input->post('tram');
            $dir = $this->input->post('dir');

            $max_id_nat = $this->RegulacionModel->get_max_id_nat();
            $new_id_nat = $max_id_nat + 1;

            $data = array(
                'Enlace_Oficial' => $inputEnlace,
                'Instrumento_normativo' => $iNormativo,
                'file_path' => !empty($file_path) ? $file_path : null,
                'url' => null
            );

            $id_naturaleza = $this->RegulacionModel->insert_naturaleza_regulacion($data);

            if (!empty($selectedRegulaciones)) {
                foreach ($selectedRegulaciones as $regulacion) {
                    foreach ($regulacion as $regulacionItem) {
                        $data_derivada = array(
                            'ID_Nat' => $id_naturaleza,
                            'ID_Regulacion' => $regulacionItem
                        );
                        $this->RegulacionModel->insert_derivada_reg($data_derivada);
                    }
                }
            }

            $max_id_rel_nat = $this->RegulacionModel->get_max_id_rel_nat();
            $new_id_rel_nat = $max_id_rel_nat + 1;
            $last_id_regulacion = $this->RegulacionModel->get_last_id_regulacion();

            // Guardar en la base de datos rel_nat_reg
            if (!empty($selectedSectors) && !empty($selectedSubsectors) && !empty($selectedRamas) && !empty($selectedSubramas) && !empty($selectedClases)) {
                foreach ($selectedSectors as $sector) {
                    foreach ($selectedSubsectors as $subsector) {
                        foreach ($selectedRamas as $rama) {
                            foreach ($selectedSubramas as $subrama) {
                                foreach ($selectedClases as $clase) {
                                    $data_rel_nat = array(
                                        'ID_Regulacion' => $last_id_regulacion,
                                        'ID_Nat' => $id_naturaleza,
                                        'ID_sector' => $sector,
                                        'ID_subsector' => $subsector,
                                        'ID_rama' => $rama,
                                        'ID_subrama' => $subrama,
                                        'ID_clase' => $clase
                                    );
                                    $this->RegulacionModel->insert_rel_nat_reg($data_rel_nat);
                                    $new_id_rel_nat++; // Incrementar el ID_relNaturaleza para la próxima inserción
                                }
                            }
                        }
                    }
                }
            } else if (!empty($selectedSectors) && !empty($selectedSubsectors)) {
                // Verifica que los campos se ingresen en orden
                if ((empty($selectedRamas) && empty($selectedSubramas) && empty($selectedClases)) ||
                    (!empty($selectedRamas) && empty($selectedSubramas) && empty($selectedClases)) ||
                    (!empty($selectedRamas) && !empty($selectedSubramas) && empty($selectedClases))) {
                    
                    foreach ($selectedSectors as $sector) {
                        foreach ($selectedSubsectors as $subsector) {
                            foreach ($selectedRamas as $rama) {
                                foreach ($selectedSubramas as $subrama) {
                                    foreach ($selectedClases as $clase) {
                                        $data_rel_nat = array(
                                            'ID_Regulacion' => $last_id_regulacion,
                                            'ID_Nat' => $id_naturaleza,
                                            'ID_sector' => $sector,
                                            'ID_subsector' => $subsector,
                                            'ID_rama' => !empty($rama) ? $rama : null,
                                            'ID_subrama' => !empty($subrama) ? $subrama : null,
                                            'ID_clase' => null
                                        );
                                        $this->RegulacionModel->insert_rel_nat_reg($data_rel_nat);
                                        $new_id_rel_nat++; // Incrementar el ID_relNaturaleza para la próxima inserción
                                    }
                                }
                            }
                        }
                    }
                } else {
                    // Manejo de error: los campos no están en el orden correcto
                    echo "Error: Los campos deben ser ingresados en orden.";
                }
            }

            // Extraer registros de la tabla tramitesTable y guardarlos en la base de datos
        $tramites = json_decode($this->input->post('tramites'), true);

        if (is_array($tramites)) {
            foreach ($tramites as $tramite) {
                $data_tramite = array(
                    'ID_Nat' => $id_naturaleza,
                    'Nombre' => $tramite['Nombre'],
                    'Direccion' => $tramite['Direccion']
                );
                $this->RegulacionModel->insert_tramite($data_tramite);
            }
            
        } else {
            log_message('error', 'Invalid tramites data: ' . print_r($tramites, true));
        }

            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Invalid request'));
        }
    }


    private function uploadFile($file, $userId)
    {
        // Validación y subida del archivo
        try {
            if (isset($_FILES['userfile']) && $_FILES['userfile']['error'] != UPLOAD_ERR_NO_FILE) {
                $allowed_types = ['image/jpeg', 'image/png', 'application/pdf']; // Define los tipos de archivos permitidos
                $max_size = 4096; // Define el tamaño máximo del archivo en KB

                if ($_FILES['userfile']['size'] > $max_size * 1024) {
                    throw new Exception('El tamaño del archivo no debe exceder los 4 MB.');
                }
                if (!in_array($_FILES['userfile']['type'], $allowed_types)) {
                    throw new Exception('Formato de archivo no permitido. Solo se permiten archivos JPEG, PNG y PDF.');
                }

                // Subir el archivo por FTP antes de registrar el usuario
                $this->connectFTP();

                // Directorio de destino en el servidor FTP
                $upload_path = 'assets/ftp/';

                // Nombre del archivo en el servidor
                $file_name = $this->formatFileName($file['name'], $userId);
                $file_tmp = $file['tmp_name'];

                // Subir el archivo al servidor FTP
                if ($this->ftp->upload($file_tmp, $upload_path . $file_name, 'auto')) {
                    $file_path = $upload_path . $file_name;
                    $this->disconnectFTP();
                    return ['status' => 'success', 'file_path' => $file_path];
                } else {
                    throw new Exception('Error al subir el archivo por FTP.');
                }
            }
        } catch (Exception $e) {
            return ['status' => 'error', 'file_error' => $e->getMessage()];
        }
        return ['status' => 'success'];
    }

    private function formatFileName($name, $userId)
    {
        // Obtener la extensión del archivo
        $extension = pathinfo($name, PATHINFO_EXTENSION);

        // Obtener el nombre sin la extensión
        $nameWithoutExtension = pathinfo($name, PATHINFO_FILENAME);

        // Reemplazar espacios y caracteres no alfanuméricos por guiones bajos
        $nameWithoutExtension = preg_replace('/[^a-zA-Z0-9]/', '_', $nameWithoutExtension);

        // Convertir a minúsculas
        $nameWithoutExtension = strtolower($nameWithoutExtension);

        // Obtener fecha actual sin la hora
        $date = date('Ymd');

        // Añadir la fecha y id al nombre del archivo
        $newName = $nameWithoutExtension . '_' . $userId . '_' . $date . '.' . $extension;

        return $newName;
    }

    public function save_naturaleza_regulacion2()
    {
        $id_regulacion = $this->input->post('idRegulacion');
        $idNaturaleza = $this->input->post('idNaturaleza');

        // Obtener el registro existente de la base de datos
        $existing_record = $this->RegulacionModel->get_naturaleza_regulacion($idNaturaleza);

        // Inicializar la variable file_path
        $file_path = null;

        // Subir nuevo archivo si existe
        if (isset($_FILES['userfile']) && $_FILES['userfile']['error'] != UPLOAD_ERR_NO_FILE) {
            $file = $_FILES['userfile'];
            $user = $this->ion_auth->user()->row();
            $userId = $user->id;
            $upload_result = $this->uploadFile($file, $userId);

            if ($upload_result['status'] == 'success') {
                $file_path = $upload_result['file_path'];

                // Eliminar archivo anterior si existe y no es el mismo que el nuevo archivo
                if (!empty($existing_record->file_path) && $existing_record->file_path !== $file_path) {
                    $this->connectFTP();
                    $this->ftp->delete_file($existing_record->file_path); // Eliminar archivo anterior
                    $this->disconnectFTP();
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => $upload_result['file_error']]);
                return;
            }
        }

        // Verificar si el botón fue clickeado y el radiobutton "no" está seleccionado
        if ($this->input->post('btn_clicked') && $this->input->post('radio_no_selected')) {
            $inputEnlace = $this->input->post('inputEnlace');
            $iNormativo = $this->input->post('iNormativo');
            $selectedRegulaciones = json_decode($this->input->post('selectedRegulaciones'), true);
            $url = null;

            // Obtener el ID_Nat más grande y agregar uno más grande
            $max_id_nat = $this->RegulacionModel->get_max_id_nat();
            $new_id_nat = $max_id_nat + 1;

            $existing_record = $this->RegulacionModel->get_naturaleza_regulacion($idNaturaleza);

            $data = array(
                'ID_Nat' => $idNaturaleza,
                'Enlace_Oficial' => $inputEnlace,
                'Instrumento_normativo' => $iNormativo,
                'file_path' => !empty($file_path) ? $file_path : null,
                'url' => null
            );

            if ($existing_record) {
                // Actualizar el registro existente
                $this->RegulacionModel->update_naturaleza_regulacion($data);
            } else {
                // Insertar un nuevo registro
                $this->RegulacionModel->insert_naturaleza_regulacion($data);
            }

            // Guardar en la base de datos derivada_reg
            if (!empty($selectedRegulaciones)) {
                foreach ($selectedRegulaciones as $regulacion) {
                    // Verificar si $regulacion es un array
                    if (is_array($regulacion)) {
                        // Si es un array, iterar sobre sus valores para realizar múltiples inserciones
                        foreach ($regulacion as $regulacionItem) {
                            $data_derivada = array(
                                'ID_Nat' => $idNaturaleza,
                                'ID_Regulacion' => $regulacionItem
                            );
                            $this->RegulacionModel->insert_derivada_reg($data_derivada);
                        }
                    }
                }
            }
            // Obtener el ID_relNaturaleza más grande y agregar uno más grande
            $max_id_rel_nat = $this->RegulacionModel->get_max_id_rel_nat();
            $new_id_rel_nat = $max_id_rel_nat + 1;

            // Obtener el último ID_Regulacion ingresado en la tabla ma_regulacion
            $last_id_regulacion = $this->RegulacionModel->get_last_id_regulacion();

            // Guardar en la base de datos rel_nat_reg
            $data_rel_nat = array(
                'ID_Regulacion' => $id_regulacion,
                'ID_Nat' => $idNaturaleza,
                'ID_sector' => null,
                'ID_subsector' => null,
                'ID_rama' => null,
                'ID_subrama' => null,
                'ID_clase' => null
            );

            $this->RegulacionModel->insert_rel_nat_reg($data_rel_nat);

            // Extraer registros de la tabla tramitesTable y guardarlos en la base de datos
            $tramites = json_decode($this->input->post('tramites'), true);

            if (is_array($tramites)) {
                foreach ($tramites as $tramite) {
                    $data_tramite = array(
                        'ID_Nat' => $idNaturaleza,
                        'Nombre' => $tramite['Nombre'],
                        'Direccion' => $tramite['Direccion']
                    );
                    $this->RegulacionModel->insert_tramite($data_tramite);
                }
                echo json_encode(array('status' => 'success'));
            } else {
                log_message('error', 'Invalid tramites data: ' . print_r($tramites, true));
            }

        } else if ($this->input->post('btn_clicked') && $this->input->post('radio_si_selected')) {
            $inputEnlace = $this->input->post('inputEnlace');
            $url = null;
            $iNormativo = $this->input->post('iNormativo');
            $selectedRegulaciones = json_decode($this->input->post('selectedRegulaciones'), true);
            $selectedSectors = json_decode($this->input->post('selectedSectors'), true);
            $selectedSubsectors = json_decode($this->input->post('selectedSubsectors'), true);
            $selectedRamas = json_decode($this->input->post('selectedRamas'), true);
            $selectedSubramas = json_decode($this->input->post('selectedSubramas'), true);
            $selectedClases = json_decode($this->input->post('selectedClases'), true);

            // Obtener el ID_Nat más grande y agregar uno más grande
            $max_id_nat = $this->RegulacionModel->get_max_id_nat();
            $new_id_nat = $max_id_nat + 1;

            // Guardar en la base de datos de_naturaleza_regulacion
            $existing_record = $this->RegulacionModel->get_naturaleza_regulacion($idNaturaleza);

            $data = array(
                'ID_Nat' => $idNaturaleza,
                'Enlace_Oficial' => $inputEnlace,
                'Instrumento_normativo' => $iNormativo,
                'file_path' => !empty($file_path) ? $file_path : null,
                'url' => null
            );

            if ($existing_record) {
                // Actualizar el registro existente
                $this->RegulacionModel->update_naturaleza_regulacion($data);
            } else {
                // Insertar un nuevo registro
                $this->RegulacionModel->insert_naturaleza_regulacion($data);
            }

            // Guardar en la base de datos derivada_reg
            if (!empty($selectedRegulaciones)) {
                foreach ($selectedRegulaciones as $regulacion) {
                    // Verificar si $regulacion es un array
                    if (is_array($regulacion)) {
                        // Si es un array, iterar sobre sus valores para realizar múltiples inserciones
                        foreach ($regulacion as $regulacionItem) {
                            $data_derivada = array(
                                'ID_Nat' => $idNaturaleza,
                                'ID_Regulacion' => $regulacionItem
                            );
                            $this->RegulacionModel->insert_derivada_reg($data_derivada);
                        }
                    }
                }
            }

            // Obtener el ID_relNaturaleza más grande y agregar uno más grande
            $max_id_rel_nat = $this->RegulacionModel->get_max_id_rel_nat();
            $new_id_rel_nat = $max_id_rel_nat + 1;

            // Obtener el último ID_Regulacion ingresado en la tabla ma_regulacion
            $last_id_regulacion = $this->RegulacionModel->get_last_id_regulacion();

            // Guardar en la base de datos rel_nat_reg
            if (!empty($selectedSectors) && !empty($selectedSubsectors) && !empty($selectedRamas) && !empty($selectedSubramas) && !empty($selectedClases)) {
                foreach ($selectedSectors as $sector) {
                    foreach ($selectedSubsectors as $subsector) {
                        foreach ($selectedRamas as $rama) {
                            foreach ($selectedSubramas as $subrama) {
                                foreach ($selectedClases as $clase) {
                                    $data_rel_nat = array(
                                        'ID_Regulacion' => $id_regulacion,
                                        'ID_Nat' => $idNaturaleza,
                                        'ID_sector' => $sector,
                                        'ID_subsector' => $subsector,
                                        'ID_rama' => $rama,
                                        'ID_subrama' => $subrama,
                                        'ID_clase' => $clase
                                    );
                                    $this->RegulacionModel->insert_rel_nat_reg($data_rel_nat);
                                    $new_id_rel_nat++; // Incrementar el ID_relNaturaleza para la próxima inserción
                                }
                            }
                        }
                    }
                }
            } else if (!empty($selectedSectors) && !empty($selectedSubsectors)) {
                foreach ($selectedSectors as $sector) {
                    foreach ($selectedSubsectors as $subsector) {
                        $data_rel_nat = array(
                            'ID_Regulacion' => $id_regulacion,
                            'ID_Nat' => $idNaturaleza,
                            'ID_sector' => $sector,
                            'ID_subsector' => $subsector,
                            'ID_rama' => null,
                            'ID_subrama' => null,
                            'ID_clase' => null
                        );
                        $this->RegulacionModel->insert_rel_nat_reg($data_rel_nat);
                        $new_id_rel_nat++; // Incrementar el ID_relNaturaleza para la próxima inserción
                    }
                }
            }
            // Extraer registros de la tabla tramitesTable y guardarlos en la base de datos
            $tramites = json_decode($this->input->post('tramites'), true);

            if (is_array($tramites)) {
                foreach ($tramites as $tramite) {
                    $data_tramite = array(
                        'ID_Nat' => $idNaturaleza,
                        'Nombre' => $tramite['Nombre'],
                        'Direccion' => $tramite['Direccion']
                    );
                    $this->RegulacionModel->insert_tramite($data_tramite);
                }
                echo json_encode(array('status' => 'success'));
            } else {
                log_message('error', 'Invalid tramites data: ' . print_r($tramites, true));
            }
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Invalid request'));
        }
    }

    public function listar_regulaciones()
    {
        $data['regulaciones'] = $this->RegulacionModel->get_all_regulaciones();
        $this->blade->render('regulaciones/regulaciones2', $data);
    }


    public function enviar_regulacion($id_regulacion)
    {
        $regulacion = $this->RegulacionModel->obtenerRegulacionPorId($id_regulacion);
        $user = $this->ion_auth->user()->row(); // Obtener el usuario actual
        $group = $this->ion_auth->get_users_groups($user->id)->row(); // Obtener el grupo del usuario
        $idUser = $user->id;

        if ($regulacion) {
            // Consultar si la regulación fue devuelta por consejería en la trazabilidad
            $movimiento_consejeria = $this->RegulacionModel->buscarMovimientoDevolucionConsejeria($id_regulacion);

            // Determinar el usuario destino en función del grupo del usuario actual y si fue devuelta por consejería
            if ($group->name === 'sujeto_obligado') {
                if ($movimiento_consejeria) {
                    // Si la regulación fue devuelta por consejería, enviarla directamente a consejería
                    $usuario_destino = 'consejeria';
                    $Estatus = 2;
                } else {
                    // En el primer envío, notificar a sedeco y admin
                    $usuario_destino = 'sedeco,admin';
                    $Estatus = 1;
                }
            } elseif (($group->name === 'sedeco') || ($group->name === 'admin')) {
                $usuario_destino = 'consejeria'; // Notificar a 'consejeria'
                $Estatus = 2;
            }

            // Enviar la regulación
            $this->RegulacionModel->enviar_regulacion($id_regulacion, $Estatus);

            $data = [
                'titulo' => 'Nueva Regulación Recibida',
                'mensaje' => 'Has recibido una nueva regulación: ' . $regulacion->Nombre_Regulacion,
                'usuario_destino' => $usuario_destino, // Identificador del usuario o grupo
                'id_regulacion' => $id_regulacion,
                'leido' => 0, // Indica que la notificación no ha sido leída
                'fecha_envio' => date('Y-m-d') // Fecha y hora de envío
            ];
            $this->NotificacionesModel->crearNotificacion($data);

            // Registrar el movimiento en la trazabilidad
            $dataTrazabilidad = [
                'ID_Regulacion' => $id_regulacion,
                'fecha_movimiento' => date('Y-m-d H:i:s'),
                'descripcion_movimiento' => 'Regulación enviada',
                'usuario_responsable' => $user->email,
                'estatus_anterior' => 'Creado',
                'estatus_nuevo' => 'Enviado'
            ];
            $this->RegulacionModel->registrarMovimiento($dataTrazabilidad);

            // Devolver respuesta JSON de éxito
            echo json_encode(['success' => true, 'message' => 'La regulación ha sido enviada correctamente.']);
        } else {
            // Devolver respuesta JSON de error
            echo json_encode(['success' => false, 'message' => 'No se encontró la regulación con el ID proporcionado.']);
        }
    }

    public function devolver_regulacion($id_regulacion)
    {
        $regulacion = $this->RegulacionModel->obtenerRegulacionPorId($id_regulacion);
        $user = $this->ion_auth->user()->row(); // Obtener el usuario actual
        $group = $this->ion_auth->get_users_groups($user->id)->row(); // Obtener el grupo del usuario
        $idUser = $user->id;
        if ($regulacion) {
            $this->RegulacionModel->devolver_regulacion($id_regulacion);

            // Obtener el usuario creador de la regulación
            $usuario_creador = $regulacion->id_usuario_creador;

            $data = [
                'titulo' => 'Regulación Devuelta',
                'mensaje' => 'Se ha devuelto la regulación: ' . $regulacion->Nombre_Regulacion,
                'id_usuario' => $usuario_creador,
                'usuario_destino' => null,
                'id_regulacion' => $id_regulacion,
                'leido' => 0, // Indica que la notificación no ha sido leída
                'fecha_envio' => date('Y-m-d') // Fecha y hora de envío
            ];


            $this->NotificacionesModel->crearNotificacion($data);

            // Determinar la descripción del movimiento en función del grupo que devuelve la regulación
            if (($group->name === 'sedeco') || ($group->name === 'admin')) {
                $descripcion_movimiento = 'Regulación devuelta por sedeco';
            } elseif ($group->name === 'consejeria') {
                $descripcion_movimiento = 'Regulación devuelta por consejería';
            } else {
                $descripcion_movimiento = 'Regulación devuelta'; // En caso de que sea otro grupo
            }


            // Registrar el movimiento en la trazabilidad
            $dataTrazabilidad = [
                'ID_Regulacion' => $id_regulacion,
                'fecha_movimiento' => date('Y-m-d H:i:s'),
                'descripcion_movimiento' => $descripcion_movimiento,
                'usuario_responsable' => $user->email,
                'estatus_anterior' => 'Enviado',
                'estatus_nuevo' => 'Devuelto'
            ];
            $this->RegulacionModel->registrarMovimiento($dataTrazabilidad);

            // Devolver respuesta JSON de éxito
            echo json_encode(['success' => true, 'message' => 'La regulación ha sido devuelta correctamente.']);
        } else {
            // Devolver respuesta JSON de error
            echo json_encode(['success' => false, 'message' => 'No se encontró la regulación con el ID proporcionado.']);
        }
    }

    public function publicar_regulacion($idRegulacion)
    {
        $this->RegulacionModel->publicar_regulacion($idRegulacion);

        // Obtener el usuario actual
        $user = $this->ion_auth->user()->row();
        $idUser = $user->id;

        // Registrar el movimiento en la trazabilidad
        $dataTrazabilidad = [
            'ID_Regulacion' => $idRegulacion,
            'fecha_movimiento' => date('Y-m-d H:i:s'),
            'descripcion_movimiento' => 'Regulación publicada',
            'usuario_responsable' => $user->email,
            'estatus_anterior' => 'Enviado',
            'estatus_nuevo' => 'Publicado'
        ];

        $this->RegulacionModel->registrarMovimiento($dataTrazabilidad);


        echo json_encode(['success' => true, 'message' => 'La regulación ha sido publicada correctamente.']);
    }

    public function despublicar_regulacion($idRegulacion)
    {
        $this->RegulacionModel->despublicar_regulacion($idRegulacion);

        // Obtener el usuario actual
        $user = $this->ion_auth->user()->row();
        $idUser = $user->id;

        // Registrar el movimiento en la trazabilidad
        $dataTrazabilidad = [
            'ID_Regulacion' => $idRegulacion,
            'fecha_movimiento' => date('Y-m-d H:i:s'),
            'descripcion_movimiento' => 'Regulación despublicada',
            'usuario_responsable' => $user->email,
            'estatus_anterior' => 'Publicado',
            'estatus_nuevo' => 'Enviado'
        ];

        $this->RegulacionModel->registrarMovimiento($dataTrazabilidad);

        echo json_encode(['success' => true, 'message' => 'La regulación ha sido despublicada correctamente.']);
    }


    public function obtenerTrazabilidad()
    {
        $idRegulacion = $this->input->post('id');
        $trazabilidad = $this->RegulacionModel->obtenerTrazabilidadPorRegulacion($idRegulacion);

        // Devolver la respuesta en formato JSON
        echo json_encode($trazabilidad);
    }



    public function marcar_leido($id_notificacion)
    {
        $result = $this->NotificacionesModel->marcarComoLeido($id_notificacion);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No se pudo marcar como leído.']);
        }
    }

    public function eliminar_notificacion($id_notificacion)
    {
        $result = $this->NotificacionesModel->eliminarNotificacion($id_notificacion);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No se pudo eliminar la notificación.']);
        }
    }

    public function actualizar_estatus()
    {
        $id = $this->input->post('id');

        if ($id) {
            // Actualizar el estatus de la regulación
            $this->load->model('RegulacionModel');
            $this->RegulacionModel->actualizar_estatus($id);

            echo json_encode(array('status' => 'success', 'message' => 'Estatus actualizado exitosamente.'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Solicitud inválida.'));
        }
    }

    public function show_emiten($id_caract)
    {
        // Cargar el modelo
        $this->load->model('RegulacionModel');

        // Obtener los ID_Emiten
        $emiten = $this->RegulacionModel->get_emiten_by_caract($id_caract);

        // Mostrar los resultados en la consola
        echo '<script>';
        echo 'console.log(' . json_encode($emiten) . ');';
        echo '</script>';
    }


    public function editarCaracteristicas($id)
    {
        // Cargar el modelo
        $this->load->model('RegulacionModel');
        // Obtener los datos necesarios usando el $id
        $data['regulacion'] = $this->RegulacionModel->get_regulacion_by_id($id);
        // Cargar la vista con los datos
        $this->blade->render('editar_caracteristicas', $data);
    }

    public function modificarRegulacion()
    {
        $formData = $this->input->post();

        // Verificar que los índices existan en formData
        if (!isset($formData['ID_Regulacion']) || !isset($formData['nombre']) || !isset($formData['campoExtra']) || !isset($formData['objetivoReg'])) {
            echo json_encode(array('status' => 'error', 'message' => 'Datos incompletos'));
            return;
        }

        // Preparar los datos para actualizar
        $data = array(
            'Nombre_Regulacion' => $formData['nombre'],
            'Vigencia' => $formData['campoExtra'],
            'Objetivo_Reg' => $formData['objetivoReg'],
            'Fecha_Act_Sys' => date('Y-m-d')
        );

        // Actualizar los datos
        $this->load->model('RegulacionModel');
        $result = $this->RegulacionModel->updateRegulacion($formData['ID_Regulacion'], $data);

        // Verificar el resultado de la actualización
        if ($result) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Error al actualizar la regulación'));
        }
    }

    public function modificarCaracteristicas()
    {
        $formData = $this->input->post();

        // Verificar que los índices existan en formData
        if (!isset($formData['ID_Regulacion']) || !isset($formData['ID_caract']) || !isset($formData['ID_tOrdJur']) || !isset($formData['Nombre']) || !isset($formData['Ambito_Aplicacion']) || !isset($formData['Fecha_Exp']) || !isset($formData['Fecha_Publi']) || !isset($formData['Fecha_Vigor']) || !isset($formData['Fecha_Act']) || !isset($formData['Vigencia']) || !isset($formData['Orden_Gob'])) {
            echo json_encode(array('status' => 'error', 'message' => 'Datos incompletos'));
            return;
        }

        // Preparar los datos para actualizar
        $data = array(
            'ID_caract' => $formData['ID_caract'],
            'ID_tOrdJur' => $formData['ID_tOrdJur'],
            'Nombre' => $formData['Nombre'],
            'Ambito_Aplicacion' => $formData['Ambito_Aplicacion'],
            'Fecha_Exp' => $formData['Fecha_Exp'],
            'Fecha_Publi' => $formData['Fecha_Publi'],
            'Fecha_Vigor' => $formData['Fecha_Vigor'],
            'Fecha_Act' => $formData['Fecha_Act'],
            'Vigencia' => $formData['Vigencia'],
            'Orden_Gob' => $formData['Orden_Gob']
        );

        // Actualizar los datos
        $this->load->model('RegulacionModel');
        $result = $this->RegulacionModel->updateCaracteristicas($formData['ID_Regulacion'], $data);

        // Verificar el resultado de la actualización
        if ($result) {
            // Obtener la regulación actualizada
            $regulacion = $this->RegulacionModel->obtenerRegulacionPorId($formData['ID_Regulacion']);

            // Verificar si la regulación está publicada y el usuario es de sujeto obligado
            if ($regulacion && $regulacion->Estatus == 3 && $this->ion_auth->in_group('sujeto_obligado')) {
                // Obtener el ID del usuario que creó la regulación
                $idUsuarioCreador = $regulacion->id_usuario_creador;

                // Crear la notificación para consejería
                $notificacionData = [
                    'titulo' => 'Regulación Editada',
                    'mensaje' => 'La regulación publicada"' . $regulacion->Nombre_Regulacion . '" ha sido editada por el Sujeto Obligado.',
                    'id_usuario' => null,
                    'usuario_destino' => 'consejeria', // Grupo de consejería
                    'id_regulacion' => $formData['ID_Regulacion'],
                    'leido' => 0,
                    'fecha_envio' => date('Y-m-d H:i:s')
                ];
                $this->NotificacionesModel->crearNotificacion($notificacionData);
            }

            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Error al actualizar las características de la regulación'));
        }
    }

    public function eliminarEmiten()
    {
        $ID_caract = $this->input->post('ID_caract');
        $ID_Dependencia = $this->input->post('ID_Dependencia');

        if (!$ID_caract || !$ID_Dependencia) {
            echo json_encode(array('status' => 'error', 'message' => 'Datos incompletos'));
            return;
        }

        $this->load->model('RegulacionModel');
        $result = $this->RegulacionModel->deleteEmiten($ID_caract, $ID_Dependencia);

        if ($result) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Error al eliminar el registro de la base de datos'));
        }
    }

    public function eliminarAplican()
    {
        $ID_caract = $this->input->post('ID_caract');
        $ID_Dependencia = $this->input->post('ID_Dependencia');

        if (!$ID_caract || !$ID_Dependencia) {
            echo json_encode(array('status' => 'error', 'message' => 'Datos incompletos'));
            return;
        }

        $this->load->model('RegulacionModel');
        $result = $this->RegulacionModel->deleteAplican($ID_caract, $ID_Dependencia);

        if ($result) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Error al eliminar el registro de la base de datos'));
        }
    }

    public function verificarRelAutoridadesEmiten()
    {
        $ID_caract = $this->input->post('ID_caract');

        // Verificar si el ID_caract está presente
        if (empty($ID_caract)) {
            echo json_encode(['status' => 'error', 'message' => 'ID_caract no proporcionado']);
            return;
        }

        // Consultar la base de datos para verificar si existen registros con el ID_caract
        $result = $this->RegulacionModel->verificarRelAutoridadesEmiten($ID_caract);

        if ($result) {
            echo json_encode(['status' => 'exists', 'data' => $result]);
        } else {
            echo json_encode(['status' => 'empty']);
        }
    }

    public function obtenerExistentesPorCaract()
    {
        $ID_caract = $this->input->post('ID_caract');

        // Verificar si el ID_caract está presente
        if (empty($ID_caract)) {
            echo json_encode(['status' => 'error', 'message' => 'ID_caract no proporcionado']);
            return;
        }

        // Obtener los registros existentes desde el modelo
        $existentes = $this->RegulacionModel->get_existentes_by_caract($ID_caract);

        echo json_encode(['status' => 'success', 'data' => $existentes]);
    }

    public function verificarRelAutoridadesAplican()
    {
        $ID_caract = $this->input->post('ID_caract');

        // Verificar si el ID_caract está presente
        if (empty($ID_caract)) {
            echo json_encode(['status' => 'error', 'message' => 'ID_caract no proporcionado']);
            return;
        }

        // Consultar la base de datos para verificar si existen registros con el ID_caract
        $result = $this->RegulacionModel->verificarRelAutoridadesAplican($ID_caract);

        if ($result) {
            echo json_encode(['status' => 'exists', 'data' => $result]);
        } else {
            echo json_encode(['status' => 'empty']);
        }
    }

    public function obtenerExistentesPorCaractAplican()
    {
        $ID_caract = $this->input->post('ID_caract');

        // Verificar si el ID_caract está presente
        if (empty($ID_caract)) {
            echo json_encode(['status' => 'error', 'message' => 'ID_caract no proporcionado']);
            return;
        }

        // Obtener los registros existentes desde el modelo
        $existentes = $this->RegulacionModel->get_existentes_by_caract2($ID_caract);

        echo json_encode(['status' => 'success', 'data' => $existentes]);
    }

    public function obtenerNuevoIdJerarquia()
    {
        // Obtener el último ID_Jerarquia desde el modelo
        $ultimoIdJerarquia = $this->RegulacionModel->get_last_id_jerarquia();
        $nuevoIdJerarquia = $ultimoIdJerarquia + 1;

        echo json_encode(['status' => 'success', 'nuevoIdJerarquia' => $nuevoIdJerarquia]);
    }

    public function get_indices_by_caract_ajax()
    {
        $ID_caract = $this->input->post('ID_caract');
        $indices = $this->RegulacionModel->get_indices_by_caract($ID_caract);
        echo json_encode($indices);
    }

    public function buscarIndiceEnRelIndice()
    {
        $ID_Indice = $this->input->post('ID_Indice');

        // Buscar en la tabla rel_indice
        $this->db->where('ID_Indice', $ID_Indice);
        $this->db->or_where('ID_Padre', $ID_Indice);
        $query = $this->db->get('rel_indice');

        if ($query->num_rows() > 0) {
            echo json_encode($query->result_array());
        } else {
            echo json_encode([]);
        }
    }

    public function eliminarEnRelIndice()
    {
        $ID_Indice = $this->input->post('ID_Indice');

        // Eliminar en la tabla rel_indice
        $this->db->where('ID_Indice', $ID_Indice);
        $this->db->or_where('ID_Padre', $ID_Indice);
        if ($this->db->delete('rel_indice')) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No se pudo eliminar los registros en rel_indice.']);
        }
    }

    public function eliminarIndice()
    {
        $ID_caract = $this->input->post('ID_caract');
        $ID_Indice = $this->input->post('ID_Indice');

        // Lógica para eliminar el registro de la base de datos
        $this->db->where('ID_caract', $ID_caract);
        $this->db->where('ID_Indice', $ID_Indice);
        if ($this->db->delete('de_indice')) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No se pudo eliminar el registro.']);
        }
    }
    public function verificarRegistrosEnDeIndice()
    {
        $ID_caract = $this->input->post('ID_caract');

        // Verificar si existen registros con el ID_caract en la tabla de_indice
        $this->db->where('ID_caract', $ID_caract);
        $query = $this->db->get('de_indice');

        if ($query->num_rows() > 0) {
            $registrosExistentes = array_column($query->result_array(), 'ID_Indice');
            echo json_encode(['existe' => true, 'registrosExistentes' => $registrosExistentes]);
        } else {
            echo json_encode(['existe' => false, 'registrosExistentes' => []]);
        }
    }

    public function getMateriasExentas()
    {
        $id_regulacion = $this->input->post('id_regulacion');

        // Verificar si id_regulacion es nulo
        if (is_null($id_regulacion)) {
            // Devolver un array vacío como JSON
            echo json_encode([]);
            return;
        }

        // Cargar el modelo
        $this->load->model('RegulacionModel');

        // Obtener los registros de la tabla rel_regulaciones_materias
        $registros = $this->RegulacionModel->get_materias_by_regulacion2($id_regulacion);

        // Devolver los registros como JSON
        echo json_encode($registros);
    }

    public function getNombresMaterias()
    {
        $idMaterias = $this->input->post('idMaterias');

        // Verificar si idMaterias está vacío
        if (empty($idMaterias)) {
            // Devolver un array vacío como JSON
            echo json_encode([]);
            return;
        }

        // Cargar el modelo
        $this->load->model('RegulacionModel');

        // Obtener los nombres de las materias
        $nombresMaterias = $this->RegulacionModel->get_nombres_materias($idMaterias);

        // Devolver los nombres como JSON
        echo json_encode($nombresMaterias);
    }

    public function eliminarMateriasExentas()
    {
        $id_regulacion = $this->input->post('id_regulacion');

        // Eliminar los registros existentes con el id_regulacion
        $this->db->where('ID_Regulacion', $id_regulacion);
        $this->db->delete('rel_regulaciones_materias');

        if ($this->db->affected_rows() > 0) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No se encontraron registros para eliminar.']);
        }
    }

    public function obtenerMaterias()
    {
        $id_regulacion = $this->input->post('id_regulacion');
        // Obtener los labels enviados desde el cliente
        $labels = $this->input->post('labels');

        // Verificar que los labels no estén vacíos
        if (!empty($labels)) {
            // Buscar los ID_materia correspondientes en la tabla cat_regulacion_materias_gub
            $this->db->select('ID_materia');
            $this->db->from('cat_regulacion_materias_gub');
            $this->db->where_in('Nombre_Materia', $labels);
            $query = $this->db->get();
            $idMaterias = $query->result_array();

            // Enviar una respuesta de éxito con los datos
            echo json_encode(array(
                'status' => 'success',
                'idMaterias' => $idMaterias,
                'id_regulacion' => $id_regulacion
            ));
        } else {
            // Enviar una respuesta de error
            echo json_encode(array('status' => 'error', 'message' => 'No labels provided'));
        }
    }
    public function verificarSector()
    {
        $id_regulacion = $this->input->post('id_regulacion');

        // Cargar el modelo
        $this->load->model('RegulacionModel');

        // Obtener el registro de la tabla rel_nat_reg
        $registro = $this->RegulacionModel->get_rel_nat_reg_by_id($id_regulacion);

        // Verificar si el campo ID_sector no es nulo
        if ($registro && !is_null($registro['ID_sector'])) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }
    public function obtenerSectoresPorRegulacion()
    {
        $id_regulacion = $this->input->post('id_regulacion');

        // Cargar el modelo
        $this->load->model('RegulacionModel');

        // Obtener los ID_Sector de la tabla rel_nat_reg
        $sectores = $this->RegulacionModel->get_sectores_by_regulacion($id_regulacion);

        if (empty($sectores)) {
            echo json_encode([]);
            return;
        }

        // Obtener los nombres de los sectores de la tabla cat_sector
        $id_sectores = array_column($sectores, 'ID_Sector');
        $nombres_sectores = $this->RegulacionModel->get_nombres_sectores($id_sectores);

        // Devolver los nombres de los sectores como JSON
        echo json_encode($nombres_sectores);
    }
    public function obtenerSubsectoresPorRegulacion()
    {
        $id_regulacion = $this->input->post('id_regulacion');

        // Cargar el modelo
        $this->load->model('RegulacionModel');

        // Obtener los ID_subsector de la tabla rel_nat_reg
        $subsectores = $this->RegulacionModel->get_subsectores_by_regulacion($id_regulacion);

        if (empty($subsectores)) {
            echo json_encode([]);
            return;
        }

        // Obtener los nombres de los subsectors de la tabla cat_subsector
        $id_subsectores = array_column($subsectores, 'ID_Subsector');
        $nombres_subsectores = $this->RegulacionModel->get_nombres_subsectores($id_subsectores);

        // Devolver los nombres de los subsectors como JSON
        echo json_encode($nombres_subsectores);
    }
    public function obtenerRamasPorRegulacion()
    {
        $id_regulacion = $this->input->post('id_regulacion');

        // Cargar el modelo
        $this->load->model('RegulacionModel');

        // Obtener los ID_rama de la tabla rel_nat_reg
        $ramas = $this->RegulacionModel->get_ramas_by_regulacion($id_regulacion);

        if (empty($ramas)) {
            echo json_encode([]);
            return;
        }

        // Obtener los nombres de las ramas de la tabla cat_rama
        $id_ramas = array_column($ramas, 'ID_Rama');
        $nombres_ramas = $this->RegulacionModel->get_nombres_ramas($id_ramas);

        // Devolver los nombres de las ramas como JSON
        echo json_encode($nombres_ramas);
    }

    public function obtenerSubramasPorRegulacion()
    {
        $id_regulacion = $this->input->post('id_regulacion');

        // Cargar el modelo
        $this->load->model('RegulacionModel');

        // Obtener los ID_subrama de la tabla rel_nat_reg
        $subramas = $this->RegulacionModel->get_subramas_by_regulacion($id_regulacion);

        if (empty($subramas)) {
            echo json_encode([]);
            return;
        }

        // Obtener los nombres de las subramas de la tabla cat_subrama
        $id_subramas = array_column($subramas, 'ID_Subrama');
        $nombres_subramas = $this->RegulacionModel->get_nombres_subramas($id_subramas);

        // Devolver los nombres de las subramas como JSON
        echo json_encode($nombres_subramas);
    }

    public function obtenerClasesPorRegulacion()
    {
        $id_regulacion = $this->input->post('id_regulacion');

        // Cargar el modelo
        $this->load->model('RegulacionModel');

        // Obtener los ID_clase de la tabla rel_nat_reg
        $clases = $this->RegulacionModel->get_clases_by_regulacion($id_regulacion);

        if (empty($clases)) {
            echo json_encode([]);
            return;
        }

        // Obtener los nombres de las clases de la tabla cat_clase
        $id_clases = array_column($clases, 'ID_Clase');
        $nombres_clases = $this->RegulacionModel->get_nombres_clases($id_clases);

        // Devolver los nombres de las clases como JSON
        echo json_encode($nombres_clases);
    }

    public function obtenerRegulacionesPorNat()
    {
        $id_regulacion = $this->input->post('id_regulacion');

        // Cargar el modelo
        $this->load->model('RegulacionModel');

        // Obtener los ID_Nat de la tabla derivada_reg
        $nats = $this->RegulacionModel->get_nats_by_regulacion($id_regulacion);

        if (empty($nats)) {
            echo json_encode([]);
            return;
        }

        // Obtener los ID_Regulacion de la tabla derivada_reg
        $id_nats = array_column($nats, 'ID_Nat');
        $regulaciones = $this->RegulacionModel->get_regulaciones_by_nats($id_nats);

        if (empty($regulaciones)) {
            echo json_encode([]);
            return;
        }

        // Obtener los nombres de las regulaciones de la tabla ma_regulacion
        $id_regulaciones = array_column($regulaciones, 'ID_Regulacion');
        $nombres_regulaciones = $this->RegulacionModel->get_nombres_regulaciones($id_regulaciones);

        // Devolver los nombres de las regulaciones como JSON
        echo json_encode($nombres_regulaciones);
    }

    public function obtenerIdSectoresPorRegulacion()
    {
        $id_regulacion = $this->input->post('id_regulacion');

        // Cargar el modelo
        $this->load->model('RegulacionModel');

        // Obtener los ID_Sector de la tabla rel_nat_reg
        $sectores = $this->RegulacionModel->get_sectores_by_regulacion($id_regulacion);

        if (empty($sectores)) {
            echo json_encode([]);
            return;
        }

        // Devolver los ID_Sector como JSON
        echo json_encode($sectores);
    }

    public function obtenerIdSubsectoresPorRegulacion()
    {
        $id_regulacion = $this->input->post('id_regulacion');

        // Cargar el modelo
        $this->load->model('RegulacionModel');

        // Obtener los ID_subsector de la tabla rel_nat_reg
        $subsectores = $this->RegulacionModel->get_subsectores_by_regulacion($id_regulacion);

        if (empty($subsectores)) {
            echo json_encode([]);
            return;
        }

        // Devolver los ID_subsector como JSON
        echo json_encode($subsectores);
    }

    public function obtenerIdRamasPorRegulacion()
    {
        $id_regulacion = $this->input->post('id_regulacion');

        // Cargar el modelo
        $this->load->model('RegulacionModel');

        // Obtener los ID_rama de la tabla rel_nat_reg
        $ramas = $this->RegulacionModel->get_ramas_by_regulacion($id_regulacion);

        if (empty($ramas)) {
            echo json_encode([]);
            return;
        }

        // Devolver los ID_rama como JSON
        echo json_encode($ramas);
    }

    public function obtenerIdSubramasPorRegulacion()
    {
        $id_regulacion = $this->input->post('id_regulacion');

        // Cargar el modelo
        $this->load->model('RegulacionModel');

        // Obtener los ID_subrama de la tabla rel_nat_reg
        $subramas = $this->RegulacionModel->get_subramas_by_regulacion($id_regulacion);

        if (empty($subramas)) {
            echo json_encode([]);
            return;
        }

        // Devolver los ID_subrama como JSON
        echo json_encode($subramas);
    }

    public function obtenerIdClasesPorRegulacion()
    {
        $id_regulacion = $this->input->post('id_regulacion');

        // Cargar el modelo
        $this->load->model('RegulacionModel');

        // Obtener los ID_clase de la tabla rel_nat_reg
        $clases = $this->RegulacionModel->get_clases_by_regulacion($id_regulacion);

        if (empty($clases)) {
            echo json_encode([]);
            return;
        }

        // Devolver los ID_clase como JSON
        echo json_encode($clases);
    }

    public function obtenerIdRegulacionesPorNat()
    {
        $id_regulacion = $this->input->post('id_regulacion');

        // Cargar el modelo
        $this->load->model('RegulacionModel');

        // Obtener los ID_Nat de la tabla derivada_reg
        $nats = $this->RegulacionModel->get_nats_by_regulacion($id_regulacion);

        if (empty($nats)) {
            echo json_encode([]);
            return;
        }

        // Obtener los ID_Regulacion de la tabla derivada_reg
        $id_nats = array_column($nats, 'ID_Nat');
        $regulaciones = $this->RegulacionModel->get_regulaciones_by_nats($id_nats);

        // Devolver los ID_Regulacion como JSON
        echo json_encode($regulaciones);
    }
    public function getMaxValuesTram()
    {
        $this->load->model('RegulacionModel');
        $maxValues = $this->RegulacionModel->getMaxValuesTram();
        echo json_encode($maxValues);
    }
    public function insertTramite($id_naturaleza) {
        // Obtener datos del POST
        $tram = $this->input->post('tram');
        $dir = $this->input->post('dir');

        // Validar datos
        if (empty($tram) || empty($dir)) {
            // Retornar error si los datos están vacíos
            echo json_encode(['error' => 'Campos obligatorios faltantes']);
            return;
        }

        // Insertar datos en la base de datos
        $data = [
            'ID_Nat' => $id_naturaleza,
            'Nombre' => $tram,
            'Direccion' => $dir
        ];
        $inserted_id = $this->RegulacionModel->insert_tramite($data);

        // Obtener el registro insertado
        $new_tramite = $this->RegulacionModel->get_tramite_by_id($inserted_id);

        // Retornar el registro insertado como JSON
        echo json_encode($new_tramite);
    }
    public function guardarRegistros() {
        // Obtiene los datos enviados por la solicitud AJAX
        $registros = $this->input->post('registros');
        $ID_caract = $this->input->post('ID_caract');
        if ($ID_caract == null || $ID_caract == '' || $ID_caract == 'N/A' || !is_numeric($ID_caract)) {
            $this->load->database();
            $query = $this->db->query("SELECT MAX(ID_caract) as maxID FROM de_regulacion_caracteristicas");
            $result = $query->row();
            if ($result->maxID == null) {
                $ID_Caract = 1;
            }else{
                $ID_Caract = $result->maxID;
            }
            $ID_caract = $ID_Caract;
        }
        

        // Verifica que los datos no estén vacíos
        if (!empty($registros) && !empty($ID_caract)) {
            foreach ($registros as $registro) {
                $data = array(
                    'ID_MatSec' => $registro['ID_MatSec'],
                    'ID_caract' => $ID_caract,
                    'Materias' => $registro['Materias'],
                    'Sectores' => $registro['Sectores'],
                    'SujetosRegulados' => $registro['SujetosRegulados']
                );

                // Inserta los datos en la tabla de_mat_sec_suj
                $this->RegulacionModel->insertarRegistro($data);
            }
            // Responde con éxito
            echo json_encode(array('status' => 'success'));
        } else {
            // Responde con error si los datos están vacíos
            echo json_encode(array('status' => 'error', 'message' => 'Datos incompletos'));
        }
    }

    public function InsertarFundamentos() {
        // Obtiene los datos enviados por la solicitud AJAX
        $fundamentos = $this->input->post('fundamentos');
        $ID_caract = $this->input->post('ID_caract');
        if ($ID_caract == null || $ID_caract == '' || $ID_caract == 'N/A' || !is_numeric($ID_caract)) {
            $this->load->database();
            $query = $this->db->query("SELECT MAX(ID_caract) as maxID FROM de_regulacion_caracteristicas");
            $result = $query->row();
            if ($result->maxID == null) {
                $ID_Caract = 1;
            }else{
                $ID_Caract = $result->maxID;
            }
            $ID_caract = $ID_Caract;
        }

        // Verifica que los datos no estén vacíos
        if (!empty($fundamentos) && !empty($ID_caract)) {
            foreach ($fundamentos as $fundamento) {
                $data = array(
                    'ID_Fun' => $fundamento['ID_Fun'],
                    'ID_caract' => $ID_caract,
                    'Nombre' => $fundamento['Nombre'],
                    'Articulo' => $fundamento['Articulo'],
                    'Link' => $fundamento['Link']
                );

                // Inserta los datos en la tabla de_mat_sec_suj
                $this->RegulacionModel->insertFun($data);
            }

            // Responde con éxito
            echo json_encode(array('status' => 'success'));
        } else {
            // Responde con error si los datos están vacíos
            echo json_encode(array('status' => 'error', 'message' => 'Datos incompletos'));
        }
    }
    public function verificarRegistros() {
        $ultimoID = $this->RegulacionModel->obtenerUltimoIDMatSec();
        $existenRegistros = $ultimoID !== null;

        echo json_encode(array(
            'existenRegistros' => $existenRegistros,
            'ultimoID' => $ultimoID
        ));
    }
    public function verificarRegistros2() {
        $ID_caract = $this->input->get('ID_caract');
        $ultimoID = $this->RegulacionModel->obtenerUltimoIDMatSec();
        $registrosExistentes = $this->RegulacionModel->get_registros_by_id_caract($ID_caract);
        $existenRegistros = $ultimoID !== null;

        echo json_encode(array(
            'ID_caract' => $ID_caract,
            'existenRegistros' => $existenRegistros,
            'ultimoID' => $ultimoID,
            'registrosExistentes' => $registrosExistentes
        ));
    }
    public function verificarFundamentos() {
        $ultimoID = $this->RegulacionModel->obtenerUltimoIDFun();
        $existenRegistros = $ultimoID !== null;

        echo json_encode(array(
            'existenRegistros' => $existenRegistros,
            'ultimoID' => $ultimoID
        ));
    }
    public function verificarFundamentos2() {
        $ID_caract = $this->input->get('ID_caract');
        $ultimoID = $this->RegulacionModel->obtenerUltimoIDFun();
        $registrosExistentes = $this->RegulacionModel->get_fundamentos_by_id_caract($ID_caract);
        $existenRegistros = $ultimoID !== null;

        echo json_encode(array(
            'ID_caract' => $ID_caract,
            'existenRegistros' => $existenRegistros,
            'ultimoID' => $ultimoID,
            'registrosExistentes' => $registrosExistentes
        ));
    }
    public function verificarTramites() {
        $ID_Nat = $this->input->get('ID_Nat');
        $ultimoID = $this->RegulacionModel->obtenerUltimoIDTram();
        $registrosExistentes = $this->RegulacionModel->get_tramites_by_id_nat($ID_Nat);
        $existenRegistros = $ultimoID !== null;

        echo json_encode(array(
            'ID_Nat' => $ID_Nat,
            'existenRegistros' => $existenRegistros,
            'ultimoID' => $ultimoID,
            'registrosExistentes' => $registrosExistentes
        ));
    }
    public function eliminarRegistro() {
        $ID_MatSec = $this->input->post('ID_MatSec');

        if ($this->RegulacionModel->eliminarRegistro($ID_MatSec)) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'error'));
        }
    }
    public function eliminarFundamento() {
        $ID_Fun = $this->input->post('ID_Fun');

        if ($this->RegulacionModel->eliminarFun($ID_Fun)) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'error'));
        }
    }
    public function eliminarTramite() {
        $ID_Tram = $this->input->post('ID_Tram');

        if ($this->RegulacionModel->eliminarTram($ID_Tram)) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'error'));
        }
    }
}