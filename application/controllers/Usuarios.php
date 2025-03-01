<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuarios extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UsuarioModel');
        $this->load->library('form_validation');
        if (!$this->ion_auth->logged_in()) {
            print_r($this->ion_auth->logged_in());
            redirect('auth/login', 'refresh');
        }
    }

    public function index()
    {
        $this->usuario();
    }
    public function usuario()
    {
        $data['usuarios'] = $this->UsuarioModel->getUsuarios($id = null);

        // Verifica el grupo del usuario y redirige a la vista correspondiente
        if ($this->ion_auth->in_group('sujeto_obligado')) {
            $this->blade->render('sujeto/usuarios', $data);
        } elseif ($this->ion_auth->in_group('sedeco') || $this->ion_auth->in_group('admin')) {
            $this->blade->render('admin/usuarios', $data);
        } elseif ($this->ion_auth->in_group('consejeria')) {
            $this->blade->render('consejeria/usuarios', $data);
        } else {
            // Si el usuario no pertenece a ninguno de los grupos anteriores, redirige a la página de inicio de sesión
            redirect('auth/login', 'refresh');
        }
    }

    public function agregar_usuario()
    {
        $data['roles'] = $this->UsuarioModel->getRoles();
        $data['sujetos'] = $this->UsuarioModel->getSujetosObligados();
        $data['tipos'] = $this->UsuarioModel->getTipoSujetoObligado();
        $data['unidades'] = $this->UsuarioModel->getUnidadesAdministrativas();

        // Verifica el grupo del usuario y redirige a la vista correspondiente
        if ($this->ion_auth->in_group('sujeto_obligado')) {
            $this->blade->render('sujeto/agregar-usuario', $data);
        } elseif ($this->ion_auth->in_group('sedeco')) {
            $this->blade->render('admin/agregar-usuario', $data);
        } elseif ($this->ion_auth->in_group('consejeria')) {
            $this->blade->render('consejeria/agregar-usuario', $data);
        } else {
            // Si el usuario no pertenece a ninguno de los grupos anteriores, redirige a la página de inicio de sesión
            redirect('auth/login', 'refresh');
        }
    }

    public function insertar()
    {
        // Define las reglas de validación
        $this->form_validation->set_rules(
            'inputNombreUsuario',
            'Nombre',
            'required|regex_match[/^[a-zA-Z ]*$/]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'regex_match' => 'El campo %s solo puede contener letras'
            )
        );
        $this->form_validation->set_rules(
            'inputApellidoPaterno',
            'Apellido Paterno',
            'required|regex_match[/^[a-zA-Z]*$/]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'regex_match' => 'El campo %s solo puede contener letras'
            )
        );
        $this->form_validation->set_rules(
            'inputCorreo',
            'Correo Electrónico',
            'required|valid_email|trim|is_unique[ma_usuario.Correo_Electronico]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'valid_email' => 'Por favor, introduce una dirección de correo electrónico válida.',
                'is_unique' => 'El correo electrónico ya está registrado.'
            )
        );
        $this->form_validation->set_rules('inputFechaAlto', 'Fecha de alta', 'required');
        $this->form_validation->set_rules('inputNumTel', 'Número de teléfono', 'required|regex_match[/^\(\d{3}\) \d{3}-\d{4}$/]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'regex_match' => 'El campo %s debe tener el formato (123) 456-7890'
            )
        );
        $this->form_validation->set_rules('selectRoles', 'Rol', 'required');
        $this->form_validation->set_rules('selectTipoSujeto', 'Tipo de sujeto', 'required');
        $this->form_validation->set_rules('selectSujetos', 'Sujeto obligado', 'required');
        $this->form_validation->set_rules('selectUnidades', 'Unidad administrativa', 'required');

        if ($this->form_validation->run() != FALSE) {
            $selectRoles = $this->input->post('selectRoles');
            $selectTipoSujeto = $this->input->post('selectTipoSujeto');
            $selectSujetos = $this->input->post('selectSujetos');
            $selectUnidades = $this->input->post('selectUnidades');
            $inputApellidoPaterno = $this->input->post('inputApellidoPaterno');
            $inputApellidoMaterno = $this->input->post('inputApellidoMaterno');
            $inputNombreUsuario = $this->input->post('inputNombreUsuario');
            $inputCorreo = $this->input->post('inputCorreo');
            $inputFechaAlto = $this->input->post('inputFechaAlto');
            $inputNumTel = $this->input->post('inputNumTel');
            $inputExtension = $this->input->post('inputExtension');
            $inputCargoServidorPublico = $this->input->post('inputCargoServidorPublico');
            $inputTitulo = $this->input->post('inputTitulo');
            $inputNumeroEmpleado = $this->input->post('inputNumeroEmpleado');

            // Recoge los datos del formulario
            $data = array(
                'ID_rol' => $selectRoles,
                'ID_sujeto' => $selectSujetos,
                'ID_tipoSujeto' => $selectTipoSujeto,
                'ID_unidad' => $selectUnidades,
                'Apellido_Paterno' => $inputApellidoPaterno,
                'Apellido_Materno' => $inputApellidoMaterno,
                'Nombre' => $inputNombreUsuario,
                'Correo_Electronico' => $inputCorreo,
                'Fecha_Cargo_ROM' => $inputFechaAlto,
                'Num_Tel' => $inputNumTel,
                'Extension' => $inputExtension,
                'cargo' => $inputCargoServidorPublico,
                'titulo' => $inputTitulo,
                'clave_Empleado' => $inputNumeroEmpleado,
                'Estatus' => 1
            );

            // Inserta los datos en la base de datos
            $this->UsuarioModel->insertar($data);
            $response = array('status' => 'success', 'redirect_url' => 'usuario');
            echo json_encode($response);
        } else {
            $response = array('status' => 'error', 'errores' => $this->form_validation->error_array());
            echo json_encode($response);
        }
    }


    public function editar($id)
    {
        $data['usuario'] = $this->UsuarioModel->getUsuarios($id);
        $data['roles'] = $this->UsuarioModel->getRoles();
        $data['unidades'] = $this->UsuarioModel->getUnidadesAdministrativas();
        $data['sujetos'] = $this->UsuarioModel->getSujetosObligados();
        $data['tipos'] = $this->UsuarioModel->getTipoSujetoObligado();

        if ($this->ion_auth->in_group('sujeto_obligado')) {
            $this->blade->render('sujeto/editar-usuario', $data);
        } elseif ($this->ion_auth->in_group('sedeco')) {
            $this->blade->render('admin/editar-usuario', $data);
        } elseif ($this->ion_auth->in_group('consejeria')) {
            $this->blade->render('consejeria/editar-usuario', $data);
        } else {
            // Si el usuario no pertenece a ninguno de los grupos anteriores, redirige a la página de inicio de sesión
            redirect('auth/login', 'refresh');
        }
    }

    public function eliminar($id)
    {
        $this->UsuarioModel->eliminar($id);
        redirect('usuarios');
    }

    public function actualizar()
    {

        // Define las reglas de validación
        $this->form_validation->set_rules(
            'inputNombreUsuario',
            'Nombre',
            'required|regex_match[/^[a-zA-Z ]*$/]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'regex_match' => 'El campo %s solo puede contener letras'
            )
        );
        $this->form_validation->set_rules(
            'inputApellidoPaterno',
            'Apellido Paterno',
            'required|regex_match[/^[a-zA-Z]*$/]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'regex_match' => 'El campo %s solo puede contener letras'
            )
        );
        $this->form_validation->set_rules(
            'inputCorreo',
            'Correo Electrónico',
            'required|valid_email|trim',
            array(
                'required' => 'El campo %s es obligatorio.',
                'valid_email' => 'Por favor, introduce una dirección de correo electrónico válida.'
            )
        );
        $this->form_validation->set_rules('inputFechaAlto', 'Fecha de alta', 'required');
        $this->form_validation->set_rules(
            'inputNumTel',
            'Número de teléfono',
            'required|regex_match[/^\(\d{3}\) \d{3}-\d{4}$/]',
            array(
                'required' => 'El campo %s es obligatorio.',
                'regex_match' => 'El campo %s debe tener el formato (123) 456-7890'
            )
        );
        $this->form_validation->set_rules('selectRoles', 'Rol', 'required');
        $this->form_validation->set_rules('selectTipoSujeto', 'Tipo de sujeto', 'required');
        $this->form_validation->set_rules('selectSujetoObligado', 'Sujeto obligado', 'required');
        $estatus = $this->input->post('selectEstatus') === 'Activo' ? true : false;
        $id = $this->input->post('ID_Usuario');

        if ($this->form_validation->run() != FALSE) {
            $selectRoles = $this->input->post('selectRoles');
            $selectTipoSujeto = $this->input->post('selectTipoSujeto');
            $selectSujetos = $this->input->post('selectSujetoObligado');
            $selectUnidades = $this->input->post('selectUnidad');
            $inputApellidoPaterno = $this->input->post('inputApellidoPaterno');
            $inputApellidoMaterno = $this->input->post('inputApellidoMaterno');
            $inputNombreUsuario = $this->input->post('inputNombreUsuario');
            $inputCorreo = $this->input->post('inputCorreo');
            $inputFechaAlto = $this->input->post('inputFechaAlto');
            $inputNumTel = $this->input->post('inputNumTel');
            $inputExtension = $this->input->post('inputExtension');
            $inputCargoServidorPublico = $this->input->post('inputCargoServidorPublico');
            $inputTitulo = $this->input->post('inputTitulo');
            $inputNumeroEmpleado = $this->input->post('inputNumeroEmpleado');

            $data = array(
                'ID_rol' => $selectRoles,
                'ID_sujeto' => $selectSujetos,
                'ID_tipoSujeto' => $selectTipoSujeto,
                'ID_unidad' => $selectUnidades,
                'Apellido_Paterno' => $inputApellidoPaterno,
                'Apellido_Materno' => $inputApellidoMaterno,
                'Nombre' => $inputNombreUsuario,
                'Correo_Electronico' => $inputCorreo,
                'Fecha_Cargo_ROM' => $inputFechaAlto,
                'Num_Tel' => $inputNumTel,
                'Extension' => $inputExtension,
                'cargo' => $inputCargoServidorPublico,
                'titulo' => $inputTitulo,
                'clave_Empleado' => $inputNumeroEmpleado,
                'Estatus' => $estatus
            );

            $this->UsuarioModel->actualizar($id, $data);

            $response = array('status' => 'success');
            echo json_encode($response);
        } else {
            $response = array('status' => 'error', 'errores' => $this->form_validation->error_array());
            echo json_encode($response);
        }
    }
}
