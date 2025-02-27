<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('America/Mexico_City');
class Oficinas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('OficinaModel');
        $this->load->model('NotificacionesModel');
        $this->load->library('form_validation');
        $this->load->helper('security');
        if (!$this->ion_auth->logged_in()) {
            print_r($this->ion_auth->logged_in());
            redirect('auth/login', 'refresh');
        }
    }

    public function index()
    {
        $this->oficina();
    }

    public function oficina()
    {
        $user = $this->ion_auth->user()->row();
        $group = $this->ion_auth->get_users_groups($user->id)->row();
        $groupName = $group->name;
        $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsgroups($groupName);
        $data["oficinas"] = $this->OficinaModel->getOficinas();

        // Verifica el grupo del usuario y redirige a la vista correspondiente
        if ($this->ion_auth->in_group('sujeto_obligado')) {
            $this->blade->render('sujeto/oficinas', $data);
        } elseif ($this->ion_auth->in_group('sedeco') || $this->ion_auth->in_group('admin')) {
            $this->blade->render('admin/oficinas', $data);
        } elseif ($this->ion_auth->in_group('consejeria')) {
            $this->blade->render('consejeria/oficinas', $data);
        } else {
            // Si el usuario no pertenece a ninguno de los grupos anteriores, redirige a la página de inicio de sesión
            redirect('auth/login', 'refresh');
        }
    }

    public function agregar_oficina()
    {
        $this->load->model('NotificacionesModel');
        $user = $this->ion_auth->user()->row();
        $group = $this->ion_auth->get_users_groups($user->id)->row();
        $groupName = $group->name;
        $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsgroups($groupName);
        $data['sujetos'] = $this->OficinaModel->getSujetosObligados();
        $data['unidades'] = $this->OficinaModel->getUnidadAdministrativa();
        $data['vialidades'] = $this->OficinaModel->getCatVialidades();
        $data['municipios'] = $this->OficinaModel->getCatMunicipios();
        $data['localidades'] = $this->OficinaModel->getCatLocalidades();
        $data['asentamientos'] = $this->OficinaModel->getCatAsentamientos();

        // Verifica el grupo del usuario y redirige a la vista correspondiente
        if ($this->ion_auth->in_group('sujeto_obligado')) {
            $this->blade->render('sujeto/agregar-oficina', $data);
        } elseif ($this->ion_auth->in_group('sedeco') || $this->ion_auth->in_group('admin')) {
            $this->blade->render('admin/agregar-oficina', $data);
        } elseif ($this->ion_auth->in_group('consejeria')) {
            $this->blade->render('consejeria/agregar-oficina', $data);
        } else {
            // Si el usuario no pertenece a ninguno de los grupos anteriores, redirige a la página de inicio de sesión
            redirect('auth/login', 'refresh');
        }
    }

    public function get_unidades_by_sujeto($sujeto_id)
    {
        $user = $this->ion_auth->user()->row();
        $user_id = $user->id;
        $unidades = $this->OficinaModel->getUnidadesBySujeto($sujeto_id, $user_id);
        echo json_encode($unidades);
    }

    public function insertar()
    {
        $this->form_validation->set_rules(
            'inputNombre',
            'Nombre',
            'trim|required|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s,\.]+$/]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'regex_match' => 'El campo %s solo puede contener letras, comas y puntos.'
            )
        );
        $this->form_validation->set_rules(
            'siglas',
            'Siglas',
            'required|regex_match[/^[a-zA-Z]*$/]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'regex_match' => 'El campo %s solo puede contener letras y no puede tener espacios ni caracteres numéricos.'
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
        /*
        $this->form_validation->set_rules(
            'codigo_postal',
            'Código postal',
            'required|exact_length[5]|numeric|greater_than_equal_to[0]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'exact_length' => 'El campo %s debe tener 5 dígitos.',
                'numeric' => 'El campo %s solo puede contener números.',
                'greater_than_equal_to' => 'El campo %s no puede ser negativo.'
            )
        );
        */
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
            'extension',
            'trim|regex_match[/^[1-9]*$/]|max_length[6]|min_length[2]',
            array(
            'numeric' => 'El campo %s debe ser numérico.',
            'max_length' => 'El campo %s no debe exceder los 6 caracteres.',
            'min_length' => 'El campo %s debe tener al menos 2 caracteres.',
            'regex_match' => 'El campo %s no debe contener el número 0.'
            )
        );
        $this->form_validation->set_rules('email', 'Correo electrónico', 'trim|required|valid_email');
        $this->form_validation->set_rules('sujeto', 'Sujeto Obligado', 'required');
        $this->form_validation->set_rules('unidad', 'Unidad administrativa', 'required');
        $this->form_validation->set_rules('tipo_vialidad', 'Tipo vialidad', 'required');
        $this->form_validation->set_rules(
            'inputVialidad',
            'Nombre vialidad',
            'trim|required|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s,\.\d]+$/]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'regex_match' => 'El campo %s solo puede contener letras, comas y puntos.'
            )
        );
        $this->form_validation->set_rules('localidad', 'Localidad', 'required');
        $this->form_validation->set_rules('tipo_asentamiento', 'Tipo asentamiento', 'required');
        $this->form_validation->set_rules('nombre_asentamiento', 'Nombre asentamiento', 'required');

        if ($this->form_validation->run() != FALSE) {
            $sujeto = $this->input->post('sujeto');
            $unidad = $this->input->post('unidad');
            $localidad = $this->input->post('localidad');
            $tipo_asentamiento = $this->input->post('tipo_asentamiento');
            $nombre_asentamiento = $this->input->post('nombre_asentamiento', true);
            $tipo_vialidad = $this->input->post('tipo_vialidad');
            $municipio = $this->input->post('municipio');
            $nombre = $this->input->post('inputNombre', true);
            $siglas = $this->input->post('siglas', true);
            $nombre_vialidad = $this->input->post('inputVialidad', true);
            $num_interior = $this->input->post('num_interior');
            $num_exterior = $this->input->post('num_exterior');
            /* $codigo_postal = $this->input->post('codigo_postal');*/
            $inputNumTel = $this->input->post('phone');
            $extension = $this->input->post('ext');
            $email = $this->input->post('email', true);
            $notas = $this->input->post('notas', true);
            $horarios_ = $this->input->post('horarios');

            $data = array(
                'ID_sujeto' => $sujeto,
                'ID_unidad' => $unidad,
                'ID_localidad' => $localidad,
                'ID_nAsentamiento' => $nombre_asentamiento,
                'ID_vialidad' => $tipo_vialidad,
                'ID_municipio' => $municipio,
                'nombre' => $nombre,
                'tipo' => 'oficina',
                'Siglas' => $siglas,
                'tipo_asentamiento' => $tipo_asentamiento,
                'Nombre_Vialidad' => $nombre_vialidad,
                'Num_interior' => $num_interior,
                'Num_Exterior' => $num_exterior,
                /* 'c_p' => $codigo_postal,*/
                'NumTel_Oficial' => $inputNumTel,
                'Extension' => $extension,
                'Correo_Elec' => $email,
                'Notas' => $notas,
                'status' => 1,
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

            // Insertar la oficina después de validar los horarios
            $id_oficina = $this->OficinaModel->insertar_oficina($data);

            if (!empty($horarios_)) {
                $horarios = json_decode($horarios_);
                foreach ($horarios as $horario) {
                    $dias = $horario->dia;
                    $aperturas = $horario->apertura;
                    $cierres = $horario->cierre;

                    $id_horario = $this->OficinaModel->insertar_horario($dias, $aperturas, $cierres);

                    // Asociar la oficina con el horario de atención en la tabla rel_oficina_horario
                    $this->OficinaModel->asociar_oficina_horario($id_oficina, $id_horario);
                }
            }

            $response = array('status' => 'success', 'redirect_url' => 'index');
            echo json_encode($response);
        } else {
            $response = array('status' => 'error', 'errores' => $this->form_validation->error_array());
            echo json_encode($response);
        }
    }

    public function editar($encoded_id)
    {
        $id = base64_decode($encoded_id);
        if (!is_numeric($id)) {
            // Redirige a la página de autenticación si el ID no es un número
            redirect('home', 'refresh');
        }
        $this->load->model('NotificacionesModel');
        $user = $this->ion_auth->user()->row();
        $idUser = $user->id;
        $group = $this->ion_auth->get_users_groups($user->id)->row();
        $groupName = $group->name;
        $data['unread_notifications'] = $this->NotificacionesModel->countUnreadNotificationsgroups($groupName);
        $data['oficinas'] = $this->OficinaModel->getOficinaEditar($id);
        $data['horarios'] = $this->OficinaModel->getHorariosOficina($id);
        $data['sujetos'] = $this->OficinaModel->getSujetosObligados();
        $data['unidades'] = $this->OficinaModel->getUnidadAdministrativaByUser($idUser);
        $data['vialidades'] = $this->OficinaModel->getCatVialidades();
        $data['municipios'] = $this->OficinaModel->getCatMunicipios();
        $data['localidades'] = $this->OficinaModel->getCatLocalidades();
        $data['asentamientos'] = $this->OficinaModel->getCatAsentamientos();

        // Verifica el grupo del usuario y redirige a la vista correspondiente
        if ($this->ion_auth->in_group('sujeto_obligado')) {
            $this->blade->render('sujeto/editar-oficina', $data);
        } elseif ($this->ion_auth->in_group('sedeco') || $this->ion_auth->in_group('admin')) {
            $this->blade->render('admin/editar-oficina', $data);
        } elseif ($this->ion_auth->in_group('consejeria')) {
            $this->blade->render('consejeria/editar-oficina', $data);
        } else {
            // Si el usuario no pertenece a ninguno de los grupos anteriores, redirige a la página de inicio de sesión
            redirect('auth/login', 'refresh');
        }
    }


    public function eliminar($id)
    {
        $this->OficinaModel->ocultarOficina($id);
        redirect('oficinas/index');
    }

    public function actualizar()
    {
        $this->form_validation->set_rules(
            'inputNombre',
            'Nombre',
            'trim|required|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s,\.]+$/]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'regex_match' => 'El campo %s solo puede contener letras, comas y puntos.'
            )
        );
        $this->form_validation->set_rules(
            'siglas',
            'Siglas',
            'required|regex_match[/^[a-zA-Z]*$/]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'regex_match' => 'El campo %s solo puede contener letras y no puede tener espacios ni caracteres numéricos.'
            )
        );
        $this->form_validation->set_rules(
            'num_exterior',
            'Número exterior',
            'required|max_length[6]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'max_length' => 'El campo %s no debe exceder los 6 caracteres.'
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
            'número de teléfono',
            'required|regex_match[/^\(\d{3}\) \d{3}-\d{4}$/]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'regex_match' => 'El campo %s no tiene el formato correcto. Ejemplo: (123) 456-7890'
            )
        );
        $this->form_validation->set_rules(
            'ext',
            'extension',
            'trim|regex_match[/^[1-9]*$/]|max_length[6]|min_length[2]',
            array(
            'numeric' => 'El campo %s debe ser numérico.',
            'max_length' => 'El campo %s no debe exceder los 6 caracteres.',
            'min_length' => 'El campo %s debe tener al menos 2 caracteres.',
            'regex_match' => 'El campo %s no debe contener el número 0.'
            )
        );
        $this->form_validation->set_rules('email', 'Correo electrónico', 'trim|required|valid_email');
        $this->form_validation->set_rules('sujeto', 'Sujeto Obligado', 'required');
        $this->form_validation->set_rules('unidad', 'Unidad administrativa', 'required');
        $this->form_validation->set_rules('tipo_vialidad', 'Tipo de vialidad', 'required');
        $this->form_validation->set_rules(
            'inputVialidad',
            'Nombre de vialidad',
            'trim|required|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s,\.\d]+$/]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'regex_match' => 'El campo %s solo puede contener letras, comas y puntos.'
            )
        );


        if ($this->form_validation->run() != FALSE) {
            $sujeto = $this->input->post('sujeto');
            $unidad = $this->input->post('unidad');
            $localidad = $this->input->post('localidad');
            $tipo_asentamiento = $this->input->post('tipo_asentamiento');
            $nombre_asentamiento = $this->input->post('nombre_asentamiento', true);
            $tipo_vialidad = $this->input->post('tipo_vialidad');
            $municipio = $this->input->post('municipio');
            $nombre = $this->input->post('inputNombre', true);
            $siglas = $this->input->post('siglas', true);
            $nombre_vialidad = $this->input->post('inputVialidad', true);
            $num_interior = $this->input->post('num_interior');
            $num_exterior = $this->input->post('num_exterior');
            /* $codigo_postal = $this->input->post('codigo_postal');*/
            $inputNumTel = $this->input->post('phone');
            $extension = $this->input->post('ext');
            $email = $this->input->post('email', true);
            $notas = $this->input->post('notas', true);
            $horarios_ = ($this->input->post('horarios'));
            $horariosEliminados_ = $this->input->post('horariosEliminados');
            $id_oficina = $this->input->post('id_oficina');

            $data = array(
                'ID_sujeto' => $sujeto,
                'ID_unidad' => $unidad,
                'ID_localidad' => $localidad,
                'ID_nAsentamiento' => $nombre_asentamiento,
                'ID_vialidad' => $tipo_vialidad,
                'ID_municipio' => $municipio,
                'nombre' => $nombre,
                'Siglas' => $siglas,
                'tipo_asentamiento' => $tipo_asentamiento,
                'Nombre_Vialidad' => $nombre_vialidad,
                'Num_interior' => $num_interior,
                'Num_Exterior' => $num_exterior,
                /* 'c_p' => $codigo_postal,*/
                'NumTel_Oficial' => $inputNumTel,
                'Extension' => $extension,
                'Correo_Elec' => $email,
                'Notas' => $notas,
            );

            $this->OficinaModel->actualizar_oficina($id_oficina, $data);

            // Eliminar los horarios de la oficina
            if (!empty($horariosEliminados_)) {
                $horariosEliminados = json_decode($horariosEliminados_);
                if ($horariosEliminados != null) {
                    foreach ($horariosEliminados as $idhorario) {
                        $this->OficinaModel->eliminarHorarios($idhorario);
                    }
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
            }

            // Insertar los horarios de la oficina
            if (!empty($horarios_)) {
                $horarios = json_decode($horarios_);
                if ($horarios != null) {
                    foreach ($horarios as $horario) {
                        $dias = $horario->dia;
                        $aperturas = $horario->apertura;
                        $cierres = $horario->cierre;

                        $id_horario = $this->OficinaModel->insertar_horario($dias, $aperturas, $cierres);

                        // Asociar la oficina con el horario de atención en la tabla rel_oficina_horario
                        $this->OficinaModel->asociar_oficina_horario($id_oficina, $id_horario);
                    }
                }
            }

            $response = array('status' => 'success');
            echo json_encode($response);
        } else {
            $response = array('status' => 'error', 'errores' => $this->form_validation->error_array());
            echo json_encode($response);
        }
    }
}
