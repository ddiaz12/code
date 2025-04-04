<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('MenuModel');
        $this->load->model('NotificacionesModel');
        $this->load->model('RegulacionModel');
        if (!$this->ion_auth->logged_in()) {
            print_r($this->ion_auth->logged_in());
            redirect('auth/login', 'refresh');
        }
    }

    public function index()
    {
        $this->load->view('inicio');
    }

    public function menu_enviadas()
    {
        $user = $this->ion_auth->user()->row();
        $group = $this->ion_auth->get_users_groups($user->id)->row();
        $groupName = $group->name;
        $id = $user->id;
        $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsgroups($groupName);
        $data['enviadas'] = $this->MenuModel->obtenerRegulacionesEnviadasPorUsuario($id, $groupName);
        if ($this->ion_auth->in_group('sujeto_obligado')) {
            $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsId($id);
            $this->blade->render('menuSujeto/enviadas', $data);
        } elseif ($this->ion_auth->in_group('sedeco') || $this->ion_auth->in_group('admin')) {
            $this->blade->render('menuAdmin/enviadas', $data);
        } elseif ($this->ion_auth->in_group('consejeria')) {
            $this->blade->render('menuConsejeria/enviadas', $data);
        } else {
            // Si el usuario no pertenece a ninguno de los grupos anteriores, redirige a la página de inicio de sesión
            redirect('auth/logout', 'refresh');
        }
    }

    public function menu_sujeto()
    {
        $user = $this->ion_auth->user()->row();
        $group = $this->ion_auth->get_users_groups($user->id)->row();
        $groupName = $group->name;
        $id = $user->id;
        $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsgroups($groupName);
        $data['sujetos'] = $this->MenuModel->getSujetosObligados();

        if ($this->ion_auth->in_group('sujeto_obligado')) {
            $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotifications($id);
            $this->blade->render('menuSujeto/sujeto-obligado', $data);
        } elseif ($this->ion_auth->in_group('sedeco') || $this->ion_auth->in_group('admin')) {
            $this->blade->render('menuAdmin/sujeto-obligado', $data);
        } elseif ($this->ion_auth->in_group('consejeria')) {
            $this->blade->render('menuSupervisor/sujeto-obligado', $data);
        } else {
            // Si el usuario no pertenece a ninguno de los grupos anteriores, redirige a la página de inicio de sesión
            redirect('auth/logout', 'refresh');
        }
    }

    public function menu_unidades()
    {
        $user = $this->ion_auth->user()->row();
        $group = $this->ion_auth->get_users_groups($user->id)->row();
        $groupName = $group->name;
        $id = $user->id;
        $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsgroups($groupName);
        $data['unidades'] = $this->MenuModel->getUnidadesAdministrativas($id);

        if ($this->ion_auth->in_group('sujeto_obligado')) {
            $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsId($id);
            $this->blade->render('menuSujeto/unidades-administrativas', $data);
        } elseif ($this->ion_auth->in_group('sedeco') || $this->ion_auth->in_group('admin')) {
            $this->blade->render('menuAdmin/unidades-administrativas', $data);
        } elseif ($this->ion_auth->in_group('consejeria')) {
            $this->blade->render('menuSupervisor/unidades-administrativas', $data);
        } else {
            // Si el usuario no pertenece a ninguno de los grupos anteriores, redirige a la página de inicio de sesión
            redirect('auth/logout', 'refresh');
        }
    }

    public function menu_guia()
    {

        $user = $this->ion_auth->user()->row();
        $group = $this->ion_auth->get_users_groups($user->id)->row();
        $groupName = $group->name;
        $userId = $user->id;
        $notifications = $this->NotificacionesModel->getNotificationsGrupos($groupName);
        $data['notificaciones'] = $notifications;
        $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsgroups($groupName);

        if ($this->ion_auth->in_group('sujeto_obligado')) {
            $notifications = $this->NotificacionesModel->getNotifications($userId);
            $data['notificaciones'] = $notifications;
            $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsId($userId);
            $this->blade->render('menuSujeto/guia', $data);
        } elseif ($this->ion_auth->in_group('sedeco') || $this->ion_auth->in_group('admin')) {
            $this->blade->render('menuAdmin/guia', $data);
        } elseif ($this->ion_auth->in_group('consejeria')) {
            $this->blade->render('menuConsejeria/guia', $data);
        } else {
            // Si el usuario no pertenece a ninguno de los grupos anteriores, redirige a la página de inicio de sesión
            redirect('auth/logout', 'refresh');
        }
    }

    public function menu_log()
    {

        $user = $this->ion_auth->user()->row();
        $group = $this->ion_auth->get_users_groups($user->id)->row();
        $groupName = $group->name;
        $userId = $user->id;
        $notifications = $this->NotificacionesModel->getNotificationsGrupos($groupName);
        $data['notificaciones'] = $notifications;
        $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsgroups($groupName);

        if ($this->ion_auth->in_group('sujeto_obligado')) {
            $notifications = $this->NotificacionesModel->getNotifications($userId);
            $data['notificaciones'] = $notifications;
            $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsId($userId);
            $this->blade->render('menuSujeto/log', $data);
        } elseif ($this->ion_auth->in_group('sedeco') || $this->ion_auth->in_group('admin')) {
            $this->blade->render('menuAdmin/log', $data);
        } elseif ($this->ion_auth->in_group('consejeria')) {
            $this->blade->render('menuConsejeria/log', $data);
        } else {
            // Si el usuario no pertenece a ninguno de los grupos anteriores, redirige a la página de inicio de sesión
            redirect('auth/logout', 'refresh');
        }
    }

    public function menu_buzon()
    {
        $this->load->model('NotificacionesModel');
        $user = $this->ion_auth->user()->row();
        $group = $this->ion_auth->get_users_groups($user->id)->row();
        $groupName = $group->name;
        $userId = $user->id;
        $notifications = $this->NotificacionesModel->getNotificationsGrupos($groupName);
        $data['notificaciones'] = $notifications;
        $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsgroups($groupName);
        if ($this->ion_auth->in_group('sujeto_obligado')) {
            $notifications = $this->NotificacionesModel->getNotifications($userId);
            $data['notificaciones'] = $notifications;
            $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsId($userId);
            $this->blade->render('menuSujeto/buzon', $data);
        } elseif ($this->ion_auth->in_group('sedeco') || $this->ion_auth->in_group('admin')) {
            $this->blade->render('menuAdmin/buzon', $data);
        } elseif ($this->ion_auth->in_group('consejeria')) {
            $this->blade->render('menuConsejeria/buzon', $data);
        } else {
            // Si el usuario no pertenece a ninguno de los grupos anteriores, redirige a la página de inicio de sesión
            redirect('auth/logout', 'refresh');
        }
    }
    public function menu_publicadas()
    {
        $user = $this->ion_auth->user()->row();
        $group = $this->ion_auth->get_users_groups($user->id)->row();
        $groupName = $group->name;
        $userId = $user->id;
        $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsgroups($groupName);
        $data['publicadas'] = $this->MenuModel->getRegulacionesPublicadas();
        $data['regulaciones'] = $this->RegulacionModel->get_all_regulaciones();
        if ($this->ion_auth->in_group('sujeto_obligado')) {
            $notifications = $this->NotificacionesModel->getNotifications($userId);
            $data['notificaciones'] = $notifications;
            $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsId($userId);
            $data['publicadas'] = $this->MenuModel->getRegulacionesPublicada($userId);
            $data['regulaciones'] = $this->RegulacionModel->get_regulaciones_por_usuario($userId);
            $this->blade->render('menuSujeto/publicadas', $data);
        } elseif ($this->ion_auth->in_group('sedeco') || $this->ion_auth->in_group('admin')) {
            $this->blade->render('menuAdmin/publicadas', $data);
        } elseif ($this->ion_auth->in_group('consejeria')) {
            $this->blade->render('menuConsejeria/publicadas', $data);
        } else {
            // Si el usuario no pertenece a ninguno de los grupos anteriores, redirige a la página de inicio de sesión
            redirect('auth/logout', 'refresh');
        }
    }

    public function menu_modificadas()
    {
        $user = $this->ion_auth->user()->row();
        $group = $this->ion_auth->get_users_groups($user->id)->row();
        $groupName = $group->name;
        $userId = $user->id;
        $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsgroups($groupName);
        $data['abrogadas'] = $this->MenuModel->getRegulacionesAbrogadas();
        if ($this->ion_auth->in_group('sujeto_obligado')) {
            $data['modificadas'] = $this->MenuModel->getRegulacionesModificadas($userId);
            $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsId($userId);
            $this->blade->render('menuSujeto/abrogadas', $data);
        } elseif ($this->ion_auth->in_group('sedeco') || $this->ion_auth->in_group('admin')) {
            $this->blade->render('menuAdmin/abrogadas', $data);
        } elseif ($this->ion_auth->in_group('consejeria')) {
            $this->blade->render('menuConsejeria/abrogadas', $data);
        } else {
            // Si el usuario no pertenece a ninguno de los grupos anteriores, redirige a la página de inicio de sesión
            redirect('auth/logout', 'refresh');
        }
    }

    //Cambiar estatus de la regulacion para modificarlas
    public function modificarRegulacion()
    {
        $id_regulacion = $this->input->post('id');
        $regulacion = $this->RegulacionModel->obtenerRegulacionPorId($id_regulacion);
        // Obtener el usuario actual
        $user = $this->ion_auth->user()->row();
        $group = $this->ion_auth->get_users_groups($user->id)->row();


        if ($regulacion && $regulacion->Estatus == 3) {

            $result = $this->MenuModel->modificarRegulacion($id_regulacion);

            // Determinar el usuario destino en función del grupo del usuario actual
            if ($group->name === 'sujeto_obligado') {

                $usuario_destino = 'consejeria';

                $data = [
                    'titulo' => 'Regulacion abrogada',
                    'mensaje' => 'El sujeto obligado ha abrogado la regulación: ' . $regulacion->Nombre_Regulacion,
                    'usuario_destino' => $usuario_destino, // Identificador del usuario o grupo
                    'id_regulacion' => $id_regulacion,
                    'leido' => 0, // Indica que la notificación no ha sido leída
                    'fecha_envio' => date('Y-m-d') // Fecha y hora de envío
                ];
                $this->NotificacionesModel->crearNotificacion($data);
            }

            // Registrar el movimiento en la trazabilidad
            $dataTrazabilidad = [
                'ID_Regulacion' => $id_regulacion,
                'fecha_movimiento' => date('Y-m-d H:i:s'),
                'descripcion_movimiento' => 'Regulación abrogada',
                'usuario_responsable' => $user->email,
                'estatus_anterior' => 'Publicado',
                'estatus_nuevo' => 'Abrogada'
            ];
        } else if ($regulacion && $regulacion->Estatus == 4) {
            $result = $this->MenuModel->modificarRegulacionAbrogada($id_regulacion);

            // Determinar el usuario destino en función del grupo del usuario actual
            if ($group->name === 'sujeto_obligado') {

                $usuario_destino = 'consejeria';

                $data = [
                    'titulo' => 'Regulacion abrogada',
                    'mensaje' => 'El sujeto obligado ha quitado el estatus abrogado a la regulación: ' . $regulacion->Nombre_Regulacion,
                    'usuario_destino' => $usuario_destino, // Identificador del usuario o grupo
                    'id_regulacion' => $id_regulacion,
                    'leido' => 0, // Indica que la notificación no ha sido leída
                    'fecha_envio' => date('Y-m-d') // Fecha y hora de envío
                ];
                $this->NotificacionesModel->crearNotificacion($data);
            }

            // Registrar el movimiento en la trazabilidad
            $dataTrazabilidad = [
                'ID_Regulacion' => $id_regulacion,
                'fecha_movimiento' => date('Y-m-d H:i:s'),
                'descripcion_movimiento' => 'Se le quito el estatus de abrogada a la regulacion',
                'usuario_responsable' => $user->email,
                'estatus_anterior' => 'Abrogada',
                'estatus_nuevo' => 'Publicado'
            ];
        } else if ($regulacion && $regulacion->Estatus == 5) {
            $result = $this->MenuModel->modificarRegulacion($id_regulacion);

            // Determinar el usuario destino en función del grupo del usuario actual
            if ($group->name === 'sujeto_obligado') {

                $usuario_destino = 'consejeria';

                $data = [
                    'titulo' => 'Regulacion abrogada',
                    'mensaje' => 'El sujeto obligado ha abrogado la regulación: ' . $regulacion->Nombre_Regulacion,
                    'usuario_destino' => $usuario_destino, // Identificador del usuario o grupo
                    'id_regulacion' => $id_regulacion,
                    'leido' => 0, // Indica que la notificación no ha sido leída
                    'fecha_envio' => date('Y-m-d') // Fecha y hora de envío
                ];
                $this->NotificacionesModel->crearNotificacion($data);
            }

            // Registrar el movimiento en la trazabilidad
            $dataTrazabilidad = [
                'ID_Regulacion' => $id_regulacion,
                'fecha_movimiento' => date('Y-m-d H:i:s'),
                'descripcion_movimiento' => 'Regulación abrogada',
                'usuario_responsable' => $user->email,
                'estatus_anterior' => 'Emergencia',
                'estatus_nuevo' => 'Abrogada'
            ];
        }

        $this->RegulacionModel->registrarMovimiento($dataTrazabilidad);

        // Verificar el resultado y devolver una respuesta adecuada
        if ($result) {
            echo json_encode(array('status' => 'success', 'message' => 'Regulación modificada exitosamente.'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Error al modificar la regulación.'));
        }
    }



    public function agregar_unidades()
    {
        $this->load->model('NotificacionesModel');
        $user = $this->ion_auth->user()->row();
        $group = $this->ion_auth->get_users_groups($user->id)->row();
        $groupName = $group->name;
        $id = $user->id;

        //Obtener el sujeto obligado del usuario actual
        $sujeto_obligado = $this->MenuModel->getSujetoObligadoPorUsuario($id);

        $data['sujeto_obligado'] = $sujeto_obligado;
        $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsgroups($groupName);
        $data['sujetos'] = $this->MenuModel->getSujetosObligados();
        $data['vialidades'] = $this->MenuModel->getCatVialidades();
        $data['municipios'] = $this->MenuModel->getCatMunicipios();
        $data['localidades'] = $this->MenuModel->getCatLocalidades();
        $data['asentamientos'] = $this->MenuModel->getCatAsentamientos();

        if ($this->ion_auth->in_group('sujeto_obligado')) {
            $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsId($id);
            $this->blade->render('menuSujeto/agregar-unidad', $data);
        } elseif ($this->ion_auth->in_group('sedeco') || $this->ion_auth->in_group('admin')) {
            $this->blade->render('menuAdmin/agregar-unidad', $data);
        } elseif ($this->ion_auth->in_group('consejeria')) {
            $this->blade->render('menuSupervisor/agregar-unidad', $data);
        } else {
            // Si el usuario no pertenece a ninguno de los grupos anteriores, redirige a la página de inicio de sesión
            redirect('auth/logout', 'refresh');
        }
    }

    public function insertar_unidad()
    {
        //print_r($this->input->post('sujeto'));
        // Obtener los datos del formulario
        //print_r($this->input->post('json1'));
        //print_r($this->input->post('json2'));
        //$datos = array();
        $user = $this->ion_auth->user()->row();
        $id = $user->id;
        $this->form_validation->set_rules(
            'inputNombre',
            'Nombre',
            'trim|required|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s,\.]+$/]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'regex_match' => 'El campo %s solo puede contener letras, espacios, comas y puntos.'
            )
        );
        $this->form_validation->set_rules(
            'siglas',
            'Siglas',
            'required|alpha',
            array(
                'required' => 'El campo %s es obligatorio.',
                'alpha' => 'El campo %s solo puede contener letras'
            )
        );
        $this->form_validation->set_rules(
            'num_exterior',
            'Número exterior',
            'required|max_length[5]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'max_length' => 'El campo %s no debe exceder los 5 caracteres.'
            )
        );
        /* $this->form_validation->set_rules(
            'codigo_postal',
            'Código postal',
            'required|exact_length[5]|numeric|greater_than_equal_to[0]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'exact_length' => 'El campo %s debe tener 5 dígitos.',
                'numeric' => 'El campo %s solo puede contener números.',
                'greater_than_equal_to' => 'El campo %s no puede ser negativo.'
            )
        );*/
        $this->form_validation->set_rules(
            'phone',
            'Número de teléfono',
            'required|regex_match[/^\(\d{3}\) \d{3}-\d{4}$/]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'regex_match' => 'El campo %s no tiene el formato correcto. Ejemplo: (123) 456-7890'
            )
        );
        $this->form_validation->set_rules(
            'ext',
            'extension',
            'trim|regex_match[/^[0-9]*$/]|max_length[6]|min_length[2]',
            array(
            'numeric' => 'El campo %s debe ser numérico.',
            'max_length' => 'El campo %s no debe exceder los 6 caracteres.',
            'min_length' => 'El campo %s debe tener al menos 2 caracteres.',
            )
        );
        $this->form_validation->set_rules('email', 'Correo electrónico', 'required');
        $this->form_validation->set_rules('sujeto', 'Sujeto obligado', 'required');
        $this->form_validation->set_rules('tipo_vialidad', 'Tipo vialidad', 'required');
        $this->form_validation->set_rules(
            'nombre_vialidad',
            'Nombre vialidad',
            'trim|required|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s,\.0-9ºª]+$/]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'regex_match' => 'El campo %s solo puede contener letras, números, espacios, comas, puntos y abreviaturas comunes.'
            )
        );
        $this->form_validation->set_rules('localidad', 'Nombre localidad', 'required');
        $this->form_validation->set_rules('tipo_asentamiento', 'Tipo asentamiento', 'required');
        $this->form_validation->set_rules('nombre_asentamiento', 'Nombre asentamiento', 'required');

        if ($this->form_validation->run() != FALSE) {

            $sujeto = $this->input->post('sujeto');
            $municipio = $this->input->post('municipio');
            $localidad = $this->input->post('localidad');
            $tipo_asentamiento = $this->input->post('tipo_asentamiento');
            $nombre_asentamiento = $this->input->post('nombre_asentamiento', true);
            $nombre = $this->input->post('inputNombre', true);
            $siglas = $this->input->post('siglas', true);
            $tipo_vialidad = $this->input->post('tipo_vialidad');
            $nombre_vialidad = $this->input->post('nombre_vialidad', true);
            $num_interior = $this->input->post('num_interior');
            $num_exterior = $this->input->post('num_exterior');
            /* $codigo_postal = $this->input->post('codigo_postal');*/
            $inputNumTel = $this->input->post('phone');
            $extension = $this->input->post('ext');
            $email = $this->input->post('email', true);
            $notas = $this->input->post('notas', true);
            $checkboxOficina = $this->input->post('checkboxOficina');
            $horarios_ = $this->input->post('horarios');

            $data = array(
                'ID_sujeto' => $sujeto,
                'ID_municipio' => $municipio,
                'ID_localidad' => $localidad,
                'ID_nAsentamiento' => $nombre_asentamiento,
                'created_by' => $id,
                'nombre' => $nombre,
                'siglas' => $siglas,
                'ID_vialidad' => $tipo_vialidad,
                'tipo_asentamiento' => $tipo_asentamiento,
                'nombre_vialidad' => $nombre_vialidad,
                'Num_interior' => $num_interior,
                'Num_Exterior' => $num_exterior,
                'NumTel_Oficial' => $inputNumTel,
                'extension' => $extension,
                'Correo_Elec' => $email,
                'Notas' => $notas,
                'checkOficina' => $checkboxOficina == 'on' ? '1' : '0',
                'status' => 1
            );

            // Verificar que los horarios estén completos antes de insertar la oficina
            if (!empty($horarios_)) {
                $horarios = json_decode($horarios_);
                $dias_ingresados = array(); // Array para llevar un registro de los días ingresados

                foreach ($horarios as $horario) {
                    $dias = $horario->dia;
                    $aperturas = $horario->apertura;
                    $cierres = $horario->cierre;

                    // Si falta algún dato de apertura o cierre, mostrar mensaje de error
                    if (empty($aperturas) || empty($cierres)) {
                        $response = array('status' => 'error', 'message' => 'Falta información en horarios de atención en los campos de apertura o cierre.');
                        echo json_encode($response);
                        return;
                    }

                    // Verificar si el día ya ha sido ingresado
                    if (in_array($dias, $dias_ingresados)) {
                        $response = array('status' => 'error', 'message' => 'El día ' . $dias . ' ya ha sido ingresado.');
                        echo json_encode($response);
                        return;
                    }

                    // Agregar el día al array de días ingresados
                    $dias_ingresados[] = $dias;
                }
            }

            $id_unidad = $this->MenuModel->insertar_unidad($data);

            // Insertar los horarios de la unidad administrativa
            $horarios_ = $this->input->post('horarios');
            if (!empty($horarios_)) {
                $horarios = json_decode($horarios_);
                foreach ($horarios as $horario) {
                    $dias = $horario->dia;
                    $aperturas = $horario->apertura;
                    $cierres = $horario->cierre;

                    // Insertar el horario en la tabla de_horarios y obtener el ID insertado
                    $id_horario = $this->MenuModel->insertarHorario($dias, $aperturas, $cierres);

                    // Insertar una nueva fila en la tabla rel_unidad_horario
                    $this->MenuModel->insertarRelacionUnidadHorario($id_unidad, $id_horario);
                }
            }

            $response = array('status' => 'success', 'redirect_url' => 'menu_unidades');
            echo json_encode($response);
        } else {
            $response = array('status' => 'error', 'errores' => $this->form_validation->error_array());
            echo json_encode($response);
        }
    }

    public function eliminar_unidad($id)
    {
        $this->MenuModel->ocultarUnidad($id);
    }

    public function editar_unidad($encoded_id)
    {
        $id = base64_decode($encoded_id);
        if (!is_numeric($id)) {
            // Redirige a la página de autenticación si el ID no es un número
            redirect('home', 'refresh');
        }
        $user = $this->ion_auth->user()->row();
        $group = $this->ion_auth->get_users_groups($user->id)->row();
        $groupName = $group->name;
        $iduser = $user->id;
        $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsgroups($groupName);
        $data['sujetos'] = $this->MenuModel->getSujetosObligados();
        $data['vialidades'] = $this->MenuModel->getCatVialidades();
        $data['municipios'] = $this->MenuModel->getCatMunicipios();
        $data['localidades'] = $this->MenuModel->getCatLocalidades();
        $data['unidades'] = $this->MenuModel->getUnidad($id);
        $data['horarios'] = $this->MenuModel->obtenerHorariosUnidad($id);
        $data['asentamientos'] = $this->MenuModel->getCatAsentamientos();

        if ($this->ion_auth->in_group('sujeto_obligado')) {
            $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsId($iduser);
            $this->blade->render('menuSujeto/editar-unidad', $data);
        } elseif ($this->ion_auth->in_group('sedeco') || $this->ion_auth->in_group('admin')) {
            $this->blade->render('menuAdmin/editar-unidad', $data);
        } elseif ($this->ion_auth->in_group('consejeria')) {
            $this->blade->render('menuSupervisor/editar-unidad', $data);
        } else {
            // Si el usuario no pertenece a ninguno de los grupos anteriores, redirige a la página de inicio de sesión
            redirect('auth/logout', 'refresh');
        }
    }

    public function actualizar_unidad()
    {
        $this->form_validation->set_rules(
            'inputNombre',
            'Nombre',
            'trim|required|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s,\.]+$/]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'regex_match' => 'El campo %s solo puede contener letras, espacios, comas y puntos.'
            )
        );
        $this->form_validation->set_rules(
            'siglas',
            'Siglas',
            'required|alpha',
            array(
                'required' => 'El campo %s es obligatorio.',
                'alpha' => 'El campo %s solo puede contener letras'
            )
        );
        $this->form_validation->set_rules(
            'num_exterior',
            'Número exterior',
            'required|max_length[5]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'max_length' => 'El campo %s no debe exceder los 5 caracteres.'
            )
        );
        /*$this->form_validation->set_rules(
            'codigo_postal',
            'Código postal',
            'required|exact_length[5]|numeric|greater_than_equal_to[0]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'exact_length' => 'El campo %s debe tener 5 dígitos.',
                'numeric' => 'El campo %s solo puede contener números.',
                'greater_than_equal_to' => 'El campo %s no puede ser negativo.'
            )
        );*/
        $this->form_validation->set_rules(
            'phone',
            'Número de teléfono oficial',
            'required|regex_match[/^\(\d{3}\) \d{3}-\d{4}$/]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'regex_match' => 'El campo %s no tiene el formato correcto. Ejemplo: (123) 456-7890'
            )
        );
        $this->form_validation->set_rules(
            'ext',
            'Extensión',
            'trim|regex_match[/^[0-9]*$/]|max_length[6]|min_length[2]',
            array(
            'numeric' => 'El campo %s debe ser numérico.',
            'max_length' => 'El campo %s no debe exceder los 6 caracteres.',
            'min_length' => 'El campo %s debe tener al menos 2 caracteres.',
            )
        );
        $this->form_validation->set_rules('email', 'Correo electrónico', 'required');
        $this->form_validation->set_rules('sujeto', 'Sujeto Obligado', 'required');
        $this->form_validation->set_rules('tipo_vialidad', 'Tipo vialidad', 'required');
        $this->form_validation->set_rules(
            'nombre_vialidad',
            'Nombre vialidad',
            'trim|required|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s,\.0-9ºª]+$/]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'regex_match' => 'El campo %s solo puede contener letras, números, espacios, comas, puntos y abreviaturas comunes.'
            )
        );

        if ($this->form_validation->run() != FALSE) {

            $id_unidad = $this->input->post('id_unidad');
            $sujeto = $this->input->post('sujeto');
            $municipio = $this->input->post('municipio');
            $localidad = $this->input->post('localidad');
            $tipo_asentamiento = $this->input->post('tipo_asentamiento');
            $nombre_asentamiento = $this->input->post('nombre_asentamiento', true);
            $nombre = $this->input->post('inputNombre', true);
            $siglas = $this->input->post('siglas', true);
            $tipo_vialidad = $this->input->post('tipo_vialidad');
            $nombre_vialidad = $this->input->post('nombre_vialidad', true);
            $num_interior = $this->input->post('num_interior');
            $num_exterior = $this->input->post('num_exterior');
            //$codigo_postal = $this->input->post('codigo_postal');
            $inputNumTel = $this->input->post('phone');
            $extension = $this->input->post('ext');
            $email = $this->input->post('email', true);
            $notas = $this->input->post('notas', true);
            $checkboxOficina = $this->input->post('checkboxOficina');
            $horarios_ = $this->input->post('horarios');

            $data = array(
                'ID_sujeto' => $sujeto,
                'ID_municipio' => $municipio,
                'ID_localidad' => $localidad,
                'ID_nAsentamiento' => $nombre_asentamiento,
                'nombre' => $nombre,
                'siglas' => $siglas,
                'ID_vialidad' => $tipo_vialidad,
                'tipo_asentamiento' => $tipo_asentamiento,
                'nombre_vialidad' => $nombre_vialidad,
                'Num_interior' => $num_interior,
                'Num_Exterior' => $num_exterior,
                'NumTel_Oficial' => $inputNumTel,
                'extension' => $extension,
                'Correo_Elec' => $email,
                'Notas' => $notas,
                'checkOficina' => $checkboxOficina == 'on' ? '1' : '0',
            );

            // Eliminar los horarios de la unidad administrativa
            $horariosEliminados_ = $this->input->post('horariosEliminados');
            if (!empty($horariosEliminados_)) {
                $horariosEliminados_ = json_decode($horariosEliminados_);
                foreach ($horariosEliminados_ as $idhorario) {
                    $this->MenuModel->eliminarHorarios($idhorario);
                }
            }

            // Verificar que los horarios estén completos antes de insertar la oficina
            if (!empty($horarios_)) {
                $horarios = json_decode($horarios_);
                $dias_ingresados = array(); // Array para llevar un registro de los días ingresados

                foreach ($horarios as $horario) {
                    $dias = $horario->dia;
                    $aperturas = $horario->apertura;
                    $cierres = $horario->cierre;

                    // Si falta algún dato de apertura o cierre, mostrar mensaje de error
                    if (empty($aperturas) || empty($cierres)) {
                        $response = array('status' => 'error', 'message' => 'Falta información en horarios de atención en los campos de apertura o cierre.');
                        echo json_encode($response);
                        return;
                    }

                    // Verificar si el día ya ha sido ingresado
                    if (in_array($dias, $dias_ingresados)) {
                        $response = array('status' => 'error', 'message' => 'El día ' . $dias . ' ya ha sido ingresado.');
                        echo json_encode($response);
                        return;
                    }

                    // Agregar el día al array de días ingresados
                    $dias_ingresados[] = $dias;
                }

                // Insertar los nuevos horarios
                foreach ($horarios as $horario) {
                    $id_horario = $this->MenuModel->insertarHorario($horario->dia, $horario->apertura, $horario->cierre);
                    $this->MenuModel->insertarRelacionUnidadHorario($id_unidad, $id_horario);
                }
            }

            $this->MenuModel->actualizar_unidad($id_unidad, $data);

            $response = array('status' => 'success');
            echo json_encode($response);

        } else {
            $response = array('status' => 'error', 'errores' => $this->form_validation->error_array());
            echo json_encode($response);
        }
    }

    public function agregar_sujeto()
    {
        $user = $this->ion_auth->user()->row();
        $group = $this->ion_auth->get_users_groups($user->id)->row();
        $groupName = $group->name;
        $id = $user->id;
        $data['materias'] = $this->MenuModel->getCatMaterias();
        $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsgroups($groupName);
        if ($this->ion_auth->in_group('sujeto_obligado')) {
            $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotifications($id);
            $this->blade->render('menuSujeto/agregar-sujeto', $data);
        } elseif ($this->ion_auth->in_group('sedeco') || $this->ion_auth->in_group('admin')) {
            $this->blade->render('menuAdmin/agregar-sujeto', $data);
        } elseif ($this->ion_auth->in_group('consejeria')) {
            $this->blade->render('menuSupervisor/agregar-sujeto', $data);
        } else {
            // Si el usuario no pertenece a ninguno de los grupos anteriores, redirige a la página de inicio de sesión
            redirect('auth/login', 'refresh');
        }
    }

    public function insertar_SujetoObligado()
    {
        $this->form_validation->set_rules(
            'inputSujetos',
            'Sujeto obligado',
            'trim|required|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s,\.]+$/]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'regex_match' => 'El campo %s solo puede contener letras, espacios, comas y puntos.'
            )
        );
        //$this->form_validation->set_rules('TipoSujeto', 'Tipo sujeto', 'required');
        $this->form_validation->set_rules(
            'inputSiglas',
            'Siglas',
            'required|regex_match[/^[a-zA-Z ]*$/]',
            array('required' => 'El campo %s es obligatorio.', 'regex_match' => 'El campo %s solo puede contener letras')
        );
        $this->form_validation->set_rules(
            'inputMateria',
            'Materia',
            'required',
        );


        if ($this->form_validation->run() != FALSE) {
            //$tipo = $this->input->post('TipoSujeto');
            $sujeto = $this->input->post('inputSujetos', true);
            $siglas = $this->input->post('inputSiglas', true);
            $materia = $this->input->post('inputMateria', true);
            $estado = $this->input->post('inputEstado', true);

            $data = array(
                //'ID_tipoSujeto' => $tipo,
                'nombre_sujeto' => $sujeto,
                'estado' => $estado,
                'siglas' => $siglas,
                'id_materia' => $materia,
                'status' => 1
            );

            $this->MenuModel->insertar_sujeto($data);

            $response = array('status' => 'success', 'redirect_url' => 'menu_sujeto');
            echo json_encode($response);
        } else {
            $response = array('status' => 'error', 'errores' => $this->form_validation->error_array());
            echo json_encode($response);
        }
    }

    public function editar_sujeto($encoded_id)
    {
        $id = base64_decode($encoded_id);
        if (!is_numeric($id)) {
            // Redirige a la página de autenticación si el ID no es un número
            redirect('home', 'refresh');
        }

        $user = $this->ion_auth->user()->row();
        $group = $this->ion_auth->get_users_groups($user->id)->row();
        $groupName = $group->name;
        $iduser = $user->id;
        $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsgroups($groupName);
        $data['materias'] = $this->MenuModel->getCatMaterias();
        $data['sujeto'] = $this->MenuModel->getSujeto($id);

        if ($this->ion_auth->in_group('sujeto_obligado')) {
            $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotifications($iduser);
            $this->blade->render('menuSujeto/editar-sujeto', $data);
        } elseif ($this->ion_auth->in_group('sedeco') || $this->ion_auth->in_group('admin')) {
            $this->blade->render('menuAdmin/editar-sujeto', $data);
        } elseif ($this->ion_auth->in_group('consejeria')) {
            $this->blade->render('menuSupervisor/editar-sujeto', $data);
        } else {
            // Si el usuario no pertenece a ninguno de los grupos anteriores, redirige a la página de inicio de sesión
            redirect('auth/login', 'refresh');
        }
    }

    public function eliminar_sujeto($id)
    {
        $this->MenuModel->eliminarSujeto($id);
    }

    public function actualizar_sujeto()
    {
        $this->form_validation->set_rules(
            'inputSujetos',
            'Sujeto obligado',
            'trim|required|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s,\.]+$/]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'regex_match' => 'El campo %s solo puede contener letras, espacios, comas y puntos.'
            )
        );
        //$this->form_validation->set_rules('TipoSujeto', 'Tipo sujeto', 'required');
        $this->form_validation->set_rules(
            'inputSiglas',
            'Siglas',
            'required|regex_match[/^[a-zA-Z ]*$/]',
            array('required' => 'El campo %s es obligatorio.', 'regex_match' => 'El campo %s solo puede contener letras')
        );
        $this->form_validation->set_rules(
            'inputMateria',
            'Materia',
            'required'
        );

        if ($this->form_validation->run() != FALSE) {
            $id_sujeto = $this->input->post('ID_sujeto');
            //$tipo = $this->input->post('TipoSujeto');
            $sujeto = $this->input->post('inputSujetos', true);
            $siglas = $this->input->post('inputSiglas', true);
            $materia = $this->input->post('inputMateria', true);
            $estado = $this->input->post('inputEstado', true);

            $data = array(
                'nombre_sujeto' => $sujeto,
                'estado' => $estado,
                'siglas' => $siglas,
                'id_materia' => $materia
            );

            $this->MenuModel->actualizar_sujeto($id_sujeto, $data);

            $response = array('status' => 'success');
            echo json_encode($response);
        } else {
            $response = array('status' => 'error', 'errores' => $this->form_validation->error_array());
            echo json_encode($response);
        }
    }
}